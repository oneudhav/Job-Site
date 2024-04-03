<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Dashboard				
				</h1>	
				<p class="text-white link-nav"><a href="<?= base_url('employers'); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Dashboard </a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->	

<section class="section-gap">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 sidebar">
				<?php $this->load->view($emp_sidebar); ?>					
			</div>

			<div class="col-lg-8 profile_job_content">
				<div class="headline">
					<h3>Dashboard</h3>
				</div>
				<div class="row m-4">
					<div class="col-md-6">
						<div class="card text-center">
							<div class="card-body">
							   <i class="fa fa-bullhorn fa-2x mb-3"></i>
							   <h4 class="mb-3">Total Job Posted</h4>
							   <h5><?= $total_posted_jobs ?></h5>
							</div>
						</div>
					</div>
					<?php  if(!empty($current_package)): ?>
					<!--	<div class="col-md-6">
						<div class="card text-center">
							<div class="card-body">
							   <i class="fa fa-shield fa-2x mb-3"></i>
							   <h4 class="mb-3">Featured Jobs Credits</h4>
							   <h5><?= ($current_package['price'] != 0)? $total_featured_jobs.'/'. $current_package['no_of_posts']: 0 ?></h5>
							</div>
						</div>
					</div> -->
					<div class="col-md-6 mt-4">
						<div class="card text-center">
							<div class="card-body">
							   <i class="fa fa-list fa-2x mb-3"></i>
							   <h4 class="mb-3">Active Package</h4>
							   <a class="btn btn-outline"><?= $current_package['title'] ?></a>
							   <p>No. of posts (<?= $current_package['no_of_posts'] ?>)</p>
							</div>
						</div>
					</div>
					<?php endif; ?>
				</div>	
				
			</div>
		</div>
	</div>
</section>
