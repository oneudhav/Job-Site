
 <!-- Start Resume -->
<div class="resume-left"> 
<a id="myBtn" data-toggle="modal" class="btn btn-default"><i class="icon-documents"></i>&nbsp;Upload Resume</a>
</div>
<div id="myModal" class="modal1 fade">
 <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal1-content">
                    <?php  
                     if($this->session->flashdata('success')){
                      echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                        }
                    ?>
      <div class="modal-header">
        <h5 class="modal-title text-danger text-center pb-5" id="exampleModalLongTitle">Upload Your Resume.</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
                    
            <?php echo form_open_multipart(base_url('home'), 'class="form-horizontal"');  ?> 
            <div class="col-12">
                    <div class="form-group">
                      <label for="ads image" class="col-sm-2 control-label">Resume</label>
                            <div class="col-sm-6">
                              <input type="file" name="userfile" class="form-control" placeholder="Resume" accept="pdf/docx/doc*" required/>
                              <input type="hidden" name="old_logo" value="">
                            </div> 
                    </div>
                      
                      <div class="form-group">
                        <div class="col-sm-2">
                          <input type="submit" name="submit" value="Upload Resume" class="btn view-btn">
                        </div>
                      </div>
                      <?php echo form_close( ); ?>
              </div>
            </div>
          </div>
         </div>
      
    </div>

<!-- End Resume --> 

  <!-- start banner Area -->
  <section class="banner-area-2 relative " id="home">  
    <div class="container-fluid">
      <div class="row  d-flex align-items-center justify-content-center">
        <div class="banner-content col-lg-12 col-md-12 col-sm-12">
				<div id="slider-main" class="owl-carousel1  owl-theme">
          <?php foreach($slider as $slide): ?>
          <div class="item" >  
          <a href="<?= $slide['url']; ?>" target="_blank"><img  src="<?= site_url().$slide['img']; ?>"  ></a>
          </div>
          <?php endforeach; ?>    
          </div>
        <h1 style="font-size:25px;"class="text-black ">
               Over <span>100+</span> Jobs Are Waiting For You      
            </h1>    
        <?php $attributes = array('id' => 'search_job', 'method' => 'post');
              echo form_open('jobs/search',$attributes);?>
              <div class="row justify-content-center form-wrap mt-5 no-gutters">
              <div class="col-lg-2 form-cols"></div>
                <div class="col-lg-4 form-cols">
                  <input type="text" class="form-control" name="job_title" value="<?php if(isset($search_value['title'])) echo str_replace('-', ' ', $search_value['title']); ?>" placeholder="Eg: Web Developer?">
                </div>
                <div class="col-lg-2 form-cols">
                    <select name="city" class="form-control">
                      <option value="">Select Location</option>
                      <?php foreach($cities as $cities1):?>
                        <?php if($search_value['city'] == $cities1['id']): ?>
                          <option value="<?= $cities1['id']; ?>" selected> <?= $cities1['name']; ?> </option>
                        <?php else: ?>
                          <option value="<?= $cities1['id']; ?>"> <?= $cities1['name']; ?> </option>
                      <?php endif; endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-2 form-cols">
                    <input type="submit" name="search" class="btn btn-info" value="Search">
                </div>   
              </div>
              <div class="col-lg-2 form-cols"></div>      
      <?php echo form_close(); ?>         
      </div>              
        </div>  
  </div>
  </section>

  <!-- End banner Area -->  
  <!-- Start Tops Jobs -->
