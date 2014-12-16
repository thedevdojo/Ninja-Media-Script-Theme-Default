<?php include('includes/header.php'); ?>



<!-- @if(isset($settings->random_bar_enabled) && $settings->random_bar_enabled == 1)
	  @include('includes.random-bar') 
	@endif -->

<div id="main_container">


	<div class="navbar gallery-sub-header" style="z-index:9;">
	  <div class="container">
	    <div class="pull-left desc-follow">

	    	<p class="website_desc pull-left"><?= $settings->website_description ?></p> 

	    	<?php include('partials/home-social.php') ?>

	    </div>

	    <div class="pull-right mobile-pull-right">
		     <form class="navbar-form search-form col-xs-12" role="search" style="margin:0px; padding-top:4px;" action="<?= URL::to('/') ?>" method="GET">
		            <div class="form-group">
		              <input type="text" class="form-control" name="search" placeholder="<?= Lang::get('lang.search') ?>" style="-webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; height:30px;">
		            	
		            </div>
	          </form>

		    <div class="search_settings">
				<i class="fa fa-search"></i>
				<i class="fa fa-cog option-sidebar-toggle"><span class="cog-arrow-up">&#9650;</span><span class="cog-arrow-down">&#9660;</span></i>

			</div>
			<script>
				$(document).ready(function(){
					$('.option-sidebar-toggle').click(function(){
						$(this).toggleClass('clicked');
						$('.options_sidebar').slideToggle();
						$('.cog-arrow-down').toggle();
						$('.cog-arrow-up').toggle();
					});

					$('.fa-search').click(function(){
						$('.search-form').toggle();
						$('.search-form input').focus();
					});
				});
			</script>
		</div>

	  </div>
	</div>

		<?php if(isset($search)): ?>
			<h4 class="container search-text"><?= Lang::get('lang.search_results_for') ?>: <?= $search ?></h4>
			<style type="text/css">.main_home_container{ padding-top:0px; }</style>
		<?php endif; ?>

		<div class="container main_home_container main_home">

		
		<div class="col-md-8 col-lg-8" style="display:block; clear:both; margin:0px auto; padding:0px; padding-bottom:70px;">
			
			<?php include('partials/loop.php') ?>
				
		</div>

		<?php include('partials/sidebar.php'); ?>

	</div>

	<?php include('partials/media-list-javascript.php'); ?>



</div>

<?php include('includes/footer.php'); ?>