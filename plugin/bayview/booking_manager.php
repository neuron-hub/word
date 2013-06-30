<?php

add_filter('admin_head', 'ShowTinyMCE');

function ShowTinyMCE() {
    // conditions here
    wp_enqueue_script('common');
    wp_enqueue_script('jquery-color');
    wp_print_scripts('editor');
    if (function_exists('add_thickbox'))
        add_thickbox();
    wp_print_scripts('media-upload');
    if (function_exists('wp_tiny_mce'))
        wp_tiny_mce();
    wp_admin_css();
    wp_enqueue_script('utils');
    do_action("admin_print_styles-post-php");
    do_action('admin_print_styles');
}

if (!empty($_POST['submit'])) {

    if (!empty($_POST['min_max_form'])) {
        update_option("bayview_min_nights", (int) $_POST['minimum_nights']);
        update_option("bayview_max_nights", (int) $_POST['maximum_nights']);
    }
    if (!empty($_POST['welcome_email_form'])) {
        update_option("bayview_welcome_email", stripslashes_deep($_POST['welcome_email_template']));
    }
    if (!empty($_POST['booking_email_form'])) {
        update_option("bayview_booking_email", stripslashes_deep($_POST['booking_email_template']));
    }
    if (!empty($_POST['booking_tax'])) {
        update_option("bayview_booking_tax", $_POST['booking_tax']);
    }
    
    if (!empty($_POST['booking_confirmation_email'])) {
        update_option('bayview_confirmation_email', stripslashes_deep($_POST['booking_confirmation_email']));
    }
    if (!empty($_POST['booking_cancellation_email_template'])) {
        update_option('bayview_cancellation_email', stripslashes_deep($_POST['booking_cancellation_email_template']));
    }
    
}

$min_nights = get_option("bayview_min_nights", 0);
$max_nights = get_option("bayview_max_nights", -1);
$booking_tax = get_option("bayview_booking_tax", 0);
$addon_serviceTax = get_option("addon_service_charges", 0);
$welcome_email = get_option("bayview_welcome_email", "");
$booking_email = get_option("bayview_booking_email", "");
$confirmation_email = get_option("bayview_confirmation_email", "");
$cancellation_email = get_option("bayview_cancellation_email", "");

?>
<div class="wrap">
    <h1>Booking Manager</h1>
    <div id="poststuff">
        <div class="metabox-holder columns-2">
            <form action="" method="post">
                <div id="post-body-content">
                    
                    <input type="hidden" name="min_max_form" value="min_max"/>
                    <div style="width:50%">
                        <fieldset style="border: 1px solid #bfbfbf">
                            <legend>Booking Configuration</legend>
                            <table style="width: 100%">
                                <tr>
                                    <td>Booking Tax (in %)</td><td align="right"><input type="text" name="booking_tax" value="<?php echo $booking_tax; ?>" size="4"/></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right"></td>
                                </tr>
                            </table>

                        </fieldset>
                    </div>

                    <br/>

                    <input type="hidden" name="welcome_email_form" value="welcome_email"/>
                    <div style="width:50%">
                        <fieldset style="border: 1px solid #bfbfbf">
                            <legend>Welcome Email Template</legend>
                            <?php
                            $initial_data = $welcome_email;
                        $settings = array(
                            'quicktags' => array('buttons' => 'em,strong,link',),
                            'text_area_name' => 'welcome_email_template', //name you want for the textarea
                            'quicktags' => true,
                            'tinymce' => true,
                            'wpautop' => true
                        );
                        $id = 'welcome_email_template'; //has to be lower case
                        wp_editor($initial_data, $id, $settings);
                        ?>
<!--                            <textarea name="welcome_email_template" cols="85" rows="10"><?php echo $welcome_email; ?></textarea>-->
                            
                            <br/>

                        </fieldset>
                    </div>

                    <br/>

                    <input type="hidden" name="booking_email_form" value="booking_email"/>
                    <div style="width:50%">
                        <fieldset style="border: 1px solid #bfbfbf">
                            <legend>Booking Email Template</legend>
                            
                            <?php
                            $initial_data = $booking_email;
                        $settings = array(
                            'quicktags' => array('buttons' => 'em,strong,link',),
                            'text_area_name' => 'booking_email_template', //name you want for the textarea
                            'quicktags' => true,
                            'tinymce' => true,
                            'wpautop' => true
                        );
                        $id = 'booking_email_template'; //has to be lower case
                        wp_editor($initial_data, $id, $settings);
                        ?>
                            
<!--                            <textarea name="booking_email_template" cols="85" rows="10"><?php //echo $booking_email; ?></textarea>-->
                            
                            <br/>

                        </fieldset>
                    </div>
                    <br/>
                    <input type="hidden" name="booking_email_form" value="booking_confirmation_email"/>
                    <div style="width:50%">
                        <fieldset style="border: 1px solid #bfbfbf">
                            <legend>Booking Confirmation Email Template</legend>
                            
                            <?php
                            $initial_data = $confirmation_email;
                        $settings = array(
                            'quicktags' => array('buttons' => 'em,strong,link',),
                            'text_area_name' => 'booking_confirmation_email', //name you want for the textarea
                            'quicktags' => true,
                            'tinymce' => true,
                            'wpautop' => true
                        );
                        $id = 'booking_confirmation_email'; //has to be lower case
                        wp_editor($initial_data, $id, $settings);
                        ?>
                            
<!--                            <textarea name="booking_confirmation_email" cols="85" rows="10"><?php //echo $confirmation_email; ?></textarea>-->
                            <br/>

                        </fieldset>
                    </div>
                    <br/>
                    <div style="width:50%">
                        <fieldset style="border: 1px solid #bfbfbf">
                            <legend>Booking cancellation Email Template</legend>
                            
                            <?php
                            $initial_data = $cancellation_email;
                        $settings = array(
                            'quicktags' => array('buttons' => 'em,strong,link',),
                            'text_area_name' => 'booking_cancellation_email_template', //name you want for the textarea
                            'quicktags' => true,
                            'tinymce' => true,
                            'wpautop' => true
                        );
                        $id = 'booking_cancellation_email_template'; //has to be lower case
                        wp_editor($initial_data, $id, $settings);
                        ?>
                            
<!--                            <textarea name="booking_email_template" cols="85" rows="10"><?php //echo $booking_email; ?></textarea>-->
                            
                            <br/>

                        </fieldset>
                    </div>
                    <br/>

                </div>
                <div class="postbox-container" id="postbox-container-1">
                    <input type="submit" name="submit" class="button button-primary button-large" value="Save"/>
                </div>
            </form>
        </div>
    </div>
</div>

