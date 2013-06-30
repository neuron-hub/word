<?php
/**
 * The template for displaying cottages page.
 *
 * @package BayView
 * @subpackage Bayview
 */
get_header();
$cart_count = count($_SESSION['data_for_cart']);
?>

<div id="body-section">
    <div class="wrapper">
        <div class="inner-body-left">
            <div class="bl-top">
                <img src="<?php echo get_template_directory_uri(); ?>/images/top-img.png" alt="" />
            </div>
            <div class="bl-mid">
                <?php
                $cart_detail = get_cart_offer('offer_id', get_the_ID());

                if (!empty($cart_detail['offer_id']) && $cart_detail['offer_id'] != get_the_ID()) {
                    unset($cart_detail);
                }

                if (!empty($cart_detail)) {
                    $in_cart = true;
                } else {
                    $in_cart = false;
                }

                $arrival = (!empty($cart_detail['arrival_date']) ? $cart_detail['arrival_date'] : (!empty($_SESSION['arrival']) ? $_SESSION['arrival'] : ''));


                $adults = $_SESSION['adults'];
                $children_selected = $_SESSION['children'];
                ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php
                    $meta = get_post_meta(get_the_ID());
                    $cottages = $meta['_cottages'][0];
                    $cottages = explode(',', $cottages);

                    $cottage_titles = array();

                    $people = 0;
                    $children = 0;

                    foreach ($cottages as $c) {
                        $cottage_titles[] = get_the_title($c);
                        $people += get_post_meta($c, '_people', true);
                        $children += get_post_meta($c, '_children', true);
                    }

                    $_addons = $meta['_addons'][0];
                    $addon_titles = array();
                    if (!empty($_addons)):
                        $_addons = explode(',', $_addons);
                        $addons = array();
                        foreach ($_addons as $addon) {
                            list($id, $quantity) = explode('|', $addon);
                            $addons[$id] = $quantity;
                        }



                        foreach ($addons as $aid => $aqty) {
                            $addon_titles[] = get_the_title($aid) . " ($aqty)";
                        }
                    endif;

                    $nights = $meta['_nights'][0];
                    $discount = $meta['_discount'][0];
                    if (!empty($arrival)) {
                        $departure = date('Y-m-d', strtotime("+" . ($nights - 1) . " days", strtotime($arrival)));
                    }
                    ?>
                    <div class="bl-heading">
                        <h1>My Reservation: <span><?php echo (!empty($arrival) ? "Arriving " . date("l, F j, Y") : ''); ?></span></h1>
                    </div>
                    <div id="featured">
                        <div id="up"><img src="<?php echo get_template_directory_uri(); ?>/images/down.png"/></div>
                        <ul class="ui-tabs-nav">
                            <?php
                            $counter = 1;
                            foreach ($cottages as $c) {
                                $attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $c));
                                ?>

                                <?php
                                foreach ($attachments as $attachment_id => $attachment) {
                                    ?>
                                    <li class="ui-tabs-nav-item" id="nav-fragment-<?php echo $counter; ?>"><a href="#fragment-<?php echo $counter; ?>"><?php echo wp_get_attachment_image($attachment_id, 'cottage-slider-thumb'); ?></a></li>

                                    <?php
                                    $counter++;
                                }
                                ?>


                                <?php
                            }
                            ?>
                        </ul>
                        <div id="down"><img src="<?php echo get_template_directory_uri(); ?>/images/up.png"/></div>
                        <?php
                        if ($counter <= 1) {
                            echo '<div id="" class="single-cottage-no-image" style="width:100%;text-align:center;">';
                            echo '<img height="196" width="668" alt="' . get_the_title() . '" class="attachment-cottage-thumb wp-post-image" src="' . get_bloginfo('template_directory') . '/images/668x250.jpg"/>';
                            echo '</div>';
                        }
                        $counter = 1;
                        foreach ($cottages as $c) {
                            $attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $c));
                            foreach ($attachments as $attachment_id => $attachment) {
                                ?>
                                <div id="fragment-<?php echo $counter; ?>" class="ui-tabs-panel" style="">
                                    <?php echo wp_get_attachment_image($attachment_id, 'cottage-slider-img'); ?>
                                </div>
                                <?php
                                $counter++;
                            }
                        }
                        ?>


                    </div>
                    <div class="cd-description">
                        <h1><?php the_title(); ?></h1>
                        <?php the_excerpt(); ?>
                        <span><a href="javascript:void(0)" onclick="jQuery('#more-details').slideToggle(1000);">+View More Detail</a></span>
                        <div id="more-details" style="display:none; clear: both">
                            <?php the_content(); ?>
                        </div>
                        <div style="color:#f00;">
                            <?php
                            if (!empty($arrival) && !empty($departure)) {
                                $res = isValidBooking(get_the_ID(), $arrival, $departure);

                                if ($res !== true) {
                                    echo "$res";
                                    $departure = $_SESSION['departure'] = '';
                                }
                            }
                            ?>
                        </div>
                    </div>               
                    <div class="cd-detail">

                        <h1>Detail</h1>
                        <h2>Suite Summary</h2>

                        <p>Arrival Date: <span id="arrival_label"><?php echo (!empty($arrival) ? date('l, F j, Y', strtotime($arrival)) : 'N/a'); ?></span><input id="arrival_input" type="text" name="arrival_date" value="<?php echo ((!empty($cart_detail['arrival_date']) && isset($cart_detail['arrival_date'])) ? date('m/d/Y', strtotime($cart_detail['arrival_date'])) : (!empty($_SESSION['arrival']) ? date('m/d/Y', strtotime($_SESSION['arrival'])) : '')); ?>" class="datepicker" style="display: none" onkeypress=""/> <a href="javascript:void(0)" onclick="toggleChange(this, 'arrival_input', 'arrival_label', true)">Change?</a></p>
    <!--                        <p>Departure Date: <span id="departure_label"><?php //echo (!empty($departure) ? date('l, F j, Y', strtotime($departure)) : 'N/a');      ?></span></p>-->
                        <p>Number of Nights: <span id="nights_label"><?php echo $nights; ?></span></p>
                        <p>Adults: <span id="adults_label"><?php echo (!empty($adults) ? $adults : '1'); ?></span><select id="adults_input" value="<?php echo (!empty($adults) ? $adults : ''); ?>" style="display:none"><?php
                        for ($i = 1; $i <= $people; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                            ?></select> <a href="javascript:void(0)" onclick="toggleChange(this, 'adults_input', 'adults_label')">Change?</a></p>
                        <p>Children 3 & up: <span id="children_label"><?php echo (!empty($children_selected) ? $children_selected : 'N/a'); ?></span><select id="children_input" value="<?php echo (!empty($children_selected) ? $children_selected : ''); ?>" style="display:none"/><option value="0" selected="selected">0</option><?php
                            for ($i = 1; $i <= $children; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?></select> <a href="javascript:void(0)" onclick="toggleChange(this, 'children_input', 'children_label')">Change?</a></p>

                    </div>
                    <div class="cd-summary">
                        <h2>Summary of Charges</h2>
                        <?php
                        if (!empty($arrival) && !empty($departure)) {
                            $prices = array();
                            foreach ($cottages as $c) {
                                $prices[get_the_title($c)] = getCottagePrice($c, get_post_meta($c, '_nightly_rate', true), $arrival, $departure);
                            }
                            $total_price = 0;
                            foreach ($prices as $cottage => $pp) {
                                $price = 0;
                                foreach ($pp as $p) {
                                    $price+=$p;
                                }
                                $prices[$cottage] = $price;
                                $total_price += $price;
                            }
                            $cottage_price = $total_price;
                            $addon_price = 0;
                            $addon_prices = array();
                            if (!empty($addons)) {
                                foreach ($addons as $addon_id => $addon_qnty) {
                                    $total_price += $addon_price += $addon_prices[get_the_title($addon_id) . " ($addon_qnty)"] = get_post_meta($addon_id, '_price', true) * $addon_qnty;
                                }
                            }

                            $total_price = ((!empty($cart_detail['total_rate']) && isset($cart_detail['total_rate'])) ? $cart_detail['total_rate'] : $total_price);
                            $discounted_price = getDiscountedPrice($total_price, $discount);
                            $discount = $total_price - $discounted_price;
                        } else {
                            $total_price = $cottage_price = $addon_price = $discounted_price = 0;
                        }
                        $bayview_tax = floatval(get_option("bayview_booking_tax", 0)) / 100;
                        ?>



                        <div class="row-a">
                            <table style="width: 100%">
                                <tr><td align="left" width="150px"><p><?php
                    echo implode(', ', $cottage_titles);
                        ?></p></td><td align="left">:</td><td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$<span id="rate_room"><?php echo round($cottage_price, 2); ?></span></td></tr>
                                            <?php if (!empty($addon_titles)): ?>
                                    <tr>
                                        <td align="left" width="150px">
                                            <p><?php echo implode(', ', $addon_titles); ?></p>
                                        </td>
                                        <td align="left">:</td>
                                        <td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$<span id="rate_pkg"><?php echo round($addon_price, 2); ?></span></td>
                                    </tr>
                                <?php endif; ?>
                                <tr><td align="left" width="150px"><p>Sub Total</p></td><td align="left">:</td><td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$<span id="rate_sub_total"><?php echo round(($addon_price + $cottage_price), 2); ?></span></td></tr>
                                <tr><td align="left" width="150px"><p>Discount</p></td><td align="left">:</td><td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$<span id="rate_discount"><?php echo round($discount, 2); ?></span></td></tr>
                                <tr><td align="left" width="150px"><p>Discounted Price</p></td><td align="left">:</td><td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$<span id="rate_discounted_price"><?php echo round($discounted_price, 2); ?></span></td></tr>
                                <tr><td align="left" width="150px"><p>Taxes & Fees</p></td><td align="left">:</td><td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$<span id="rate_fees"><?php echo round($discounted_price * $bayview_tax, 2); ?></span></td></tr>
                            </table>
                        </div>
                        <div class="row-b">
                            <table style="width: 100%">
                                <tr><td align="left" width="150px"><p>Total</p></td><td align="left">:</td><td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$<span id="rate_total"><?php echo round($discounted_price * ($bayview_tax + 1), 2); ?></span></td></tr>
                            </table>
                        </div>
                        <div class="cd-checkout-btn" id="add_to_cart">
                            <a href="javascript:void(0);" ><img src="<?php echo get_template_directory_uri(); ?>/images/addtocart.png" alt="" /></a>
                        </div>
                        <?php
                        $style = 'style="display:none; clear: both;"';
                        if ($cart_count > 0) {
                            $style = 'style="display:block; clear: both;"';
                        }
                        ?>
                        <div class="cd-checkout-btn" id="check_out_cart" <?php echo $style; ?>>
                            <a href="<?php echo home_url() . '/checkout'; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/chkout-btn.png" alt="" /></a>
                        </div>
                    </div>

                <?php endwhile; // end of the loop.      ?>
            </div>
            <div class="bl-bottom">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bottom-img.png" alt="" />
            </div>
        </div>
        <?php get_sidebar('cottage'); ?>


        <?php get_sidebar('bottom'); ?>

    </div>
</div>

<script type="text/javascript">
    
    jQuery("#add_to_cart").click(function(){
        
        var offer_id = '<?php echo get_the_ID(); ?>';

        var arrival_date = document.getElementById('arrival_label').innerHTML;
        var price = document.getElementById('rate_total').innerHTML;
        var nights = document.getElementById('nights_label').innerHTML;
        
        
        
        var adults = parseInt(jQuery('#adults_input').val());
        var children = parseInt(jQuery('#children_input').val());

        if(isNaN(adults)) adults = 0;
        if(isNaN(children)) children = 0;
        
        var people = adults + children;
        
        jQuery('#check_out_cart').hide();
        jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>',
        {
            'action': 'add_offer_to_cart', 
            'offer_id': offer_id, 
            'arrival_date':arrival_date, 
            'price': price, 
            'nights': nights, 
            'people': people
        },
        
        function (r,s){
            if(r.result != 'fail'){
                jQuery.post('index.php?bayview_ajax_action=update_cart_widget', function(data) {
                    jQuery('div.bayview_cart_widget').html(data);
                    var cart_count = jQuery('.bayview_cart_widget .bl-chk-row-one').length;
                    if(cart_count > 0){
                        jQuery('#check_out_cart').show();
                
                    }
                });
            }
            alert(r.msg);           

        }, 'json'
    );
        
        
    });
    
    
    
    function toggleChange(a, input_id, label_id, date_field) {
        
        var input = document.getElementById(input_id);
        var label = document.getElementById(label_id);
        
        if(input.style.display == 'none'){
            input.style.display = '';
            label.style.display = 'none';
            a.innerHTML='Ok';
            if(date_field != undefined && date_field) {
                if(label.innerHTML != 'N/a')    input.value = $.datepicker.formatDate('mm/dd/yy', new Date(label.innerHTML));
                else input.value='';
            }else {
                input.value = label.innerHTML;
            }
        }else {
            
            if(date_field != undefined && date_field) {
                
                
                var days = parseInt(document.getElementById('nights_label').innerHTML);
                    
                if(isNaN(days)) days = 0;
                    
                getUpdatedOfferPrice(<?php echo get_the_ID(); ?>, $.datepicker.formatDate('mm/dd/yy', new Date(document.getElementById('arrival_input').value)), function(r){
                        
                    if(r.result != 'success') {
                        alert(r.msg.replace(/<(?:.|\n)*?>/gm, ''));
                    }
                        
                    var rate_room = r.price_cottage;
                    var rate_pkg = r.price_pkg;
                    document.getElementById('rate_room').innerHTML = rate_room.toFixed(2);
                    document.getElementById('rate_pkg').innerHTML = rate_pkg.toFixed(2);
                    var rate_sub_total = rate_room+rate_pkg;
                    var discounted_price = r.discounted_price;
                    document.getElementById('rate_sub_total').innerHTML = rate_sub_total.toFixed(2);
                    document.getElementById('rate_discounted_price').innerHTML = discounted_price.toFixed(2);
                    document.getElementById('rate_discount').innerHTML = (rate_sub_total-discounted_price).toFixed(2);
                    document.getElementById('rate_fees').innerHTML = (discounted_price*<?php echo $bayview_tax; ?>).toFixed(2);
                    document.getElementById('rate_total').innerHTML = (discounted_price*<?php echo $bayview_tax + 1; ?>).toFixed(2);
                        
                });
                //var night_rate = parseFloat(document.getElementById('nightly_rate').value);
                //var rate = days * night_rate;
                    
                //document.getElementById('rate_room').innerHTML = rate;
                //                    document.getElementById('rate_tax').innerHTML = rate*0.125;
                //                    document.getElementById('rate_total').innerHTML = rate*1.125;
                //                    document.getElementById('rate_bal').innerHTML = rate*1.125;
                //updateTotalPrice();
                    
                    
                
                if(input.value.replace(/^\s+|\s+$/g,'')!='') label.innerHTML = $.datepicker.formatDate('DD, MM d, yy', new Date(input.value));
                else label.innerHTML = 'N/a';
            }else {
                label.innerHTML = input.value;
            }
            
            input.style.display = 'none';
            label.style.display = '';
            a.innerHTML='Change?';
            
        }
    }
    
    function getUpdatedOfferPrice(offer_id, date1, callback){
            
        jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', {'action': 'get_updated_offer_price_and_validate_booking', 'offer': offer_id, 'arrival': date1}, callback, 'json');
            
    }
    
    
</script>
<?php get_footer(); ?>
