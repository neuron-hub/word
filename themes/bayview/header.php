<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo get_template_directory_uri(); ?>/css/fonts.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo get_template_directory_uri(); ?>/css/media-query.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo get_template_directory_uri(); ?>/css/slider-style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo get_template_directory_uri(); ?>/css/reveal.css" rel="stylesheet" type="text/css" />

        <link href='http://fonts.googleapis.com/css?family=Orienta' rel='stylesheet' type='text/css'>

            <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
            <!--[if lt IE 9]>
            <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
            <![endif]-->

            <?php wp_head(); ?>

            <?php if (is_home() || is_front_page()): ?>
                <link href="<?php echo get_template_directory_uri(); ?>/css/media-query.css" rel="stylesheet" type="text/css" />
                <link href="<?php echo get_template_directory_uri(); ?>/css/fwslider.css" rel="stylesheet" type="text/css" />
                <script src="<?php echo get_template_directory_uri(); ?>/js/css3-mediaqueries.js" id="css3-mediaqueries"></script>
                <script src="<?php echo get_template_directory_uri(); ?>/js/fwslider.js" id="bayview-js-fwslider"></script>
            <?php endif; ?>

            <script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.validate.min.js" type="text/javascript"></script>


<!--<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/css/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/css/jquery.easing.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/css/jquery.sweet-menu-1.0.js"></script>-->
            <script>
                $(document).ready(function(){
                    $( ".datepicker" ).datepicker({
                        minDate: new Date(), 
                        dateFormat: "yy-mm-dd",
                        firstDay: 1,
                        changeFirstDay: false,
                        beforeShowDay: function(date) {
                            return [(date.getDay() < 6), ''];
                        }
                    });
                });
            </script> 
            <script type="text/javascript"> 
                $(document).ready(function(){ 
                    $('#exampleMenu').sweetMenu({
                        top: 200,
                        padding: 0,
                        iconSize: 45,
                        easing: 'linear',
                        duration: 300,
                        iconWidth: 150,
                        icons: [
                            '<?php echo get_template_directory_uri(); ?>/images/fb-hover1.png',
                            '<?php echo get_template_directory_uri(); ?>/images/tw-hover1.png',
                            //                        '<?php //echo get_template_directory_uri();        ?>/images/link-hover.png',
                            //                        '<?php //echo get_template_directory_uri();        ?>/images/google-hover.png',
                            '<?php echo get_template_directory_uri(); ?>/images/rss-hover.png'
                        ]
                    });
                    $('#login_form').submit(function(){
                        var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,4}$/i;
                        var error = '';
                        $('#email').toggleClass('invalid', ($('#email').val() =='' || !pattern.test($('#email').val())));
                        if($('#email').hasClass('invalid')){
                            error = 'Please provide your email id.\n';
                        }
                        $('#password').toggleClass('invalid', ($('#password').val() == ''));
                        if($('#password').hasClass('invalid')){
                            error += 'Please enter your password.\n';
                        }
                        if ( $('input.invalid').length ) {
                            alert(error);
                            return false;
                        }else{
                            return true;
                        }
                        return false;
                    });
                    
                    $('#register_form').submit(function(){
                        var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,4}$/i;
                        var error = '';
                        $('#register_email').toggleClass('invalid', ($('#register_email').val() == '' || !pattern.test($('#register_email').val()))); 
                        if($('#register_email').hasClass('invalid')){
                            error += 'Please enter valid email id.\n';
                        }
                        $('#register_password').toggleClass('invalid', ($('#register_password').val() == ''));
                        if($('#register_password').hasClass('invalid')){
                            error += 'Password  cannot be left empty.\n';
                        }
                        $('#register_password').toggleClass('invalid', ($('#register_password').val() != $('#register_conf_password').val()));
                        $('#register_conf_password').toggleClass('invalid', ($('#register_password').val() != $('#register_conf_password').val()));
                        if($('#register_conf_password').hasClass('invalid')){
                            error += 'The passwords provided do not match.\n';
                        }
                        if ( $('input.invalid').length ) {
                            alert(error);
                            return false;
                        }else{
                            return true;
                        }
                        return false;
                    });
                    if($('#submitform')) {
                        var flag = false;                    
                        $('#cardno').payment('formatCardNumber');
                        $('#card_expire').payment('formatCardExpiry');
                        $('#securitycode').payment('formatCardCVC');
                    
                        $('#submitform').click(function(){
                            var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,4}$/i;
                            var intRegex = /^\d+$/;
                            var charRegex = /^[A-Za-z\s]+$/;
                            $('input').removeClass('invalid');
                            var error = '';                       
                                
                            
                       
                            $('#fname').toggleClass('invalid', ($('#fname').val() == ''));
                            $('#lname').toggleClass('invalid', ($('#lname').val() == ''));
                            $('#addr1').toggleClass('invalid', ($('#addr1').val() == ''));
                            $('#phone').toggleClass('invalid', ($('#phone').val() == ''));
                            $('#city').toggleClass('invalid', ($('#city').val() == ''));
                        
                        
                        
                            $('#agreement').toggleClass('invalid', !($('#agreement').is(':checked')));
                        
                            if($('#fname').hasClass('invalid')){
                                error += 'Please enter your first name.\n';
                            }
                            if(!charRegex.test($('#fname').val()) && $('#fname').val() != ''){
                                $('#fname').toggleClass('invalid',true); 
                                error += 'First Name accepts only characters.\n'; 
                            }
			
                            if($('#lname').hasClass('invalid')){
                                error += 'Please enter your last name.\n';
                            }

                            if(!charRegex.test($('#lname').val()) && $('#lname').val() != ''){
                                $('#lname').toggleClass('invalid',true); 
                                error += 'Last Name accepts only characters.\n'; 
                            }
			
                            if($('#addr1').hasClass('invalid')){
                                error += 'Please enter your address.\n';
                            }

                            if($('#city').hasClass('invalid')){
                                error += 'Please enter your city.\n';
                            }

                            if(!charRegex.test($('#city').val()) && $('#city').val() != ''){
                                $('#city').toggleClass('invalid',true); 
                                error += 'City accepts only characters.\n'; 
                            }

                            if($('#phone').hasClass('invalid')){
                                error += 'Please enter your mobile number.\n';
                            }

                            if(!intRegex.test($('#phone').val()) && $('#phone').val() != ''){
                                $('#phone').toggleClass('invalid',true); 
                                error += 'Phone Number accepts only numeric values.\n'; 
                            }
			
                            if(!intRegex.test($('#alt_phone').val()) && $('#alt_phone').val() != ''){
                                $('#alt_phone').toggleClass('invalid',true); 
                                error += 'Alternate Phone accepts only numeric values.\n'; 
                            }

                            var cardType = $.payment.cardType($('#cardno').val());
                            $('#card').toggleClass('invalid', !($('#card').val() == cardType));
                            $('#cardno').toggleClass('invalid', !$.payment.validateCardNumber($('#cardno').val()));
                            $('#card_expire').toggleClass('invalid', !$.payment.validateCardExpiry($('#card_expire').payment('cardExpiryVal')));
                            $('#securitycode').toggleClass('invalid', !$.payment.validateCardCVC($('#securitycode').val(), cardType));
                            if($('#card').hasClass('invalid')){
                                error += 'Please select correct card type.\n';
                            }
                            if($('#cardno').hasClass('invalid')){
                                error += 'Please enter correct card number.\n';
                            }
                            if($('#card_expire').hasClass('invalid')){
                                error += 'Please enter correct card expiry date.\n';
                            }
                            if($('#securitycode').hasClass('invalid')){
                                error += 'Please enter correct security code.\n';
                            }
                            $('#nameoncard').toggleClass('invalid', ($('#nameoncard').val() == ''));
                            if($('#nameoncard').hasClass('invalid')){
                                error += 'Please enter the cardholder`s name.\n';
                            }
                            if($('#agreement').hasClass('invalid')){
                                error += 'To proceed with your booking, you need to agree to our general Terms & Conditions.\n';
                            }
                            if ( $('input.invalid').length ) {
                            
                                flag = true;
                                alert(error);
                            
                            } else {
                                flag = false;
                                $('#billinginfo_form').submit();
                            }
                        
                        
                        });
                    }
               
                });
            
            </script>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#featured").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
                    var listcount = $('#featured ul.ui-tabs-nav li').size();
                    var cli = 1;
                    $('#down').click(function() {
                        if (cli < listcount -1) {
                            $('#featured ul.ui-tabs-nav li:nth-child(' + cli + ')').slideToggle();
                            cli++;
                        }
                    });
                    $('#up').click(function() {
                        if (cli > 2) {
                            cli--;
                            $('#featured ul.ui-tabs-nav li:nth-child(' + cli + ')').slideToggle();
                        }
                    });
                });
                
                function remove_cart_detail(id){
                    jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', {'action': 'bayview_remove_cart_detail', 'cottage_id': id}, function(data) {
                        jQuery('div.bayview_cart_widget').html(data);
                        var cart_count = jQuery('.bayview_cart_widget .bl-chk-row-one').length;
                        if(cart_count > 0){
                            jQuery('#check_out_cart').show();
                            if(jQuery('#billinginfo_form').length){
                                jQuery('#billinginfo_form').show();
                            }
                
                        }
                        else{
                            jQuery('#check_out_cart').hide();
                            if(jQuery('#billinginfo_form').length){
                                jQuery('#billinginfo_form').hide();
                                jQuery('.bl-mid').append('<div class="no-item" style="width:70%; margin:10px auto;"><h3 style="text-align:center;">Oops! The cart seems empty. Please go back and select a suitable cottage.</h3></div>');
                            }
                        }
                    });
                }
                function remove_cart_offer_detail(id){
                    jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', {'action': 'bayview_remove_cart_offer', 'offer_id': id}, function(data) {
                        jQuery('div.bayview_cart_widget').html(data);
                        var cart_count = jQuery('.bayview_cart_widget .bl-chk-row-one').length;
                        if(cart_count > 0){
                            jQuery('#check_out_cart').show();
                
                        }
                        else{
                            jQuery('#check_out_cart').hide();
                        }
                    });
                }
                function get_country_state(select){
                    var id = select.value;
                    jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', {'action': 'bayview_get_country_states', 'country_id': id}, function(data) {
                        jQuery('div.country_state').html(data);
                    });
                    //               
                }
            </script>

    </head>

    <body <?php body_class(); ?>>
        <?php if (!empty($_REQUEST['msg'])): ?>
            <script type="text/javascript">
                var msg='';
                var errors = <?php
        if (!empty($flash_errors)) {
            echo json_encode($flash_errors);
            unset($flash_errors);
        } elseif (!empty($_SESSION['flash_errors'])) {
            echo json_encode($_SESSION['flash_errors']);
            unset($_SESSION['flash_errors']);
        }else
            echo json_encode(array());
        ?>;
            switch(<?php echo $_REQUEST['msg']; ?>) {
                case 1:
                    msg = "THANK YOU! \n\
    \n\
    Your request has been processed.  We will contact you within\n\
    48 hours to confirm your reservation. And an email has been sent to your email address with all the details.\n";
                    break;
                case 2:
                    msg = "Following errors occured while processing the booking request:\n";
                    for(var c=0; c<errors.length; c++) {
                        msg += errors[c]+"\n";
                    }
                    break;
                }
                if(msg!='') alert(msg);
            </script> 
        <?php endif; ?>

        <?php if (is_home() || is_front_page()): ?>
            <div id="fwslider">
                <div class="slider_container">
                    <?php
                    $args = array(
                        'post_type' => 'home_slider'
                    );

                    query_posts($args);
                    if (have_posts()):
                        while (have_posts()): the_post();
                            if (has_post_thumbnail()):
                                echo '<div class="slide">';
                                the_post_thumbnail('large');
                                echo '</div>';
                            endif;
                        endwhile;
                    endif;
                    wp_reset_query();
                    ?>

                </div>
                <div class="timers"></div>
                <div class="slidePrev"><span></span></div>
                <div class="slideNext"><span></span></div>
            </div>
            <div class="main">
                <div id="top-wrapper">
                <?php else: ?>
                    <div class="dyanamic-header">
                        <?php
                        if (function_exists('show_media_header')) {
                            show_media_header();
                        }
                        ?>
                    </div>
                    <div class="inner-main">
                        <div id="top-wrapper">

                            <div id="innertop-wrapper">

