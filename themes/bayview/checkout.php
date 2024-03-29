<?php
/**
  Template Name:checkout
  The template for displaying checkout page.
 *
 * @package BayView
 * @subpackage Bayview
 */
get_header();
global $wpdb;
?>
<style type="text/css">
    input.invalid, select.invalid {
        border: 2px solid red !important;
    }

    .validation.failed:after {
        color: red;
        content: 'Validation failed';
    }

    .validation.passed:after {
        color: green;
        content: 'Validation passed';
    }
    .bayview_cart_widget .bl-chk-row-one .widget-right{
        width: auto;
    }
    div#check_out_cart{
        display:none !important;
    }
</style>
<div id="body-section">
    <div class="wrapper">

        <!--   LEFT PART         -->

        <?php
         global $current_user;
        get_currentuserinfo();
        $usermetas = get_user_meta($current_user->ID);
       
        $cart_data1 = isset($_SESSION['cart_offer_data'])? $_SESSION['cart_offer_data'] : "";
        $cart_data2 = $_SESSION['data_for_cart'];
        
        $error = $_SESSION['checkout_errors'];
        unset($_SESSION['checkout_errors']);

$orderprocess = get_user_meta($current_user->ID, '_odrerprocess', true);
        //print_r($cart_data1);
        // print_r($cart_data2);
