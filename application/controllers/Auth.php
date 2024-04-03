<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('mailer');
		$this->load->model('auth_model','auth_model');

		
		  // load custom mailer library
	}


	  

    # pssword genaretor
    #----------------------
    function randstrGen()
    {
        $result = "";
            $chars = "0123456789";
            $charArray = str_split($chars);
            for($i = 0; $i < 5; $i++) {
                    $randItem = array_rand($charArray);
                    $result .="".$charArray[$randItem];
            }
            return $result;
    }

	//-------------------------------------------------------------------
	// login functionality
	public function login()
	{
		if ($this->input->post('login')) 
		{
			//validate inputs
			$this->form_validation->set_rules('email','email','trim|required|min_length[3]|valid_email' );
			$this->form_validation->set_rules('password','password','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_login', $data['errors']);
				redirect(base_url('auth/login'),'refresh');
			}
			else{

				$data = array(
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password') 
				);

				$data = $this->security->xss_clean($data); // XSS Clean

				$result = $this->auth_model->login($data);

				if ($result) {
					$login_data = array(
						'user_id' => $result['id'],
						'email' => $result['email'], 
						'password' => $result['password'],
						'username' => $result['firstname'],
						'is_user_login' => TRUE
					);

					$this->session->set_userdata($login_data);

					// redirected to last request page
					if(!empty($this->session->userdata('last_request_page')))
					{
						$back_to = $this->session->userdata('last_request_page');
						redirect($back_to);
					}
					else
					{
						redirect(base_url('profile'),'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('error_login','invalid email or password');
					 redirect(base_url('auth/login'),'refresh');
				}
			}
		}
		else
		{
			$data['title'] = 'Login';
			$data['meta_description'] = 'Jagir Ghar Login';
			$data['keywords'] = 'Login';

			$data['layout'] = 'auth/login_page';
			$this->load->view('layout', $data);
		}
	}

	  
     #------------------------------------
    #   facebook login and registration
    #------------------------------------    
   


    #----------------------------------------
    #       google registration and login
    #----------------------------------------    
    public function googl_login(){
     
        // Check if user is logged in
        if ($this->googleplus->getAuthenticate())
        {
            $data = $this->googleplus->getUserInfo();
        }

        $check_status = $this->db->select('*')->from('xx_users')->where('email',$data['email'])->get()->row();  

        if($check_status){
            $session_data = array(
                'id' => $check_status->id,
                'username' => $check_status->firstname,
                'role' => $check_status->user_type,
                'email' => $check_status->email,
                
                'is_user_login' => TRUE
            );


            $this->session->set_userdata($session_data);
            redirect(base_url());
            

        }else{

            $password = $this->randstrGen(); 
            $register_data = array(
                'username' => $data['firstname'],
                'email' => $data['email'],
                'role' => 1,
                'password' => hash($password)
            );
            
            $this->db->insert('xx_users',$register_data);
            #-------------------------------
            #   email send to user email
            #-------------------------------
           
            #-------------------------------

            @$sdata = $this->db->select('*')->from('xx_users')->where('email',$data['email'])->get()->row();
          
            $session_data = array(
                'id'            => $sdata->id,
                'username'          => $sdata->firstname,
                'role'     => $sdata->role,
                'email'         => $sdata->email,
                'logged_in'     => TRUE
            );

            $this->session->set_userdata($session_data);

            $data = array(
                'username'      => $data['firstname'],
                'email'     => $data['email'],
                'role' => 1,
                'password'  => $password
            );
             
            #-------------------------------------
        

            $data['login_url'] = $this->googleplus->loginURL();
			$data['title'] = 'Login';
			$data['meta_description'] = 'Jagir Ghar Login';
			$data['keywords'] = 'Login';

			$data['layout'] = 'auth/login_page';
			$this->load->view('layout', $data);

       } 

       
    }


	
	public function registration()
	{
		if ($this->input->post('submit')) 
		{
			$this->form_validation->set_rules('firstname','firstname','trim|required|min_length[3]');
			$this->form_validation->set_rules('lastname','lastname','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[5]|valid_email|is_unique[xx_users.email]');
			$this->form_validation->set_rules('password','password','trim|required|min_length[3]');
			$this->form_validation->set_rules('confirmpassword','confirm password','trim|required|min_length[3]|matches[password]');
			$this->form_validation->set_rules('termsncondition','terms n condition','required');

			if ($this->form_validation->run() == FALSE) 
			{
				$data = array(
					'errors' => validation_errors(), 
				);
				$this->session->set_flashdata('validation_errors', $data['errors']);
				redirect(base_url('auth/registration'));
			}
			else
			{
				$data = array(
					'firstname' => $this->input->post('firstname'), 
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data); // XSS Clean Data

				$result = $this->auth_model->insert_into_users($data);

				if ($result) 
				{
					$this->session->set_flashdata('registration_success','<p class="alert alert-success">You are successfully registerd! Please login below</p>');
					redirect(base_url('auth/login'), 'refresh');
				}
			}
		}
		else
		{
			$data['title'] = 'Registration';
			$data['layout'] = 'auth/registration_page';
			$this->load->view('layout', $data);
		}
	}


	//--------------------------------------------------		
	public function forgot_password()
	{
		if($this->input->post('submit')){

			//validate inputs
			$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
			if ($this->form_validation->run() == FALSE) 
			{
				$data = array(
					'errors' => validation_errors(), 
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('auth/forgot_password'));
			}
			$email = $this->input->post('email');

			$response = $this->auth_model->check_user_mail($email); // check if email exist

			if($response){
				$rand_no = rand(0,1000);
				$pwd_reset_code = md5($rand_no.$response['id']);
				$this->auth_model->update_reset_code($pwd_reset_code, $response['id']);

				// --- sending email
				$name = $response['firstname'].' '.$response['lastname'];
				$email = $response['email'];
				$reset_link = base_url('auth/reset_password/'.$pwd_reset_code);
				$body = $this->mailer->pwd_reset_link($name,$reset_link);

				$this->load->helper('email_helper');
				$to = $email;
				$subject = 'Reset your password';
				$message =  $body ;
				$email = sendEmail($to, $subject, $message, $file = '' , $cc = '');

				if($email){
					$this->session->set_flashdata('success', 'We have sent instructions for resetting your password to your email');

					redirect(base_url('auth/forgot_password'));
				}
				else{
					$this->session->set_flashdata('error', 'There is the problem on your email');
					redirect(base_url('auth/forgot_password'));
				}
			}
			else{
				$this->session->set_flashdata('error', 'The Email that you provided are invalid');
				redirect(base_url('auth/forgot_password'));
			}
		}
		else{
			$data['title'] = 'Forget Password';
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';
		
			$data['layout'] = 'auth/forget_password_page';
			$this->load->view('layout', $data);
		}
	}

	//----------------------------------------------------------------		
	public function reset_password($id=0)
	{
		// check the activation code in database
		if($this->input->post('submit')){
			
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
				$result = false;
				$data['reset_code'] = $id;
				$data['title'] = 'Reseat Password';
				$data['layout'] = 'auth/reset_password_page';
				$this->load->view('layout', $data);
			}   
			else{
				$new_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$this->auth_model->reset_password($id, $new_password);
				$this->session->set_flashdata('success','New password has been updated successfully.Please login below');
				redirect(base_url('auth/login'));
			}
		}
		else{
			$result = $this->auth_model->check_password_reset_code($id);
			if($result){
				$data['reset_code'] = $id;
				$data['title'] = 'Reseat Password';
				$data['layout'] = 'auth/reset_password_page';
				$this->load->view('layout', $data);
			}
			else{
				$this->session->set_flashdata('error','Password Reset Code is either invalid or expired.');
				redirect(base_url('auth/forgot_password'));
			}
		}
	}

	//----------------------------------------------------------------------------
	// Logout Function
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}

}// endClass
