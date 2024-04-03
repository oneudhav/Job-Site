<!-- #header start -->
<div class="topBar mb-5 hidden-sm hidden-xs">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="pull-left brands">
            <li><a href="<?= site_url(); ?>home"  class=" blog">Home</a></li>
            <li><a href="<?= site_url(); ?>info" class="about">About Us</a></li>
            <li><a href="<?= site_url(); ?>blog" class="about">Blog</a></li>
          </ul>
          <div class="topBar-right pull-right">
            <ul class="pull-left icons mr0">
              <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
              <li><a href="https://www.twitter.com/"  target="_blank"><i class="fa fa-twitter"></i></a></li>
              <li><a href="https://www.linkedin.com/"  target="_blank"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="javascript:void(0)" ><i class=" fa fa-phone"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>   
<section id="header" class="fixed">

  <div class="container">
    <div class="row align-items-center d-flex">
      <div class="col-2">
        <div id="logo">
          <a href="<?= base_url(); ?>"><img src="<?= base_url($this->general_settings['logo']); ?>" alt="" title="" /></a>
        </div>
      </div>
      <div class="col-10">
        <nav id="nav-menu-container">
          <ul class="nav-menu">
           
            <?php if ($this->session->userdata('is_user_login')): ?>
              <li class="menu-has-children"><a href="">Jobs</a>
                <ul>
                  <li><a href="<?= base_url('jobs'); ?>">Search Job</a></li>
                  <li><a href="<?= base_url('jobs-by-category'); ?>">Jobs by Category</a></li>
                  <li><a href="<?= base_url('jobs-by-industry'); ?>">Jobs by Industry</a></li>
                  <li><a href="<?= base_url('jobs'); ?>">Browse all Jobs</a></li>
                </ul>
              </li>

              <li class=""><a href="<?= base_url('company'); ?>">Companies</a></li> 
              <li><a href="<?= base_url('employers') ?>"> For Employers</a> 
              </li>   
              <li class="menu-has-children margin-left-400">
              <?php if(!empty($user_info['img'])): ?>
											<img src="<?= base_url().$user_info['img']; ?>" alt="img" height="35">
							<?php endif; ?>
              <a href="#"> <?= $this->session->userdata('username'); ?> </a>
                <ul>
                  <li><a href="<?= base_url('profile'); ?>">My Profile</a></li>
                  <li><a href="<?= base_url('myjobs'); ?>">My Applications</a></li>
                  <li><a href="<?= base_url('myjobs/matching'); ?>">Matching Jobs</a></li>
                  <li><a href="<?= base_url('myjobs/saved'); ?>">Saved Jobs</a></li>
                  <li><a href="<?= base_url('account/change_password'); ?>">Change Password</a></li>
                  <li><a href="<?= base_url('auth/logout')?>">LogOut</a></li>
                </ul>
              </li>   
            <?php elseif ($this->session->userdata('is_employer_login')): ?> 
            <li><a href="<?= base_url('employers/dashboard') ?>"> Dashboard</a>
            <li><a href="<?= base_url('employers/packages') ?>"> Packages</a>
            <li><a href="<?= base_url('employers/job/listing') ?>"> Manage Jobs</a>
            <li><a href="<?= base_url('employers/cv/search') ?>"> CV Search</a>
            </li>
            <li class="menu-has-children margin-left-400">
            
            <?php if(!empty($company_info['company_logo'])): ?>
											<img src="<?= base_url().$company_info['company_logo']; ?>" alt="img" height="35">
							<?php endif; ?>
            <a href="#"> <?= $this->session->userdata('username'); ?> </a>
                <ul>
                  <li><a href="<?= base_url('employers/profile') ?>">Dashboard</a></li>
                  <li><a href="<?= base_url('employers/job/listing') ?>">Manage Jobs</a></li>
                  <li><a href="<?= base_url('employers/account/change_password'); ?>">Change Password</a></li>
                <li><a href="<?= base_url('employers/auth/logout')?>">LogOut</a></li>
                </ul>
              </li>   
            <?php else: ?> 
            <li class=""><a href="<?= base_url(); ?>">Home</a></li>
            <li class="menu-has-children"><a href="">Jobs</a>
              <ul>
                <li><a href="<?= base_url('jobs'); ?>">Search Job</a></li>
                <li><a href="<?= base_url('jobs-by-category'); ?>">Jobs by Category</a></li>
                <li><a href="<?= base_url('jobs-by-industry'); ?>">Jobs by Industry</a></li>
                <li><a href="<?= base_url('jobs'); ?>">Browse all Jobs</a></li>
              </ul>
            </li>
            <li class=""><a href="<?= base_url('company'); ?>">Companies</a></li> 
            <li class=""><a href="<?= base_url('blog'); ?>">Blog</a></li> 
            <li><a class="nav_btn btn_login mt-1" href="<?= base_url('auth/login') ?>"><i class="lnr lnr-user pr-1"></i> JobSeeker</a></li>
            <li><a class="nav_btn mt-1" href="<?= base_url('employers') ?>"><i class="lnr lnr-briefcase pr-1"></i> Employers</a> </li>
            <?php endif; ?>                                 
          </ul>
        </nav><!-- #nav-menu-container -->      
      </div> 
      </div>
  </div>
</section><!-- #header End-->
