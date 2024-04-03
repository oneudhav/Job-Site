<!-- start banner Area -->
<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								My Resume				
							</h1>	
							<p class="text-white link-nav"><a href="<?= base_url(); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> My Resume</a></p>
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
						<?php if ($this->session->flashdata('file_error')) {
						echo '<div class="alert alert-danger">' . $this->session->flashdata('file_error') . '</div>';
						} ?>
						<?php if ($this->session->flashdata('error_update')) {
						echo '<div class="alert alert-danger">' . $this->session->flashdata('error_update') . '</div>';
						} ?>
						<?php if ($this->session->flashdata('update_success')) {
						echo '<div class="alert alert-success">' . $this->session->flashdata('update_success') . '</div>';
						} ?>
						<?php $attributes = array('id' => 'update_user_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>
						<?php echo form_open('profile',$attributes);?>
							<div class="profile_job_content col-lg-12">
								<div class="headline">
									<div class="row">
										<div class="col-md-8 col-sm-8">
											<h3 class="text-center"> My Resume Details</h3>
								</div>
									
								
								<div class="profile_job_detail">
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Full Name </h5>
												<p><?= $user_info['firstname']; ?><span> <?= $user_info['lastname']; ?></span></p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Title </h5>
												<p><?= $user_info['job_title']; ?></p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Personal Website</h5>
												<p>www.example.com</p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Personal Email </h5>
												<p><?= $user_info['email']; ?></p>
											</div>
										</div>
										<div class="col-md-12 col-sm-12">
											<div class="submit-field">
												<h5>Resume Description </h5>
												<p><?= $user_info['description']; ?></p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Profesion </h5>
												<p><?= $user_info['category']; ?></p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Location </h5>
												<p><?= $user_info['address']; ?></p>
											</div>
										</div>
										<div class="col-md-12 col-sm-12">
											<div class="submit-field">
												<h5>My Skills </h5>
												<p> <?= $user_info['skills']; ?></p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Facebook URL</h5>
												<p>http://www.example.com</p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Twitter URL</h5>
												<p>http://www.example.com</p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Google+ URL</h5>
												<p>http://www.example.com</p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Linkedin URL</h5>
												<p>http://www.example.com</p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Education *</h5>
												<p><?= get_education_level($user_info['education_level']); ?></p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Experience *</h5>
												<p><?= $user_info['experience']; ?></p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Qualification *</h5>
												<p><?= $user_info['education_level']; ?></p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Job Title </h5>
												<p><?= $user_info['job_title']; ?></p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>From to *</h5>
												<p>2012 - 2016</p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>From to *</h5>
												<p>2016 - 2018</p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Additional Certifications <small>optional</small></h5>
												<p>Diploma in Microsoft Office.</p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Additional Skills <small>optional</small></h5>
												<p>Graphic designing, Microsoft Office.</p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Your Photo <small>Size (800x800)</small></h5>
												<p>No photo selected</p>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>PDF Resume <small>Optional</small></h5>
												<p>No file selected</p>
											</div>
										</div>

									</div>
								</div>
							</div>														

						</div>
						
					</div>
				</div>	
			</section>
			<!-- End post Area -->			