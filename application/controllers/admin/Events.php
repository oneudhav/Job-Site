<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Events extends My_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/events_model', 'events_model');
		$this->load->library('datatable');
	}

	public function index()
	{
		$data['view'] = 'admin/events/event_list';
		$this->load->view('admin/layout', $data);
    }
    public function event_add()
	{
		
		if($this->input->post('submit')){
            $this->form_validation->set_rules('url', 'url', 'trim|required');
			$this->form_validation->set_rules('title', 'title', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/events/event_add';
				$this->load->view('admin/layout', $data);
			}
			else{
				$data = array(
                    'url' => $this->input->post('url'),
					'title' => $this->input->post('title'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$new_logo = $_FILES['userfile']['name'];

				// upload image
				if(!empty($new_logo))
				{
					unlink($this->input->post('old_logo')); // delete old logo

					$config = array(
						'upload_path' => "./uploads/events/",
						'allowed_types' => "png|jpg|jpeg",
						'overwrite' => TRUE,
						'max_size' => "548000", // Can be set to particular file size , here it is 0.5 MB(535 Kb)
						);

					$new_name = time().$_FILES["userfile"]['name'];
					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if($this->upload->do_upload())
					{
						$file_data = array('upload_data' => $this->upload->data());
						$data['img'] = 'uploads/events/'. $file_data['upload_data']['file_name'];
					}
					else
					{
						$data['file_error'] = array('error' => $this->upload->display_errors());
					
						$this->session->set_flashdata('file_error','Error! Please select a valid file formate');
						redirect(base_url('admin/events/event_add'));
					}
				}
				else{
					$data['img'] = $this->input->post('old_logo');
				}
				$data = $this->security->xss_clean($data);
				$result = $this->events_model->event_add($data);
				if($result){
					$this->session->set_flashdata('msg', 'Event has been added successfully!');
					redirect(base_url('admin/events/event_add'));
				}
			}
		}
		else{
	
			$data['view'] = 'admin/events/event_add';
			$this->load->view('admin/layout', $data);
		}
	}

	


	public function datatable_json()
	{				   				   
		$records = $this->events_model->get_all_events();
        $data = array();

        $i= 1;
        foreach ($records  as $row) 
		{
			$buttoncontroll = '
				 <a class="btn-delete btn btn-xs btn-danger" href='.base_url("admin/events/del/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> 
				 <i class="fa fa-trash-o"></i></a>';
			
			$data[]= array(
				$i++,
				'<img src="'.base_url($row['img']).'" width="80" height="30">',
				$row['title'],
				$row['url'],  
				$buttoncontroll
			);
        }

		$records['data'] = $data;
        
        echo json_encode($records);						   
	}
	public function del($id = 0)
	{
		$this->db->delete('xx_events', array('id' => $id));
		$this->session->set_flashdata('msg', 'Event has been deleted successfully!');
		redirect(base_url('admin/events'));
	}
	
}
?>