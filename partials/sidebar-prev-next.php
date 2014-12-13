<ul class="nav nav-pills pull-left" style="margin-bottom:15px;">
	<?php if(isset($previous->id)): ?><li class=""><a href="<?= URL::to('media') . '/' . $previous->slug ?>" class="btn btn-info btn-prev" style="padding:10px;"><?= Lang::get('lang.previous') ?></a></li><?php endif; ?>
	<?php if(isset($next->id)): ?><li class=""><a href="<?= URL::to('media') . '/' . $next->slug ?>" style="padding:10px;" class="btn btn-info btn-next"><?= Lang::get('lang.next') ?></a></li><?php endif; ?>
</ul>

<ul style="margin-bottom:15px;" id="next_media">
<?php $prev_media_list = ''; ?>
<?php foreach($media_prev as $prev_media): ?>

	
	<?php
	if($prev_media->id == $media->id) {
		$isActive = 'active';
	} else {
		$isActive = '';
	} ?>


	<?php $prev_media_list = "<li class='col-md-4'><a href='" . URL::to('media') . '/' . $prev_media->slug . "'><div class='imgLiquidFill imgLiquid " . $isActive . "' style='width:95px; height:95px;'><img alt='...' src='".trim(Config::get('site.uploads_dir') . '/images/' . $prev_media->pic_url)."' /></div></a></li>" . $prev_media_list; ?>

<?php endforeach; ?>

<?php echo $prev_media_list; ?>

<?php foreach($media_next as $next_media): ?>

	<li class="col-md-4"><a href="<?= URL::to('media') . '/' . $next_media->slug ?>"><div class="imgLiquidFill imgLiquid <?php if($next_media->id == $media->id): ?> active <?php endif; ?>" style="width:95px; height:95px;"><img alt="..." src="<?=trim(Config::get('site.uploads_dir') . '/images/' . $next_media->pic_url) ?>" /></div></a></li>

<?php endforeach; ?>
</ul>