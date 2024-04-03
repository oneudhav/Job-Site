<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->rbac->check_emp_authentiction();	// checking user login session (rbac is a library function)
		$this->load->model('employers/package_model', 'package_model');
		$this->load->model('employers/account_model', 'account_model');
		$this->load->model('employers/job_model', 'job_model');
		$this->load->model('employers/company_model','company_model');
	}

	//-------------------------------------------------------------------------------
	public function dashboard()
	{
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);
		$data['total_posted_jobs'] = $this->account_model->total_posted_job();
		$data['current_package'] = $this->package_model->get_active_package();

		// featured job post
		//$data['total_featured_jobs'] = $this->job_model->count_posted_jobs($data['current_package']['package_id'], 1, $data['current_package']['payment_id']);

		$data['emp_sidebar'] = 'employers/emp_sidebar'; // load sidebar for employer

		$data['title'] = 'Dashboard';
		$data['layout'] = 'employers/account/dashboard';
		$this->load->view('layout', $data);
	}

	//-------------------------------------------------------------------------------
	public function change_password()
	{	
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);
		if ($this->input->post('submit')) {

			
			$this->form_validation->set_rules('old_password','old password','trim|required|min_length[3]');
			$this->form_validation->set_rules('new_password','new password','trim|required|min_length[3]');
			$this->form_validation->set_rules('confirm_password','confirm password','trim|required|min_length[3]|matches[new_password]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_update_password', $data['errors']);
				redirect(base_url('employers/account/change_password'),'refresh');

			}else{

				$data = array(
					'id' => $emp_id,
					'old_password' => $this->input->post('old_password'),
					'password' => password_hash($this->input->post('new_password'), PASSWORD_BCRYPT),
				);

				$result = $this->account_model->update_password($data,$emp_id);
				
				if($result) {
					$this->session->set_flashdata('update_password_success','Password has been Successfully updated');
					
					redirect(base_url('employers/account/change_password'));
				}else{
					$this->session->set_flashdata('update_password_failed','Old Password is incorrect');
					redirect(base_url('employers/account/change_password'));
				}
			}
		}
		else{
			$data['emp_sidebar'] = 'employers/emp_sidebar'; // load sidebar for user
			$data['layout'] = 'employers/account/change_password_page';
			$this->load->view('layout', $data);
		}
	}

}// endClass