<section class="feature-cat-area section-gap " id="category">
  <div class="container ">
    <div class="row d-flex"> 
      <div class="menu-content col-lg-8 ">
        <div class="title ">
          <h1 class="mb-10 text-center"><i style="color:#652d92;"class="fa fa-star"></i> Top Jobs </h1>
        </div>         
        <div class="row">
        <?php foreach($jobs_tops as $tops): ?>
          <div class="col-lg-3 col-md-3 col-sm-3 mb-18 ">
          <div class="topsingle-fcat active">
           <p><a href="<?= site_url('jobs/'.$tops['id'].'/'.($tops['job_slug'])); ?>"><h5 style="font-size:14px;color:#0389c;text-transform: capitalize;text-align:center;"><?= text_limit($tops['title'], 20); ?></h5></a> </p>
           <p><a href="<?= site_url('jobs/'.$tops['id'].'/'.($tops['job_slug'])); ?>"> <img src="<?= base_url().get_company_logo($tops['company_id']); ?>" alt="Company Logo" width="80" height="80" /></a></p>
           <p><?= get_company_name($tops['company_id']) ?></p>
           <p> <i class="lnr lnr-map-marker"></i><?= get_city_name($tops['city']); ?></p>
             <p><i class="lnr lnr-clock"></i> <?= time_ago($tops['deadline']); ?></p>
            </div>
          </div>  
          <?php endforeach; ?>                                      
      </div> 
    </div>
     <div class="col-lg-4  sidebar ">
          <div class="single-slidebar  text-center">
            <h4 ><i class="fa fa-bullhorn"></i> Sponsor</h4>
            <div  id="sponsor-slider" class="owl-carousel"> 
            <?php foreach($rightad as $ads1): ?> 
            <ul class="cat-list ">
             <a href="<?= $ads1['url']; ?>" target="_blank"><img  src="<?= base_url().$ads1['img']; ?>"  alt="Sponsor"></a>
            </ul> 
          <?php endforeach; ?>
          </div>
          </div>   
          <div class="single-slidebar text-center">
            <h4><i class="fa fa-bookmark"></i> Premium Job</h4>
            <div  id="premium-slider" class="owl-carousel"> 
              <?php foreach($jobs_premium as $premium): ?>
                <div class="single-rated text-center">
                <img  src="<?= base_url().get_company_logo($premium ['company_id']); ?>" alt="Job Logo" />
                  <a href="<?= site_url('jobs/'.$premium['id'].'/'.($premium ['job_slug'])); ?>"><h4 style="text-transform:capitalize;"><?= text_limit($premium ['title'], 60); ?></h4></a>
                  <h6><?= get_company_name($premium ['company_id']); ?></h6>
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
  <!-- Ends Tops Jobs -->

  <!--Hot Jobs -->

 <section class="feature-cat-area section-gap2 " id="category">
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="menu-content col-lg-8">
      <div class="title ">
        <h1 class="mb-10 text-center"><i style="color:#652d92;"class="fa fa-fire"></i> Hot Jobs </h1>
      </div>         
      <div class="row">
      <?php foreach($jobs_hot as $hot): ?>
        <div class="col-lg-3 col-md-3 col-sm-3 mb-18 justify-content-center">
          <div class="hotsingle-fcat">
          <p><a href="<?= site_url('jobs/'.$hot['id'].'/'.($hot['job_slug'])); ?>"><h6 style="color:#0389c;text-transform: capitalize;"><?= text_limit($hot['title'], 20); ?></h6></a>    </p>
          <a href="<?= site_url('jobs/'.$hot['id'].'/'.($hot['job_slug'])); ?>"><img src="<?= base_url().get_company_logo($hot['company_id']); ?>" alt="Company Logo" width="80" height="80" /></a>
          <p style="font-weight: bold; font-size: 14px;"><?= get_company_name($hot['company_id']) ?></p>  
              <p><span class="lnr lnr-map-marker"></span> <?= get_city_name($hot['city']); ?></p>
              <p class="address"><span class="lnr lnr-clock"> <?= time_ago($hot['deadline']); ?></span></p>
            </a>
          </div>
        </div>  
        <?php endforeach; ?>                                     
       </div>        
  </div>
  <div class="col-lg-4 sidebar">
          <div class="single-slidebar ">
            <h4 ><i class="fa fa-briefcase"></i> Jobs By Industry</h4>
            <div class="aside-list-menu">
                  <ul class="expandable">     
                <?php foreach($industry1 as $industry):?>
                <li> <a  href="<?= base_url('jobs/industry/'.get_industry_slug($industry['industry_id'])); ?>"><p><?= get_industry_name($industry['industry_id']); ?> [ <?= $industry['total_jobs']; ?> ] </p></a></li>
                  <?php endforeach; ?>          
                  </ul>
             </div>
          </div>
          </div>  
   </div>     
