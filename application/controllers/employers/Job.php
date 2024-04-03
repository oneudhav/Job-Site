<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->rbac->check_emp_authentiction();	// checking user login session (rbac is a library function)
		$this->load->model('employers/job_model', 'job_model');
		$this->load->model('employers/package_model', 'package_model');
		$this->load->model('employers/company_model','company_model');
	}

	//------------------------------------------------------------------------
	public function expire()
	{
		$data['emp_sidebar'] = 'employers/emp_sidebar'; // load sidebar for employer
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);
		$data['title'] = 'Limit Expire';
		$data['layout'] = 'employers/jobs/limit_expire';
		$this->load->view('layout', $data);
	}

	//---------------------------------------------------------------------------------------
	public function post()
	{
		$pkg = $this->package_model->get_active_package();
		$pkg_id = $pkg['package_id'];
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);
		if(empty($pkg['package_id'])){
			$this->session->set_flashdata('expire','Click the link below to choose the best pricing for your site');
			redirect(base_url('employers/job/expire'));
			exit();
		}

		// free job post 

		// featured job post
		$total_featured_jobs = $this->job_model->count_posted_jobs($pkg_id, 1, $pkg['payment_id']);
		if($total_featured_jobs >= $pkg['no_of_posts']){
			$this->session->set_flashdata('expire','Your Featured Job Posting Limit Has Been Expired. Please renew your package');
			redirect(base_url('employers/job/expire'));
			exit();
		}

		$emp_id = $this->session->userdata('employer_id');
		$data['categories'] = $this->common_model->get_categories_list(); 
		$data['industries'] = $this->common_model->get_industries_list();
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['cities'] = $this->common_model->get_cities_list(); 
		$data['salaries'] = $this->common_model->get_salary_list();  
		$data['educations'] = $this->common_model->get_education_list();

		if ($this->input->post('post_job')) {
			$this->form_validation->set_rules('job_title','job title','trim|required|min_length[2]');
			$this->form_validation->set_rules('job_type','job type','trim|required');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('industry','industry','trim|required');
			$this->form_validation->set_rules('min_experience','min experience','trim|required');
			$this->form_validation->set_rules('max_experience','max experience','trim|required');
			$this->form_validation->set_rules('min_salary','min salary','trim|required');
			$this->form_validation->set_rules('max_salary','max salary','trim|required');
			$this->form_validation->set_rules('salary_period','salary period','trim|required');
			$this->form_validation->set_rules('skills','skills','trim|required');
			$this->form_validation->set_rules('description','description','trim|required|min_length[2]');
			$this->form_validation->set_rules('job_specification','job_specification','trim|required|min_length[2]');
			$this->form_validation->set_rules('total_positions','total positions','trim|required');
			//$this->form_validation->set_rules('gender','gender','trim|required');
			//$this->form_validation->set_rules('employment_type','employment type','trim|required');
			$this->form_validation->set_rules('education','education','trim|required');
			$this->form_validation->set_rules('country','country','trim|required');
			$this->form_validation->set_rules('state','state','trim|required');
			$this->form_validation->set_rules('city','city','trim|required');
			$this->form_validation->set_rules('location','location','trim|required');
			$this->form_validation->set_rules('deadline','deadline','trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(),
				);

				$this->session->set_flashdata('post_job_error',$data['errors']);
				redirect(base_url('employers/job/post'),'refresh');

			}else{
				$data = array(
					'employer_id' => $emp_id,
					'company_id' => get_company_id_by_employer($emp_id), // helper function
					'title' => $this->input->post('job_title'),
					'job_type' => $this->input->post('job_type'),
					'category' => $this->input->post('category'),
					'industry' => $this->input->post('industry'),
					'experience' => $this->input->post('min_experience').'-'.$this->input->post('max_experience'),
					'min_salary' => $this->input->post('min_salary'),
					'max_salary' => $this->input->post('max_salary'),
					'salary_period' => $this->input->post('salary_period'),
					'description' => $this->input->post('description'),
					'job_specification' => $this->input->post('job_specification'),
					'skills' => $this->input->post('skills'),
					'total_positions' => $this->input->post('total_positions'),
					'education' => $this->input->post('education'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'location' => $this->input->post('location'),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s'),
					'deadline' => $this->input->post('deadline'),
				);

				
				$new_logo = $_FILES['userfile']['name'];

				// upload company logo 
				if(!empty($new_logo))
				{
					unlink($this->input->post('old_logo')); // delete old logo

					$config = array(
						'upload_path' => "./uploads/job_img/",
						'allowed_types' => "png|jpg",
						'overwrite' => TRUE,
						'max_size' => "148000", // Can be set to particular file size , here it is 0.5 MB(148 Kb)
						);

					$new_name = time().$_FILES["userfile"]['name'];
					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if($this->upload->do_upload())
					{
						$file_data = array('upload_data' => $this->upload->data());
						$data['job_img'] = 'uploads/job_img/'. $file_data['upload_data']['file_name'];
					}
					else
					{
						$data['file_error'] = array('error' => $this->upload->display_errors());
					
						$this->session->set_flashdata('file_error','Error! Please select a valid file formate');
						redirect(base_url('employers/job/post'));
					}
				}
				else{
					$data['job_img'] = $this->input->post('old_logo');
				}

				$data['job_slug'] = $this->make_job_slug($this->input->post('job_title'), $this->input->post('city'));

				$data = $this->security->xss_clean($data);

				$job_id = $this->job_model->add_job($data);

				$featured_data = array(
					'employer_id' => $emp_id,
					'job_id' => $job_id,
					'package_id' => $pkg['package_id'],
					'payment_id' => $pkg['payment_id'],
					'is_featured' => ($pkg['price'] == 0)? 0 : 1
				);

				$result = $this->job_model->add_featured_job($featured_data);

				if ($result){
					$this->session->set_flashdata('post_job_success','Congratulation! Job has been Posted successfully');
					redirect(base_url('employers/job/listing'));
				}
				else{
					echo "failed";
				}
			}
		}
		else{
			$data['emp_sidebar'] = 'employers/emp_sidebar'; // load sidebar for employer

			$data['title'] = 'Post New Job';
			$data['meta_description'] = 'Jagir Ghar | Post Job';
			$data['keywords'] = 'Jagir Ghar';

			$data['layout'] = 'employers/jobs/post_job_page';
			$this->load->view('layout', $data);
		}
	}

	public function listing()
	{
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);
		$data['job_info'] = $this->job_model->get_all_jobs($emp_id);

		$data['emp_sidebar'] = 'employers/emp_sidebar'; // load sidebar for employer

		$data['title'] = 'Job Listing';
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'employers/jobs/job_listing_page';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------------------------
	public function edit($job_id=0)
	{
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);

		$data['categories'] = $this->common_model->get_categories_list(); 
		$data['industries'] = $this->common_model->get_industries_list();
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['cities'] = $this->common_model->get_cities_list(); 
		$data['salaries'] = $this->common_model->get_salary_list();  
		$data['educations'] = $this->common_model->get_education_list();

		if ($this->input->post('edit_job')) {
			$this->form_validation->set_rules('job_title','job title','trim|required|min_length[2]');
			$this->form_validation->set_rules('job_type','job type','trim|required');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('industry','industry','trim|required');
			$this->form_validation->set_rules('min_experience','min experience','trim|required');
			$this->form_validation->set_rules('max_experience','max experience','trim|required');
			$this->form_validation->set_rules('min_salary','min salary','trim|required');
			$this->form_validation->set_rules('max_salary','max salary','trim|required');
			$this->form_validation->set_rules('salary_period','salary period','trim|required');
			$this->form_validation->set_rules('skills','skills','trim|required');
			$this->form_validation->set_rules('description','description','trim|required|min_length[3]');
			$this->form_validation->set_rules('job_specification','job_specification','trim|required|min_length[2]');
			$this->form_validation->set_rules('total_positions','total positions','trim|required');
			$this->form_validation->set_rules('education','education','trim|required');
			$this->form_validation->set_rules('country','country','trim|required');
			$this->form_validation->set_rules('state','state','trim|required');
			$this->form_validation->set_rules('city','city','trim|required');
			$this->form_validation->set_rules('location','location','trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(),
				);

				$this->session->set_flashdata('edit_job_error',$data['errors']);
				redirect(base_url('employers/job/edit/'.$job_id),'refresh');

			}
			else{
				$data = array(
					'employer_id' => $emp_id,
					'company_id' => get_company_id_by_employer($emp_id), // helper function
					'title' => $this->input->post('job_title'),
					'job_type' => $this->input->post('job_type'),
					'category' => $this->input->post('category'),
					'industry' => $this->input->post('industry'),
					'experience' => $this->input->post('min_experience').'-'.$this->input->post('max_experience'),
					'salary_period' => $this->input->post('salary_period'),
					'min_salary' => $this->input->post('min_salary'),
					'max_salary' => $this->input->post('max_salary'),
					'description' => $this->input->post('description'),
					'job_specification' => $this->input->post('job_specification'),
					'skills' => $this->input->post('skills'),
					'total_positions' => $this->input->post('total_positions'),
					'education' => $this->input->post('education'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'location' => $this->input->post('location'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$new_logo = $_FILES['userfile']['name'];

				// upload J logo 
				if(!empty($new_logo))
				{
					unlink($this->input->post('old_logo')); // delete old logo

					$config = array(
						'upload_path' => "./uploads/job_img/",
						'allowed_types' => "png|jpg",
						'overwrite' => TRUE,
						'max_size' => "148000", // Can be set to particular file size , here it is 0.5 MB(148 Kb)
						);

					$new_name = time().$_FILES["userfile"]['name'];
					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if($this->upload->do_upload())
					{
						$file_data = array('upload_data' => $this->upload->data());
						$data['job_img'] = 'uploads/job_img/'. $file_data['upload_data']['file_name'];
					}
					else
					{
						$data['file_error'] = array('error' => $this->upload->display_errors());
					
						$this->session->set_flashdata('file_error','Error! Please select a valid file formate');
						redirect(base_url('employers/job/edit'));
					}
				}
				else{
					$data['job_img'] = $this->input->post('old_logo');
				}

				
				$data['job_slug'] = $this->make_job_slug($this->input->post('job_title'), $this->input->post('city'));
				$data = $this->security->xss_clean($data);
				$result = $this->job_model->edit_job($data,$job_id,$emp_id);

				if ($result) {
					$this->session->set_flashdata('update_success','Job has been Updated successfully');
					redirect(base_url('employers/job/listing'));
				}else{
					echo "failed";
				}
			}
		}
		else{
			$emp_id = $emp_id;
			$data['job_detail'] = $this->job_model->get_job_by_id($job_id,$emp_id);

			$data['emp_sidebar'] = 'employers/emp_sidebar'; // load sidebar for employer

			$data['title'] = 'Edit Job';
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'employers/jobs/edit_job_page';
			$this->load->view('layout', $data);
		}
	}

	//-----------------------------------------------------------------------------------------
	public function delete($id=0)
	{
		$emp_id = $this->session->userdata('employer_id');
		
		$this->db->where('id',$id);
		$this->db->where('employer_id',$emp_id);
		$this->db->delete('xx_job_post');
		$this->session->set_flashdata('deleted','Congratulation! Job has been Deleted successfully');
		redirect(base_url('employers/job/listing'));

	}

	//-----------------------------------------------------------------------------------------
	// make job slugon
	private function make_job_slug($job_title, $city){
		$final_job_url ='';
		$job_title = trim($job_title);
		$city = get_city_name($city);
		$job_title_slug = make_slug($job_title). '-job-in-'.make_slug($city) ;  // make slug is a helper function
		$final_job_url = $job_title_slug;
		return $final_job_url;
	}



}// endclass
