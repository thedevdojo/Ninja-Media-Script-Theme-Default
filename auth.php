<?php include('includes/header.php'); ?>

 <style type="text/css">
    html, body, #main_container{
        background:none;
    }
    .navbar.gallery-sub-header{
        display:none;
    }
    #footer, .backstretch, #overlay, .form-signin{
        display:none;
    }
</style>

	<?php if (Session::has('notification')): ?>
	    <span class="notification"><?= Session::get('notification'); ?></span>
	<?php endif; ?>

	<!-- SHOW SIGNUP FORM -->
	<?php if($type == 'signup'): ?>

		<?php include('partials/form-signup.php'); ?>

	<!-- SHOW SIGN IN FORM -->
	<?php elseif($type == 'login'): ?>

		<?php include('partials/form-login.php'); ?>

	<!-- SHOW FORGOT PASSWORD FORM -->
	<?php elseif($type == 'forgot_password'): ?>

		<?php include('partials/form-forgot-password.php'); ?>

	<!-- SHOW RESET PASSWORD FORM -->
	<?php elseif($type == 'reset_password'): ?>

		<?php include('partials/form-reset-password.php'); ?>

	<?php endif; ?>


	<div id="overlay"></div>

	<script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/jquery.backstretch.min.js"></script>
	<script type="text/javascript">

	     var RecaptchaOptions = {
	        theme : 'white'
	     };

	    var images = ['01.jpg', '02.jpg', '03.jpg', '04.jpg', '05.jpg', '06.jpg', '07.jpg', '08.jpg', '09.jpg', '10.jpg'];

	    $(document).ready(function(){
	        $.backstretch('/content/themes/default/assets/img/background/' + images[Math.floor(Math.random() * images.length)] );
	        position_elements();
	    });

	    $(window).resize(function(){
	        position_elements();
	    });

	    function position_elements(){
	        $('#overlay').css('height', $(window).height());
	        $('.form-signin').css('top', ( ($(window).height()/2) - ($('.form-signin').height()/2) ) - $('.navbar').height() + 'px' );
	        $('.backstretch, #overlay, .form-signin').fadeIn();
	    }
	</script>

<?php include('includes/footer.php'); ?>