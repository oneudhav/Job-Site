<!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          Manage Jobs       
        </h1> 
        <p class="text-white link-nav"><a href="<?= base_url('employers'); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Manage Jobs</a></p>
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
        <div class="col-md-12">
          <?php if ($this->session->flashdata('update_success')) :?>
            <div class="alert alert-success">
              <a href="#" class="close" data-dimdiss="alert" aria-label="close" title="close">×</a>
              <strong><?=$this->session->flashdata('update_success')?></strong> 
            </div>
          <?php endif;?>
          <?php if ($this->session->flashdata('deleted')) :?>
            <div class="alert alert-success">
              <a href="#" class="close" data-dimdiss="alert" aria-label="close" title="close">×</a>
              <strong><?=$this->session->flashdata('deleted')?></strong> 
            </div>
          <?php endif;?>
        </div>
        <div class="profile_job_content col-lg-12">
          <div class="headline">
            <div class="row">
              <div class="col-12">
                <h3 class="d-inline">Manage Your's Job</h3> 
                <a class="btn btn-info float-right" href="<?= base_url('employers/job/post'); ?>">Post New Job</a>
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
                  <th>Date</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php if(empty($job_info)): ?>
                  <p class="text-gray"><strong>Sorry,</strong> you didn't posted any job yet!</p>
                <?php endif; ?>

                <?php foreach ($job_info as $job): ?>
                <tr>
                  <td>
                    <h4><a href=""><?= $job['title']; ?></a></h4>
                   
                    <div class="job-listing-footer">
                      <ul>
                        <li><i class="fa fa-map-marker"></i> <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></li>
                        <li><i class="fa fa-database"></i> <?= get_industry_name($job['industry']); ?></li>
                      </ul>
                    </div>
                  </td>
                  <td class="text-center">
                    <a href="<?= base_url('employers/applicants/view/'.$job['id']); ?>">Applied (<?= $job['cand_applied']?>)</a><br/>
                    <a href="<?= base_url('employers/applicants/shortlisted/'.$job['id']); ?>">Shortlisted (<?= $job['total_shortlisted']?>)</a><br/>
                  </td>
                  <td><?= $job['created_date']; ?></td>
                  <td>                    <?php                    $curdate = date('Y-m-d');                    if ($curdate >= $job['deadline']) {                      ?>                      <span class="badge badge-light"><?= ('expired') ?></span><br/>                    <?php                    }                    ?>
                    <a href="<?= base_url('employers/job/delete/'.$job['id']); ?>" class="jagirghar-savedjobs-links btn-delete"><i title="delete" class="lnr lnr-trash"></i></a>
                    <a href="<?= base_url('employers/job/edit/'.$job['id']); ?>" class="jagirghar-savedjobs-links"><i title="edit" class="lnr lnr-pencil"></i></a>
                    <a href="<?= base_url('employers/job/edit/'.$job['id']); ?>" class="jagirghar-savedjobs-links"><i title="view" class="lnr lnr-eye"></i></a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>                            

    </div>

  </div>
</div>  
</section>
      <!-- End Job listing Area -->