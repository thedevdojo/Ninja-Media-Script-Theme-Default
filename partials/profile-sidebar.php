<div class="col-md-4 col-lg-4" id="sidebar_container">
	<div id="sidebar_inner" class="profile-container">

		<?php
		if(isset($is_user_profile) && $is_user_profile){
		 $user = $user_profile;
		}
		?>
		
		<?php if(!Auth::guest() && Auth::user()->id == $user->id): ?>
			<?php 
				$my_or_user_uploads = Lang::get('lang.my_uploads');
				$my_or_user_likes = Lang::get('lang.my_likes');
					$is_user_profile = true;
			?>
		<?php else: ?>
			<?php 
				$my_or_user_uploads = Lang::get('lang.your_uploads');
				$my_or_user_likes = Lang::get('lang.your_likes');
				$is_user_profile = false;
			?>
		<?php endif; ?>

		<a href="<?= URL::to('user/' . $user->username ) ?>"><img src="<?= Config::get('site.uploads_dir') ?>/avatars/<?= $user->avatar ?>" alt="<?= $user->username ?>" class="img-circle user-avatar-large"></a>
		<h2><?= $user->username ?> <?php if($is_user_profile): ?> <i class="fa fa-edit edit-user-profile" data-toggle="modal" data-target="#edit-modal" style="cursor:pointer;"></i><?php endif; ?></h2>
		<p><i class="fa fa-star" style="color:gold"></i> <a href="<?= URL::to('user/' . $user->username . '/points' ) ?>""><?= $user_points ?> <?= Lang::get('lang.points') ?></a> <i class="fa fa-question-circle points-question" style="cursor:pointer" data-toggle="modal" data-target="#aboutpoints"></i></p>
		<p><?= Lang::get('lang.member_since') ?>: <?= date("F j, Y", strtotime($user->created_at)) ?></p>
		
		<?php if(!Auth::guest() && Auth::user()->id != $user->id): ?>
			<?php $user_flag = UserFlag::where('user_id', '=', Auth::user()->id)->where('user_flagged_id', '=', $user->id)->first(); ?>
			<div class="flag-user" data-id="<?= $user->id ?>"><i class="fa fa-flag"></i> <span class="flag-message"><?php if(isset($user_flag->id)): ?> <?= Lang::get('lang.flagged_this_user') ?> <?php else: ?> <?= Lang::get('lang.flag_user') ?> <?php endif; ?></span></div>
		<?php endif; ?>

		<div style="width:280px; margin:15px; font-size:11px; margin-bottom:0px">
			<div class="btn-group vid-pic" data-toggle="buttons" style="margin-bottom:5px;">
			  <label class="btn btn-default <?php if(Request::is('user/' . $user->username )): ?>active<?php endif; ?> user_profile_view" data-href="<?= URL::to('user/' . $user->username ) ?>" style="line-height:20px;">
			    <input type="radio" name="user_profile" id="uploads"> <i class="fa icon-cloud-upload" style="font-size:14px; margin-right:4px;"></i> <?= $my_or_user_uploads ?>
			  </label>
			  <label class="btn btn-default <?php if(Request::is('user/' . $user->username .'/likes')): ?>active<?php endif; ?> user_profile_view" data-href="<?= URL::to('user/' . $user->username . '/likes/' ) ?>" style="line-height:20px;">
			    <input type="radio" name="user_profile" id="likes"> <i class="fa <?= $settings->like_icon ?>" style="font-size:14px; margin-right:4px;"></i> <?= $my_or_user_likes ?>
			  </label>
			</div>
		</div>

	</div>
</div>



<div style="clear:both"></div>


<script type="text/javascript">
	$(document).ready(function(){
		$("#sidebar_inner").sticky({topSpacing:50});

		$('.user_profile_view').click(function(){
			window.location = $(this).data('href');
		});

		$('points-question').tooltip('show')

	});
</script>