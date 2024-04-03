
<!-- registration-section-starts -->
<div class="container-login200">
  <div class="wrap-login100" style="width: 650px;">
    <div class="container">
      <span class="login100-form-title pb-5">
       Sign up <small>(Employers)</small>
      </span>
      
      <div class="line-title-left"></div>
      <?php 
      if($this->session->flashdata('error')){
        echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
      }
      ?>

      <?php $attributes = array('id' => 'registeration_form', 'method' => 'post'); ?>
      <?php echo form_open('employers/auth/registration',$attributes); ?>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label>First Name *</label>
            <input type="text" name="firstname" class="form-control" placeholder="Enter your first name" />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Last Name *</label>
            <input type="text" name="lastname" class="form-control" placeholder="Enter your last name" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Company Name *</label>
            <input type="text" name="company_name" class="form-control" placeholder="Enter your Company Name" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label>Password *</label>
            <input type="password" name="password" class="form-control" placeholder="Enter your password" />
          </div>
        </div>
        <div class="col-lg-6">      
         <div class="form-group">
          <label>Confirm Password *</label>
          <input type="password" name="confirmpassword" class="form-control" placeholder="Enter your password again" />
        </div>
      </div>
    </div>

  
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <input type="checkbox" name="termsncondition"> Agree to our <small> Terms and Conditions</small>
        </div>
        <?php if($this->recaptcha_status): ?>
              <div class="recaptcha-cnt">
                  <?php generate_recaptcha(); ?>
              </div>
          <?php endif; ?>
        <div class="form-group">
          <input type="submit" class="login100-form-btn btn-block" name="submit" value="Register">
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
    <div class="text-center w-full pt-4">
          <span class="txt1">
            Already have an account?
          </span>
          <a class="txt1 bo1 hov1" href="<?= base_url(); ?>employers/auth/login">
            SignIn now             
          </a>
      </div>
  </div>  
</div>  
</div>


<!-- registration-section-Ends -->
