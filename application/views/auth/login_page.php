
  <div class="container-login100">
    <div class="wrap-login100">
      <span class="login100-form-title p-b-4">
          Jobseeker Login
      </span>
      <?php    
        if ($this->session->flashdata('registration_success')) {

          echo  $this->session->flashdata('registration_success');
        }
        if($this->session->flashdata('error_login')){

          echo '<div class="alert alert-danger">' . $this->session->flashdata('error_login') . '</div>';
        }
        if($this->session->flashdata('success')){

          echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
        }
      ?> 

      <?php $attributes = array('id' => 'login_form', 'method' => 'post' , 'class' => 'login100-form validate-form');
        echo form_open('auth/login',$attributes);?>

             <div class="wrap-input100 validate-input mb-10" data-validate = "Valid email is required: ex@jagirghar.com">
                  <input class="input100" type="text" name="email" placeholder="Email">
                  <span class="focus-input100"></span>
                  <span class="symbol-input100">
                    <span class="lnr lnr-envelope"></span>
                  </span>
             </div>

                <div class="wrap-input100 validate-input mb-10" data-validate = "Password is required">
                  <input class="input100" type="password" name="password" placeholder="Password">
                  <span class="focus-input100"></span>
                  <span class="symbol-input100">
                    <span class="lnr lnr-lock"></span>
                  </span>
                </div>

                <div class="contact100-form-checkbox pt-2 ml-1">
                  <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                  <label class="label-checkbox100" for="ckb1">
                    Remember me
                  </label>
                </div>
                
                <div class="container-login100-form-btn pt-4">
                  <input type="submit" class="login100-form-btn" name="login" value="LogIn">
                </div>
              <?php echo form_close(); ?>
         
          <div class="text-center w-full mb-3">
						<span class="txt1">
							Or login with
						</span>
					</div>
					
					<a href="#" class="btn-face mb-5">
						<i class="fa fa-facebook-official"></i>
						Facebook
					</a>
			
					
					<a href="#" class="btn-google mb-5">
						<img src="<?= base_url(); ?>assets/img/signin_signup/icons/icon-google.png" alt="GOOGLE">
						Google
					</a>
					 
					<div class="text-center w-full mb-5">
						<span class="txt1">
							Not a member?
						</span>

						<a class="txt1 bo1 hov1" href="<?= base_url(); ?>auth/registration">
							Sign up now							
						</a>
					</div>
      <div class="text-center w-full pt-4">
          <a class="txt1 bo1 hov1" href="<?= base_url(); ?>auth/forgot_password">
            Forgot Password?            
          </a>
      </div>
     
    </div>
  </div>
