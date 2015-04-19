<?php include('includes/header.php'); ?>

<style type="text/css">

	.navbar.gallery-sub-header{
		display:none;
	}

	.item-large{
		width:100%;
		margin:0px auto;
	}

	div.pagination{
		padding-left:90px;
		padding-right:80px;
	}

</style>


<?php if($settings->infinite_scroll): ?>
	<style type="text/css">
		div.pagination{
			visibility:hidden;
		}
	</style>
<?php endif; ?>

	<?php 
		if(isset($user_profile)){
			$user_points = DB::table('points')->where('user_id', '=', $user_profile->id)->sum('points');
		}else {
			$user_points = DB::table('points')->where('user_id', '=', $user->id)->sum('points'); 

		}
		?>
	<?php include('partials/profile-mobile.php'); ?>

<div class="container main_home_container">


	<div class="col-md-12">

		<?php if(isset($points)): ?>

			<?php include('partials/user-points.php'); ?>
			<?php include('partials/leaderboard.php'); ?>

		<?php else: ?>

			<div id="media" class="col-md-8 col-lg-8" style="display:block; clear:both; margin:0px auto; padding:0px; padding-bottom:70px;">

				<?php if(count($media) == 0): ?>
					<h2 style="padding:10px 0px;"><i class="fa-meh-o fa"></i> <?php if(isset($likes)): ?><?= Lang::get('lang.no_likes_yet') ?><?php else: ?><?= Lang::get('lang.no_uploads_yet') ?><?php endif; ?></h2>
				<?php endif; ?>

				<?php foreach($media as $item): ?>

					<?php
					if(isset($likes)){
					 	$item = $item->media();
					} 
					?>

					  
					<div class="col-sm-12 item animated single-left" data-href="<?= URL::to('media') . '/' . $item->id ?>">

						<?php include('partials/media-item.php'); ?>

					</div>
					  

				<?php endforeach; ?>	
				
				<div style="clear:both"></div>
				<?php include('partials/pagination.php'); ?>	

			</div><!-- #media -->

		<?php endif; ?>


	<?php include('partials/profile-sidebar.php'); ?>


</div>

	</div>

</div>

<?php if(!Auth::guest() && Auth::user()->id == $user->id): ?>

	<?php include('partials/edit-user-profile.php'); ?>

<?php endif; ?>

<?php include('partials/aboutpoints.php'); ?>


<script type="text/javascript">

	$(document).ready(function(){

		$('.hover_tooltip').tooltip({ placement: 'bottom' });

		$('.flag-user').click(function(){
				this_object = $(this);
				$.post("<?= URL::to('user') . '/add_flag' ?>", { user_id: $(this).data('id') }, function(data){
					
					$.getJSON("<?= URL::to('api') . '/commentflags/' ?>" + String($(this_object).data('id')), function(data){
						flagged_user = "<?= Lang::get('lang.flagged_this_user') ?>";
						flag_user = "<?= Lang::get('lang.flag_user') ?>";
						if($(this_object).find('.flag-message').text() == flagged_user)
						{	
							$(this_object).find('.flag-message').text(flag_user);
						} else {
							$(this_object).find('.flag-message').text(flagged_user);
						}
					});
				});
			});
	});

</script>

<?php include('partials/media-list-javascript.php'); ?>

<?php include('includes/footer.php'); ?>