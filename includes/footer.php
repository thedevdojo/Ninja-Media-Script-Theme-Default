<div id="footer">
&copy; <?= date('Y') . ' ' . $settings->website_name ?>
</div>

<script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/noty/themes/default.js"></script>
<script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/noty/layouts/top.js"></script>
<script type="text/javascript" src="<?= URL::to('/') ?>/content/themes/default/assets/js/nprogress.js"></script>

<script type="text/javascript">
  $('document').ready(function(){

  	$('.dropdown').hover(function(){
        $(this).addClass('open');
    }, function(){
        $(this).removeClass('open');
    });
    $('.dropdownNotifi').hover(function(){
        $(this).removeClass('open');
    });
    $('.dropdownNotifi a').click(function(){
        $(this).parent().find('.dropdown-menu').toggle();
    });
    NProgress.start();

    <?php if(Session::get('note') != '' && Session::get('note_type') != ''): ?>
        var n = noty({text: '<?= Session::get("note") ?>', layout: 'top', type: '<?= Session::get("note_type") ?>', template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>', closeWith: ['button'], timeout:1600 });
        <?php Session::forget('note');
              Session::forget('note_type');
        ?>
    <?php endif; ?>

    var slide_pos = 1;

    $('#random-right').click(function(){
      if(slide_pos < 3){
        $('#random-slider').css('left', parseInt($('#random-slider').css('left')) - parseInt($('.random-container').width()) -28 + 'px') ;
        slide_pos += 1;
      }
    });

    $('#random-left').click(function(){
      if(slide_pos > 1){
        $('#random-slider').css('left', parseInt($('#random-slider').css('left')) + parseInt($('.random-container').width()) +28 + 'px') ;
        slide_pos -= 1;
      }
    });


  });


  $(window).load(function () {
    NProgress.done();
  });

  $(window).resize(function(){
    jquery_sticky_footer();
  });


  $(window).bind("load", function() {    
    jquery_sticky_footer();
  });

  function jquery_sticky_footer(){
    var footer = $("#footer");
    var pos = footer.position();
    var height = $(window).height();
    height = height - pos.top;
    height = height - footer.outerHeight();
    if (height > 0) {
      footer.css({'margin-top' : height+'px'});
    }
  }

  /********** Mobile Functionality **********/

  var mobileSafari = '';

  $(document).ready(function(){
    $('.mobile-menu-toggle').click(function(){
      $('.mobile-menu').toggle();
      $('body').toggleClass('mobile-margin').toggleClass('body-relative');
      $('.navbar').toggleClass('mobile-margin');
    });


    // Assign a variable for the application being used
    var nVer = navigator.appVersion;
    // Assign a variable for the device being used
    var nAgt = navigator.userAgent;
    var nameOffset,verOffset,ix;
   
   
    // First check to see if the platform is an iPhone or iPod
    if(navigator.platform == 'iPhone' || navigator.platform == 'iPod'){
      // In Safari, the true version is after "Safari" 
      if ((verOffset=nAgt.indexOf('Safari'))!=-1) {
        // Set a variable to use later
        mobileSafari = 'Safari';
      }
    }
   
    // If is mobile Safari set window height +60
    if (mobileSafari == 'Safari') { 
      // Height + 60px
      $('.mobile-menu').css('height', (parseInt($(window).height())+ 60) + 'px' );
    } else {
      // Else use the default window height
      $('.mobile-menu').css('height', $(window).height()); 
    };

  });

  $(window).resize(function(){
    // If is mobile Safari set window height +60
    if (mobileSafari == 'Safari') { 
      // Height + 60px
      $('.mobile-menu').css('height', (parseInt($(window).height())+ 60) + 'px' );
    } else {
      // Else use the default window height
      $('.mobile-menu').css('height', $(window).height()); 
    };
  });

  /********** End Mobile Functionality **********/


</script>


<?php if(isset($settings->custom_js)): ?>
  <script>
    <?= $settings->custom_js ?>
  </script>
<?php endif; ?>

<?php if(isset($settings->analytics)): ?>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', '<?= $settings->analytics ?>', 'auto');
    ga('send', 'pageview');

  </script>
<?php endif; ?>


</body>
</html>