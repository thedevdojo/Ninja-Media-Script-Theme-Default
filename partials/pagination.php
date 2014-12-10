<div class="pagination-outter pull-right;">
	<?php if($settings->infinite_scroll && $settings->infinite_load_btn): ?>
		<div class="btn btn-color load-more-btn" data-href="<?= Request::url() ?>?page=<?php if(Input::get('page') != ''): ?><?= intval(Input::get('page') + 1) ?><?php else: ?><?= '2'; ?><?php endif; ?>">
			<p>Load More</p>
			<span class="ouro">
			  <span class="left"><span class="anim"></span></span>
			  <span class="right"><span class="anim"></span></span>
			</span>
		</div>
		<div id="hidden_load_content"></div>
	<?php else: ?>
		<?php echo $media->links(); ?>
	<?php endif; ?>
</div>