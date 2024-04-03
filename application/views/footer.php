<!-- start footer Area -->    
<footer class="footer-area footer-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-3  col-md-3 col-sm-3">
        <div class="single-footer-widget newsletter text-center">
          <h6>Quick Links</h6>
          <ul class="footer-nav">		  <li><a href="<?= base_url('info'); ?>">About Us</a></li>
             <?php $pages = get_all_pages(); 
              foreach ($pages as $page) {
               echo '<li><i class="fa fa-dot-circle"></i><a href="'.base_url('p/'.$page['slug']) .'">'.$page['title'].'</a></li>';
              }
            ?>
             <li><a href="<?= base_url('contact'); ?>">Contact Us</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3  col-md-3 col-sm-3">
        <div class="single-footer-widget text-center">
          <h6>For Job Seekers</h6>
          <ul class="footer-nav">
            <li><a href="<?= base_url('auth/registration'); ?>">Register</a></li>
            <li><a href="<?= base_url('jobs/'); ?>">Search Job</a></li>
            <li><a href="<?= base_url('myjobs/matching') ?>"> Matching Jobs</a></li>
            <li><a href="<?= base_url('auth/login'); ?>">Login</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3  col-md-3 col-sm-3">
        <div class="single-footer-widget text-center">
          <h6>For Employers</h6>
          <ul class="footer-nav">
          <li><a href="<?= base_url('employers/job/post'); ?>">Post Job</a></li>
          <li><a href="<?= base_url('employers/auth/register'); ?>">Register</a></li>
          <li><a href="<?= base_url('employers/cv/shortlisted'); ?>">ShortListed Resumes</a></li>
          <li><a href="<?= base_url('employers/auth/login'); ?>">Login</a></li>
           
          </ul>
        </div>
      </div>
      <div class="col-lg-3  col-md-3 col-sm-6">
        <div class="single-footer-widget mail-chimp text-center">
          <h6 >Contact Us</h6>
          <ul class="footer-nav">
              <li><i class="fa fa-map-marker"> Jadibuti,Kathmandu </i></li>
              <li><i class="fa fa-phone"> +977 980-1235734</i></li>
              <li><i class="fa fa-envelope"> jagirghar@gmail.com</i></li>
          </ul>
        </div>
      </div>
    </div>

    
  </div>
</footer>
<!-- End Footer Area -->

<!-- start Copyright Area -->
<div class="copyright1">
  <div class="container">
    <div class="row"> 
      <div class="col-md-10 col-10">
        <div class="bottom_footer_info text-center">
          <p><?= $this->general_settings['copyright']?></p>
        </div>
      </div>
      <div class="col-md-2 col-2">
        <div class="bottom_footer_logo text-right">
          <ul class="list-inline">
            <li class="list-inline-item"><a target="_blank" href="<?= $this->general_settings['facebook_link']; ?>"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item"><a target="_blank" href="<?= $this->general_settings['twitter_link']; ?>"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a target="_blank" href="<?= $this->general_settings['google_link']; ?>"><i class="fa fa-google"></i></a></li>
            <li class="list-inline-item"><a target="_blank" href="<?= $this->general_settings['linkedin_link']; ?>"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Copyright Area --> 