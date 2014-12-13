<div id="media" style="padding-bottom:70px;">

<?php foreach($media as $item): ?>

	<div class="col-sm-12 item animated single-left" data-href="<?= URL::to('media') . '/' . $item->id ?>" data-id="<?= $item->id ?>">
					
	<?php $media_url = URL::to('media') . '/' . $item->slug; ?>

	<div class="social_container">
		 <ul class="socialcount socialcount-large" data-url="<?= $media_url ?>">
			<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?= $media_url ?>" target="_blank" title="<?= Lang::get('lang.share_facebook') ?>" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;"><span class="fa fa-facebook"></span><span class="count"><?= Lang::get('lang.fb_share') ?></span></a></li>
			<li class="twitter" data-share-text="<?= $item->title ?>"><a href="https://twitter.com/intent/tweet?url=<?= $media_url ?>&text=<?= $item->title ?>" data-url="<?= $media_url ?>" title="<?= Lang::get('lang.share_twitter') ?>" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;"><span class="fa fa-twitter" data-url="<?= $media_url ?>"></span><span class="count"><?= Lang::get('lang.tweet') ?></span></a></li>
			<li class="googleplus"><a href="https://plus.google.com/share?url=<?= $media_url ?>" target="_blank" title="<?= Lang::get('lang.share_google') ?>" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;"><span class="fa fa-google-plus"></span><span class="count"><?= Lang::get('lang.plus_one') ?></span></a></li>
			<li class="pinterest"><a href="//www.pinterest.com/pin/create/button/?url=<?= $media_url ?>&media=<?= Config::get('site.uploads_dir') . '/images/' . $item->pic_url ?>&description=<?= $item->title ?>" title="<?= Lang::get('lang.share_pinit') ?>" target="_blank" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;"><span class="fa fa-pinterest"></span><span class="count"><?= Lang::get('lang.pin_it') ?></span></a></li>						
		</ul>
	</div>

	<?php $view = ''; ?>
	<?php include('media-item.php'); ?>


	<div style="clear:both"></div>
	<div class="media-separator"></div>

	</div>

<?php endforeach; ?>

<div style="clear:both"></div>
<?php include('pagination.php'); ?>

</div><!-- #media -->
