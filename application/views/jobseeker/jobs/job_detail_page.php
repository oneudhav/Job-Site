<!-- JSsocials -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/plugins/jssocials/jssocials.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/plugins/jssocials/jssocials-theme-flat.css" />


<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
			<img  src="<?= base_url().get_company_logo($job_detail['company_id']); ?>" width="120" height="120"alt="Job Logo" />
				<h3 class="text-white">
				<?= $job_detail['title']; ?>		
				</h3>	
				<h4 class="text-white" style="float:left;margin-left:-120px;"><?= get_company_name($job_detail['company_id']); ?></h4>
			</div>											
		</div>
	</div>
</section>1
<!-- End banner Area -->	

<!-- Start post Area -->
<section class="post-area">
	<div class="container">
		<div class="row d-flex">
			<div class="col-lg-8 col-8">
				<?php if($this->session->flashdata('applied_success')): ?>
		          <div class="alert alert-success">
		            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		            <?=$this->session->flashdata('applied_success')?>
		          </div>
		        <?php  endif; ?>
		        <?php if($already_applied == true && $this->session->flashdata('applied_success') == null): ?>
		          <div class="alert alert-success">
		            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		            You have already applied for this application
		          </div>
		        <?php  endif; ?>
		        <?php if($this->session->flashdata('validation_errors')): ?>
		         <div class="alert alert-danger">
		          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		          <?= $this->session->flashdata('validation_errors') ?>
		        </div>
		      <?php endif; ?>
			</div>
			<div class="col-lg-8 post-list">
			<div class="single-post d-flex flex-row">
					<div class="details col-8">
						
					<div class="title d-flex flex-row justify-content-between mb-2">
					
				</div>
						<table class="table table-hover text-black ">
						<h5 style="font-style: italic;font-weight:bold;text-decoration: underline;">Basic Job Information</h5>
						<thead>
							<tr>
							<th scope="col">Job Category </th>
							<td scope="col">: <?= get_industry_name($job_detail['industry']); ?></td>
							</tr>
						</thead>
						<tbody>
							<tr>
							<th scope="row">No of Vacancy</th>
							<td>: <?= $job_detail['total_positions']; ?></td>
							</tr>
							<tr>
							<th scope="row">Job Type</th>
							<td>: <?= get_job_type_name($job_detail['job_type']); ?></td>
							</tr>
							<tr>
							
							<th scope="row">Offered Salary </th>
							<td>: Rs- <?= $job_detail['min_salary']; ?> Rs-<?= $job_detail['max_salary']; ?> (<?= $job_detail['salary_period']; ?>)</td>
							</tr>
							<tr>
							<th scope="col">Education  </th>
							<td scope="col">: <?= get_education_level($job_detail['education']); ?></td>
							</tr>
							<tr>
							<th scope="row">Experience</th>
							<td>: <?= $job_detail['experience']; ?> Years</td>
							</tr>
							<tr>
							<th scope="row">Location</th>
							<td>: <?= get_city_name($job_detail['city']); ?>, <?= get_country_name($job_detail['country']); ?></td>
							</tr>
							<tr>
							<th scope="row">Posted Date</th>
							<td>: <?= date('d-m-Y', strtotime($job_detail['created_date'])); ?></td>
							</tr>
							</tr>
							<tr>
							<th scope="row">Apply Before(Deadline)</th>
							<td>: <?= date('g:i A M dS',strtotime($job_detail['deadline'])); ?></td>
							</tr>
						</tbody>
						</table>
						<h5 style="font-style: italic;font-weight:bold;text-decoration:underline;">Job Specification </h5>
						<div class="description">
						<?= $job_detail['job_specification']; ?>
				        </div>
						<br>
						<h5 style="font-style: italic;font-weight:bold;text-decoration:underline;">Job Description</h5>
						<div class="description">
							<div class="text-justify"><?= $job_detail['description']; ?></div> 
				        </div>
						
						
						
						<?php  $skills = explode("," , $job_detail['skills']);?>
						<ul class="tags">
						<h5 style="font-style: italic;font-weight:bold;text-decoration: underline;">Skills</h5>
							<?php foreach($skills as $skill): ?>
							<li>
								 <a  class="label label-success"href="#"><?= $skill; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
						<div class="addthis_inline_share_toolbox"></div>
					</div>
					
					
				</div>	
			<div id="apply-block">
					<div class="collapse" id="collapseExample">
						<div class="card card-body">
							<h4 class="card-title">Apply for this job</h4>
						    <?php $attributes = array('id' => 'job-form', 'method' => 'post');
		        			echo form_open(base_url('jobs/apply_job'),$attributes);
		        			?>	
						      	<div class="form-group">
							       <textarea name="cover_letter" class="form-control" rows="5" placeholder="Your message / cover letter sent to the employer"></textarea>
							    </div> 
								
							    <!-- Hidden Inputs -->
							    <input type="hidden" name="username" value="<?= $user_detail['firstname']; ?>">
							    <input type="hidden" name="email" value="<?= $user_detail['email']; ?>" >
							    <input type="hidden" name="job_id" value="<?= $job_detail['id']; ?>" >
							    <input type="hidden" name="emp_id" value="<?= $job_detail['employer_id']; ?>" >
							    <input type="hidden" name="job_title" value="<?= $job_detail['title']; ?>" >
							    <!-- current url for redirect to same job detail page  -->
							    <input type="hidden" name="job_actual_link" value="<?= $job_actual_link ?>" >
								<?php
								    $last_request_page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
								    $this->session->set_userdata('last_request_page', $last_request_page); 
								 ?>

								<?php if($this->session->userdata('is_user_login') == true): ?>
								    <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block">Send Application</button>

								<?php elseif($this->session->userdata('is_employer_login') == true): ?>
								    <a href="<?= base_url('auth/login'); ?>" class="btn btn-primary btn-block">Please login as JobSeeker</a>
								<?php else: ?>
								    <a href="<?= base_url('auth/login'); ?>" class="btn btn-primary btn-block">Please login as JobSeeker</a> 
								<?php endif; ?>    

							<?php echo form_close(); ?>
						</div>
					</div>
			</div>
			</div>
			<div class="col-lg-4 sidebar ">
			<div class="single-slidebar text-center">
  				<h4><i class="fa fa-briefcase " aria-hidden="true"></i> Job Action </h4>
						<div class="job-listing-btns ml-5 ">
						<ul class="btns">
							<li style="float:left;"><a href="#" class="btn btn-primary saved_job  ml-15 " data-job_id="<?= $job_detail['id']; ?>"><span class="lnr lnr-star"> </span> Save Job</a></li>
							<li style="float:left;"><a class="btn btn-primary saved_job ml-15 "id="btn-apply" data-toggle="collapse" href="#collapseExample" role="button"><span class="lnr lnr-briefcase"> Apply Now </span></a></li>
						</ul> 
						</div>
			</div>

						<div class="single-slidebar text-center">
						<h4><i class="fa fa-briefcase" aria-hidden="true"></i> Jobs By Companies </h4>
						<div class="active-relatedjob-carusel">
							<?php foreach($jobscompany as $premium): ?>
							<div class="single-rated text-center">
							<img class="img-fluid" src="<?= base_url().get_company_logo($premium ['company_id']); ?>" alt="Job Logo" />
								<a href="<?= site_url('jobs/'.$premium['id'].'/'.($premium ['job_slug'])); ?>"><h4 style="text-transform:capitalize;"><?= text_limit($premium ['title'], 60); ?></h4></a>
								<h6><?= get_company_name($premium ['company_id']); ?></h6>
								<p>
								</p>
								<p class="address"><span class="lnr lnr-apartment"></span> <?= get_industry_name($premium ['industry']); ?></h5>

								<p class="address"><span class="lnr lnr-map-marker"></span>  <?= get_city_name($premium ['city']); ?>, <?= get_country_name($premium ['country']); ?></p>

								<p class="address"><span class="lnr lnr-clock"></span> Deadline : <?= time_ago($premium ['deadline']); ?></p>

								<a href="<?= site_url('jobs/'.$premium ['id'].'/'.($premium ['job_slug'])); ?>" class="btns text-uppercase">Apply job</a>

								</div>

							<?php endforeach; ?>                                 

							</div>
						</div>  
						</div>		
					</div>
				 </div>				 									
</section>
<!-- End post Area -->

<script>
    $(document).ready(function (){
        $("#btn-apply").click(function (){
            $('html, body').animate({
                scrollTop: $("#apply-block").offset().top-90
            }, 1000);
        });
    });
</script>

<script src="<?= base_url() ?>assets/plugins/jssocials/jssocials.min.js"></script>
<script>
    $("#share").jsSocials({
     showLabel: true,
     showCount: true,
     shares: ["email","twitter", "facebook", "googleplus", "linkedin"]
 	});
</script>


