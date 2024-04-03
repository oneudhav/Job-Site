<section class="content" id="general_settings">
	<div class="row">
	    <div class="col-md-12">
	      <div class="box box-body with-border">
	      	<h3>General Settings</h3>
	      </div>
	  </div>
	</div>
	<div class="row">
	    <div class="col-md-12">
	       <?php if($this->session->flashdata('success')):?>
	        <div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <?= $this->session->flashdata('success'); ?>
	        </div>
	      <?php endif; ?>
	      <?php if($this->session->flashdata('error')):?>
	        <div class="alert alert-danger alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <?= $this->session->flashdata('error'); ?>
	        </div>
	      <?php endif; ?>
	      <div class="box box-body with-border">
	      	<div>
	      	  <?php echo form_open_multipart(base_url('admin/general_settings/add')); ?>	
			  <!-- Nav tabs -->
			  <ul class="nav nav-pills" role="tablist">
			    <li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">General Setting</a></li>
			    <li role="presentation"><a href="#email" aria-controls="email" role="tab" data-toggle="tab">Email Setting</a></li>
			    <li role="presentation"><a href="#social" aria-controls="social" role="tab" data-toggle="tab">Social Media Setting</a></li>
                <li role="presentation"><a href="#reCAPTCHA" aria-controls="reCAPTCHA" role="tab" data-toggle="tab">Google reCAPTCHA</a></li>
			  </ul>
				
			  <!-- Tab panes -->
			  <div class="tab-content">

			    <!-- General Setting -->
			    <div role="tabpanel" class="tab-pane active" id="main">
			    	<div class="form-group">
                        <label class="control-label">Favicon (25*25)</label><br/>
                        <?php if(!empty($general_settings['favicon'])): ?>
                        	<img src="<?= base_url($general_settings['favicon']); ?>" class="favicon">
                        <?php endif; ?>
					    <input type="file" name="favicon" accept=".png, .jpg, .jpeg, .gif, .svg">
					    <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
					    <input type="hidden" name="old_favicon" value="<?php echo html_escape($general_settings['favicon']); ?>">
                    </div>
                    <div class="form-group">
                    	<label class="control-label">Logo</label><br/>
                    	<?php if(!empty($general_settings['logo'])): ?>
                        	<img src="<?= base_url($general_settings['logo']); ?>" class="logo" width="150">
                        <?php endif; ?>
					    <input type="file" name="logo" accept=".png, .jpg, .jpeg, .gif, .svg">
					    <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
					    <input type="hidden" name="old_logo" value="<?php echo html_escape($general_settings['logo']); ?>">
                    </div>
			    	<div class="form-group">
                        <label class="control-label">Application Name</label>
                        <input type="text" class="form-control" name="application_name" placeholder="application name" value="<?php echo html_escape($general_settings['application_name']); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Timezone</label>
                        <input type="text" class="form-control" name="timezone" placeholder="timezone"
                       value="<?php echo html_escape($general_settings['timezone']); ?> ">
                        <a href="http://php.net/manual/en/timezones.php" target="_blank">Timeszones</a>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Currency</label>
                        <input type="text" class="form-control" name="currency" placeholder="currency"
                               value="<?php echo html_escape($general_settings['currency']); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Copyright</label>
                        <input type="text" class="form-control" name="copyright"
                               placeholder="Copyright"
                               value="<?php echo html_escape($general_settings['copyright']); ?>">
                    </div>
			    </div>
				
				<!-- Email Setting -->
			    <div role="tabpanel" class="tab-pane" id="email">
                    <div class="form-group">
                        <label class="control-label">Email From/ Reply to</label>
                        <input type="text" class="form-control" name="email_from" placeholder= "no-reply@domain.com" value="<?php echo html_escape($general_settings['email_from']); ?>">
                    </div>
			    	<div class="form-group">
                        <label class="control-label">SMTP Host</label>
                        <input type="text" class="form-control" name="smtp_host" placeholder="SMTP Host" value="<?php echo html_escape($general_settings['smtp_host']); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">SMTP Port</label>
                        <input type="text" class="form-control" name="smtp_port" placeholder="SMTP Port" value="<?php echo html_escape($general_settings['smtp_port']); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">SMTP User</label>
                        <input type="text" class="form-control" name="smtp_user" placeholder="SMTP Email" value="<?php echo html_escape($general_settings['smtp_user']); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">SMTP Password</label>
                        <input type="password" class="form-control" name="smtp_pass" placeholder="SMTP Password" value="<?php echo html_escape($general_settings['smtp_pass']); ?>">
                    </div>
			    </div>

			    <!-- Social Media Setting -->
			    <div role="tabpanel" class="tab-pane" id="social">
			    	<div class="form-group">
                        <label class="control-label">Facebook</label>
                        <input type="text" class="form-control" name="facebook_link" placeholder="" value="<?php echo html_escape($general_settings['facebook_link']); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Twitter</label>
                        <input type="text" class="form-control" name="twitter_link" placeholder="" value="<?php echo html_escape($general_settings['twitter_link']); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Google Plus</label>
                        <input type="text" class="form-control" name="google_link" placeholder="" value="<?php echo html_escape($general_settings['google_link']); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Youtube</label>
                        <input type="text" class="form-control" name="youtube_link" placeholder="" value="<?php echo html_escape($general_settings['youtube_link']); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">LinkedIn</label>
                        <input type="text" class="form-control" name="linkedin_link" placeholder="" value="<?php echo html_escape($general_settings['linkedin_link']); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Instagram</label>
                        <input type="text" class="form-control" name="instagram_link" placeholder="" value="<?php echo html_escape($general_settings['instagram_link']); ?>">
                    </div>

			    </div>

                <!-- Google reCAPTCHA Setting-->
                <div role="tabpanel" class="tab-pane" id="reCAPTCHA">
                    <div class="form-group">
                        <label class="control-label">Site Key</label>
                        <input type="text" class="form-control" name="recaptcha_site_key" placeholder="Site Key" value="<?php echo ($general_settings['recaptcha_site_key']); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Secret Key</label>
                        <input type="text" class="form-control" name="recaptcha_secret_key" placeholder="Secret Key" value="<?php echo ($general_settings['recaptcha_secret_key']); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Language</label>
                        <input type="text" class="form-control" name="recaptcha_lang" placeholder="Language code" value="<?php echo ($general_settings['recaptcha_lang']); ?>">
                       
                    </div>
                </div>
                <!-- Social Logins-->
                <div role="tabpanel" class="tab-pane" id="social">
                <div class="form-group">
                        <label class="control-label">Facebook Login </label>
                        <input type="text" class="form-control" name="facebook_link" placeholder="" value="<?php echo html_escape($general_settings['facebook_link']); ?>">
                        <input type="text" class="form-control" name="facebook_link" placeholder="" value="<?php echo html_escape($general_settings['facebook_link']); ?>">
                    </div>
                    
                </div>



			  </div>

			  <div class="box-footer">
                <input type="submit" name="submit" value="Save Changes" class="btn btn-primary pull-right">
              </div>	
			<?php echo form_close(); ?>
			</div>
	      </div>
	  </div>
	</div>
</section>

<script>
    $("#setting").addClass('active');
    $('#myTabs a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
</script>
