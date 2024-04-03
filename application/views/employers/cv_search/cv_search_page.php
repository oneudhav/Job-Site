<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					CV Search 			
				</h1>	
				<p class="text-white link-nav"><a href="">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="">CV Search </a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
		<div class="row d-flex">
			<div class="col-lg-12">
				<div class="search-bar">
					<?php $attributes = array('id' => 'search_job', 'method' => 'post');
             		 echo form_open('employers/cv/search',$attributes);?>
	                <div class="row justify-content-center form-wrap no-gutters">
	                  <div class="col-lg-6 form-cols">
	                    <input type="text" class="form-control" name="job_title" value="<?php if(isset($search_value['title'])) echo str_replace('-', ' ', $search_value['title']); ?>" placeholder="what are you looging for?">
	                  </div>
	                  <div class="col-lg-4 form-cols">
	                      <select name="country" class="form-control">
	                        <option value="">Select Location</option>
	                        <?php foreach($countries as $country):?>
	                          <?php if($search_value['country'] == $country['id']): ?>
	                            <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
	                          <?php else: ?>
	                            <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
	                        <?php endif; endforeach; ?>
	                      </select>
	                  </div>
	                  <div class="col-lg-2 form-cols">
	                      <input type="submit" name="search" class="btn btn-info" value="Search">
	                  </div>                
	                </div>
	              <?php echo form_close(); ?>
	            </div> 
			</div>
			<!-- End search sidebar -->
			<div class="col-12 post-list">
				<?php if(empty($profiles)): ?>
		          <p class="alert alert-danger"><strong>Sorry,</strong> we could not find any profile for the keywords that you entered</p>
		        <?php endif; ?>
				<?php foreach($profiles as $row): ?>
				<div class="single-post d-flex flex-row">
					<div class="thumb">
						<img src="<?= base_url()?>assets/img/user.png" height=100 alt="">
						<?php  $skills = explode("," , $row['skills']);?>
						<ul class="tags">
							<?php foreach($skills as $skill): ?>
							<li>
								<a href="#"><?= $skill; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="details col-lg-7">
						<div class="title d-flex flex-row justify-content-between">
							<div class="titles">
								<a href="#"><h4><?= $row['firstname'].' '.$row['lastname']; ?></h4></a>
								<h6><?= $row['job_title']; ?></h6>					
							</div>
						</div>
						<p class="">Location: <?= get_city_name($row['city']).','. get_country_name($row['country']); ?></p>
						<p class="">Education: <?= get_education_level($row['education_level']); ?></p>
						<p class="">Experience: <?= $row['experience']; ?> Years</p>
						<p class="">Nationality: <?= get_country_name($row['nationality']); ?></p>
						<p class="">Current Salary: Rs <?= $row['current_salary']; ?></p>
						<p class="">Expected Salary:Rs <?= $row['expected_salary']; ?></p>
						<p class="">Category: <?= get_category_name($row['category']); ?></p>
						<p class="address">
							<?= $row['description']; ?>
						</p>
					</div>
					<div class="options col-lg-3">
						<ul class="btns">
							<li><a href="<?= base_url('employers/cv/make_shortlist/'.$row['id']); ?>">Shortlist</a></li><br/>
							<?php if(!empty($row['resume'])) :?>
							<li><a href="<?= base_url().$row['resume']; ?>">Download Resume</a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>			
				<?php endforeach; ?>									
			</div>
			<div class="col-12">
          		<div class="pull-right"><?php echo $this->pagination->create_links(); ?></div>
			</div>
		</div>
	</div>	
</section>
<!-- End post Area -->

