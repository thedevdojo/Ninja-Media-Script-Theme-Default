<div class="col-md-4 col-lg-4" id="sidebar_container">

	<!-- OPTIONS BAR -->

		<div class="options_sidebar">
		<?php $media_view = Cookie::get('media_view'); ?>

		<h2>Viewing Options:</h2>

		<div class="viewing_options">
		  <i class="fa fa-th-list <?php if(!isset($media_view) || $media_view == 'list'){ echo 'active'; } ?>" data-url="<?= URL::to('view/list'); ?>"></i>
		  <i class="fa fa-th-large <?php if(isset($media_view) && $media_view == 'grid_large'){ echo 'active'; } ?>" data-url="<?= URL::to('view/grid_large'); ?>"></i>
		  <i class="fa fa-th <?php if(isset($media_view) && $media_view == 'grid'){ echo 'active'; } ?>" data-url="<?= URL::to('view/grid'); ?>"></i>
		</div>
		<div style="clear:both"></div>

		</div>

		<script type="text/javascript">
		  $(document).ready(function(){
		    $('.viewing_options i').click(function(){
		      window.location = $(this).data('url');
		    }); 
		  });
		</script>

	<!-- END OPTIONS BAR -->

	

	<div id="sidebar_inner">
		<div id="sidebar" <?php if(isset($single) && $single): ?>style="margin-top:27px;"<?php else: ?>style="margin-top:15px;"<?php endif; ?>>

			<?php if(isset($single) && $single): ?>

				<?php include('sidebar-prev-next.php'); ?>
				<div class="clear"></div>
				<?php include('media-tags.php'); ?>

			<?php else: ?>

				<a class="spcl-button color" href="<?= URL::to('upload') ?>"><?= Lang::get('lang.submit_pic_or_video') ?></a>

				<div class="social_block">
					<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F<?= $settings->facebook_page_id ?>&amp;width&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:240px; width:100%;" allowTransparency="true"></iframe>
				</div>

			<?php endif; ?>
			
			<?php if(isset($settings->square_ad) && !empty($settings->square_ad)): ?>
				<?= json_decode($settings->square_ad) ?>
			<?php else: ?>
				<img src="http://placehold.it/300x250&text=Advertisement" style='position:relative; left:1px; width:100%; overflow:hidden' />
			<?php endif; ?>
		</div>
	</div>
</div>
<div style="clear:both"></div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#sidebar_inner").sticky({topSpacing:50});
	});
</script>