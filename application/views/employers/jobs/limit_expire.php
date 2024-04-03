<!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white text-center">
           Limit Expire       
        </h1> 
        <p class="text-white text-center link-nav"><a href="<?= base_url('employers'); ?>">Home </a>  <span class="lnr lnr-arrow-right "></span>  <a href=""> Limit Expire</a></p>
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area -->  

<!-- Start post Area -->
<!-- Start post Area -->
<section class="post-area section-gap">
  <div class="container">
    <div class="row justify-content-center d-flex">
      <div class="col-lg-4 sidebar">          
        <?php $this->load->view($emp_sidebar); ?>
      </div>
      
      <div class="col-lg-8 box-shadow">
        <div class="body p-4">
          <?php if($this->session->userdata('expire')): ?>
            <p class="alert alert-info">
             <?= $this->session->userdata('expire'); ?>
            </p>
          <?php endif; ?>
          <p>Please <a href="<?= base_url('employers/packages'); ?>">Click here</a> to view the Job Posting <a href="<?= base_url('employers/packages'); ?>">Packages & Plans</a></p>
        </div>
        
      </div>
    </div>
  </div>
</section>