</div>  
</section>
  <!-- Ending Premium Jobs -->
  <!-- Start feature-cat Area -->

  <section class="feature-cat-area section-gap1  pb-5" id="category">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content  col-lg-8">
          <div class="title ">
          <h1 class="mb-10 text-center"><i style="color:#652d92;"class="fa fa-briefcase"></i> Featured Jobs </h1>
          </div>
			   <div class="row">
					<div class="col-lg-2 col-md-2 col-sm-2">
						<div class="single-fcat">
						  <a href="<?= base_url('jobs/category/accounting'); ?>">
							<img src="<?= base_url(''); ?>assets/img/o1.png" alt="">
							<p>Accounting</p>
						  </a>
						</div>
					  </div>
					  <div class="col-lg-2 col-md-2 col-sm-2">
						<div class="single-fcat">
						  <a href="<?= base_url('jobs/category/construction'); ?>">
							<img src="<?= base_url(); ?>assets/img/o2.png" alt="">
							<p>Construction</p>
						  </a>
						  </div>
						</div>
					  <div class="col-lg-2 col-md-2 col-sm-2">
						<div class="single-fcat">
						  <a href="<?= base_url('jobs/category/information-technology'); ?>">
							<img src="<?= base_url(); ?>assets/img/o3.png" alt="">
							<p>Technology</p>
						  </a>
						</div>
					  </div>
					  <div class="col-lg-2 col-md-2 col-sm-2">
						<div class="single-fcat">
						  <a href="<?= base_url('jobs/category/sales'); ?>">
							<img src="<?= base_url(); ?>assets/img/o4.png" alt="">
							<p>Sales</p>
						  </a>
						</div>
					  </div>
					  <div class="col-lg-2 col-md-2 col-sm-2">
						<div class="single-fcat">
						  <a href="<?= base_url('jobs/category/medical-healthcare'); ?>">
							<img src="<?= base_url(); ?>assets/img/o5.png" alt="">
							<p>Medical</p>
						  </a>
						</div>
					  </div>

					  <div class="col-lg-2 col-md-4 col-sm-6">
						<div class="single-fcat">
						  <a href="<?= base_url('jobs/category/engineering'); ?>">
							<img src="<?= base_url(); ?>assets/img/o6.png" alt="">
							<p>Engineering</p>
						  </a>
						</div>      
					  </div> 
					</div>
        </div>
              <div class="col-lg-4 sidebar">
                      <div class="single-slidebar text-center">
                        <h4><i class="fa fa-globe"></i> Our Social Pages</h4>
                        <ul class="cat-list">
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0&appId=256963648753869&autoLogAppEvents=1" nonce="EOUHQ0pG"></script>
                        <div class="fb-page" data-href="https://www.facebook.com/Jagir-Ghar-PvtLtd-112367360437852" data-tabs="timeline" data-width="" data-height="120px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Jagir-Ghar-PvtLtd-112367360437852" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Jagir-Ghar-PvtLtd-112367360437852">Jagir Ghar Pvt.Ltd.</a></blockquote></div>
                        </ul> 
                      </div>
              </div>  
        </div>  
       </div>
  </section>

  <!-- End feature-cat Area -->
  <!-- Start post Area -->

  <section class="post-area section-gap2 bg-white">
    <div class="container">
      <div class="row justify-content-center d-flex">
              <div class="menu-content col-lg-8">
                <div class="title ">
                  <h1 class="text-center">Recent Jobs</h1>
                  <p></p>
                </div>
              </div>
        <div class="col-lg-8 col-md-8 col-sm-8 post-list">
          <?php foreach($jobs as $job): ?>
            <div class="single-post d-flex flex-row">
              <div class="thumb">
              <img style="float:left;padding-left:-10px;" src="<?= base_url().get_company_logo($job['company_id']); ?>" alt="Job Logo" width="80" height="80" />
              </div>
              <div  class="details ">
                <div class="title pl-5 d-flex flex-row justify-content-between">
                  <div class="titles ">
                  <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><h4 style="color:#0389c;margin-left:50px;"><?= text_limit($job['title'], 60); ?></h4></a>
					<h6 style="margin-left:50px;"><?= get_company_name($job['company_id']); ?></h6>       
                  </div>
                </div>
                <div  class="job-listing-footer ">
                  <ul style="margin-left:50px;"> 
                  <li><i class="lnr lnr-map-marker"></i> <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></li>
                    <li><i class="lnr lnr-briefcase"></i> <?= get_job_type_name($job['job_type']); ?></li>
                    <li><i class="lnr lnr-clock">Deadline :</i> <?= time_ago($job['deadline']); ?></li>
                  </ul>                 
                </div>
              </div>
              <div class="job-listing-btns">
                <ul class="btns">
							<li><a class="saved_job" data-job_id="<?= $job['id']; ?>"><span class="lnr lnr-star"> Save Job </span></a></li>
				      <li><a class="saved_job" href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><span class="lnr lnr-briefcase"> Apply Now </span></a></li>       
                </ul>
              </div>
            </div>
          <?php endforeach; ?>
          <a class="text-uppercase loadmore-btn mb-10 justify-content-center mx-auto d-block" href="<?= base_url('jobs'); ?>">Show More Jobs</a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 sidebar">
          <div class="single-slidebar text-center">
            <h4><i class="fa fa-calendar" aria-hidden="true"></i> Events Area </h4>
            <ul class="cat-list">
            <?php foreach($events as $event): ?>
          <a href="<?= $event['url']; ?>" target="_blank"><img  src="<?= site_url().$event['img']; ?>" height="220" width="220"  ></a>
          <?php endforeach; ?>   
            </ul> 
         </div>
        </div>
    </div>  
	</div>
  </section>

  <!-- End post Area -->

  <section class="companies-area  section-gap2 pb-5">
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="menu-content pb-10 col-lg-12">
      <div class="title text-center">
        <h1 class="mb-10">Top Companies</h1>
       </div>
    </div>
  </div>
    <div class="row">
      <div class="col-lg-12  bg-companies">
          <div  class="owl-company owl-carousel"> 
                            <?php foreach($companies as $company): ?>
                                      <div class="company-item-list ">
                                        <a href="<?= base_url('company/'.$company['company_slug']); ?>"><img src="<?= base_url().$company['company_logo']; ?>"  alt="company-img" /></a>
                                      </div>
                          <?php endforeach; ?>
          </div>      
      </div>
    </div>
