
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Job Alerts				
							</h1>	
							<p class="text-white link-nav"><a href="<?= base_url(); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Job Alerts</a></p>
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
							<div class="profile_job_content col-lg-12">
								<div class="headline">
									<div class="row">
										<div class="col-md-8 col-sm-8">
											<h3> Manage Jobs</h3>
										</div>
										<div class="col-sm-4 col-md-4 mb-2">
											 <div class="input-group">
											    <input type="text" class="form-control" placeholder="Search">
											    <div class="input-group-append">
											      <a class="btn btn-white"><i class="fa fa-search"></i></a>  
											     </div>
											</div>   
										</div>
									</div>	
								</div>
								
								<div class="jagirghar-job-alerts">
                                        <div class="table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Job Title</th>
                                                        <th>Applications</th>
                                                        <th>Featured</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                        	<h4>Computer and Information Tech</h4>
                                                        	<div class="job-listing-footer">
                                                        		<ul>
																	<li><i class="fa fa-calendar"></i> Created: Sep 14, 2017</li>
																	<li><i class="fa fa-calendar"></i> Expiry: Dec 9, 2017</li>
																</ul>
                                                        	</div>
                                                        	<div class="job-listing-footer">
                                                        		<ul>
																	<li><i class="fa fa-map-marker"></i> Netherlands, Rotterdam</li>
																	<li><i class="fa fa-database"></i> Web Developer</li>
																</ul>
                                                        	</div>
                                                        	
                                                        </td>
                                                        <td class="text-center"><a href="">4 Application(s)</a></td>
                                                        <td class="text-center"><i class="lnr lnr-star"></i></td>
                                                        <td>Jun 2, 2017</td>
                                                        <td>
                                                            <a href="#" class="jagirghar-savedjobs-links"><i class="lnr lnr-trash"></i></a>
                                                            <a href="#" class="jagirghar-savedjobs-links"><i class="lnr lnr-pencil"></i></a>
                                                            <a href="#" class="jagirghar-savedjobs-links"><i class="lnr lnr-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

							</div>														

						</div>
						
					</div>
				</div>	
			</section>
			<!-- End post Area -->	