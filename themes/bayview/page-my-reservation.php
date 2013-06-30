<?php
/**
 * The template for displaying cottages page.
 *
 * @package BayView
 * @subpackage Bayview
 */
if(is_numeric($_GET['house']) && isset($_GET['house'])){
    $cottage = get_post($_GET['house']);
    
}else{
    get_template_part('404');
}
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
                $cart_detail = get_cart_detail('cottage_Id', $cottage->ID);

                if (!empty($cart_detail['cottage_Id']) && $cart_detail['cottage_Id'] != $cottage->ID) {
                    unset($cart_detail);
                }

                //print_r($cart_detail);
                ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php $meta = get_post_meta($cottage->ID); ?>
                    <div class="bl-heading">
                        <h1>My Reservation: <?php if (!empty($_SESSION['arrival'])): ?><span>Arriving <?php echo date('l, F d, Y ', strtotime($_SESSION['arrival'])); ?></span><?php endif; ?></h1>
                    </div>
                    <div id="featured" >
                        <?php
                        $attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $cottage->ID));
                        if (count($attachments) > 0):
                           if(count($attachments) > 2){
                            ?>
                            
                            <div id="up"><img src="<?php echo get_template_directory_uri(); ?>/images/down.png"/></div>
                            <?php } ?>
                            <ul class="ui-tabs-nav">
                                <?php
                                $counter = 1;
                                foreach ($attachments as $attachment_id => $attachment) {
                                    ?>
                                    <li class="ui-tabs-nav-item" id="nav-fragment-<?php echo $counter; ?>"><a href="#fragment-<?php echo $counter; ?>"><?php echo wp_get_attachment_image($attachment_id, 'cottage-slider-thumb'); ?></a></li>

                                    <?php
                                    $counter++;
                                }
                                ?>
                            </ul>
                            <?php 
                            if(count($attachments) > 2){ ?>
                            <div id="down"><img src="<?php echo get_template_directory_uri(); ?>/images/up.png"/></div>
                            <?php
                            }
                            $counter = 1;
                            foreach ($attachments as $attachment_id => $attachment) {
                                ?>
                                <div id="fragment-<?php echo $counter; ?>" class="ui-tabs-panel" style="">
                                    <?php echo wp_get_attachment_image($attachment_id, 'cottage-slider-img'); ?>
                                </div>
                                <?php
                                $counter++;
                            }
                        else:
                            echo '<div id="" class="single-cottage-no-image" style="width:100%;text-align:center;">';
                            echo '<img height="196" width="668" alt="' . $cottage->post_title . '" class="attachment-cottage-thumb wp-post-image" src="' . get_bloginfo('template_directory') . '/images/668x250.jpg"/>';
                            echo '</div>';
                        endif;
                        ?>



                    </div>
                    <div class="cd-description">
                        <h1><?php echo $cottage->post_title; ?></h1>
                        <?php echo $cottage->post_excerpt; ?>
                        <span><a href="javascript:void(0)" onclick="jQuery('#more-details').slideToggle(1000);">+View More Detail</a></span>
                        <div id="more-details" style="display:none; clear: both">
                            
                            <?php echo $cottage->post_content ?>
                        </div>
                        <div style="color:#f00;">
                            <?php
                            if (!empty($_SESSION['arrival']) && !empty($_SESSION['departure'])) {
                                $res = isValidBooking(get_the_ID(), $_SESSION['arrival'], $_SESSION['departure']);

                                if ($res !== true) {
                                    echo "$res";
                                    $_SESSION['departure'] = '';
                                }
                            }
                            ?>
                        </div>
                    </div>               
                    <div class="cd-detail">
                        <?php $nights = (!empty($_SESSION['departure']) && !empty($_SESSION['arrival']) ? round((strtotime($_SESSION['departure']) - strtotime($_SESSION['arrival'])) / 60.0 / 60.0 / 24.0, 0) : 0); ?>
                        <h1>Detail</h1>
                        <h2>Cottage Summary</h2>
                        <p>Location: <?php echo $meta['_location'][0];  if(!empty($meta['_location_link'][0])):?><span><a href="<?php echo ($meta['_location_link'][0] ? $meta['_location_link'][0] : ''); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/locater.png" alt="" /></a></span><?php endif; ?></p>
                        <p>Arrival Date: <span id="arrival_label"><?php echo ((!empty($cart_detail['arrival_date']) && isset($cart_detail['arrival_date'])) ? date('l, F j, Y', strtotime($cart_detail['arrival_date'])) : (!empty($_SESSION['arrival']) ? date('l, F j, Y', strtotime($_SESSION['arrival'])) : 'N/a')); ?></span></p>
                        <p>Departure Date: <span id="departure_label"><?php echo ((!empty($cart_detail['depature_date']) && isset($cart_detail['depature_date'])) ? date('l, F j, Y', strtotime($cart_detail['depature_date'])) : (!empty($_SESSION['departure']) ? date('l, F j, Y', strtotime($_SESSION['departure'])) : 'N/a')); ?></span></p>
                        <p>Number of Nights: <span id="nights_label"><?php echo $nights; ?></span></p>
                        <p>Adults: <span id="adults_label"><?php echo (!empty($_SESSION['adults']) ? $_SESSION['adults'] : '1'); ?></span></p>
                        
                        <?php 
                        $children = (!empty($meta['_children'][0]) ? $meta['_children'][0] : 0);
                        ?>
                        <p>Children 3 & up: <span id="children_label"><?php echo (!empty($_SESSION['children']) ? $_SESSION['children'] : 'N/a'); ?></span></p>
                        
    <!--                        <p>Suite Style: Queen Sofa Suite</p>
                        <p>Accessible: Accessible Room Requested</p>-->
                    </div>
                    <div class="cd-summary">
                        <h2>Summary of Charges</h2>
                        <?php
                        if (!empty($_SESSION['arrival']) && !empty($_SESSION['departure'])) {
                            $price = getCottagePrice($cottage->ID, $meta['_nightly_rate'][0], $_SESSION['arrival'], $_SESSION['departure'], true);
//                            echo "Org Price: " . $meta['_nightly_rate'][0];
//                            echo "<br/><pre>";
//                            print_r($prices);
//                            echo "</pre>";

                            
                        } else {
                            $price = '0.00';
                        }
                        $price = ((!empty($cart_detail['room_rate']) && isset($cart_detail['room_rate'])) ? $cart_detail['room_rate'] : $price);
                        $bayview_tax = (get_option("bayview_booking_tax", 0.00) ? (get_option("bayview_booking_tax") / 100) : 1.00);
                         
			$price = ($price ? $price : '0.00');
                        ?>


                        <input type="hidden" id="nightly_rate" name="nightly_rate" value="<?php echo $meta['_nightly_rate'][0]; ?>"/>
                        <input type="hidden" id="total_people" name="total_people" value="<?php echo $meta['_people'][0]; ?>"/>
                        <div class="row-a">
                            <table style="width: 100%">
                                <tr><td align="left" width="150px"><p>Room</p></td><td align="left">:</td><td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$<span id="rate_room"><?php echo number_format($price,  2,'.', ''); ?></span></td></tr>
                                <tr><td align="left" width="150px"><p>Packages</p></td><td align="left">:</td><td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$<span id="rate_pkg">0.00</span></td></tr>
                                <tr id="packages" style="display:none"><td colspan="3" align="right"><ul id="packages_list" style="list-style: none;">

                                        </ul></td></tr>
                                <tr><td align="left" width="150px"><p>Taxes & Fees</p></td><td align="left">:</td><td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$<span id="rate_tax"><?php echo number_format($price * $bayview_tax, 2,'.', ''); ?></span></td></tr>
                            </table>
                        </div>
                        <!--                        <div class="row-b">
                                                    <table style="width: 100%">
                                                        <tr><td align="left" width="150px"><p>Total</p></td><td align="left">:</td><td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$<span id="rate_total"><?php echo round(floatval($price * $bayview_tax), 2); ?></span></td></tr>
                                                        <tr><td align="left" width="150px"><p>Advance Deposit <span><img src="<?php echo get_template_directory_uri(); ?>/images/advance-icon.png" alt="" /></span></p></td><td align="left">:</td><td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$0.00</td></tr>
                                                    </table>
                                                </div>-->
                        <div class="row-c">
                            <table style="width: 100%">
                                <tr><td align="left" width="150px"><p>Total</p></td><td align="left">:</td><td align="right" width="*" style="border-width: 0px 0px 1px 0px; border-style: dotted; border-color: #000;">$<span id="rate_total"><?php echo number_format($price * ($bayview_tax+1) ,2 , '.', ''); ?></span></td></tr>
                            </table>
                        </div>

                    </div>
                    <div class="cd-packages">
                        <h1>Packages:</h1>
                        <?php
                        $addons = get_posts(array('post_type' => 'addon', 'numberposts' => -1, 'post_status' => 'publish'));
                        $counter = 0;
                        echo "<ul class='list'>";
                        foreach ($addons as $addon) {
                            if ($counter && !($counter % 3)) {
                                echo "</ul>";
                                echo "<ul class='list'>";
                            }
                            ?>
                            <li>

                                <h2><?php echo $addon->post_title; ?></h2>
                                <h2><?php echo (get_the_post_thumbnail($addon->ID, 'thumbnail_addons') ? get_the_post_thumbnail($addon->ID, 'thumbnail_addons') : '<img height="120" width="150" alt="No Image" class="attachment-thumbnail_addons wp-post-image" src="' . get_bloginfo('template_directory') . '/images/160x100.jpg">'); ?></h2>
                                <p><?php echo $addon->post_excerpt; ?></p>
                                <span><a href="#TB_inline?width=600&height=250&inlineId=myModal_<?php echo $addon->ID; ?>" title="<?php echo $addon->post_title; ?>" class="thickbox">+ View Full Description</a></span>
                                <div id="myModal_<?php echo $addon->ID; ?>" style="display:none;">
                                    <p><?php echo $addon->post_content; ?></p>
                                </div>
                                <h3>$<?php echo get_post_meta($addon->ID, '_price', true) ?>/Package</h3>
                                <p>Quantity &nbsp; <select id="addon_<?php echo $addon->ID; ?>" name="addon[<?php echo $addon->ID; ?>]">
                                        <?php for ($quantity = 0; $quantity <= 10; $quantity++) { ?>
                                            <option value="<?php echo $quantity; ?>"><?php echo $quantity; ?></option>
                                        <?php } ?>
                                    </select></p>
                                <h3><a href="javascript:void(0)" onclick="addPackage(<?php echo $addon->ID . ",'$addon->post_title', jQuery('#addon_$addon->ID').val(), " . get_post_meta($addon->ID, '_price', true); ?>)"><img src="<?php echo get_template_directory_uri(); ?>/images/update-btn.png" alt="" /></a></h3>
                            </li><?php
                                $counter++;
                            }
                            echo "</ul>";
                                    ?>
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
                    <div class="cd-checkout-btn" id="check_out_cart" <?php echo $style; ?> >
                        <a href="<?php echo home_url() . '/checkout'; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/chkout-btn.png" alt="" /></a>
                    </div>
                <?php endwhile; // end of the loop.    ?>
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
        
        
        
        
        var cottage_Id = '<?php echo $cottage->ID; ?>';

        var cottage_title = '<?php echo $cottage->post_title; ?>';

        var arrival_date = document.getElementById('arrival_label').innerHTML;
        var depature_date = document.getElementById('departure_label').innerHTML;
        
        
        var room_rate = document.getElementById('rate_room').innerHTML;
        
        var adults = parseInt(jQuery('#adults_input').val());
        var children = parseInt(jQuery('#children_input').val());
        
        var total_people = parseInt(jQuery('#total_people').val());
        if(isNaN(adults)) adults = 0;
        if(isNaN(children)) children = 0;
         var people = adults + children;
        if(people > total_people){
            alert('You have exceeded the limit. Maximum number of guests can only be '+total_people+'!');
            return;
        }
        
       
        
        var total = document.getElementById('rate_total').innerHTML;
        
        var pkgs = [];
        var counter = 0 ;
        
        jQuery('#packages_list li').each(
    
        function(){
            var pid;
            pkgs[counter] = {};
            pid=pkgs[counter].package_id = jQuery(this).attr('addon_id');
            pkgs[counter].package_name = jQuery('#pkg_'+pid+'_name').html();
            pkgs[counter].package_quantity = jQuery('#pkg_'+pid+'_quantity').html();
            pkgs[counter].package_price = jQuery('#pkg_'+pid+'_price').html();
            
            counter++;
        });
       
        jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>',
        {'action': 'add_data_to_cart', 'cottage_Id': cottage_Id, 'cottage_title': cottage_title, 'arrival_date':arrival_date,
            'depature_date':depature_date,'room_rate': room_rate
            ,'total':total,'addons':pkgs, 'people': people},
        cart_response, 'json');
        jQuery('#check_out_cart').hide();
        
    });
    
    function cart_response(r,s){
        if(r.result == 'success'){
        jQuery.post('index.php?bayview_ajax_action=update_cart_widget', function(data) {
            jQuery('div.bayview_cart_widget').html(data);
            var cart_count = jQuery('.bayview_cart_widget .bl-chk-row-one').length;
            if(cart_count > 0){
                jQuery('#check_out_cart').show();
                
            }
           
        
        });
        }
        alert(r.msg);
        
       
        
        
    }
    
    function toggleChange(a, input_id, label_id, date_field) {
        
        var input = document.getElementById(input_id);
        var label = document.getElementById(label_id);
        var today = new Date();
        today = today.toDateString();
        
        
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
                if(Date.parse(today) > Date.parse(document.getElementById('arrival_input').value)){
                    alert("Arrival date can not be in past date");
                    return false;
                }
                
                if(Date.parse(today) > Date.parse(document.getElementById('departure_input').value)){
                    alert("Departure date can not be in past date");
                    return false;
                }
                var days = getDayDelta(Date.parse(document.getElementById('arrival_input').value), Date.parse(document.getElementById('departure_input').value));
                if(days < 0 ){
                    
                    alert("Arrival date can not be in future than departure date");
                    return false;
                }
                if(!isNaN(days)) {
                    document.getElementById('nights_label').innerHTML = days;
                    
                    getUpdatedCottagePrice(<?php echo get_the_ID(); ?>, $.datepicker.formatDate('mm/dd/yy', new Date(document.getElementById('arrival_input').value)), $.datepicker.formatDate('mm/dd/yy', new Date(document.getElementById('departure_input').value)), function(r){
                        
                        if(r.result != 'success') {
                            alert(r.msg.replace(/<(?:.|\n)*?>/gm, ''));
                        }
                        
                        var rate = r.price;
                        document.getElementById('rate_room').innerHTML = rate.toFixed(2);
                        updateTotalPrice();
                        
                    });
                    //var night_rate = parseFloat(document.getElementById('nightly_rate').value);
                    //var rate = days * night_rate;
                    
                    //document.getElementById('rate_room').innerHTML = rate;
                    //                    document.getElementById('rate_tax').innerHTML = rate*0.125;
                    //                    document.getElementById('rate_total').innerHTML = rate*1.125;
                    //                    document.getElementById('rate_bal').innerHTML = rate*1.125;
                    //updateTotalPrice();
                    
                    
                }else {
                    document.getElementById('nights_label').innerHTML = 'N/a';
                }
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
    
    function getUpdatedCottagePrice(cottage_id, date1, date2, callback){
            
        jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', {'action': 'get_updated_cottage_price_and_validate_booking', 'cottage': cottage_id, 'arrival': date1, 'departure': date2}, callback, 'json');
            
    }
    
    function getDayDelta(date1, date2){
        
        var delta = date2 - date1;

        return Math.round(delta / 1000.0 / 60.0 / 60.0 / 24.0);
    }
    
    function addPackage(pkg_id, name, quantity, price){
        jQuery('#packages').css('display','');
        
        pkg_id = parseInt(pkg_id);
        
        if(isNaN(pkg_id) || pkg_id <= 0) { 
            alert('No packages specified');
            return;
        }
        
        quantity = parseInt(quantity);
        
        if(isNaN(quantity) || quantity <= 0) {
            alert("Invalid Quantity!");
            return;
        }
        
        price = parseFloat(price);
        
        if(isNaN(price)) {
            alert("Invalid Price!");
            return;
        }
        
        var pkg = jQuery('#pkg_'+pkg_id);
        if(pkg == undefined || !pkg || !pkg.length) {
            pkg = jQuery('<li addon_id="'+pkg_id+'" id="pkg_'+pkg_id+'"><a href="javascript:void(0)" style="background-color: #f00; border: 1px solid #ff0000; border-radius: 5px; color: #fff;" title="remove" onclick="removePackage('+pkg_id+')">X</a> <span id="pkg_'+pkg_id+'_name">'+name+'</span>(<span id="pkg_'+pkg_id+'_quantity"></span>) for $<span id="pkg_'+pkg_id+'_price"></span></li>').appendTo(jQuery('#packages_list'));
        }
        
        var ext_quantity = parseFloat(jQuery('#pkg_'+pkg_id+'_quantity').html());
        var ext_price = parseFloat(jQuery('#pkg_'+pkg_id+'_price').html());
        
        if(isNaN(ext_quantity)) ext_quantity = 0;
        if(isNaN(ext_price)) ext_price = 0;
        var added_price = quantity*price;
        ext_quantity += quantity;
        ext_price += added_price;
        
        var ext_pkgs_price = parseFloat(jQuery('#rate_pkg').html());
        
        if(isNaN(ext_pkgs_price)) ext_pkgs_price = 0;
        
        ext_pkgs_price += added_price;
        
        jQuery('#rate_pkg').html(ext_pkgs_price.toFixed(2));
        
        jQuery('#pkg_'+pkg_id+'_quantity').html(ext_quantity);
        jQuery('#pkg_'+pkg_id+'_price').html(ext_price.toFixed(2));
        
        updateTotalPrice();
        
    }
    
    function removePackage(pkg_id){
        var ext_price = parseFloat(jQuery('#pkg_'+pkg_id+'_price').html());
        
        if(isNaN(ext_price)) ext_price = 0;
        
        var ext_pkgs_price = parseFloat(jQuery('#rate_pkg').html());
        
        if(isNaN(ext_pkgs_price)) ext_pkgs_price = 0;
        
        ext_pkgs_price -= ext_price;
        
        jQuery('#rate_pkg').html(ext_pkgs_price.toFixed(2));
        
        jQuery('#pkg_'+pkg_id).remove();
        
        updateTotalPrice();
    }
    
    function updateTotalPrice(){
        var rate_room = parseFloat(jQuery('#rate_room').html());
        var rate_pkg = parseFloat(jQuery('#rate_pkg').html());
        
        
        if(isNaN(rate_room)){
            rate_room = 0;
        }
        if(isNaN(rate_pkg)){
            rate_pkg = 0;
        }
        
        var rate_tax = (rate_room + rate_pkg) * <?php echo $bayview_tax; ?>;
        
        var rate_total = rate_room + rate_pkg + rate_tax;
        
        jQuery('#rate_tax').html(rate_tax.toFixed(2));
        jQuery('#rate_total').html(rate_total.toFixed(2));
        jQuery('#rate_bal').html(rate_total.toFixed(2));
    }
    
    
    jQuery(document).ready(function(){
        var addons = <?php if (!empty($cart_detail["addons"])) echo json_encode($cart_detail["addons"]); else echo "[]"; ?>;
        
        for(var i=0; i<addons.length; i++) {
            var qty = parseInt(addons[i].package_quantity);
            var price = parseInt(addons[i].package_price);
            if(isNaN(price)) price = 0;
            if(isNaN(qty) || qty == 0) price = 0;
            else price /= qty;
            addPackage(addons[i].package_id, addons[i].package_name, addons[i].package_quantity, price);
        }
    });
    
</script>
<?php get_footer(); ?>
