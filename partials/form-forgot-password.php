<div class="container">

    <?php if (Session::has('notification')): ?>
        <span class="notification"><?= Session::get('notification') ?></span>
    <?php endif; ?>

    <?php $googleService = OAuth::consumer( 'Google' ); ?>
     

    <form method="POST" action="<?= URL::to('password_reset') ?>" accept-charset="UTF-8" class="form-signin" style="top: 34px; display: block;">
        <?php if (Session::has('error')): ?>
          <span class="error"><?= trans(Session::get('reason')) ?></span>
        <?php elseif (Session::has('success')): ?>
          <span class="success"><?= Lang::get('lang.email_sent') ?></span>
        <?php endif; ?>
        <h2 class="form-login-heading" style="font-size:16px; color:#fff; text-align:center; font-weight:normal; margin-bottom:15px; margin-top:5px;"><?= Lang::get('lang.reset_password') ?></h2>
          
        <input name="email" type="text" id="email" class="form-control" placeholder="Email Address">
        <button class="btn btn-lg btn-block btn-color" type="submit"><?= Lang::get('lang.submit') ?></button>
     
    </form>

</div>