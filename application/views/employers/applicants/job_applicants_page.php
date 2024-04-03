<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Applicants Listings				
				</h1>	
				<p class="text-white link-nav"><a href="<?= base_url(); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Applicants Listings</a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->	

<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
		<div class="row justify-content-center d-flex">

			<div class="col-lg-12 post-list">
				<?php if(empty($applicants)): ?>
                  <p class="alert alert-danger"><strong>Sorry,</strong> There is not applicants against this job.</p>
                <?php endif; ?>
				<?php foreach($applicants as $applicant): ?>
					<div class="single-post justify-content-between d-flex flex-row">
						<div class="thumb">
							<img src="<?= base_url(); ?>assets/img/user.png" height=60 alt="">
						</div>
						<div class="details">
							<div class="title d-flex flex-row justify-content-between">
								<div class="titles">
									<a><h4 class="text-capitalize"><?= $applicant['firstname']; ?> <?= $applicant['lastname']; ?> ( <?= $applicant['job_title']; ?>)</h4></a>				
								</div>
							</div>
							<div class="job-listing-footer">
								<ul>
									<li><i class="lnr lnr-map-marker"></i> <?= get_city_name($applicant['city']); ?>, <?= get_country_name($applicant['country']); ?></li>
									<li><i class="lnr lnr-apartment"></i> <?= get_category_name($applicant['category']); ?></li>
									<li><i class="fa fa-google-plus"></i> <?= $applicant['email']; ?></li>
								</ul>									
							</div>
						</div>
						<div class="job-listing-btns">
							<div class="dropdown">
								<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    More
								</button>
								<?php $resume = ($applicant['resume'] != '')? base_url($applicant['resume']): '#'  ?>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								    <a class="dropdown-item" href="<?= $resume; ?>">Preview CV</a>
								    <a class="dropdown-item" href="<?= $resume; ?>">Download CV</a>
								    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#emailModal" data-whatever="<?= $applicant['email']; ?>">Email Candidate</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item" href="<?= base_url('employers/applicants/make_shortlist/'.$applicant['id'].'/'.$applicant['job_id']); ?>">Shortlist</a>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
					<div class="pull-right">
				        <?php echo $this->pagination->create_links(); ?>
				    </div>
				</div>
			</div>
		</div>
	</section>
					
	<!-- End applicants Area -->	

<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open("/",'class="email-form"') ?>
          <input type="hidden" name="email" class="form-control" id="email">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Subject:</label>
            <input type="text" name="subject" class="form-control" id="subject">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea name="message" class="form-control" id="message"></textarea>
          </div>
          <div class="form-group">
          	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        	<input type="submit" class="btn btn-primary send_email" name="submit" value="Send Message">
          </div>
        <?php form_close(); ?>
      </div>
     
    </div>
  </div>
</div>
<script type="text/javascript">
  /* ----------------- Email ------------------*/

  $('#emailModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body #email').val(recipient);

     $('.send_email').click(function(e) {

      var _form = $(".email-form").serialize();
      $.ajax({
          data: _form,
          type: 'POST',
          url: '<?php echo base_url();?>employers/applicants/email',
          success: function(response){
            modal.find('.modal-title').text(response);
            $(".email-from").trigger('reset');
        	$('.close').trigger('click');
          }
      });
      e.preventDefault();
    }); 
    
  });
   

</script>