<?php endif; ?>
                            <div class="header">
                                <div class="top-header">
                                    <div class="logo">
                                        <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="" /></a>
                                    </div>
                                    <div class="promo">
                                        <a href="<?php echo home_url("featured-offers"); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/center-icon.png" alt="" /></a>
                                    </div>
                                    <div class="login_logout">
<?php if (is_user_logged_in()): ?>
                                            <a href="<?php echo admin_url("profile.php"); ?>" title="Account">Account</a> &nbsp; 
                                            <a href="<?php echo wp_logout_url(home_url()); ?>" title="Logout">Logout</a>

<?php else: ?>
                                            <a href="<?php echo wp_login_url(); ?>" title="Login">Login</a> &nbsp; 
                                            <a href="<?php echo home_url("wp-login.php?action=register"); ?>" title="Login">Register</a>

<?php endif; ?>
                                    </div>
                                    <div class="top-header-right">
                                        <p>Give us a call</p>
                                        <h3><span><img src="<?php echo get_template_directory_uri(); ?>/images/phone-icon.png" alt="" /></span> 1-800-461-0243</h3>
                                        <h6 style="display:none;">Request a callback</h6>
                                        <div class="search">
                                            <form action="<?php echo home_url(); ?>" method="get">
                                                <input type="text" class="search-input" name="s"/> <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/search-btn.png" alt="" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $defaults = array(
                                    'theme_location' => 'primary',
                                    'menu' => '',
                                    'container' => 'div',
                                    'container_class' => 'nav',
                                    'container_id' => '',
                                    'menu_class' => '',
                                    'menu_id' => '',
                                    'echo' => true,
                                    'fallback_cb' => 'wp_page_menu',
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'depth' => 0,
                                    'walker' => ''
                                );

                                wp_nav_menu($defaults);
                                ?>
                                <!--        <div class="nav">
                                                <ul>
                                                <li><a href="#">Our Cottages</a></li>
                                                <li><a href="#">Facilities & Amenities</a></li>
                                                <li><a href="#">Village Map</a></li>
                                                <li><a href="#">Photo Gallery</a></li>
                                                <li><a href="#">Rental Rates</a></li>
                                                <li><a href="#">Fractional Ownership</a></li>
                                                <li><a href="#">Get Directions</a></li>
                                                <li><a href="#">Contact Us</a></li>
                                                <li><a href="#">Blog</a></li>
                                            </ul>
                                        </div>-->
