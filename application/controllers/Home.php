<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('job_model');
		$this->load->model('company_model');

	}

	//-----------------------------------------------------------------------------
	// Index funciton will call bydefault
	public function index()
	{	

		if($this->input->post('submit')){
					
				$new_logo = $_FILES['userfile']['name'];
				// upload image
				if(!empty($new_logo))
				{
					unlink($this->input->post('old_logo')); // delete old logo

					$config = array(
						'upload_path' => "./uploads/direct_resume/",
						'allowed_types' => "pdf|docx|doc",
						'overwrite' => TRUE,
						'max_size' => "548000", // Can be set to particular file size , here it is 0.5 MB(535 Kb)
						);

					$new_name = time().$_FILES["userfile"]['name'];
					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if($this->upload->do_upload())
					{
						$file_data = array('upload_data' => $this->upload->data());
						$data['uploads'] = 'uploads/direct_resume/'. $file_data['upload_data']['file_name'];
					}
					else
					{
						$data['file_error'] = array('error' => $this->upload->display_errors());
					
						$this->session->set_flashdata('file_error','Error! Please select a valid file formate');
						redirect(base_url('home'));
					}
				}
				else{
					$data['uploads'] = $this->input->post('old_logo');
				}
				$data = $this->security->xss_clean($data);
				$result = $this->home_model->resume($data);
				if($result){
					$this->session->set_flashdata('success', 'Resume has been added successfully!');
					redirect(base_url('home'));
				}
			}
		
		
		$data['countries'] = $this->common_model->get_countries_list(); //get those countries who have jobs
		$data['cities'] = $this->common_model->get_cities_list();
		$data['industry1'] = $this->home_model->get_industry_with_jobs(3,0);
		$data['deadline'] = $this->common_model->get_job_deadline();
		// get countries for dropdown
		$data['companies1'] = $this->company_model->get_companies();

		
		$data['jobs'] = $this->home_model->get_jobs(10,0);
		$data['jobs_hot'] = $this->home_model->get_hot_jobs(18,0);
		$data['jobs_tops'] = $this->home_model->get_top_jobs(18,0);
		$data['jobs_premium'] = $this->home_model->get_premium_jobs(6,0);

		$data['companies'] =  $this->home_model->get_companies_logo(4,0);
		$data['posts'] = $this->home_model->get_latest_blog_post();
		$data['testi'] = $this->home_model->get_testimonials();
		$data['ad'] = $this->home_model->get_ads();
		$data['rightad'] = $this->home_model->get_righttopads();
		$data['slider'] = $this->home_model->get_slider();
		$data['events'] = $this->home_model->get_events();

		$data['title'] = 'Home';
		$data['meta_description'] = 'Jagir Ghar';
		$data['keywords'] = 'jagirghar';

		$data['layout'] = 'home';
		$this->load->view('layout', $data);
	}

	
	//-----------------------------------------------------------------------------
	// About Us Page


	public function about_us()
	{
		$data['title'] = 'About';
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'about_us';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------------
	// Dynamic page builder 
    public function any($slug)
    {
        $slug = $this->security->xss_clean($slug);
        //index page
        if (empty($slug)) {
            redirect(base_url());
        }

        $data['page'] = $this->home_model->get_page($slug);

        //if not exists
        if (empty($data['page'])) {
            redirect(base_url());
        } else {
        	$data['title'] = $data['page']['title'];
			$data['meta_description'] = $data['page']['description'];
			$data['keywords'] = $data['page']['keywords'];

			$data['layout'] = 'page';
			$this->load->view('layout', $data);

        }
    }

	//-----------------------------------------------------------------------------
	// Contact Us Functionality
	public function contact()
	{
		if ($this->input->post('submit'))
		{
			$this->form_validation->set_rules('username','first name','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[3]');
			$this->form_validation->set_rules('subject','last name','trim|required|min_length[3]');
			$this->form_validation->set_rules('message','message','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_send', $data['errors']);

				redirect(base_url('contact'),'refresh');
			}
			else
			{
				$data = array(
					'username' => $this->input->post('first_name'),
					'email' => $this->input->post('email'),
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data); // XSS Clean Data

				$result = $this->home_model->contact($data);

				if ($result) 
				{
					// email code
					$this->load->helper('email_helper');

					$to = $this->general_settings['admin_email'];
					$subject = 'Contact Us | Jagir Ghar';
					$message =  '<p>Username: '.$data['username'].'</p> 
					<p>Email: '.$data['email'].'</p>
					<p>Message: '.$data['message'].'</p>' ;

					sendEmail($to, $subject, $message, $file = '' , $cc = '');

					$this->session->set_flashdata('success','<p class="alert alert-success"><strong>Success! </strong>your message has been sent successfully!</p>');
					redirect(base_url('contact'), 'refresh');
				}
				else
				{
					redirect(base_url('contact'), 'refresh');
				}
			}
		}
		else
		{
			$data['title'] = 'Contact';
			$data['layout'] = 'contact_us';
			$this->load->view('layout', $data);
		}
	}
		public function aboutus()
	{
		
			
			$data['title'] = 'AboutUs';
			$data['layout'] = 'aboutus';
			$this->load->view('layout', $data);
		
	}
}// endClass