</div>
</section>

  <!-- End cities Area -->
  <!-- Start testimonial Area -->

  <section class="testimonial-area  section-gap2 pb-5">
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="menu-content pb-10 col-lg-12">
      <div class="title text-center">
        <h1 class="mb-10">Testimonials</h1>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 shdw  pb-4">
        <div id="testimonial-slider" class="owl-carousel">
                        <?php foreach($testi as $testimonials): ?>   
                        <div class="testimonial-pad">
                              <div class="testimonial-box">
                                    <div class="testimonial-image">
                                        <img src="<?= base_url().$testimonials['img']; ?>" />
                                    </div>
                                    <div class="testimonial-content">
                                        <h3>
                                        <?= $testimonials['name'];?> <span><?= $testimonials['position']; ?></span>
                                        </h3>
                                       <p> <?= $testimonials['desc']; ?></p>
                                    </div>
                              </div>
                            </div>
                            <?php endforeach; ?>      
        </div>
    </div>
  </div>
</div>
</section>

  <!-- End testimonial Area -->
  <section class="testimonial-area section-full section-gap2 pb-5">
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="menu-content pb-20 col-lg-12 ">
          <div class="title text-center ">
              <h1 class="mb-10 "><i class="fa fa-bullhorn "> Ads</i></h1>
        </div>
        <div class="banner-content  align-items-center  col-lg-12 col-md-12 col-sm-12">
              <div id="sliderbottom-main" class="owl-carousel1 owl-theme"> 
                  <?php foreach($ad as $ads): ?>   
                    <div class="item" >  
                    <a href="<?= $ads['url']; ?>" target="_blank"><img  src="<?= site_url().$ads['img']; ?>" height="80" width="920" ></a>
                  </div>
                    <?php endforeach; ?>
              </div>
       </div>
    </div>
  </div>
</section>


