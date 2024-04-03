 <div class="single-slidebar">
  <figure class="mb-4">
    <a href="#" class="employer-dashboard-thumb"> <img src="<?= base_url().$user_info['img']; ?>" width="100%"></a>
    <figcaption>
      <h2><?= $this->session->userdata('username'); ?></h2>
	
         <!-- <h4><?= $user_info['firstname']  ?></h4>
         <h5 class="text-capitalize"><?= $user_info['job_title']; ?></h5>-->
    </figcaption>
  </figure>
  <ul class="cat-list">
    <li>
      <a class="text_active" href="<?= base_url('profile'); ?>"><p><i class="fa fa-user-o pr-2"></i> My Profile</p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('profile/myresume'); ?>"><p><i class="fa fa-id-card-o pr-2"></i> My Resume</p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('myjobs'); ?>"><p><i class="fa fa-file-word-o pr-2"></i> My Applied Jobs</p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('myjobs/matching'); ?>"><p><i class="fa fa-briefcase pr-2"></i> Matching jobs</p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('myjobs/saved'); ?>"><p><i class="fa fa-heart-o pr-2"></i> Saved jobs</p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('account/change_password'); ?>"><p><i class="fa fa-lock pr-2"></i> Change Password</p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('auth/logout')?>"><p><i class="fa fa-sign-out pr-2"></i> Logout</p></a>
    </li>
  </ul>
</div> 