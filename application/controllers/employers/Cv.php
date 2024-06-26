<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cv extends Main_Controller{

	public function __construct(){
		parent::__construct();
		$this->per_page_record = 10;
		$this->rbac->check_emp_authentiction();	// checking user login session
		$this->load->model('employers/cv_model','cv_model');
		$this->load->model('employers/company_model','company_model');
	}

	//--------------------------------------------------------------------------------------
	public function search(){

		$search = array();

		$data['countries'] = $this->common_model->get_countries_list(); 
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);

		if($this->input->post('search'))
		{
			// search job title, keyword
			if(!empty($this->input->post('job_title')))
				$search['job_title'] = make_slug($this->input->post('job_title'));

			// search job city
			if(!empty($this->input->post('country')))
				$search['country'] = $this->input->post('country');

			$query = $this->uri->assoc_to_uri($search);

			redirect(base_url('employers/cv/search/'.$query),'refresh');

		}
		$search_array = $this->uri->uri_to_assoc(4);
		$search_query = $this->uri->assoc_to_uri($search_array);

		// pagination
		$pg_arr = pagination_assoc('p', 4); // helper function

		$count = $this->cv_model->count_user_profiles($search_array);

		$offset = $pg_arr['offset'];

		$url= base_url("employers/cv/search/".$pg_arr['uri']);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = $pg_arr['seg'];	

		$this->pagination->initialize($config);

		$data['search_value'] = $search_array;
		$data['profiles'] = $this->cv_model->get_user_profiles($search_array, $this->per_page_record, $offset);

		$data['title'] = 'CV Search Result';
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'employers/cv_search/cv_search_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------
	// Shortlist Resume
	public function make_shortlist($user_id)
	{
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);
		$result = $this->cv_model->do_shortlist($emp_id, $user_id); 

		if($result){
			redirect(base_url('employers/cv/shortlisted'), 'refresh');
		}
	}

	//-----------------------------------------------------------------------------------------
	// Shortlisted Applicant
	public function shortlisted(){
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);
		$data['applicants'] = $this->cv_model->get_shortlisted_applicants(); 

		$data['emp_sidebar'] = 'employers/emp_sidebar'; // load sidebar for employer

		$data['title'] = 'Shortlisted Resume';
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'employers/applicants/shortlisted_applicants_page';
		$this->load->view('layout',$data);
	}

}

?> 