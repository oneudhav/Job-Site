 <!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          Matching Jobs        
        </h1> 
        <p class="text-white link-nav"><a href="<?= base_url(); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Matching Jobs</a></p>
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area -->  
<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
		<div class="row justify-content-center d-flex">
			<div class="col-lg-4 sidebar">							
				<?php $this->load->view($user_sidebar); ?>
			</div>
			<div class="col-lg-8 post-list">
				<?php foreach($jobs as $job): ?>
				<div class="col-lg-12">
	                <?php if(empty($jobs)): ?>
	                  <p class="text-gray"><strong>Sorry,</strong> there is no marching job at the moment</p>
	                <?php endif; ?>
	              </div>
				<div class="single-post d-flex flex-row">
					<div class="thumb">
				
					</div>
					<div class="details">
						<div class="title d-flex flex-row justify-content-between">
							<div class="titles">
							<img  src="<?= base_url().get_company_logo($job['company_id']); ?>" alt="Job Logo" width="60" height="60"  />
								<a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><h4><?= text_limit($job['title'], 35); ?></h4></a>
												
							</div>
							
						</div>
						<div class="job-listing-footer">
							<ul>
								<li><i class="lnr lnr-map-marker"></i> <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></li>
								<li><i class="lnr lnr-briefcase"></i> <?= get_job_type_name($job['job_type']); ?></li>
								<li><i class="lnr lnr-apartment"></i> <?= get_industry_name($job['industry']); ?></li>
								<li><i class="lnr lnr-clock"></i> <?= time_ago($job['deadline']); ?></li>
							</ul>									
						</div>
					</div>
					<div class="job-listing-btns ml-4">
						<ul class="btns">
							<li><a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><span class="lnr lnr-star"> Apply Now </span> </a></li>
						</ul>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>	
</section>
<!-- End post Area -->		