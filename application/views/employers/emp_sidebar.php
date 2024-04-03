<div class="single-slidebar">
	<figure class="mb-4">
		<a href="#" class="employer-dashboard-thumb"> <img src="<?= base_url().$company_info['company_logo']?>" alt=""></a>
		<figcaption>
			<h2><?= $this->session->userdata('username'); ?></h2>
		</figcaption>
	</figure>
	<ul class="cat-list">
		<li>
			<a class="justify-content-between d-flex text_active" href="<?= base_url('employers/dashboard'); ?>"><p><i class="fa fa-dashboard pr-2"></i> Dashboard</p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex text_active" href="<?= base_url('employers/profile'); ?>"><p><i class="fa fa-user-o pr-2"></i> Personal Info</p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/company'); ?>"><p><i class="fa fa-user-o pr-2"></i>  Company Profile</p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/job/post'); ?>"><p><i class="fa fa-plus pr-2"></i>  Post New Job</p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/job/listing'); ?>"><p><i class="fa fa-list pr-2"></i>  Manage Jobs</p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/packages/bought'); ?>"><p><i class="fa fa-th-large pr-2"></i>  My Packages</p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/cv/shortlisted') ?>"><p><i class="fa fa-briefcase pr-2"></i>  Shortlisted CV Resumes</p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/account/change_password'); ?>"><p><i class="fa fa-lock pr-2"></i> Change Password</p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/auth/logout'); ?>"><p><i class="fa fa-sign-out pr-2"></i> Logout</p></a>
		</li>
	</ul>
</div>	