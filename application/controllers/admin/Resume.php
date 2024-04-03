<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Resume extends My_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/resume_model', 'resume_model');
		$this->load->library('datatable');
	}

	public function index()
	{
		$data['view'] = 'admin/resume/resume_list';
		$this->load->view('admin/layout', $data);
    }
   
	


	public function datatable_json()
	{				   				   
		$records = $this->resume_model->get_all_resume();
        $data = array();

        $i= 1;
        foreach ($records  as $row) 
		{
			$buttoncontroll = '
				 <a class="btn-delete btn btn-xs btn-danger" href='.base_url("admin/events/del/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> 
				 <i class="fa fa-trash-o"></i></a>';
			
			$data[]= array(
				$i++,
		     	'<a class="btn btn-xs btn-info" "href="'.base_url($row['uploads']).'" download> <i class="fa fa-file-word-o"></i></a>',
				$buttoncontroll
			);
        }

		$records['data'] = $data;
        
        echo json_encode($records);						   
    }

	public function del($id = 0)
	{
		$this->db->delete('xx_resume', array('id' => $id));
		$this->session->set_flashdata('msg', 'Resume has been deleted successfully!');
		redirect(base_url('admin/resume'));
	}
	
}
?>