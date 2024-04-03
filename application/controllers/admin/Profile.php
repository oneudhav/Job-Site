<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/admin_model', 'admin_model');
	}

	//-------------------------------------------------------------------------
	public function index()
	{
		if($this->input->post('submit')){
			$data = array(
				'username' => $this->input->post('username'),
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'mobile_no' => $this->input->post('mobile_no'),
				'updated_at' => date('Y-m-d : h:m:s'),
			);
			
			$data = $this->security->xss_clean($data);
			$result = $this->admin_model->update_user($data);
			if($result){
				$this->session->set_flashdata('msg', 'Profile has been Updated Successfully!');
				redirect(base_url('admin/profile'), 'refresh');
			}
		}
		else{
			$data['admin'] = $this->admin_model->get_user_detail();
			$data['title'] = 'Admin Profile';
			$data['view'] = 'admin/profile/index';
			$this->load->view('admin/layout', $data);
		}
	}

	//-------------------------------------------------------------------------
	public function change_pwd()
	{
		$id = $this->session->userdata('admin_id');
		if($this->input->post('submit')){
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'trim|required|matches[password]');
			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->admin_model->get_user_detail();
				$data['view'] = 'admin/profile/change_pwd';
				$this->load->view('admin/layout', $data);
			}
			else{
				$data = array(
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
				);
				$data = $this->security->xss_clean($data);
				$result = $this->admin_model->change_pwd($data, $id);
				if($result){
					$this->session->set_flashdata('msg', 'Password has been changed successfully!');
					redirect(base_url('admin/profile/change_pwd'));
				}
			}
		}
		else{
			$data['user'] = $this->admin_model->get_user_detail();
			$data['title'] = 'Change Password';
			$data['view'] = 'admin/profile/change_pwd';
			$this->load->view('admin/layout', $data);
		}
	}
	public function addadminuser()
	{
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('username', 'username', 'trim|required');
			$this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('address', 'address', 'trim|required');	
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/profile/addadminuser';
				$this->load->view('admin/layout', $data);
			}
			else{
				$data = array(
					'username' => $this->input->post('username'),
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'mobile_no' => $this->input->post('mobile_no'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'address' => $this->input->post('address'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$new_logo = $_FILES['userfile']['name'];

				// upload admin image
				if(!empty($new_logo))
				{
					unlink($this->input->post('old_logo')); // delete old logo

					$config = array(
						'upload_path' => "./uploads/admin_img/",
						'allowed_types' => "png|jpg|jpeg",
						'overwrite' => TRUE,
						'max_size' => "548000", // Can be set to particular file size , here it is 0.5 MB(148 Kb)
						);

					$new_name = time().$_FILES["userfile"]['name'];
					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if($this->upload->do_upload())
					{
						$file_data = array('upload_data' => $this->upload->data());
						$data['admin_img'] = 'uploads/admin_img/'. $file_data['upload_data']['file_name'];
					}
					else
					{
						$data['file_error'] = array('error' => $this->upload->display_errors());
					
						$this->session->set_flashdata('file_error','Error! Please select a valid file formate');
						redirect(base_url('admin/profile/addadminuser'));
					}
				}
				else{
					$data['admin_img'] = $this->input->post('old_logo');
				}
				$data = $this->security->xss_clean($data);
				$result = $this->admin_model->addadminuser($data);
				if($result){
					$this->session->set_flashdata('msg', 'Admin User has been added successfully!');
					redirect(base_url('admin/profile/addadminuser'));
				}
			}
		}
		else{
			$data['admin'] = $this->admin_model->get_user_detail();
			$data['view'] = 'admin/profile/addadminuser';
			$this->load->view('admin/layout', $data);
		}
		
	}
}

?>	