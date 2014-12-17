<div class="container">

    <?php if (Session::has('notification')): ?>
        <span class="notification"><?= Session::get('notification') ?></span>
    <?php endif; ?>

    <form method="post" action="<?= URL::to('signup') ?>" class="form-signin">

    <h2 class="form-login-heading"><?= Lang::get('lang.sign_up_with') ?></h2>
    <div class="social-signup">
        <a class="facebook-signup" href="<?= $facebook ?>"></a>
        <a class="google-signup" href="<?= URL::to('auth/google') ?>"></a>
    </div>
        <!-- check for notifications -->

        <div class="line"></div>
            <h2 class="form-login-heading-second"><?= Lang::get('lang.or_signup_with') ?></h2>
        <div class="line"></div>
        
        <input type="text" class="form-control" id="username" name="username" placeholder="<?= Lang::get('lang.username') ?>">
        <input type="text" class="form-control" id="email" name="email" style="-webkit-border-top-left-radius: 0px; -webkit-border-top-right-radius: 0px; -moz-border-radius-topleft: 0px; -moz-border-radius-topright: 0px; border-top-left-radius: 0px; border-top-right-radius: 0px;" placeholder="<?= Lang::get('lang.email_address') ?>">
        <input type="password" class="form-control" id="password" name="password" style="margin-bottom:0px; -webkit-border-bottom-left-radius: 0px; -webkit-border-bottom-right-radius: 0px; -moz-border-radius-bottomleft: 0px; -moz-border-radius-bottomright: 0px; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;" placeholder="<?= Lang::get('lang.password') ?>">
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="<?= Lang::get('lang.confirm_password') ?>">
        <input type="hidden" class="form-control" id="redirect" name="redirect" value="<?= Input::get('redirect') ?>" />
        
        <?php if($settings->captcha): ?>
            <?= Recaptcha::recaptcha_get_html($settings->captcha_public_key) ?>
        <?php endif; ?>


        <button class="btn btn-lg btn-block btn-color" type="submit"><?= Lang::get('lang.sign_up') ?></button>
        

    </form>

</div>

<script type="text/javascript">

     var RecaptchaOptions = {
        theme : 'white'
     };

</script>
