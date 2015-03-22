<!DOCTYPE html>
<html>
<head>
    <?php $settings = Setting::first(); ?>
    <?php if(isset($item->title)): ?>
      <title><?= stripslashes($item->title) ?></title>
    <?php else: ?>
      <title><?= $settings->website_name ?> - <?= $settings->website_description ?></title>
    <?php endif; ?>

    <meta name="viewport" content="initial-scale=1">
    
    <link rel="stylesheet" href="<?= URL::to('/') ?>/content/themes/default/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= URL::to('/') ?>/content/themes/default/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?= URL::to('/') ?>/content/themes/default/assets/css/animate.min.css" />
    <link rel="stylesheet" href="<?= URL::to('/') ?>/content/themes/default/assets/css/style.css" />
    <?= dynamic_styles($settings); ?>

    <link rel="icon" href="<?= Config::get('site.uploads_dir') . '/settings/' . $settings->favicon ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= Config::get('site.uploads_dir') . '/settings/' . $settings->favicon ?>" type="image/x-icon">

    <!--[if lte IE 8]>
      <script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/masonry.pkgd.min.js"></script>
    <script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/jquery.infinitescroll.min.js"></script>
    <script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/jquery.sticky.js"></script>
    <script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/jquery.fitvid.js"></script>
    <script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/jquery.timeago.js"></script>

    <?php if(isset($item->title) && isset($item->pic_url)): ?>
      <meta property="og:title" content="<?= stripslashes($item->title) ?>"/>
      <meta property="og:url" content="<?= Request::url() ?>"/>
      <meta property="og:image" content="<?= Config::get('site.uploads_dir') . '/images/' . $item->pic_url ?>"/>
      <meta property="og:type" content="article" />

        <?php if(isset($item->description)): ?>
          <meta property="og:description" content="<?= $item->description ?>"/>
        <?php endif; ?>

      <meta itemprop="name" content="<?= stripslashes($item->title) ?>">
      <meta itemprop="description" content="<?= $item->description ?>">
      <meta itemprop="image" content="<?= Config::get('site.uploads_dir') . '/images/' . $item->pic_url ?>">
    <?php endif; ?>
</head>
<body>

<nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only"><?= Lang::get('lang.toggle_navigation') ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand logo" href="<?= URL::to('/') ?>"><img src="<?= Config::get('site.uploads_dir') . '/settings/' . $settings->logo ?>" style="height:35px; width:auto;" /></a>
      
        <div class="mobile-menu-toggle"><i class="fa fa-bars"></i></div>

          <!-- MOBILE NAV -->

            <div class="mobile-menu">

              <?php if(!Auth::guest()): ?>

                <?php $user_profile = ''; ?>
                <?php if(isset($user->username)): $user_profile = $user; endif; ?>

                <?php $user = Auth::user(); ?>
                <?php $user_points = DB::table('points')->where('user_id', '=', $user->id)->sum('points'); ?>
                <a href="<?= URL::to('user') . '/' . $user->username; ?>" class="usr-avatar"><img src="<?= Config::get('site.uploads_dir') ?>/avatars/<?= $user->avatar ?>" alt="<?= $user->username ?>" class="img-circle user-avatar-large"></a>
                <a href="<?= URL::to('user') . '/' . $user->username; ?>" class="username"><h2><?php if(strlen(Auth::user()->username) > 14): echo substr(Auth::user()->username, 0, 14) . '...'; else: echo Auth::user()->username; endif; ?></h2></a>
                <p class="points"><i class="fa fa-star" style="color:gold"></i> <?= $user_points ?> points</p>
                <div id="avatar-bg"></div>

              <?php endif; ?>

              <ul>
                <li class="<?php if(Request::is('/') || Request::is('category/*')){ echo 'active'; } ?>"><a href="<?= URL::to('/') ?>"><i class="fa fa-home"></i> <?= Lang::get('lang.home') ?></a></li>
               <li class="dropdown <?php if(Request::is('popular/*') || Request::is('popular')){ echo 'active'; } ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-star"></i> <?= Lang::get('lang.popular') ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?= URL::to('popular/week') ?>"><?= Lang::get('lang.for_the_week') ?></a></li>
                  <li><a href="<?= URL::to('popular/month') ?>"><?= Lang::get('lang.for_the_month') ?></a></li>
                  <li><a href="<?= URL::to('popular/year') ?>"><?= Lang::get('lang.for_the_year') ?></a></li>
                  <li><a href="<?= URL::to('popular') ?>"><?= Lang::get('lang.all_time') ?></a></li>
                </ul>
              </li>
              
              <?php $categories = Category::orderBy('order', 'ASC')->get(); ?>

              <li class="dropdown">
                  <a href="#" class="dropdown-toggle categories" data-toggle="dropdown"><i class="fa fa-folder-open"></i> <?= Lang::get('lang.categories') ?> <b class="caret"></b></a>
                  
                  <ul class="dropdown-menu">
                      <li>
                          <?php foreach ($categories as $category): ?>
                            <a href="<?= URL::to('category') . '/' . strtolower($category->name) ?>"><?= $category->name ?></a>
                          <?php endforeach; ?>
                      </li>
                    </ul>
             </li>

             <?php if($settings->pages_in_menu): ?>
             <li class="dropdown <?php if(Request::is('pages/*') || Request::is('pages')){ echo 'active'; } ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-text"></i> <?= $settings->pages_in_menu_text ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php $pages = Page::all(); ?>
                  <?php foreach($pages as $page): ?>
                    <li><a href="<?= URL::to('pages') . '/' . $page->url ?>"><?= $page->title ?></a></li>
                  <?php endforeach; ?>
                
                </ul>
              </li>
              <?php endif; ?>

             <li><a href="<?= URL::to('/random') ?>"><i class="fa fa-random"></i> <?= Lang::get('lang.random') ?></a></li>

          </ul>

          <!-- END MOBILE NAV -->



        <ul class="nav navbar-nav navbar-right">
        <?php if(Auth::guest()): ?>
        
        
            <li class="<?php if(Request::is('login')){ echo 'active'; } ?>"><a href="<?= URL::to('login') ?>"><?= Lang::get('lang.sign_in') ?></a></li>
            
            <?php if($settings->user_registration): ?>
              <li class="<?php if(Request::is('signup')){ echo 'active'; } ?>"><a href="<?= URL::to('signup') ?>"><?= Lang::get('lang.sign_up') ?></a></li>
            <?php endif; ?>

        <?php else: ?>

        <?php $user_points = DB::table('points')->where('user_id', '=', Auth::user()->id)->sum('points'); ?>

          <li class="dropdown">
              <a href="#" class="user-menu dropdown-toggle" data-toggle="dropdown"><b class="caret"></b><div id="user-info"><h4><i class="fa fa-gear"></i> <?= Lang::get('lang.settings') ?></h4></div> </a>
              <ul class="dropdown-menu">
                <?php if(Auth::user()->admin): ?>
                  <li><a href="<?= URL::to('admin') ?>" class="admin_link_mobile"><i class="fa fa-coffee"></i> <?= Lang::get('lang.admin') ?></a></li>
                <?php endif; ?>
                <li><a href="<?= URL::to('user') . '/' . Auth::user()->username; ?>"><i class="fa fa-user"></i> <?= Lang::get('lang.my_profile') ?></a></li>
                <li><a href="<?= URL::to('logout') ?>" id="user_logout_mobile"><i class="fa fa-power-off"></i> <?= Lang::get('lang.logout') ?></a></li>
              </ul>
            </li>

        <?php endif; ?>
            <?php if($settings->user_registration || !Auth::guest()): ?>
              <li><a href="<?= URL::to('upload') ?>" class="upload-btn"><i class="fa fa-cloud-upload"></i> <?= Lang::get('lang.upload') ?></a></li>
            <?php endif; ?>
          </ul>


        </div>
      </div>


      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
      
      <ul class="nav navbar-nav navbar-left nav-desktop">
        <!--li><a href="#" id="categories_open"><i class="fa fa-th-list"></i> Categories</a></li-->
        <li class="<?php if(Request::is('/') || Request::is('category/*')) echo 'active'; ?>"><a href="<?= URL::to('/') ?>"><i class="fa fa-home"></i><span> <?= Lang::get('lang.home') ?></span></a><div class="nav-border-bottom"></div></li>
         <li class="dropdown <?php if(Request::is('popular/*') || Request::is('popular')){ echo 'active';  } ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-star"></i><span> <?= Lang::get('lang.popular') ?> </span><b class="caret"></b><div class="nav-border-bottom"></div></a>
          <ul class="dropdown-menu">
            <li><a href="<?= URL::to('popular/week') ?>"><?= Lang::get('lang.for_the_week') ?></a></li>
            <li><a href="<?= URL::to('popular/month') ?>"><?= Lang::get('lang.for_the_month') ?></a></li>
            <li><a href="<?= URL::to('popular/year') ?>"><?= Lang::get('lang.for_the_year') ?></a></li>
            <li><a href="<?= URL::to('popular') ?>"><?= Lang::get('lang.all_time') ?></a></li>
          </ul>
        </li>
        
        <?php $categories = Category::orderBy('order', 'ASC')->get(); ?>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle categories" data-toggle="dropdown"><i class="fa fa-folder-open"></i><span> <?= Lang::get('lang.categories') ?> </span><b class="caret"></b><div class="nav-border-bottom"></div></a>
            
            <ul class="dropdown-menu">
                <li>
                    <?php foreach ($categories as $category): ?>
                      <a href="<?= URL::to('category') . '/' . strtolower($category->name) ?>"><?= $category->name ?></a>
                    <?php endforeach; ?>
                </li>
              </ul>
       </li>

       <?php if($settings->pages_in_menu): ?>
       <li class="dropdown <?php if(Request::is('pages/*') || Request::is('pages')){ echo 'active'; } ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-text"></i> <?= $settings->pages_in_menu_text ?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <?php $pages = Page::all(); ?>
            <?php foreach($pages as $page): ?>
              <li><a href="<?= URL::to('pages') . '/' . $page->url ?>"><?= $page->title ?></a></li>
            <?php endforeach; ?>
          
          </ul>
        </li>
        <?php endif; ?>

      </ul>  


      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?= URL::to('/random') ?>" class="random"><i class="fa fa-random"></i></a></li>
      <?php if($settings->user_registration || !Auth::guest()): ?>
        <li><a href="<?= URL::to('upload') ?>" class="upload-btn upload-btn-desktop"><i class="fa fa-cloud-upload"></i> <?= Lang::get('lang.upload') ?></a></li>
      <?php endif; ?>

      <?php if(Auth::guest()): ?>
      
      
          <li class="<?php if(Request::is('login')){ echo 'active'; } ?>"><a href="<?= URL::to('login') ?>" id="login-button-desktop"><?= Lang::get('lang.sign_in') ?></a><div class="nav-border-bottom"></div></li>
          <?php if($settings->user_registration): ?>
            <li class="<?php if(Request::is('signup')){ echo 'active'; } ?>"><a href="<?= URL::to('signup') ?>" id="signup-button-desktop"><?= Lang::get('lang.sign_up') ?></a><div class="nav-border-bottom"></div></li>
          <?php endif; ?>
      <?php else: ?>

      <?php $user_points = DB::table('points')->where('user_id', '=', Auth::user()->id)->sum('points'); ?>

        <li class="dropdown">
            <a href="#" class="user-menu user-menu-desktop dropdown-toggle" data-toggle="dropdown"><img src="<?= Config::get('site.uploads_dir') ?>/avatars/<?= Auth::user()->avatar ?>" class="img-circle" /><b class="caret"></b><div id="user-info"><h4><?php if(strlen(Auth::user()->username) > 8){ echo substr(Auth::user()->username, 0, 8) . '...';  } else { echo Auth::user()->username; } ?></h4><p><?= $user_points ?> <?= Lang::get('lang.points') ?></p></div> </a>
            <ul class="dropdown-menu">
              <?php if(Auth::user()->admin): ?>
                <li><a href="<?= URL::to('admin') ?>" class="admin_link_desktop"><i class="fa fa-coffee"></i> <?= Lang::get('lang.admin') ?></a></li>
              <?php endif; ?>
              <li><a href="<?= URL::to('user') . '/' . Auth::user()->username; ?>" class="user-profile-link-desktop"><i class="fa fa-user"></i> <?= Lang::get('lang.my_profile') ?></a></li>
              <li><a href="<?= URL::to('logout') ?>" id="user_logout_desktop"><i class="fa fa-power-off"></i> <?= Lang::get('lang.logout') ?></a></li>
            </ul>
          </li>

    <?php endif; ?>
    </ul>



  </div><!-- /.navbar-collapse -->
</div><!-- /.container -->
</nav>

