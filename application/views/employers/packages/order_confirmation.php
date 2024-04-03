<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Order Confirmation				
				</h1>	
				<p class="text-white link-nav"><a href="<?= base_url(); ?>">Back </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Order Confirmation </a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->	

<section class="section-gap">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 ">
				<h3 class="text-center">Your Order Summery</h3>
				<hr />
				<div class="card text-center">
					<div class="card-body">
					    <h5 class="card-title"><?= $package_detail['title'] ?></h5>
					    <p class="card-text"><?= $package_detail['detail'] ?></p>
					    <ul>
					    	<h6>No of Posts: <?= $package_detail['no_of_posts'] ?>  </h6>
					    	<h6>No of Days: <?= $package_detail['no_of_days'] ?></h6>
					    </ul>
					   
					    <h3 class="mt-5">Rs <?= $package_detail['price']?></h3>

					    <!-- Paypal Integration-->

					    <?php

						$paypal_url = $this->config->item('paypal_url'); // Test Paypal API URL

						$paypal_id = $this->config->item('business'); // Business email ID

						?>
				        
				        <?php echo form_open( base_url('employers/packages/buy'), array('id'=>'','method'=>'post')); ?>
				            <input type="hidden" name="package_id" value="<?= $package_detail['id'] ?>">
				
							<input type="image" class="mb-10" src="<?= base_url(); ?>/assets/img/payments/esewa.png" height="40px" border="0" name="submit" alt="Esewa">
							

						<?php echo form_close(); ?>

					  </div>
				</div>
			</div>
		</div>
	</div>
</section>
