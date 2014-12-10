<?php $tags = array_filter(explode(',', $media->tags)); ?>
	
<?php if(count($tags) >= 1 && !empty($tags)): ?>

<h4>Tags</h4>

<ul class="tags">
	<?php foreach($tags as $tag): ?>
		<li><a href="<?= URL::to('tags') . '/' . $tag ?>"><?= $tag ?></a></li>
	<?php endforeach; ?>
</ul>
<div style="clear:both"></div>

<?php endif; ?>