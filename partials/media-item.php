<div class="item-large">
  	<div class="single-title">
  		
  		<?php if($item->user()): ?>
  			<?php $user_url = URL::to('user') . '/' . $item->user()->username;
  				  $username = $item->user()->username;
  				  $user_avatar = Config::get('site.uploads_dir') . '/avatars/' . $item->user()->avatar;
  			?>
  		<?php else: ?>
  			<?php $user_url = '#_';
  				  $username = Lang::get('lang.anonymous');
  				  $user_avatar = Config::get('site.uploads_dir') . '/avatars/default.jpg';
  			?>
  		<?php endif; ?>

		<a href="<?= $user_url ?>"><img src="<?= $user_avatar ?>" class="img-circle user-avatar-medium" /></a><h2 class="item-title"><a href="<?= URL::to('media') . '/' . $item->slug; ?>" alt="<?= $item->title ?>"><?= stripslashes($item->title) ?></a></h2>
		<div class="item-details">
			<p class="details"><?= Lang::get('lang.submitted_by') ?>: <a href="<?= $user_url ?>"><?= $username?></a> <?= Lang::get('lang.submitted_on') ?> <?= date("F j, Y", strtotime($item->created_at)) ?></p>
			<p class="home-like-count"><i class="fa <?= $settings->like_icon ?>"></i> <span><?= $item->totalLikes() ?></span></p>
			<p class="home-comment-count"><i class="fa fa-comments"></i> <?= count($item->comments) ?></p>
			<p class="home-view-count"><i class="fa fa-eye"></i> <?php if(isset($view_increment) && $view_increment == true ): ?><?= $item->views + 1 ?><?php else: ?><?= $item->views ?><?php endif; ?> </p>
		</div>
		
		<?php if(!Auth::guest()): ?>
			<?php $liked = MediaLike::where('user_id', '=', Auth::user()->id)->where('media_id', '=', $item->id)->first(); ?> 
		<?php endif; ?>
		
		<div class="home-media-like <?php if(isset($liked->id)){ echo 'active'; } ?>" data-authenticated="<?php if(Auth::guest()): ?><?= 'false' ?><?php else: ?><?= 'true' ?><?php endif; ?>" data-id="<?= $item->id ?>"><i class="fa <?= $settings->like_icon ?>"></i></div>
		
	</div>

	<div class="clear"></div>

	<?php if($item->nsfw != 0 && Auth::guest()): ?>

		<div class="nsfw-container">
			<h1>NSFW!</h1>
			<p>This content has been marked as Not Safe For Work, login to view this content</p>
			<div class="nsfw-login-signup">
				<a href="<?= URL::to('login') ?>?redirect=<?= URL::to('media') . '/' . $item->slug; ?>" class="btn btn-color nsfw-login">login</a>
				<span>or</span>
				<a href="<?= URL::to('signup') ?>?redirect=<?= URL::to('media') . '/' . $item->slug; ?>" class="btn btn-color">signup</a>
			</div>
		</div>
	
	<?php else: ?>
	
		<?php if($item->vid != 1): ?>
			<?php if(strpos($item->pic_url, '.gif') > 0): ?>
				<div class="animated-gif">
					<img class="single-media animation" alt="..." src="<?= Config::get('site.uploads_dir') . '/images/' . $item->pic_url ?>" data-animation="<?= Config::get('site.uploads_dir') . '/images/' . str_replace('.gif', '-animation.gif', $item->pic_url) ?>" data-original="<?= Config::get('site.uploads_dir') . '/images/' . $item->pic_url ?>" data-state="0" />
					<img style="display:none" src="<?= Config::get('site.uploads_dir') . '/images/' . str_replace('.gif', '-animation.gif', $item->pic_url) ?>" />
					<p class="gif-play"><i class="fa fa-play-circle-o"></i></p>
				</div>
			<?php else:
					$str = $item->pic_url;
					$img = explode(";",$str);
					foreach ($img as $value) { ?>
						<a href="<?= URL::to('media') . '/' . $item->slug; ?>" alt="<?= $item->title ?>"><img class="single-media" alt="..." src="<?= Config::get('site.uploads_dir') . '/images/' . $value ?>" /></a>
						<p></p>
			<?php 	} 
				endif; ?>
	
		<?php else: ?>

			<div class="video_container <?php if(strpos($item->vid_url, 'vine') > 0){ echo 'vine'; } ?>" <?php if(isset($single) && $single): ?>itemprop="video" itemscope itemtype="http://schema.org/VideoObject"<?php endif; ?>>
				
				<?php if(isset($single) && $single): ?>
					<meta itemprop="thumbnailUrl" content="<?= Config::get('site.uploads_dir') . '/images/' . $item->pic_url ?>" />
					<meta itemprop="embedUrl" content="<?= $item->vid_url ?>" />
					<meta itemprop="name" content="<?= stripslashes($item->title) ?>" />
					<?php if($settings->media_description && isset($item->description) && !empty($item->description)): ?>
						<span itemprop="description"><?= $item->description ?></span>
					<?php endif; ?>
				<?php endif; ?>


				<!-- YOUTUBE VIDEO -->
				<?php if (strpos($item->vid_url, 'youtube') > 0 || strpos($item->vid_url, 'youtu.be') > 0): ?>
			        
					<iframe title="YouTube video player" class="youtube-player" type="text/html" width="640"
			height="360" src="http://www.youtube.com/embed/<?= Youtubehelper::extractUTubeVidId($item->vid_url); ?>?theme=light&rel=0" frameborder="0"
			allowFullScreen></iframe>

			   

			    <!-- VIMEO VIDEO -->
			    <?php elseif (strpos($item->vid_url, 'vimeo') > 0): ?>
			        <?php $vimeo_id = (int)substr(parse_url($item->vid_url, PHP_URL_PATH), 1); ?>
			        <iframe src="//player.vimeo.com/video/<?= $vimeo_id; ?>" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			    
			    <!-- VINE Video -->
			    <?php elseif (strpos($item->vid_url, 'vine') > 0): ?>
			    	<?php $include_embed = (strpos($item->vid_url, '/embed') > 0) ? '' : '/embed'; ?>
			    	<img class="single-media vine-thumbnail" style="cursor:pointer;" alt="..." src="<?= Config::get('site.uploads_dir') . '/images/' . $item->pic_url ?>" data-embed="<?= $item->vid_url . $include_embed ?>/simple?audio=1" />
			    	<p class="vine-thumbnail-play" data-embed="<?= $item->vid_url . $include_embed ?>/simple?audio=1" style="color:#fff; color:rgba(255, 255, 255, 0.6); font-size:50px; position:absolute; z-index:999; width:50px; height:50px; top:50%; left:50%; margin:0px; padding:0px; margin-left:-30px; margin-top:-30px; cursor:pointer;"><i class="fa fa-play-circle-o"></i></p>
			    	
			    <?php endif; ?>

			</div> <!-- .video_container -->

		<?php endif; ?>

	<?php endif; ?>

	<!-- end NSFW IF -->

	<?php if($settings->media_description && isset($item->description) && !empty($item->description)): ?>
		<p class="media_description"><?= html_entity_decode($item->description) ?></p>
	<?php endif; ?>
</div><!-- item-large -->