//            foreach ($cart_data as $value) {
//                
//
//               echo  get_the_post_thumbnail($value['cottage_Id'],array(110,90));
//            }
//            
        ?>

        <div class="inner-body-left">
            <div class="bl-top">
                <img src="<?php echo get_template_directory_uri(); ?>/images/top-img.png" alt="" />
            </div>
            <div class="bl-mid">
                <?php if ((!is_user_logged_in() || !current_user_can('customer') ) && (empty($cart_data1) && empty($cart_data2)) ) { ?>
                        <div class="bl-heading">
                        <h1>My Reservation:</h1>
                    </div>
                <?php } ?>
                <?php if (is_user_logged_in() || current_user_can('customer')) { ?>
			<?php if(empty($orderprocess)) { ?>
                    <div class="bl-heading">
                        <h1>My Reservation:</h1>
                    </div>
			<?php } ?>
                    <?php if (!empty($error)): ?>
                        <div class="checkout_error" style="float: left; width: 100%; border: 1px solid rgb(255, 0, 0);">
                            <p style="color:#ff0000;padding: 5px 0;text-align: center;width: 100%;">
                                <?php
                                echo $error;
                                ?></p>

                        </div>
                    <?php endif; ?>
                    <?php if (!empty($cart_data1) || !empty($cart_data2)): ?>
                        <div class="bayview_cart_widget">
                        <?php endif; ?>
                        <?php
                        $cart_data1 = isset($_SESSION['cart_offer_data'])? $_SESSION['cart_offer_data'] : "";
                        if (!empty($cart_data1)):
                            foreach ($cart_data1 as $value):
                                ?>

                                <div class="bl-chk-row-one">
                                    <div class="widget-left" style="position: relative">

                                        <?php // $large_image_url = wp_get_attachment_image_src( $value['cottage_Id'],array(110,90));     ?>
                                        <?php echo (get_the_post_thumbnail($value['offer_id'], array(110, 90)) ? get_the_post_thumbnail($value['offer_id'], array(110, 90)) : '<img height="90" width="110" alt="No Image" class="attachment-110x90 wp-post-image" src="' . get_bloginfo('template_directory') . '/images/160x100.jpg">'); ?><span onclick="remove_cart_offer_detail(<?php echo $value['offer_id']; ?>)" style="top: 0;right: 0;
                                              position: absolute; z-index: 12; font-weight: bold; font-size: larger; color: white; background-color: black; cursor: pointer">X</span>
                                    </div>
                                    <div class="widget-right">
                                        <h2><?php echo get_the_title($value['offer_id']); ?></h2>
                                        <div><a href="<?php echo get_permalink($value['offer_id']); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/detail-btn.png" alt="" /></a></div>
                                        <h2>Total Price: <br/> $<?php echo round($value['price'], 2); ?></h2>
                                    </div>
                                </div>

                                <?php
                            endforeach;
                        endif;


                        $cart_data2 = $_SESSION['data_for_cart'];
                        if (!empty($cart_data2)):
                            foreach ($cart_data2 as $value):
                                ?>

                                <div class="bl-chk-row-one">
                                    <div class="widget-left" style="position: relative">

                                        <?php // $large_image_url = wp_get_attachment_image_src( $value['cottage_Id'],array(110,90));     ?>


										<?php
										$args=array(
													  'name' => 'my-reservation',
													  'post_type' => 'page',
													  'post_status' => 'publish',
													  'posts_per_page' => 1
													);
										$page = get_posts($args);
										$page = $page[0];
										?>
                                        <?php echo (get_the_post_thumbnail($value['cottage_Id'], array(110, 90)) ? get_the_post_thumbnail($value['cottage_Id'], array(110, 90)) : '<img height="90" width="110" alt="No Image" class="attachment-110x90 wp-post-image" src="' . get_bloginfo('template_directory') . '/images/160x100.jpg">'); ?><span onclick="remove_cart_detail(<?php echo $value['cottage_Id']; ?>)" style="top: 0;right: 0;
                                              position: absolute; z-index: 12; font-weight: bold; font-size: larger; color: white; background-color: black; cursor: pointer">X</span>
                                <!--                        <img src="<?php echo get_template_directory_uri(); ?>/images/thum-imgs01.jpg" alt="" />-->
                                    </div>
                                    <div class="widget-right">
                                        <h2><?php echo get_the_title($value['cottage_Id']); ?></h2>
                                        <div><a href="<?php echo get_permalink($page).'?house='.$value['cottage_Id']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/detail-btn.png" alt="" /></a></div>
                                        <h2>Total Price: <br/> $<?php echo $value['total'] ?></h2>
                                    </div>
                                </div>

                                <?php
                            endforeach;
                        endif;
                    }
                    ?>
                    <?php if (!empty($cart_data1) || !empty($cart_data2)): ?>
                        <?php if (is_user_logged_in() || current_user_can('customer')) { ?>
                        </div>
                    <?php } ?>



                    <div class="chk-description">
                        <?php if (!is_user_logged_in() || !current_user_can('customer')) { ?>
                            <h4 class="checkout_login">Before you proceed further with the checkout, you need to either login or register first.</h4>
                            <?php if (!empty($error)): ?>
                                <div class="checkout_error" style="float: left; width: 100%; border: 1px solid rgb(255, 0, 0);">
                                    <p style="color:#ff0000;padding: 5px 0;text-align: center;width: 100%;">
                                        <?php
                                        echo $error;
                                        ?></p>

                                </div>
                            <?php endif; ?>
                            <div class="login_register">
                                <form id="login_form" action="" method="post"> <!--FORM STARTS HERE  -->
                                    <h1>Login</h1>
                                    <div class="innerrow">
                                        <!-- <input name="user" value="guest" type="radio" id="guest"/> Guest User  &nbsp; 
                                        <input name="user" value="existing" type="radio" checked="checked" id="exist" /> Existing User -->


                                    <!--                                <span><a href="#">Create an Account</a></span>-->

                                        <div class="form" id="existing">
                                            <p>Email Address</p>
                                            <input type="text" value="" class="input-style" required="required" id="email" name="email" />
                                            <p>Password</p><br />
                                            <input type="password" value="" class="input-style" id="password" required="required" name="password" />
                                            <span>
                                                <p><a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" style="text-align:left;float: left;">Forgot Password ?</a></p>
                                                <input type="hidden" name="login_register" value="login"/>
                                                <input type="submit" value="Login" name="login_user" class="login" />
                                            </span>
                                            

                                        </div>

                                    </div>
                                </form>
                            </div>
                            <div class="login_or_register"><h3> OR </h3></div>
                            <div class="login_register">
                                <form id="register_form" action="" method="post" class="reg-form" > <!--FORM STARTS HERE  -->
                                    <h1>Register Here</h1>
                                    <div class="innerrow">
                                        <!-- <input name="user" value="guest" type="radio" id="guest"/> Guest User  &nbsp; 
                                        <input name="user" value="existing" type="radio" checked="checked" id="exist" /> Existing User -->


                                    <!--                                <span><a href="#">Create an Account</a></span>-->

                                        <div class="form" id="existing">
                                            <p>Email Address</p>
                                            <input type="text" value="" class="input-style" required="required" id="register_email" name="register_email" />
                                            <p>Password</p><br />
                                            <input type="password" value="" class="input-style" id="register_password" required="required" name="register_password" />
                                            <p>Confirm Password</p>
                                            <input type="password" value="" class="input-style" id="register_conf_password" name="register_conf_password" />
                                            <span>
                                                <input type="hidden" name="login_register" value="register"/>
                                                <input type="submit" value="Submit" name="register_user" class="login" />
                                            </span>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        <?php } else { ?>                    
                            <form id="billinginfo_form" action="" method="post"> <!--FORM STARTS HERE  -->
                                <h1>Billing Information</h1>
                                <div class="form" id="billinginfo">
                                    <div class="form-row1">
                                        <div class="col-1">
                                            <p>First Name</p>
                                            <input id="fname" name="fname" type="text" value="<?php echo $usermetas['first_name'][0]; ?>" required="required" class="input-style1" />
                                        </div>
                                        <div class="col-1">
                                            <p>Last Name</p>
                                            <input id="lname" name="lname" type="text" value="<?php echo $usermetas['last_name'][0]; ?>" class="input-style1" />
                                        </div><div class="error">XX</div>
                                    </div>
                                    <div class="form-row1">
                                        <p>Address 1</p>
                                        <input type="text" id="addr1" name="addr1" value="<?php echo $usermetas['addr1'][0]; ?>" required="required" class="input-style" /><div class="error">XX</div>
                                        <p>Address 2</p><br />
                                        <input type="text" id="addr2" name="addr2" value="<?php echo $usermetas['addr2'][0]; ?>" class="input-style" /><div class="error">XX</div>
                                    </div>
                                    <div class="form-row1">
                                        <div class="col-2">
                                            <p>Country</p>
                                            <?php
                                            $query = "SELECT * FROM `{$wpdb->prefix}bayview_country` ORDER BY name";
                                            $country = $wpdb->get_results($query);
                                            ?>
                                            <select class="select-style" name="select_country" onchange="get_country_state(this);">
                                                <?php
                                                foreach ((array) $country as $ctry) {
                                                    $ctry_selected = '';
                                                    $country_id = ($usermetas['country'][0] ? $usermetas['country'][0] : 38);
                                                    if ($ctry->country_id == $country_id) {
                                                        $ctry_selected = 'selected="selected"';
                                                    }
                                                    echo '<option value="' . $ctry->country_id . '" ' . $ctry_selected . '>' . $ctry->name . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <p>Postal Code</p>
                                            <input type="text" id="pcode" name="pcode" value="<?php echo $usermetas['postcode'][0]; ?>" class="input-style2" />
                                        </div>
                                    </div>
                                    <div class="form-row1">
                                        <div class="col-4">
                                            <p>City</p>
                                            <input id="city" type="text" name="city" value="<?php echo $usermetas['city'][0]; ?>" class="input-style3" />
                                        </div>
                                        <div class="col-3 country_state">
                                            <?php
                                            $query_state = "SELECT * FROM `{$wpdb->prefix}bayview_zone` WHERE `country_id`=$country_id";
                                            
                                            $country_state = $wpdb->get_results($query_state);
                                            
                                            ?>
                                            <p>State</p>                                    
                                            <select class="select-style1" name="select_state">
                                                <?php
                                                foreach ((array) $country_state as $state) {
                                                    $state_selected = '';
                                                    $state_name = ($usermetas['state'][0] ? $usermetas['state'][0] : 'Ontario');
                                                    if ($state->name == $state_name) {
                                                        $state_selected = 'selected="selected"';
                                                    }
                                                    echo '<option value="' . $state->name . '"' . $state_selected . '>' . $state->name . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row1">
                                        <h6>Contact Information</h6>
                                        <div class="col-1">
                                            <p>Mobile Phone</p>
                                            <input id="phone" name="phone" type="text" value="<?php echo $usermetas['phone'][0]; ?>" pattern="\d*" required="required" class="input-style1" />
                                        </div>
                                        <div class="col-1">
                                            <p>Alternate Phone</p>
                                            <input type="text" value="<?php echo $usermetas['alt_phone'][0]; ?>" name="alt_phone" id="alt_phone" pattern="\d*" class="input-style1" />
                                        </div>
                                    </div>
                                    <!--                            <div class="form-row1">
                                                                    <h6>Additional Information</h6>
                                                                    <span><a href="#">Click here to add Special Requests</a></span>
                                                                    <select class="select-style2" name="additional_info"><option> online </option></select>
                                                                </div>-->
                                </div>
                                <h1>Payment Information</h1>
                                <div class="form">
                                    <div class="form-row1">
                                        <div class="col-1">
                                            <p>Card Type</p>
                                            <select id="card" class="select-style3" name="card_type">
                                                <option value="visa"> Visa </option>
                                                <option value="mastercard"> Master Card </option>
                                                <option value="amex"> American Express </option>
                                                <option value="dinersclub"> Diners Club </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row1">
                                        <div class="col-2">
                                            <p>Card Number</p>
                                            <input id="cardno" type="text" name="card_number"  pattern="\d*" x-autocompletetype="cardno" placeholder="Card number" required="required" class="select-style">
                                        </div>
                                        <div class="col-3">
                                            <p>Expiration (mm/yy or mm/yyyy)</p>
                                            <input id="card_expire" name="card_expire" type="text" value="" pattern="\d*" x-autocompletetype="card_expire" placeholder="MM/YY" required="required" class="input-style2" maxlength="9" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-row1">
                                        <div class="col-3">
                                            <p>Security Code</p>
                                            <input id="securitycode" name="securitycode" type="password" pattern="\d*" x-autocompletetype="securitycode" placeholder="CVC" required="required" value="" class="input-style2" autocomplete="off"/>
                                        </div>
                                        <div class="col-2">
                                            <p>Name on Card</p>
                                            <input id="nameoncard" name="nameoncard" type="text" class="select-style">
                                        </div>
                                    </div>
                                </div>
                                <!--                        <h4>Guest Policies</h4>-->
                                <div class="form-row2">
        <!--                            <p><strong>What information do we collect?</strong><br/>

        We collect information from you when you subscribe to our newsletter, respond to a survey or fill out a form.<br/>

        When ordering or registering on our site, as appropriate, you may be asked to enter your: name, e-mail address, mailing address or phone number. You may, however, visit our site anonymously.</p>-->
        <!--                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>-->
        <!--                            <span><a href="#">Click here to add Special Requests</a></span>-->
        <!--                            <span><a href="<?php //echo home_url("privacy-policy"); ?>" target="_blank">View Privacy Policy</a></span>-->
                                    <br/>
                                    <h4>Booking Policy</h4><br/>
                                    <div style="clear: both; float: none; max-height: 250px; overflow-y: scroll; padding: 5px; border: 1px solid #bfbfbf;">
                                        <?php $page_data = get_page('291'); ?>

                                        <?php echo str_replace("\n", "<br/>", $page_data->post_content); ?>

                                    </div>
                                    <br/>
                                    <h4>Privacy Policy</h4><br/>
                                    <div style="clear: both; float: none; max-height: 250px; overflow-y: scroll; padding: 5px; border: 1px solid #bfbfbf;">
                                        <?php $page_data = get_page('276'); ?>

                                        <?php echo str_replace("\n", "<br/>", $page_data->post_content); ?>

                                    </div>

                                    <br/><br/>
                                    <span>
                                        <input type="checkbox" name="agreement" id="agreement" value="" required="required" style="float: left; margin: 0px 2px;"/> <strong style="margin-bottom:5px;"> I Agree to the Bayview Wildwood Resort Policies.</strong> 

                                        <p><a href="#">
                                                <input type="hidden" name="order_confirm" value="true"/>
                                                <input type="image" id="submitform"  src="<?php echo get_template_directory_uri(); ?>/images/chkout-btn.png"/>
        <!--                                        <img src="<?php //echo get_template_directory_uri();       ?>/images/chkout-btn.png" alt="" />-->

                                            </a>
                                        </p>
                                    </span>
                                </div>
                            </form> <!--FORM ENDS HERE  -->
                        <?php } ?>
                    </div>


                    <?php
                else:
                    
                    if(!empty($orderprocess)){
/*                        echo '<div class="no-item" style="width:70%; margin:10px auto;"><h3 style="text-align:center;">The reservation requested by you needs to be verified by Bayview Wildwood Resort. A confirmation will be emailed after the verification process is complete.</h3></div>';
                        delete_user_meta($current_user->ID, '_odrerprocess');
                    }  else {
                        echo '<div class="no-item" style="width:70%; margin:10px auto;"><h3 style="text-align:center;">Cart is empty.</h3></div>';*/

			delete_user_meta($current_user->ID, '_odrerprocess');
			$the_slug = 'order-confirmation';
			$args=array(
			  'name' => $the_slug,
			  'post_type' => 'page',
			  'post_status' => 'publish',
			  'posts_per_page' => 1
			);
			query_posts($args);
			while (have_posts()) : the_post();
                            /* Include the post format-specific template for the content. If you want to
                             * this in a child theme then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part('content', 'page');

                        endwhile;
			send_booking_email_notification($current_user->ID);
			}else {
                        echo '<div class="no-item" style="width:70%; margin:10px auto;"><h3 style="text-align:center;">Cart is empty.</h3></div>';
                    }

			

                    
                endif;
                ?>
            </div>
            <div class="bl-bottom">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bottom-img.png" alt="" />
            </div>
        </div>





        <!--   RIGHT PART         -->

        <div class="inner-body-right">
            <div class="br-top">
                <img src="<?php echo get_template_directory_uri(); ?>/images/right-top.png" alt="" />
            </div>
            <div class="inner-br-mid">
                <div class="booking-policy chk-booking-policy">
                    <a href="<?php echo home_url("rental-rates"); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/thum-img04.jpg" alt="" /></a>
                    <a href="<?php echo home_url("rental-rates"); ?>"><p>Rates are subject to change at any time without notice.
                            <span>View Booking Policies*</span></p></a>
                </div>
                <div class="thum-img-shadow-a">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/thum-shadow.png" alt="" />
                </div>
                <div class="feature-offer">
                    <a href="<?php echo home_url("special-offers"); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/thum-img05.jpg" alt="" /></a>
                    <div>
                        <a href="<?php echo home_url("special-offers"); ?>"><h1>Featured Offers
                                <span>Contrary to popular belief...</span></h1></a>
                    </div>
                    <h2 class="rm-btn">
                        <a href="<?php echo home_url("special-offers"); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/rm-btn.png" alt="" /></a>
                    </h2>
                </div>

                <div class="thum-img-shadow-a">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/thum-shadow.png" alt="" />
                </div>
            </div>
            <div class="inner-br-bottom"></div>
        </div>

        <!--        <div class="three-column">
                    <div class="column-1">
                        <div class="column-one-top"></div>
                        <div class="column-one-mid">
                            <img src="<?php //echo get_template_directory_uri();   ?>/images/img002.png" alt="" />
                            <h2>Bayview Wildwood Resort</h2>
                        </div>
                        <div class="column-one-bottom"></div>
                    </div>
                    <div class="column-2">
                        <div class="column-one-top"></div>
                        <div class="column-one-mid">
                            <img src="<?php //echo get_template_directory_uri();   ?>/images/img003.png" alt="" />
                            <h2>The Village of Port Stanton</h2>
                        </div>
                        <div class="column-one-bottom"></div>
                    </div>
                    <div class="column-3">
                        <div class="column-one-top"></div>
                        <div class="column-one-mid">
                            <img src="<?php //echo get_template_directory_uri();   ?>/images/img004.png" alt="" />
                            <h2>The Cottages at Port Stanton</h2>
                        </div>
                        <div class="column-one-bottom"></div>
                    </div>
                </div>-->
        <?php get_sidebar('bottom'); ?> 
    </div>
</div>
<script>
    
    $(function() {  
            
        $('.error').hide();  
            
        $("#guest").click(function(){
            $("#existing").hide();
            $("#guestuser").show();
        });
  
        $("#exist").click(function(){
            $("#guestuser").hide();
            $("#existing").show();
        });
           
        $("#submitform").click(function() {
              
            var radio = $('input:radio[name=user]:checked').val();   
           
            if(radio =='existing'){
               
                var email = $("input#email").val(); 
                var password = $("input#password").val();  
            
            }else if(radio =='guest'){
               
               
            }
           
            return false;
           
              
              
            //            var name = $("input#name").val();  
            //            if (name == "") {  
            //                $("label#name_error").show();  
            //                $("input#name").focus();  
            //                return false;  
            //            }  
            //            var email = $("input#email").val();  
            //            if (email == "") {  
            //                $("label#email_error").show();  
            //                $("input#email").focus();  
            //                return false;  
            //            }  
              
              
              
            
        });
    });                     
</script>
<?php get_footer(); ?>
