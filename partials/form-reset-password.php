<div class="container">

    <form method="POST" action="<?= URL::to('password_reset') . '/' . $token ?>" accept-charset="UTF-8" class="form-signin" style="top: 51px; display: block;">  
            
        <?php if (Session::has('error')): ?>
            <span class="error"><?= trans(Session::get('reason')) ?></span>
        <?php elseif (Session::has('success')): ?>
            <span class="success"><?= Lang::get('lang.email_has_been_set') ?></span>
        <?php endif; ?>

        <h2 class="form-login-heading" style="font-size:16px; color:#fff; text-align:center; font-weight:normal; margin-bottom:15px; margin-top:5px;"><?= Lang::get('lang.enter_email_pass') ?></h2>

        
     
        <input name="email" type="text" id="email" class="form-control" placeholder="email">
     
        <input name="password" type="password" id="password" class="form-control" placeholder="password">
     
        <input name="password_confirmation" type="password" id="password_confirmation" class="form-control" placeholder="confirm password">
     
        <input name="token" type="hidden" value="<?= $token ?>">     
        <button class="btn btn-lg btn-block btn-color" type="submit"><?= Lang::get('lang.reset_password') ?></button>
     
    </form>

</div>