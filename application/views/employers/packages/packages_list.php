<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Packages				
				</h1>	
				<p class="text-white link-nav"><a href="<?= base_url(); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Packages</a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->	

<!-- Start price Area -->
<section class="price-area section-gap" id="price">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="menu-content pb-60 col-lg-12 ">
				<div class="title ">
					<h1 class="text-center">Choose the best pricing for you</h1>
					
				</div>
			</div>
		</div>						
		<div class="row">
			<?php foreach($packages as $package): ?>
			<div class="col-lg-12 text-center">
				<div class="single-price no-padding">
					<div class="price-top">
						<h4><?= $package['title']; ?></h4>
						<h6 class="mt-3">(<?= $package['no_of_posts']; ?> Posts)</h6>
						<h6 class="mt-3">Package Duration (<?= $package['no_of_days']; ?> Days)</h6>
					</div>
					<p class="p-3"><?= $package['detail']; ?></p>
					
					<div class="price-bottom">
						<div class="price-wrap d-flex flex-row justify-content-center">
							<span class="price total">NPR</span><h1><?= $package['price']; ?></h1>
						</div>
						<?php echo form_open( base_url('employers/packages/order_confirmation'), array('id'=>'form','method'=>'post')); ?>
							<input type="hidden" name="package_id" value="<?= $package['id']; ?>">
							<input type="submit" class="btn btn-info header-btn" name="submit" value="Buy Now">
						<?php echo form_close(); ?>
						
					</div>

				</div>
			</div>
			<?php endforeach; ?>
							
		</div>
	</div>	
</section>
<!-- End price Area -->	