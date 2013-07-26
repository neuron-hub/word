<h1>Bookings</h1>

<?php
global $wpdb;
$booking_table = $table_prefix . 'bookinglog';
$shedule_table = $table_prefix . 'bayview_schedule';
$payment_table = $table_prefix . 'payment';
$paged = ($_REQUEST['paged']) ? $_REQUEST['paged'] : 1;

$limit = 20; // number of rows in page
$offset = ( $paged - 1 ) * $limit;

$total = $wpdb->get_var("SELECT COUNT(`id`) FROM $booking_table booked ");

$num_of_pages = ceil($total / $limit);

$query = "SELECT * FROM $booking_table booked ORDER BY booked.ID DESC LIMIT $offset, $limit";

$bookings = $wpdb->get_results($query);

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
<div class="wrap">
    <table cellspacing="0" class="wp-list-table widefat fixed posts">
        <thead>
            <tr>
                <th class="manage-column column-cb desc" id="title" scope="col" style="width: 5%;" ><span># ID</span></th>
                <th style="" class="manage-column column-taxonomy-station"  scope="col" style="width: 10%">Cottage</th>
<!--                <th style="" class="manage-column column-cottage_number"  scope="col">Cottage Number/Room</th>-->
                <th style="" class="manage-column column-data desc"  scope="col" style="width: 25%"><span>Email</span></th>
                <th style="" class="manage-column column-data desc"  scope="col" style="width: 2%"><span>Person</span></th>
                <th style="" class="manage-column column-date asc" scope="col" style="width: 5%"><span>Payment Info</span></th>
                <th style="" class="manage-column column-date asc" scope="col" style="width: 15%"><span>Addons</span></th>
                <th style="" class="manage-column column-date asc" scope="col" style="width: 10%"><span>Arrival</span></th>
                <th style="" class="manage-column column-date asc" scope="col" style="width: 10%"><span>Departure</span></th>
                <th style="" class="manage-column column-date asc" scope="col" style="width: 10%"><span>Total Price</span></th>
                <th style="" class="manage-column column-date asc" scope="col" style="width: 10%"><span>Status</span></th>
            </tr> 
        </thead>

        <tfoot>
            <tr>        
                <th class="manage-column column-cb desc" id="title" scope="col" style="width: 30px;" ><span># ID</span></th>
                <th style="" class="manage-column column-taxonomy-station"  scope="col" style="width: 50px;">Cottage</th>
