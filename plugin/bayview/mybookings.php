<h1>Bookings</h1>

<?php
global $wpdb, $current_user;

get_currentuserinfo();


$booking_table = $table_prefix . 'bookinglog';
$payment_table = $table_prefix . 'payment';
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$limit = 10; // number of rows in page
$offset = ( $paged - 1 ) * $limit;
$total = $wpdb->get_var( "SELECT COUNT(`id`) FROM $booking_table WHERE user_id = ".$current_user->ID );
$num_of_pages = ceil( $total / $limit );

$bookings = $wpdb->get_results("SELECT * FROM $booking_table WHERE user_id = " . $current_user->ID." LIMIT $offset, $limit");

$page_links = paginate_links( array(
    'base' => add_query_arg( 'pagenum', '%#%' ),
    'format' => '',
    'prev_text' => __( '&laquo;', 'aag' ),
    'next_text' => __( '&raquo;', 'aag' ),
    'total' => $total,
    'current' => $paged
) );

if ( $page_links ) {
    echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
}
?>
<table cellspacing="0" class="wp-list-table widefat fixed posts">
    <thead>
        <tr>
            <th class="manage-column column-cb desc" id="title" scope="col"  style="width: 100px;"><span>Booking ID</span></th>
            <th style="width: 100px;" class="manage-column column-taxonomy-station"  scope="col">Cottage</th>
            <th style="width: 200px;" class="manage-column column-comments num desc"  scope="col"><span>Email</span></th>
            <th style="width: 150px;" class="manage-column column-date asc" scope="col"><span>Payment Info</span></th>
            <th style="width: 200px;" class="manage-column column-date asc" scope="col"><span>Addons</span></th>
            <th style="width: 150px;" class="manage-column column-date asc" scope="col"><span>Arrival</span></th>
            <th style="width: 150px;" class="manage-column column-date asc" scope="col"><span>Departure</span></th>
            <th style="width: 120px;" class="manage-column column-date asc" scope="col"><span>Total Price</span></th>
            <th style="width: 200px;" class="manage-column column-date asc" scope="col"><span>Status</span></th>
        </tr>
    </thead>

    <tfoot>
        <tr>        
            <th class="manage-column column-cb desc" id="title" scope="col"  style="width: 100px;"><span>Booking ID</span></th>
            <th style="width: 100px;" class="manage-column column-taxonomy-station"  scope="col">Cottage</th>
            <th style="width: 200px;" class="manage-column column-comments num desc"  scope="col"><span>Email</span></th>
            <th style="width: 150px;" class="manage-column column-date asc" scope="col"><span>Payment Info</span></th>
            <th style="width: 200px;" class="manage-column column-date asc" scope="col"><span>Addons</span></th>
            <th style="width: 150px;" class="manage-column column-date asc" scope="col"><span>Arrival</span></th>
            <th style="width: 150px;" class="manage-column column-date asc" scope="col"><span>Departure</span></th>
            <th style="width: 120px;" class="manage-column column-date asc" scope="col"><span>Total Price</span></th>
            <th style="width: 200px;" class="manage-column column-date asc" scope="col"><span>Status</span></th>
        </tr>

    </tfoot>

    <tbody id="the-list">

        <?php
        $alternate = false;
        if (count($bookings) <= 0) {
            ?>
            <tr valign="top" class="booking-no type-cottage status-publish hentry-no iedit author-self" id="booking-no">
                <td class="post-title page-title column-cb" colspan="9" style="text-align:center;">No Booking Found. </td>
            </tr>
            <?php
        }
        foreach ($bookings as $booking) {
            $alternate = !$alternate;
            ?>
            <tr valign="top" class="booking-<?php echo $booking->ID; ?> type-cottage status-publish hentry<?php echo ($alternate ? ' alternate' : ''); ?> iedit author-self" id="booking-<?php echo $booking->ID; ?>">

                <td class="post-title page-title column-cb">
                    <?php echo $booking->ID; ?>
                </td>
                <td class="post-title page-title column-title">
                    <strong><a title="View Cottage" href="<?php echo get_permalink($booking->cottage_id); ?>" class="row-title"><?php echo get_the_title($booking->cottage_id); ?></a></strong>
                </td>
                <td class="post-title page-title column-title">
                    <?php echo get_userdata($booking->user_id)->user_email; ?>
                </td>
                <td class="post-title page-title column-title">
                    <a href="javascript:void(0)" onclick="showPayInfo(<?php echo $booking->p_id; ?>); return false">View</a>
                </td>
                <td class="post-title page-title column-title">
                    <?php
                    $addons = json_decode($booking->addons);
                    if (!empty($addons)) {
                        foreach ($addons as $addon) {
                            echo "$addon->package_quantity of $addon->package_name <br/>";
                        }
                    }
                    else{
                        echo 'None';
                    }
                    ?>
                </td>
                <td class="post-title page-title column-title">
                    <?php echo $booking->cottage_arrival_date; ?>
                </td>
                <td class="post-title page-title column-title">
                    <?php echo $booking->cottage_departure_date; ?>
                </td>
                <td class="post-title page-title column-title">
                    <?php echo $booking->cottage_total; ?>
                </td>
                <td class="post-title page-title column-title">
                    <div id="booking-status-div-<?php echo $booking->ID; ?>">
                        <span id="booking-status-<?php echo $booking->ID; ?>">
                            <?php
                            switch ($booking->cottage_status) {
                                case 0:
                                    echo "Awaiting Confirmation";
                                    break;
                                case 1:
                                    echo "Confirmed";
                                    break;
                                case 2:
                                    echo "Party Arrived";
                                    break;
                                default:
                                    echo "Cancelled";
                            }
                            ?>
                        </span></div>


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
<script type="text/javascript">

    
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
                "<tr>"+
                "<th>CustomerID:</th><td>"+r.user_id+"</td>"+
                "</tr>"+
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
