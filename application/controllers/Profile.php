<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->rbac->check_user_authentication();	// checking user login session (rbac is a library function)
		$this->load->model('profile_model');
		$this->load->model('common_model');
	}

	//-----------------------------------------------------------------------------------
	// Update Personal Info
	public function index()
	{		
		$data['countries'] = $this->common_model->get_countries_list(); 

		$user_id = $this->session->userdata('user_id');

		if ($this->input->post('update'))
		{
			$this->form_validation->set_rules('firstname','firstname','trim|required|min_length[3]');
			$this->form_validation->set_rules('lastname','lastname','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[7]|valid_email');
			$this->form_validation->set_rules('dob','date of birth','trim|min_length[3]');
			$this->form_validation->set_rules('mobile_no','mobile no','trim|required|min_length[3]');
			$this->form_validation->set_rules('nationality','nationality','trim');
			$this->form_validation->set_rules('category','category','trim|min_length[1]');
			$this->form_validation->set_rules('job_title','job title','trim|min_length[3]');
			$this->form_validation->set_rules('description','Objective','trim|min_length[10]');
			$this->form_validation->set_rules('country','country','required|trim');
			$this->form_validation->set_rules('state','state','required|trim');
			$this->form_validation->set_rules('city','city','required|trim');
			$this->form_validation->set_rules('address','address','trim|min_length[3]');
			$this->form_validation->set_rules('experience','experience','trim');
			$this->form_validation->set_rules('skills','skills','trim');
			$this->form_validation->set_rules('age','age','trim');
			$this->form_validation->set_rules('current_salary','current salary','trim');
			$this->form_validation->set_rules('expected_salary','expected salary','trim');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_update', $data['errors']);
				redirect(base_url('profile'),'refresh');

			}
			else
			{
				$data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'dob' => $this->input->post('dob'),
					'mobile_no' => $this->input->post('mobile_no'),
					'nationality' => $this->input->post('nationality'),
					'category' => $this->input->post('category'),
					'job_title' => $this->input->post('job_title'),
					'description' => $this->input->post('description'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'address' => $this->input->post('address'),
					'experience' => $this->input->post('experience'),
					'age' => $this->input->post('age'),
					'current_salary' => $this->input->post('current_salary'),
					'expected_salary' => $this->input->post('expected_salary'),
					'skills' => $this->input->post('skills'),
					'profile_completed' => 1,
					'updated_date' => date('Y-m-d : h:m:s')
				);
				$new_logo = $_FILES['userfile']['name'];

				// upload image
				if(!empty($new_logo))
				{
					unlink($this->input->post('old_logo')); // delete old logo

					$config = array(
						'upload_path' => "./uploads/candinate_img/",
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
						$data['img'] = 'uploads/candinate_img/'. $file_data['upload_data']['file_name'];
					}
					else
					{
						$data['file_error'] = array('error' => $this->upload->display_errors());
					
						$this->session->set_flashdata('file_error','Error! Please select a valid file formate');
						redirect(base_url('profile'));
					}
				}
				else{
					$data['img'] = $this->input->post('old_logo');
				}

				$data = $this->security->xss_clean($data); // XSS Clean

				$result = $this->profile_model->update_user($data,$user_id);

				if ($result) 
				{
					$this->session->set_flashdata('update_success','Profile has been  updated successfully');
					redirect(base_url('profile'));
				}
			}
		}
		else
		{
			$data['categories'] = $this->common_model->get_categories_list(); 
			$data['countries'] = $this->common_model->get_countries_list(); 
			$data['salaries'] = $this->common_model->get_salary_list();  
			$data['user_info'] = $this->profile_model->get_user_by_id($user_id);
			$data['education'] = $this->profile_model->get_user_education($user_id);
			$data['languages'] = $this->profile_model->get_user_language($user_id);
			$data['experiences'] = $this->profile_model->get_user_experience($user_id);

			$data['user_sidebar'] = 'jobseeker/user_sidebar'; // load sidebar for user

			$data['title'] = 'Profile';
			$data['meta_description'] = 'Job Seeker Profile';
			$data['keywords'] = 'meta tags here';
		
			$data['layout'] = 'jobseeker/profile/user_profile_page';
			$this->load->view('layout', $data);

		}
	}

	//-----------------------------------------------------------------------------------
	// Update Resume 

	public function myresume()
	{		
		$data['countries'] = $this->common_model->get_countries_list(); 

		$user_id = $this->session->userdata('user_id');

			$data['categories'] = $this->common_model->get_categories_list(); 
			$data['countries'] = $this->common_model->get_countries_list(); 
			$data['salaries'] = $this->common_model->get_salary_list();  
			$data['user_info'] = $this->profile_model->get_user_by_id($user_id);
			$data['education'] = $this->profile_model->get_user_education($user_id);
			$data['languages'] = $this->profile_model->get_user_language($user_id);
			$data['experiences'] = $this->profile_model->get_user_experience($user_id);

			$data['user_sidebar'] = 'jobseeker/user_sidebar'; // load sidebar for user

			$data['title'] = 'My Resume';
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';
		
			$data['layout'] = 'jobseeker/profile/myresume';
			$this->load->view('layout', $data);

		
	}

	
	public function resume()
	{
		if ($this->input->post('update_resume'))
		{
			$user_id = $this->session->userdata('user_id');

			// upload resume 
			if(!empty($_FILES["userfile"]['name']))
			{
				$config = array(
					'upload_path' => "./uploads/resume/",
					'allowed_types' => "docx|doc|pdf",
					'overwrite' => TRUE,
					'max_size' => "1048576", // Can be set to particular file size , here it is 1 MB(1MB)
					);

				$new_name = time().$_FILES["userfile"]['name'];
				$config['file_name'] = $new_name;

				$this->load->library('upload', $config);

				if($this->upload->do_upload())
				{
					$file_data = array('upload_data' => $this->upload->data());
					$data['resume'] =  'uploads/resume/'. $file_data['upload_data']['file_name'];
				}
				else
				{
					$data['file_error'] = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('file_error','Error! Please select a valid file formate');
					redirect(base_url('profile'));
				}
			}
			else{
				$data['resume'] = $this->input->post('old_resume');
			}
			//end resume upload code
			$data = $this->security->xss_clean($data); // XSS Clean

			$result = $this->profile_model->update_user($data,$user_id);

			if ($result) 
			{
				$this->session->set_flashdata('update_success','User resume has been updated successfully');
				redirect(base_url('profile'));
			}
		}
		else
		{
			redirect('profile');
		}
	}

	//-----------------------------------------------------------------------------------
	// User Experience
	public function experience()
	{
		if ($this->input->post('update_experience')) {

			$user_id = $this->session->userdata('user_id');
			
			$this->form_validation->set_rules('job_title','job title','trim|required|min_length[3]');
			$this->form_validation->set_rules('company','company','trim|required|min_length[3]');
			$this->form_validation->set_rules('country','country','trim|required');
			$this->form_validation->set_rules('starting_month','starting month','trim|required');
			$this->form_validation->set_rules('starting_year','starting_year','trim|required');
			$this->form_validation->set_rules('ending_month','ending month','trim');
			$this->form_validation->set_rules('ending_year','ending_year','trim');
			$this->form_validation->set_rules('currently_working_here','currently_working_here','trim');
			$this->form_validation->set_rules('description','description','trim|min_length[50]');

			if ($this->form_validation->run() == FALSE) {

				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_update', $data['errors']);

				redirect(base_url('profile'),'refresh');
			}else{
				$data = array(
					'user_id' => $user_id,
					'job_title' => $this->input->post('job_title'),
					'company' => $this->input->post('company'),
					'country' => $this->input->post('country'),
					'starting_month' => $this->input->post('starting_month'),
					'starting_year' => $this->input->post('starting_year'),
					'ending_month' => $this->input->post('ending_month'),
					'ending_year' => $this->input->post('ending_year'),
					'currently_working_here' => $this->input->post('currently_working_here'),
					'description' => $this->input->post('description'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$id = ($this->input->post('exp_id')) ? $this->input->post('exp_id') : NULL;

				$result = $this->profile_model->update_experience($data,$id);
				if ($result) {
					$this->session->set_flashdata('update_success','user experience has been Successfully updated');
					redirect(base_url('profile'));
				}
			}

		}else{
			redirect('profile');
		}
	}

	//-----------------------------------------------------------------------------------
	public function get_experience_by_id()
	{
		if($this->input->post('exp_id'))
		{
			$exp_id = $this->input->post('exp_id');
			$data['exp'] = $this->profile_model->get_experience_by_id($exp_id);
			echo $this->load->view('jobseeker/profile/user_experience_edit',$data,true);
		}
	}

	//-----------------------------------------------------------------------------------
	public function delete_experience($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('xx_seeker_experience');

		$this->session->set_flashdata('update_success','user experience has been Successfully updated');
		redirect('profile');
	}


	//-----------------------------------------------------------------------------------
	// User Education
	public function education()
	{
		if ($this->input->post('update_education')) {

			$user_id = $this->session->userdata('user_id');

			$this->form_validation->set_rules('degree','degree level','trim|required|min_length[3]');
			$this->form_validation->set_rules('degree_title','degree title','trim|required|min_length[3]');
			$this->form_validation->set_rules('major_subjects','major subjects','trim|required|min_length[3]');
			$this->form_validation->set_rules('country','country','trim|required|min_length[3]');
			$this->form_validation->set_rules('institution','institution','trim|required|min_length[3]');
			$this->form_validation->set_rules('completion_year','completion year','trim|required|min_length[3]');
			$this->form_validation->set_rules('result_type','result type','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' =>validation_errors()
				);

				$this->session->set_flashdata('error_update_education', $data['errors']);
				redirect(base_url('profile'),'refresh');
			}else{
				$data = array(
					'user_id' => $user_id,
					'degree' => $this->input->post('degree'),
					'degree_title' => $this->input->post('degree_title'),
					'major_subjects' => $this->input->post('major_subjects'),
					'country' => $this->input->post('country'),
					'institution' => $this->input->post('institution'),
					'completion_year' => $this->input->post('completion_year'),
					'result_type' => $this->input->post('result_type'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$result = $this->profile_model->update_education($data,$user_id);
				if ($result) {
					$this->session->set_flashdata('update_education_success','user education has been Successfully updated');
					redirect(base_url('profile'));
				}
			}
		}else{
			$user_id = $this->session->userdata('user_id');
			$data['user_info'] = $this->profile_model->get_user_by_id($user_id);

			$data['title'] = 'title here';
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'jobseeker/profile/user_profile_page';
			$this->load->view('layout', $data);
		}
	}

	//-----------------------------------------------
	public function add_education()
	{
		$this->form_validation->set_rules('level','Degree Level','trim|required');
		$this->form_validation->set_rules('title','Title','trim|required|min_length[3]');
		$this->form_validation->set_rules('majors','Majors','trim|required|min_length[3]');
		$this->form_validation->set_rules('institution','Institution','trim|required|min_length[3]');
		$this->form_validation->set_rules('country','Education Country','trim|required');
		$this->form_validation->set_rules('year','completion year','trim|required|exact_length[4]|numeric');

			if ($this->form_validation->run() == FALSE) {

				$data = array(
					'errors' =>validation_errors()
				);

				$this->session->set_flashdata('error_update', $data['errors']);
				redirect(base_url('profile'),'refresh');

			}else{
				$user_id = $this->session->userdata('user_id');
				$data = array(
					'user_id' => $user_id,
					'degree' => $this->input->post('level'),
					'degree_title' => $this->input->post('title'),
					'major_subjects' => $this->input->post('majors'),
					'country' => $this->input->post('country'),
					'institution' => $this->input->post('institution'),
					'completion_year' => $this->input->post('year'),
					'updated_date' => date('Y-m-d'),
				);

				$this->profile_model->add_user_education($data);

				$this->session->set_flashdata('update_success','user education has been Successfully updated');
				redirect(base_url('profile'));
			}
	}
 	
 	//-----------------------------------------------
	public function update_education()
	{
		$this->form_validation->set_rules('level','Degree Level','trim|required');
		$this->form_validation->set_rules('title','Title','trim|required|min_length[3]');
		$this->form_validation->set_rules('majors','Majors','trim|required|min_length[3]');
		$this->form_validation->set_rules('institution','Institution','trim|required|min_length[3]');
		$this->form_validation->set_rules('country','Education Country','trim|required');
		$this->form_validation->set_rules('year','completion year','trim|required|exact_length[4]|numeric');

			if ($this->form_validation->run() == FALSE) {

				$data = array(
					'errors' =>validation_errors()
				);

				$this->session->set_flashdata('error_update', $data['errors']);
				redirect(base_url('profile'),'refresh');

			}
			else{
				$edu_id = $this->input->post('edu_id');
				$data = array(
					'degree' => $this->input->post('level'),
					'degree_title' => $this->input->post('title'),
					'major_subjects' => $this->input->post('majors'),
					'country' => $this->input->post('country'),
					'institution' => $this->input->post('institution'),
					'completion_year' => $this->input->post('year'),
					'updated_date' => date('Y-m-d'),
				);
				$this->profile_model->update_education($data,$edu_id);

				$this->session->set_flashdata('update_success','user education has been Successfully updated');
				redirect(base_url('profile'));
			}
	}

	//-----------------------------------------------
	public function get_education_by_id()
	{
		if($this->input->post('edu_id'))
		{
			$edu_id = $this->input->post('edu_id');
			$data['edu'] = $this->profile_model->get_education_by_id($edu_id);
			echo $this->load->view('jobseeker/profile/user_education_edit',$data,true);
		}
	}

	//-----------------------------------------------
	public function delete_education($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('xx_seeker_education');

		$this->session->set_flashdata('update_success','user education has been Successfully updated');
		redirect('profile');
	}



	//-----------------------------------------------------------------------------------
	// User Skills
	public function skill()
	{
		if ($this->input->post('update_skill')){

			$user_id = $this->session->userdata('user_id');
			$this->form_validation->set_rules('new_skill','new skill','trim|required|min_length[3]');
			$this->form_validation->set_rules('experience','experience','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' =>validation_errors()
				);

				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('profile'),'refresh');
			}
			else{
				$data = array(
					'user_id' => $user_id,
					'new_skill' => $this->input->post('new_skill'),
					'experience' => $this->input->post('experience'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$result = $this->profile_model->update_skill($data,$user_id);

				if ($result) {
					$this->session->set_flashdata('update_skill_success','user skill has been Successfully updated');
					redirect(base_url('profile'));
				}
			}
		}
		else{
			$user_id = $this->session->userdata('user_id');
			$data['user_info'] = $this->profile_model->get_user_by_id($user_id);

			$data['title'] = 'title here';
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'jobseeker/profile/user_profile_page';
			$this->load->view('layout', $data);
		}
	}


	//----------------------------------------------------------------------
	// User Summary
	public function summary()
	{
		if ($this->input->post('update_summary')){

			$user_id = $this->session->userdata('user_id');
			$this->form_validation->set_rules('summary','summary','trim|required|min_length[20]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' =>validation_errors()
				);

				$this->session->set_flashdata('error_update_summary', $data['errors']);
				redirect(base_url('profile'),'refresh');
			}else{
				$data = array(
					'user_id' => $user_id,
					'summary' => $this->input->post('summary'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$result = $this->profile_model->update_summary($data,$user_id);

				if ($result) {
					$this->session->set_flashdata('update_summary_success','user summary has been Successfully updated');
					redirect(base_url('profile'));
				}
			}
		}
		else{
			$user_id = $this->session->userdata('user_id');
			$data['user_info'] = $this->profile_model->get_user_by_id($user_id);

			$data['title'] = 'title here';
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'jobseeker/profile/user_profile_page';
			$this->load->view('layout', $data);
		}
	}


	//----------------------------------------------------------------------
	// User Languages
	public function language()
	{
		if ($this->input->post('update_language')){

			$user_id = $this->session->userdata('user_id');

			$this->form_validation->set_rules('language','language','trim|required|min_length[3]');
			$this->form_validation->set_rules('proficiency_with_this_language','proficiency with this language','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {

				$data = array(
					'errors' =>validation_errors()
				);

				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('profile'),'refresh');

			}else{
				$data = array(
					'user_id' => $user_id,
					'language' => $this->input->post('language'),
					'proficiency' => $this->input->post('proficiency_with_this_language'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$result = $this->profile_model->update_languages($data,$user_id);

				if ($result) {
					$this->session->set_flashdata('update_language_success','user language has been Successfully updated');
					redirect(base_url('profile'));
				}
			}
		}
		else{
			$user_id = $this->session->userdata('user_id');
			$data['user_info'] = $this->profile_model->get_user_by_id($user_id);

			$data['title'] = 'title here';
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'jobseeker/profile/user_profile_page';
			$this->load->view('layout', $data);
		}
	}

	
	//------------------------------------------------------------------------------
	// LANGUAGE //
	public function add_language()
	{
		$this->form_validation->set_rules('language','Language','trim|required');
		$this->form_validation->set_rules('lang_level','Proficiency Level','trim|required');

			if ($this->form_validation->run() == FALSE) {

				$data = array(
					'errors' =>validation_errors()
				);

				$this->session->set_flashdata('error_update', $data['errors']);
				redirect(base_url('profile'),'refresh');

			}else{
				$user_id = $this->session->userdata('user_id');
				$data = array(
					'user_id' => $user_id,
					'language' => $this->input->post('language'),
					'proficiency' => $this->input->post('lang_level'),
					'updated_date' => date('Y-m-d'),
				);

				$this->profile_model->add_user_language($data);

				$this->session->set_flashdata('update_success','user profile has been Successfully updated');
				redirect(base_url('profile'));
			}
	}

	//----------------------------------------------
	public function update_language()
	{
		$this->form_validation->set_rules('language','Language','trim|required');
		$this->form_validation->set_rules('lang_level','Proficiency Level','trim|required');

			if ($this->form_validation->run() == FALSE) {

				$data = array(
					'errors' =>validation_errors()
				);

				$this->session->set_flashdata('error_update', $data['errors']);
				redirect(base_url('profile'),'refresh');

			}
			else{
				$edu_id = $this->input->post('lang_id');
				$data = array(
					'language' => $this->input->post('language'),
					'proficiency' => $this->input->post('lang_level'),
					'updated_date' => date('Y-m-d'),
				);
				$this->profile_model->update_language($data,$edu_id);

				$this->session->set_flashdata('update_success','user profile has been Successfully updated');
				redirect(base_url('profile'));
			}
	}

	//----------------------------------------------
	public function get_language_by_id()
	{
		if($this->input->post('lang_id'))
		{
			$lang_id = $this->input->post('lang_id');
			$data['lang'] = $this->profile_model->get_language_by_id($lang_id);
			echo $this->load->view('jobseeker/profile/user_language_edit',$data,true);
		}
	}

	//----------------------------------------------
	public function delete_language($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('xx_seeker_languages');

		$this->session->set_flashdata('update_success','user profile has been Successfully updated');
		redirect('profile');
	}

	
}