<!--                <th style="" class="manage-column column-cottage_number"  scope="col">Cottage Number/Room</th>-->
                <th style="" class="manage-column column-data asc"  scope="col" style="width: 250px;"><span>Email</span></th>
                <th style="" class="manage-column column-data asc"  scope="col"><span>Person</span></th>
                <th style="" class="manage-column column-date asc" scope="col"><span>Payment Info</span></th>
                <th style="" class="manage-column column-date asc" scope="col"><span>Addons</span></th>
                <th style="" class="manage-column column-date asc" scope="col"><span>Arrival</span></th>
                <th style="" class="manage-column column-date asc" scope="col"><span>Departure</span></th>
                <th style="" class="manage-column column-date asc" scope="col"><span>Total Price</span></th>
                <th style="" class="manage-column column-date asc" scope="col"><span>Status</span></th>
            </tr>

        </tfoot>

        <tbody id="the-list">

            <?php
            $alternate = false;
            if (count($bookings) <= 0) {
                ?>
                <tr valign="top" class="booking-no type-cottage status-publish hentry-no iedit author-self" id="booking-no">
                    <td class="post-title page-title column-cb" colspan="10" style="text-align:center;">No Booking Found. </td>
                </tr>
                <?php
            }
            foreach ($bookings as $booking) {
                $alternate = !$alternate;
                $color = 'style="background-color:red"';
                switch ($booking->cottage_status) {
                    case 0:
                        $color = 'style="background-color:#E8ADAA"';
                        break;
                    case 1:
                        $color = 'style="background-color:#C3FDB8"';
                        break;
                    default:
                        $color = '';
                }
                ?>
                <tr valign="top" <?php echo $color; ?> class="booking-<?php echo $booking->ID; ?> type-cottage status-publish hentry<?php echo ($alternate ? ' alternate' : ''); ?> iedit author-self" id="booking-<?php echo $booking->ID; ?>">

                    <td>
                        <?php echo $booking->ID; ?>
                    </td>
                    <td>
                        <strong><!--<a title="View Cottage" href="<?php echo admin_url("post.php"); ?>?post=<?php echo $booking->cottage_id; ?>&amp;action=edit" class="row-title"> --><?php echo get_the_title($booking->cottage_id); ?><!--</a>--></strong>
                    </td>
<!--                    <td class="post-title page-title column-title">
                        <strong><?php echo $booking->cottage_number; ?></strong>
                    </td>-->
                    <td>
                        <?php echo get_userdata($booking->user_id)->user_email; ?>
                    </td>
                    <td>
                        <?php echo $booking->people; ?>
                    </td>
                    <td>
                        <a href="javascript:void(0)" onclick="showPayInfo(<?php echo $booking->p_id; ?>); return false">View</a>
                    </td>
                    <td>
                        <?php
                        $addons = json_decode($booking->addons);
                        if (!empty($addons)) {
                            foreach ($addons as $addon) {
                                echo "$addon->package_quantity of $addon->package_name <br/>";
                            }
                        } else {
                            echo "None";
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo $booking->cottage_arrival_date; ?>
                    </td>
                    <td>
                        <?php echo $booking->cottage_departure_date; ?>
                    </td>
                    <td>
                        <?php echo $booking->cottage_total; ?>
                    </td>
                    <td>
                        <div id="booking-status-div-<?php echo $booking->ID; ?>" style="float: left;">
                            <span id="booking-status-<?php echo $booking->ID; ?>" style="float: left;width: 86px;">
                                <?php
                                switch ($booking->cottage_status) {
                                    case 0:
                                        echo "Pending";
                                        break;
                                    case 1:
                                        echo "Approved";
                                        break;
                                    default:
                                        echo "Cancelled";
                                }
                                ?>
                            </span>&nbsp;<button class="button-primary" onclick="jQuery('#booking-status-div-<?php echo $booking->ID; ?>').hide();jQuery('#booking-status-edit-div-<?php echo $booking->ID; ?>').show();">Change?</button>
                        </div>
                        <div id="booking-status-edit-div-<?php echo $booking->ID; ?>" style="display:none;float:left">
                            <select id="booking-status-edit-<?php echo $booking->ID; ?>" name="booking-status-edit-<?php echo $booking->ID; ?>">
                                <option value="0">Pending</option>
                                <option value="1">Approved</option>
                                <option value="-1">Cancelled</option>
                            </select>&nbsp;<div id="publishing-action">
<span class="spinner"></span><button class="button-primary" onclick="updateBookingStatus(<?php echo $booking->ID; ?>);">Update</button></div>
                        </div>

                    </td>


                </tr>

                <?php
            }
            ?>

        </tbody>
    </table>
    <div id="payinfo_dialog">
        &nbsp;
    </div>
</div>
<script type="text/javascript">
    
    function updateBookingStatus(bid){
        var status = jQuery("#booking-status-edit-"+bid).val();
        jQuery('#publishing-action .spinner').show();
        jQuery.post("<?php echo admin_url("admin-ajax.php"); ?>", 
        {
            'action' : "bayview_update_booking_status",
            'booking_id' : bid,
            'status' : status
        },
        function (r) {
            if(r.status == undefined || r.status != "success") {
                if(r.msg == undefined) {
                    alert("Some error occured while trying to update booking status");
                }else {
                    alert(r.msg);
                }
                jQuery('#publishing-action .spinner').hide();
                //location.reload(true);
                return;
            }
            jQuery('#booking-status-'+bid).html(jQuery("#booking-status-edit-"+bid+" option[value="+status+"]").html());
            jQuery('#booking-status-edit-div-'+bid).hide();
            jQuery('#booking-status-div-'+bid).show();
            jQuery('#publishing-action .spinner').hide();
            location.reload(true);
        },
        "json"
    );
    }
    
    function showPayInfo(pid) {
        
        jQuery.post("<?php echo admin_url("admin-ajax.php"); ?>", 
        {
            'action' : "bayview_get_payment_info",
            'payment_id' : pid
        },
        function (r) {
            if(r.status == undefined || r.status != "success") {
                if(r.msg == undefined) {
                    jQuery("#payinfo_dialog").html("Some error occured while trying to fetch payment info for specified payment#"+pid);
                }else {
                    jQuery("#payinfo_dialog").html("Following error occured while trying to fetch payment info for specified payment#"+pid+"\n"+r.msg);
                }
                return;
            }
            r = r.result;
            jQuery("#payinfo_dialog").html(
            "<table>"+
                "<tr>"+
                "<th>PaymentID:</th><td>"+r.ID+"</td>"+
                "</tr>"+
//                "<tr>"+
//                "<th>CustomerID:</th><td>"+r.user_id+"</td>"+
//                "</tr>"+
                "<tr>"+
                "<th>First Name:</th><td>"+r.fname+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Last Name:</th><td>"+r.lname+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Address:</th><td>"+r.address1+"<br/>"+r.address2+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Country:</th><td>"+r.country+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Postal Code:</th><td>"+r.postal_code+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>State:</th><td>"+r.state+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Mobile:</th><td>"+r.mobile_phone+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Alt. Phone:</th><td>"+r.alt_phone+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Card Type:</th><td>"+r.card_type+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Card Number:</th><td>"+r.card_number+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Card Expiry:</th><td>"+r.card_exp+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Card Security:</th><td>"+r.card_security+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Card Name:</th><td>"+r.card_name+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Gross Total:</th><td>"+r.gross_total+"</td>"+
                "</tr>"+
                "</table>"
        );
            jQuery("#payinfo_dialog").dialog({
                dialogClass: "no-close",
                buttons: [
                    {
                        text: "OK",
                        click: function() {
                            jQuery( this ).dialog("close");
                        }
                    }
                ]
            });
        },
        "json"
    );
        
    }
</script>