<?php if (is_home() || is_front_page()): ?>
                                    <div class="banner-left">
                                        <div class="chk-avalb">
                                            <form action="<?php echo home_url(); ?>" name="check_availabilty" id="check_availabilty" method="get">
                                                <div class="row-one">
                                                    <p>Arrival Date:</p>
                                                    <input type="text" name="arrival_date" class="datepicker required"/>
                                                </div>
                                                <div class="row-one">
                                                    <p>Departure Date:</p>
                                                    <input type="text" name="departure_date" class="datepicker required"/>
                                                </div>
                                                <div class="row-two">
                                                    <div class="column-one">
                                                        <p>Adults:</p>
                                                        <select class="select required" name="adults"><option value="">Select</option>
                                                            <?php
                                                            for ($i = 1; $i <= 10; $i++) {
                                                                echo "<option value='$i'>$i</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="column-two" style="margin-left:5px !important;">
                                                        <p>Children (Age 3-12)</p>
                                                        <select class="select" name="children"><option value="0">Select</option>
                                                            <?php
                                                            for ($i = 1; $i <= 10; $i++) {
                                                                echo "<option value='$i'>$i</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div style="color:#fd3434;">* Saturday arrivals and departures not permitted.</div>
                                                <div class="chk-avalb-btn">
                                                    <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/chk-avlb-btn.png" alt="" />
                                                </div>
                                                <input type="hidden" name="s" value="cottage" />
                                                <input type="hidden" name="post_type" value="cottage" />
                                            </form>
                                            <script type="text/javascript">
                                                    $().ready(function() {
                                                        // validate the comment form when it is submitted
                                                        $("#check_availabilty").validate();
                                                    });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="banner-right">
                                        <div class="banner-right-txt">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/banner-text.png" alt="" />
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- TODO: something to show here -->
<?php endif; ?>

                                <!-- Social Icons -->
                                <div class="feedback-btn">
                                    <a href="<?php echo home_url("contact-us"); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/feedback-btn.png" alt="" /></a>
                                </div>
                                <ul id="exampleMenu">
                                    <?php
                                    $bayview_facebook_link = get_option("bayview_facebook_link", "");
                                    $bayview_twitter_link = get_option("bayview_twitter_link", "");
//                            $bayview_linkedin_link = get_option("bayview_linkedin_link", "");
//                            $bayview_google_link = get_option("bayview_google_link", "");
                                    ?>

                                    <li><a href="<?php echo ($bayview_facebook_link ? $bayview_facebook_link : '#'); ?>" target="_blank" title=""></a></li>
                                    <li><a href="<?php echo ($bayview_twitter_link ? $bayview_twitter_link : '#'); ?>" target="_blank" title=""></a></li>
        <!--                            <li><a href="<?php echo ($bayview_linkedin_link ? $bayview_linkedin_link : '#'); ?>" title=""></a></li>
                                    <li><a href="<?php echo ($bayview_google_link ? $bayview_google_link : '#'); ?>" title=""></a></li>-->
                                    <li><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" title=""></a></li>
                                </ul>                                                                        
                            </div>
                        </div>
                    </div>
                    <?php /*
                      <div id="page" class="hfeed site">
                      <header id="masthead" class="site-header" role="banner">
                      <hgroup>
                      <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                      <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                      </hgroup>

                      <nav id="site-navigation" class="main-navigation" role="navigation">
                      <h3 class="menu-toggle"><?php _e( 'Menu', 'bayview' ); ?></h3>
                      <a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'bayview' ); ?>"><?php _e( 'Skip to content', 'bayview' ); ?></a>
                      <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
                      </nav><!-- #site-navigation -->

                      <?php $header_image = get_header_image();
                      if ( ! empty( $header_image ) ) : ?>
                      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
                      <?php endif; ?>
                      </header><!-- #masthead -->

                      <div id="main" class="wrapper">
                     * 
                     */ ?>
