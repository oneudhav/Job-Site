<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-8">
				<h1 class="text-white">
					Your Packages				
				</h1>	
				<p class="text-white link-nav"><a href="<?= base_url('employers'); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Your Packages </a></p>
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

			<div class="col-lg-8 profile_job_content text-center">
				<div class="headline">
					<h3>Your Packages</h3>
				</div>
				<?php if(empty($package_detail)): ?>
                  <p class="text-gray"><strong>Sorry,</strong> you don't have any Active package Yet. Please visit the pricing link on Navbar Menu!</p>
                <?php endif; ?>

				<?php foreach($package_detail as $package): ?>
				<div class="card m-5">
					<div class="card-body">
					    <h4 class="card-title"><?= $package['title'] ?></h4>
					    <p class="card-text"><?= $package['detail'] ?></p>
					    <p class="pt-3">Total No. of Posts : <?= $package['no_of_posts'] ?></p>
					    <p class="pt-3">Total No. of Days : <?= $package['no_of_days'] ?></p>
					    <p class="pt-3">Bought Date : <?= date_time($package['buy_date']) ?></p>
					    <p class="pt-3">Expiry Date : <?= date_time($package['expire_date']) ?></p>
					    <h5 class="pt-3">Price : <?= $package['price'] ?> </h5>
					    <?php
					    	$current_date = date("Y-m-d");
					    	if($current_date == $package['expire_date'])
					    		echo '<a class="btn btn-danger mt-3">Expired</a>';

					    	if($package['is_active'] == 1)
					    		echo '<a href="" class="btn btn-success mt-3">Active</a>';

					    	if($package['is_active'] == 0)
					    		echo '<a class="btn btn-danger mt-3">Deactivited</a>';
					    ?>


					  </div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
