<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=isset($title)?$title. ' - '. $this->general_settings['application_name']: 'Jagir Ghar'; ?></title>
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?= base_url($this->general_settings['favicon']); ?>">
	<meta charset="utf-8">
	<meta name="description" content="<?= isset($meta_description)?$meta_description : ''; ?>">
	<meta name="keywords" content="<?= isset($keywords)?$keywords : ''; ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<?php if (isset($show_og_tags)): ?>
	<meta property="og:title" content="<?= $og_title; ?>">
	<meta property="og:description" content="<?= $og_description; ?>">
	<meta property="og:image" content="<?= base_url($og_image); ?>">
	<meta property="og:image:secure_url" content="<?= base_url($og_image); ?>">
	<meta property="og:url" content="<?= $og_url; ?>">
	<meta name="twitter:card" content="summary_large_image">
	<?php endif; ?>


	<!-- Latest compiled and minified CSS -->

	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/linearicons.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/magnific-popup.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/nice-select.css">					
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/animate.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.theme.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.transitions.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>


  
	
</head>

<body>

	<!-- Navbar File-->
		
	<?php include('navbar.php'); ?>

	


	<!--main content start-->
		<?php $this->load->view($layout); ?>
	<!--main content end-->
		
	<!-- Footer File-->
	<?php include('footer.php'); ?>


	<!-- Scripts Files -->
	

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/easing.min.js"></script>			
	<script src="<?= base_url(); ?>assets/js/hoverIntent.js"></script>
	<script src="<?= base_url(); ?>assets/js/superfish.min.js"></script>	
	<script src="<?= base_url(); ?>assets/js/jquery.ajaxchimp.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>	
	<script src="<?= base_url(); ?>assets/js/owl.carousel.min.js"></script>			
	<script src="<?= base_url(); ?>assets/js/jquery.sticky.js"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.nice-select.min.js"></script>			
	<script src="<?= base_url(); ?>assets/js/parallax.min.js"></script>		
	<!-- Notify JS -->
	<script src="<?= base_url() ?>assets/js/notify.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/main.js"></script>	
	
	<?php include('js_footer.php'); ?>
<script type="text/javascript">
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

	

</body>
</html>