<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Main_Controller{

	public function __construct(){
		parent::__construct();
		$this->rbac->check_emp_authentiction();	// checking user login session
		$this->load->model('employers/profile_model','profile_model');
		$this->load->model('employers/company_model','company_model');
	}

	//-------------------------------------------------------------------------
	public function index(){

		$data['countries'] = $this->common_model->get_countries_list(); 
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);

		if ($this->input->post('update')) {
			$emp_id = $this->session->userdata('employer_id');

			$this->form_validation->set_rules('firstname','firstname','trim|required|min_length[3]');
			$this->form_validation->set_rules('lastname','lastname','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[5]|valid_email');
			$this->form_validation->set_rules('mobile_no', 'number','trim|min_length[3]');
			$this->form_validation->set_rules('designation','designation','trim|required|min_length[3]');
			$this->form_validation->set_rules('city','city','trim|required');
			$this->form_validation->set_rules('state','state','trim|required');
			$this->form_validation->set_rules('country','country','trim|required');
			$this->form_validation->set_rules('address','address','trim|required|min_length[5]');
			
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('error_update', $data['errors']);
				redirect(base_url('employers/profile'),'refresh');
			}
			else{
				$data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'mobile_no' => $this->input->post('mobile_no'),
					'designation' => $this->input->post('designation'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'address' => $this->input->post('address'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data); // filter data through the XSS filter
				$result = $this->profile_model->update_employer($data,$emp_id);

				if ($result) {
					$this->session->set_flashdata('update_success','Personal Info has been updated successfully');
					redirect(base_url('employers/profile'));
				}
			 }
		}
		else{

			$emp_id = $this->session->userdata('employer_id');
			$data['emp_info'] = $this->profile_model->get_employer_by_id($emp_id);
			
			$data['emp_sidebar'] = 'employers/emp_sidebar'; // load sidebar for employer

			$data['title'] = 'Profile';
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'employers/profile/profile_page';
			$this->load->view('layout', $data);

		}
	}

	//--------------------------------------------------------------------------------------
	public function change_password(){
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);
		if ($this->input->post('update_password')) {

			$emp_id = $this->session->userdata('employer_id');

			$this->form_validation->set_rules('old_password','old password','trim|required|min_length[3]');
			$this->form_validation->set_rules('new_password','new password','trim|required|min_length[3]');
			$this->form_validation->set_rules('confirm_password','confirm password','trim|required|min_length[3]|matches[new_password]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_update_password', $data['errors']);
				redirect(base_url('employers/profile/change_password'),'refresh');

			}else{

				$data = array(
					'id' => $emp_id,
					'old_password' => $this->input->post('old_password'),
					'password' => $this->input->post('new_password'),
				);

				$result = $this->profile_model->update_password($data,$emp_id);
				
				if($result) {
					$this->session->set_flashdata('update_password_success','user password has been Successfully updated');
					
					redirect(base_url('employers/profile/change_password'));
				}else{
					$this->session->set_flashdata('update_password_failed','Old Password is incorrect');
					redirect(base_url('employers/profile/change_password'));
				}
			}
		}else
		{
			$emp_id = $this->session->userdata('employer_id');

			$data['title'] = 'Change Password';
			$data['layout'] = 'employers/profile/change password';
			$this->load->view('layout', $data);
		}
	}

}

?> 