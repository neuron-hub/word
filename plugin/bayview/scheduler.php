<?php

function bayview_scheduler_page() {

    global $wpdb, $current_user;
    $schedule_table = "{$wpdb->prefix}bayview_schedule";
    get_currentuserinfo();
    $valid = 0;
    if (isset($_POST) && is_array($_POST) && !empty($_POST)) {

        if (isset($_POST['add_schedule']) && ($_POST['add_schedule'] == 'true') && (!isset($_POST['is_edit_schedule']) || !($_POST['is_edit_schedule'] == 'true'))) {
            $schedule_from = date('Y-m-d', strtotime($_POST['schedule_from']));
            $schedule_to = date('Y-m-d', strtotime($_POST['schedule_to']));
            $schedule_nights = (int) $_POST['schedule_nights'];
            $schedule_inventory = (int) $_POST['schedule_inventory'];
            $schedule_price = $_POST['schedule_price'];
            $weekend_price = $_POST['weekend_price'];
            $schedule_cottage = (int) $_POST['schedule_cottage'];
            $cottage_number = (int) $_POST['cottage_number'];
            $active = $_POST['active'];
            if (!empty($schedule_from) && !empty($schedule_to) && !empty($schedule_nights) && !empty($schedule_price)) {
                $insert = $wpdb->insert(
                        $schedule_table, array(
                    'schedule_from' => $schedule_from,
                    'schedule_to' => $schedule_to,
                    'schedule_nights' => $schedule_nights,
                    'schedule_inventory' => $schedule_inventory,
                    'schedule_price' => $schedule_price,
                    'weekend_price' => $weekend_price,
                    'cottage_number' => $cottage_number,
                    'schedule_cottage' => $schedule_cottage,
                    'active' => $active
                        ), array(
                    '%s',
                    '%s',
                    '%d',
                    '%d',
                    '%s',
                    '%s',
                    '%d',
                    '%d',
                    '%s'
                        )
                );
                if ($insert) {
                    $sendback = add_query_arg('added', 1, $_POST['_wp_refrence_redirect'] . '?page=scheduler');
                    wp_redirect($sendback);
                    exit();
                    $valid = 1;
                } else {
                    $sendback = add_query_arg('error', 1, $_POST['_wp_refrence_redirect'] . '?page=scheduler');
                    update_user_meta($current_user->ID, 'schedule_error', $wpdb->last_error);


                    wp_redirect($sendback);
                    exit();
                }
            } else {
                $sendback = add_query_arg('error', 1, $_POST['_wp_refrence_redirect'] . '?page=scheduler');
                wp_redirect($sendback);
                exit();
            }
        }

        if (isset($_POST['is_edit_schedule']) && ($_POST['is_edit_schedule'] == 'true') && !(isset($_POST['delete_condition']))) {


            foreach ((array) $_POST['edit_schedule'] as $coupon_id => $coupon_data) {

                $coupon_id = (int) $coupon_id;

                $check_values = $wpdb->get_row($wpdb->prepare("SELECT `ID`, `schedule_from`, `schedule_to`, `schedule_cottage`, `schedule_inventory`, `schedule_nights`, `schedule_price`,`weekend_price`, `cottage_number`, `active` FROM `" . $schedule_table . "` WHERE `ID` = %d", $coupon_id), ARRAY_A);


                // Sort both arrays to make sure that if they contain the same stuff,
                // that they will compare to be the same, may not need to do this, but what the heck
                if ($check_values != null)
                    ksort($check_values);

                ksort($coupon_data);

                if ($check_values != $coupon_data) {

                    $insert_array = array();

                    foreach ($coupon_data as $coupon_key => $coupon_value) {
                        if (isset($check_values[$coupon_key]) && $coupon_value != $check_values[$coupon_key])
                            $insert_array[] = "`$coupon_key` = '$coupon_value'";
                    }

                    if (count($insert_array) > 0)
                        $wpdb->query($wpdb->prepare("UPDATE `" . $schedule_table . "` SET " . implode(", ", $insert_array) . " WHERE `id` = %d LIMIT 1;", $coupon_id));

                    unset($insert_array);

                    $rules = $coupon_data['events'];

                    $rules = serialize($rules);

                    $wpdb->update(
                            IMIX_TABLE_COUPON_CODES, array(
                        'events' => $rules,
                            ), array(
                        'id' => $coupon_id
                            ), '%s', '%d'
                    );
                    $sendback = remove_query_arg(array('error'), $_POST['_wp_refrence_redirect'] . '?page=scheduler');
                    $sendback = add_query_arg('updated', 1, $_POST['_wp_refrence_redirect'] . '?page=scheduler');
                    wp_redirect($sendback);
                    exit();
                }
            }
        }
    }
    ?>
    <style>
        .displaynone{display:none;}
    </style>
    <script type='text/javascript'>
                                                                                                                        
        function show_status_box(id,image_id) {
            state = document.getElementById(id).style.display;
            if(state != 'block') {
                document.getElementById(id).style.display = 'block';

            } else {
                document.getElementById(id).style.display = 'none';

            }
            return false;
        }
                                                                                                                                
        function enable_coupon_limit(obj) {
            var limituses = obj.value;
            if(limituses == '1') {
                document.getElementById('coupon_limit').style.visibility = "visible";
                document.getElementById('max_tickets').focus();
            } else {
                document.getElementById('coupon_limit').style.visibility = "hidden";
            }
        } 
        function enable_coupon_limits(obj, id) {
            var limituses = obj.value;
            if(limituses == '1') {
                document.getElementById('coupon_limit_'+id).style.visibility = "visible";
                document.getElementById('max_tickets_'+id).focus();
            } else {
                document.getElementById('coupon_limit_'+id).style.visibility = "hidden";
            }
        } 
                                                                                                                            
        function checknum(evt) {
                                                                                                                    	
            evt = (evt) ? evt : window.event
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if(charCode == 9 || charCode == 8 || (charCode >= 48) && (charCode <= 57) || (charCode == 46 && evt.keyCode == 46))
                return true;
            else
                return false;
        }
        function price_check(evt) {
                                                                                                                    	
            evt = (evt) ? evt : window.event
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if(charCode == 9 || charCode == 8 || (charCode >= 48) && (charCode <= 57) || (charCode == 46))
                return true;
            else
                return false;
        }
        jQuery(document).ready(function(){
            jQuery('.imix_edit_schedule').click(function(){
                id = jQuery(this).attr('rel');
                id = 'schedule_box_'+id;
                if(jQuery('#'+id).hasClass('displaynone')){
                    jQuery('#'+id).show();
                    jQuery('#'+id).removeClass('displaynone');
                }else{
                    jQuery('#'+id).addClass('displaynone');
                    jQuery('#'+id).hide();
                }
            });
            jQuery('.delete_button').click(function(e){
                e.preventDefault(); 
                jQuery( "#dialog-message" ).dialog({
                    modal: true,
                    position: { my: "center", at: "center", of: window },
                    show: "slow",
                    resizable: false,
                    draggable: false,
                    maxHeight: 190,
                    maxWidth: 310,
                    buttons: {
                        Ok: function() {
                            jQuery( this ).dialog( "close" );
                            jQuery(e).trigger('click');
                            document.location.href = jQuery(e.target).attr('href');
                            return true;
                        },
                        Cancel: function() {
                            jQuery( this ).dialog( "close" );
                            return false;
                        }
                    }
                });
                                                        
            });
            jQuery('form#new_coupon').submit(function(e){
                                                                                           
                if(jQuery('input:text[name=add_coupon_name]').val() =='' || jQuery('input:text[name=add_coupon_code]').val() == '' || jQuery('input:text[name=add_discount]').val() ==''){
                    jQuery('.error').html('<p>Plesae fill out the Required fields</p>');
                    jQuery('.error').show();
                    return false;  
                }
                if(jQuery('#add_discount_type').val() == '1'){
                    if(jQuery('input:text[name=add_discount]').val() <= 0 || jQuery('input:text[name=add_discount]').val() >= 100){
                        jQuery('.error').html('<p>Enter discount amount of "%" between 0 and 100</p>');
                        jQuery('.error').show();
                        return false;
                    }  
                }
                else{
                    var checker = 0;
                    var multipleValues = jQuery("#multiple_event").val() || [];
                    var events_id = multipleValues.join(", ");
                    if(jQuery('input:text[name=add_discount]').val() <= 0){
                        jQuery('.error').html('<p>Enter value of discount amount between 0 and price of ticket</p>');
                        jQuery('.error').show();
                        return false;
                    }
                                                                                                    
                    var data = {
                        action: 'validate_coupon_amount',
                        event_id: events_id,
                        amount: jQuery('input:text[name=add_discount]').val()
                    };
                                                                                                    
                                                                                                   
                    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                    jQuery.post(ajaxurl, data, function(response) {
                        if(response.result == 'wrong'){
                            checker = 0;
                                                                                                        
                            jQuery('.error').html('<p>Enter value of 2014-06-24discount amount between 0 and price of ticket</p>');
                            jQuery('.error').show();     
                                                                                                        
                            return false;
                        }
                        if(response.result == 'right'){
                            checker = 1;
                            return true;
                        }
                                                                                                                     
                    },"json");
                                                                                                
                    if(checker == 1){
                        alert('sdfsdfsdfsdf');
                    }       
                }
                                                                                                                       
            });
        });
    </script>

    <div class="wrap">
        <div id="dialog-message" title="Coupon Delete" style="display: none;">
            <p>
                <span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0;"></span>
                Are you sure, you want to delete schedule.
            </p>
            <p>
                If yes press <strong>Ok</strong> else <strong>Cancel</strong>.
            </p>
        </div>

	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
        <h2> 
            <?php esc_html_e('Scheduler', 'imix'); ?>
            <a href="#" id="add_coupon_box_link" class="add_item_link button add-new-h2" onClick="return show_status_box( 'add_coupon_box', 'add_coupon_box_link' );">
                <?php esc_html_e('Add New', 'imix'); ?>
            </a>
        </h2>
        <div class="error" style="display:none;"></div> 

        <?php if (!empty($wpdb->last_error)): ?>
            <div style="" class="error below-h2"><p><?php echo $wpdb->last_error; ?></p></div>
            <?php $wpdb->flush(); ?>
        <?php endif; ?>
        <?php
        if (isset($_REQUEST['updated']) && $_REQUEST['updated'] == 1):
            echo "<div class='updated'><p align='center'>" . esc_html__('The Schedule has been updated.', 'imix') . "</p></div>";
        endif;

        if ($valid == 1 || (isset($_REQUEST['added']) && $_REQUEST['added'] == 1)):
            echo "<div class='updated'><p align='center'>" . esc_html__('The schedule has been added.', 'imix') . "</p></div>";
        endif;
        ?>
        <table style="width: 100%;">
            <tr>
                <td id="coupon_data">
                    <div id='add_coupon_box' class='modify_coupon' style="display: none;" >
                        <form name='coupon' id="new_coupon" method='post' action=''>
                            <table class='add-coupon' width="100%" >
                                <tr>
                                    <th style="text-align:left;"><?php esc_html_e('From*', 'imix'); ?></th>
                                    <th><?php esc_html_e('To*', 'imix'); ?></th>
                                    <th><?php esc_html_e('Min. Nights*', 'imix'); ?></th>
                                    <th><?php esc_html_e('Inventory*', 'imix'); ?></th>                                    
                                    <th><?php esc_html_e('Midweek Price*', 'imix'); ?></th>
                                    <th><?php esc_html_e('Weekend Price*', 'imix'); ?></th>
                                    <th><?php esc_html_e('Cottages*', 'imix'); ?></th>
                                    <th><?php esc_html_e('Cottage Number/Room', 'imix'); ?></th>
                                </tr>
                                <tr>
                                    <td style="text-align: left;" valign="top">
                                        <input type="text" class="datepicker" size="10" value="<?php echo date('Y-m-d'); ?>" readonly="true" name="schedule_from" id="schedule_from" />
                                    </td>
                                    <td style="text-align: center;" valign="top">
                                        <input type="text" class="datepicker" size="10" value="<?php echo date('Y') . '-' . (date('m') + 1) . '-' . date('d'); ?>" readonly="true" name="schedule_to" id="schedule_to" />
                                    </td>
                                    <td style="text-align: center;" valign="top">
                                        <input type='text' value='' size='3' id="schedule_nights" name='schedule_nights' onkeypress="return checknum(event)" required="required" />

                                    </td>
                                    <td style="text-align: center;" valign="top">
                                        <input type='text' value='1' size='3' name='schedule_inventory' id="schedule_inventory" onkeypress="return checknum(event)" required="required" />

                                    </td>
                                    <td style="text-align: center;" valign="top">
                                        <input type='text' value='' size='3' name='schedule_price' id="schedule_price" onkeypress="return price_check(event)" required="required" />
                                    </td>
                                    <td style="text-align: center;" valign="top">
                                        <input type='text' value='' size='3' name='weekend_price' id="weekend_price" onkeypress="return price_check(event)" required="required" />
                                    </td>
                                    <td style="text-align: center;" valign="top">
                                        <select name="schedule_cottage" id="multiple_cottage"  required="required">
                                            <option value="" selected="selected">Select Cottage</option>
                                            <?php
                                            $time = time();
                                            $args = array(
                                                'post_type' => 'cottage',
                                                'post_status' => array('publish'),
                                                'posts_per_page' => -1,
                                            );
                                            $the_query = new WP_Query($args);
                                            while ($the_query->have_posts()) : $the_query->the_post();
                                                echo '<option value="' . get_the_ID() . '">' . get_the_title() . '</option>';
                                            endwhile;
                                            ?>

                                        </select>
                                    </td>
                                    <td style="text-align: center;" valign="top">
                                        <input type='text' value='' size='6' name='cottage_number' id="cottage_number" onkeypress="return checknum(event)" />
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan='7' scope="row">
                                        <p>
                                            <span class='input_label'><?php esc_html_e('Activate/Deactivate', 'imix'); ?></span>
                                            <input type='hidden' value='0' name='active' />
                                            <input type="hidden" value="<?php echo $_SERVER['PHP_SELF'] ?>" name="_wp_refrence_redirect" />
                                            <input type='checkbox' value='1' checked='checked' name='active' />
                                            <span class='description'><?php esc_html_e('.', 'imix') ?></span>
                                        </p>
                                    </td>
                                    <td style="text-align: center;">
                                        <input type='hidden' value='true' name='add_schedule' />
                                        <input type='submit' value='<?php esc_attr_e('Add Schedule', 'imix'); ?>' name='submit_schedule' class='button-primary' />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </td>
            </tr>
        </table>

        <?php
        $columns = array(
            'schedule_from' => __('Schedule From', 'imix'),
            'schedule_to' => __('Schedule To', 'imix'),
            'schdule_nights' => __('Min. Nights', 'imix'),
            'schedule_inventory' => __('Inventory', 'imix'),
            'schedule_cottages' => __('Cottages', 'imix'),
            'week_price' => __('Midweek Price', 'imix'),
            'weekend_price' => __('Weekend Price', 'imix'),
            'cottage_number' => __('Cottage Number', 'imix'),
            'status' => __('Status', 'imix'),
            'edit' => __('Edit', 'imix')
        );
        register_column_headers('display-coupon-details', $columns);
        $paged = ($_REQUEST['paged']) ? $_REQUEST['paged'] : 1;

        $limit = 10; // number of rows in page
        $offset = ( $paged - 1 ) * $limit;

        $total = $wpdb->get_var("SELECT COUNT(`id`) FROM `{$wpdb->prefix}bayview_schedule` ");

        $num_of_pages = ceil($total / $limit);
        $page_links = paginate_links(array(
            'base' => add_query_arg('paged', '%#%'),
            'format' => '',
            'prev_text' => __('&laquo;', 'aag'),
            'next_text' => __('&raquo;', 'aag'),
            'total' => $num_of_pages,
            'current' => $paged
                ));

        if ($page_links) {
            echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
        }
        ?>

        <table class="coupon-list widefat" cellspacing="0">
            <thead>
                <tr>
                    <?php print_column_headers('display-coupon-details'); ?>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <?php print_column_headers('display-coupon-details', false); ?>
                </tr>
            </tfoot>

            <tbody>
                <?php
                $i = 0;

                $schedule_data = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}bayview_schedule` ORDER BY ID DESC LIMIT $offset, $limit ", ARRAY_A);
                foreach ((array) $schedule_data as $schedule) {
                    $alternate = "";
                    $i++;
                    if (($i % 2) != 0) {
                        $alternate = "class='alt'";
                    }

                    $start = get_date_from_gmt($coupon['start'], 'd/m/Y');
                    $expiry = get_date_from_gmt($coupon['expiry'], 'd/m/Y');

                    echo "<tr $alternate>\n\r";

                    echo "    <td>\n\r";
                    echo esc_attr($schedule['schedule_from']);
                    echo "    </td>\n\r";

                    echo "    <td>\n\r";
                    echo esc_attr($schedule['schedule_to']);
                    echo "    </td>\n\r";

                    echo "    <td>\n\r";
                    echo esc_attr($schedule['schedule_nights']);
                    echo "    </td>\n\r";

                    echo "    <td>\n\r";
                    echo esc_attr($schedule['schedule_inventory']);
                    echo "    </td>\n\r";

                    echo "    <td>\n\r";
                    echo   ($schedule['schedule_cottage'] == '' ? '': get_post($schedule['schedule_cottage'])->post_title);
                    echo "    </td>\n\r";

                    echo "    <td>\n\r";
                    echo $schedule['schedule_price'];
                    echo "    </td>\n\r";

                    echo "    <td>\n\r";
                    echo $schedule['weekend_price'];
                    echo "    </td>\n\r";

                    echo "    <td>\n\r";
                    echo $schedule['cottage_number'];
                    echo "    </td>\n\r";
                    
                    echo "    <td>\n\r";
                    echo ($schedule['active'] == '1' ? 'Active': 'Deactive');
                    echo "    </td>\n\r";


                    echo "    <td>\n\r";
                    echo "<a title='Schedule edit' href='javascript:void(0);' rel='" . $schedule['ID'] . "' class='imix_edit_schedule'  >" . esc_html__('Edit', 'imix') . "</a>";
                    echo "    </td>\n\r";

                    echo "  </tr>\n\r";

                    echo "  <tr class='schedule_edit'>\n\r";
                    echo "    <td colspan='9' style='padding-left:0px;border:none;'>\n\r";
                    echo "      <div id='schedule_box_" . $schedule['ID'] . "' class='displaynone modify_coupon' >\n\r";
                    bayview_schedule_edit_form($schedule);
                    echo "      </div>\n\r";
                    echo "    </td>\n\r";
                    echo "  </tr>\n\r";
                }
                ?>
            </tbody>
        </table>

                                                                                            <!--        <p style='margin: 10px 0px 5px 0px;'>
        <?php //_e('<strong>Note:</strong> ', 'imix');      ?>
                                                                                                    </p>-->

    </div>

    <?php
}

function bayview_schedule_edit_form($schedule) {
    if (!empty($schedule)) {


        $schedule_id = $schedule['ID'];
        ?>
        <div id="edit_schedule_box" class="modify_schedule" >
            <form name="edit_schedule_<?php echo $schedule_id; ?>" id="edit_schedule_<?php echo $schedule_id; ?>" method="post" action="">
                <table class='add-coupon' width="100%" >
                    <tr>
                        <th><?php esc_html_e('From*', 'imix'); ?></th>
                        <th><?php esc_html_e('To*', 'imix'); ?></th>
                        <th><?php esc_html_e('Min. Nights*', 'imix'); ?></th>
                        <th><?php esc_html_e('Inventory*', 'imix'); ?></th>  
                        <th><?php esc_html_e('Cottages*', 'imix'); ?></th>
                        <th><?php esc_html_e('Midweek Price*', 'imix'); ?></th>
                        <th><?php esc_html_e('Weekend Price*', 'imix'); ?></th>

                        <th><?php esc_html_e('Cottage Number', 'imix'); ?></th>
                    </tr>
                    <tr>
                        <td style="text-align: left;" valign="top">
                            <input type="text" class="datepicker" size="8" value="<?php echo $schedule['schedule_from'] ?>" readonly="true" name="edit_schedule[<?php echo $schedule_id; ?>][schedule_from]" id="schedule_from_<?php echo $schedule_id; ?>" />
                        </td>
                        <td style="text-align: left;" valign="top">
                            <input type="text" class="datepicker" size="8" value="<?php echo $schedule['schedule_to']; ?>" readonly="true" name="edit_schedule[<?php echo $schedule_id; ?>][schedule_to]" id="schedule_to_<?php echo $schedule_id; ?>" />
                        </td>
                        <td style="text-align: center;" valign="top">
                            <input type='text' value="<?php echo $schedule['schedule_nights']; ?>" size='3' id="schedule_nights_<?php echo $schedule_id; ?>" name='edit_schedule[<?php echo $schedule_id; ?>][schedule_nights]' onkeypress="return checknum(event)" required="required" />

                        </td>
                        <td style="text-align: center;" valign="top">
                            <input type='text' value="<?php echo $schedule['schedule_inventory']; ?>" size='3' name='edit_schedule[<?php echo $schedule_id; ?>][schedule_inventory]' id="schedule_inventory_<?php echo $schedule_id; ?>" onkeypress="return checknum(event)" required="required" />

                        </td>
                        <td style="text-align: center;" valign="top">
                            <select name="edit_schedule[<?php echo $schedule_id; ?>][schedule_cottage]" id="multiple_cottage_<?php echo $schedule_id; ?>" required="required">
                                <option value="" <?php echo ('' == $schedule['schedule_cottage'] ? 'selected="selected"' : "" ); ?>>Select Cottage</option>
                                <?php
                                $time = time();
                                $args = array(
                                    'post_type' => 'cottage',
                                    'post_status' => array('publish'),
                                    'posts_per_page' => -1,
                                );
                                $the_query = new WP_Query($args);
                                while ($the_query->have_posts()) : $the_query->the_post();
                                    echo '<option value="' . get_the_ID() . '" ' . (get_the_ID() == $schedule['schedule_cottage'] ? 'selected="selected"' : "" ) . '>' . get_the_title() . '</option>';
                                endwhile;
                                ?>

                            </select>
                        </td>
                        <td style="text-align: center;" valign="top">
                            <input type='text' value="<?php echo $schedule['schedule_price']; ?>" size='3' name='edit_schedule[<?php echo $schedule_id; ?>][schedule_price]' id="schedule_price_<?php echo $schedule_id; ?>" onkeypress="return price_check(event)" required="required" />
                        </td>
                        <td style="text-align: center;" valign="top">
                            <input type='text' value="<?php echo $schedule['weekend_price']; ?>" size='3' name='edit_schedule[<?php echo $schedule_id; ?>][weekend_price]' id="weekend_price_<?php echo $schedule_id; ?>" onkeypress="return price_check(event)" />
                        </td>

                        <td style="text-align: center;" valign="top">
                            <input type='text' value="<?php echo $schedule['cottage_number']; ?>" size='3' name='edit_schedule[<?php echo $schedule_id; ?>][cottage_number]' id="cottage_number _<?php echo $schedule_id; ?>" onkeypress="return checknum(event)" />

                        </td>

                    </tr>
                    <tr>
                        <td colspan='4' scope="row">
                            <p>
                                <span class='input_label'><?php esc_html_e('Activate/Deactivate', 'imix'); ?></span>
                                <input type='hidden' value='0' name='edit_schedule[<?php echo $schedule_id; ?>][active]' />
                                <input type="hidden" value="<?php echo $_SERVER['PHP_SELF'] ?>" name="_wp_refrence_redirect" />
                                <input type='checkbox' value='1' <?php echo (($schedule['active'] == 1) ? "checked='checked'" : '') ?> name='edit_schedule[<?php echo $schedule_id; ?>][active]' />
                                <span class='description'><?php esc_html_e('', 'imix') ?></span>
                            </p>
                        </td>
                        <td style="text-align: center;" colspan='4'>
                            <input type='hidden' value='true' name='is_edit_schedule' />
                            <input type='submit' value='<?php esc_attr_e('Update Schedule', 'imix'); ?>' name='submit_schedule' class='button-primary' />
                        </td>
                    </tr>
                </table>
            </form>

        </div>

        <?php
    }
}
?>
