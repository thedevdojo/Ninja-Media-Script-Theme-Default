<div class="container">

    <form method="post" action="<?= URL::to('login') ?>" class="form-signin">

	<h2 class="form-login-heading"><?= Lang::get('lang.sign_in_with') ?></h2>
    <div class="social-signup">
        <a class="facebook-signup" href="<?= $facebook ?>"></a>
        <a class="google-signup" href="<?= URL::to('auth/google') ?>"></a>
    </div>

    
       
        <div class="line"></div>
            <h2 class="form-login-heading-second"><?= Lang::get('lang.or_sign_in_with') ?></h2>
        <div class="line"></div>

        <input type="text" class="form-control" placeholder="<?= Lang::get('lang.username_or_email') ?>" id="email" name="email" autofocus>
        <input type="password" class="form-control" placeholder="<?= Lang::get('lang.password') ?>" id="password" name="password">
        <input type="hidden" class="form-control" id="redirect" name="redirect" value="<?= Input::get('redirect') ?>" />
        <button class="btn btn-lg btn-block btn-color btn-signin" type="submit"><?= Lang::get('lang.sign_in') ?></button>
        <a href="<?= URL::to('password_reset') ?>" class="reset_password" style="width:100%; text-align:center; display:block;"><?= Lang::get('lang.forgot_password') ?></a>
    </form>

</div>

<div id="overlay"></div>