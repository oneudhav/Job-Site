<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/texteditor/lib/css/prettify.css"></link>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/texteditor/src/bootstrap-wysihtml5.css"></link>

<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Post a New Job				
				</h1>	
				<p class="text-white link-nav"><a href="#">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Post a New Job</a></p>
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
				<?php $this->load->view($emp_sidebar); ?>
			</div>
			
			<div class="col-lg-8 post-list">
				<div class="row">
					<div class="col-12">
						<?php 
							if ($this->session->flashdata('post_job_success')) {
				                echo '<div class="alert alert-success">' . $this->session->flashdata('post_job_success') . '</div>';
				            }
							if($this->session->flashdata('post_job_error')){
				                echo '<div class="alert alert-danger">' . $this->session->flashdata('post_job_error') . '</div>';
				        	}
						?>
					</div>

					<?php $attributes = array('id' => 'post_job', 'method' => 'post');
        			echo form_open_multipart('employers/job/post',$attributes);?>

					<div class="add_job_content col-lg-12">
						<div class="headline">
							<h3><i class="fa fa-folder-o"></i> Post a New Job</h3>
						</div>
						<div class="add_job_detail">
							<div class="row">
							<div class="col-12">
							
								<div class="col-12">
									<div class="submit-field">
										<h5>Job Title *</h5>
										<input type="text" name="job_title" class="form-control">
									</div>
								</div>
								<div class="col-md-12 ">
									<div class="submit-field">
										<h5>Job Type *</h5>
										<?php 
											$types = get_job_type_list();
											$options = array('' => 'Select Job Type') + array_column($types, 'type','id');
											echo form_dropdown('job_type',$options,'','class="form-control" required');
										?>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Job Category *</h5>
										<select class="form-control" name="category">
										   <option>Select Category</option>
										   <?php foreach($categories as $category): ?>
										   		<option value="<?= $category['id']?>"><?= $category['name']?></option>
										   <?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-12 ">
									<div class="submit-field">
										<h5>Job Industry *</h5>
										<select class="form-control" name="industry">
										   <option>Select Industry</option>
										   <?php foreach($industries as $industry):?>
										   		<option value="<?= $industry['id']?>"><?= $industry['name']?></option>
										   <?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-12 ">
									<div class="submit-field"> 
										<h5>No of Vacancy Available *</h5>
										<select name="total_positions" class="form-control">	
									  	    <?php for($i=1; $i<30; $i++): ?>
									   			<option value="<?= $i; ?>"><?= $i; ?></option>
										    <?php endfor; ?>
										</select>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Working Experience  *</h5>
										<div class="row">
											<div class="col-md-6">
												<div class="input-group">
													<?php 
														$options = get_experience_list('Minimum');
														echo form_dropdown('min_experience',$options,'','class="form-control"');
													?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<?php 
														$options = get_experience_list('Maximum');
														echo form_dropdown('max_experience',$options,'','class="form-control"');
													?>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Salary  *</h5>
										<div class="row">
											<div class="col-md-6">
												<div class="input-group">
													<input type="number" name="min_salary" class="form-control" placeholder="Minimum">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<input type="number" name="max_salary" class="form-control" placeholder="Maximum">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Salary Period  *</h5>
										<select name="salary_period" class="form-control">
											<option value="Hourly">Hourly</option>
											<option value="Weekly">Weekly</option>
											<option value="Monthly">Monthly</option>
											<option value="Monthly">Anually</option>
										</select>
									</div>
								</div>

								<div class="col-12">
									<div class="submit-field">
										<h5> Skills *</h5>
										<input type="text" name="skills" class="form-control" placeholder="e.g. job title, responsibilites">
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Job Description *</h5>
										<textarea name="description" class="form-control" id="editor1" rows="5"></textarea>
									</div>
								</div>								<div class="col-md-12 col-sm-12">									<div class="submit-field">										<h5>Job Specification *</h5>										<textarea name="job_specification" class="form-control" id="editor2" rows="5"></textarea>									</div>								</div>
								
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Education *</h5>
										<select class="form-control" name="education">
											<option value="">Select Education</option>
											<?php foreach($educations as $row): ?>
												<option value="<?= $row['id']; ?>"> <?= $row['type']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Country *</h5>
										<select class="country form-control" name="country">
										   <option>Select Country</option>
										    <?php foreach($countries as $country):?>
										   		<option value="<?= $country['id']?>"><?= $country['name']?></option>
										    <?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Zone *</h5>
										<select class="form-control state" name="state" required>
								            <option>Select Zone</option>
								        </select>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>District *</h5>
										<select class="form-control city" name="city" required>
								            <option>Select District</option>
								         </select>
									</div>
								</div>
								<div class="col-12">
									<div class="submit-field">
										<h5>Location *</h5>
										<input type="text" name="location" class="form-control" placeholder="Type Address">
									</div>
								</div>
								<div class="col-12">
									<div class="submit-field">
										<h5> <?=('deadline')?> *</h5>
										<input type="date" name="deadline" class="form-control" placeholder="Job Deadline">
									</div>
								</div>
								
							
							</div>
						</div>
					</div>
					<div class="add_job_btn col-lg-12 mt-3">
						<div class="submit-field">
							<input type="submit" class="job_detail_btn" name="post_job" value="Submit">
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>													
			</div>
		</div>
	</div>	
</section>
<!-- End post Area -->	  <script>         CKEDITOR.replace( 'editor1' );  </script>  <script>         CKEDITOR.replace( 'editor2' );  </script>