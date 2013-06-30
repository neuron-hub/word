<?php
global $table_prefix;
if (!empty($_POST['order_placed'])) {


    $email = $_POST['email'];

    $user = get_user_by('email', $email);

    if ($user === false) {
        $user_id = wp_create_user($email, "123456", $email);

        $user = get_userdata($user_id);

        my_new_user_notification($user_id, "123456");
    }

    $user->add_cap('customer');

    $booking_table = $table_prefix . 'bookinglog';
    $payment_table = $table_prefix . 'payment';
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address1 = $_POST['addr1'];
    $address2 = $_POST['addr2'];
    $country = $_POST['select_country'];
    $postal_code = $_POST['pcode'];
    $city = $_POST['city'];
    $state = $_POST['select_state'];
    $mobile_phone = $_POST['phone'];
    $alt_phone = $_POST['alt_phone'];
    $card_type = $_POST['card_type'];
    $card_number = $_POST['card_number'];
    $card_expire = $_POST['card_expire'];
    $securitycode = $_POST['securitycode'];
    $nameoncard = $_POST['nameoncard'];
    $num_people = $_POST['num_people'];


    $arrival = $_POST['booking_arrival'];
    $departure = $_POST['booking_departure'];

    $gross_total = 0;


    $_cottages = $_POST['booked_cottages'];
    $_offers = $_POST['booked_offers'];
    $cottage_price = 0;
    $tax = floatval(get_option('bayview_booking_tax', 0));
    $service = floatval(get_option("addon_service_charges", 0));
    $tax = 1 + ($tax / 100.0);
    $service = 1 + ($service / 100.0);

    if (!empty($_cottages)) {

        $_cottages = explode(',', $_cottages);

        $_addons = $_POST['booked_addons'];

        $addons = array();

        $addons_price = 0;

        if (!empty($_addons)) {
            $_addons = explode(',', $_addons);
            foreach ($_addons as $addon) {
                list($aid, $aqnty) = explode('|', $addon);
                $gross_total += $price = $aqnty * get_post_meta($aid, '_price', true);
                $addons_price += $price;
                $addons[] = array(
                    'package_id' => $aid,
                    'package_name' => get_the_title($aid),
                    'package_quantity' => $aqnty,
                    'package_price' => $price
                );
            }
        }
        $addons_price *= $service;
        
        $cottages_people = 0;
        foreach ($_cottages as $cottage_people) {
            $cottage_adults = get_post_meta($cottage_people, '_people', true);
            $cottage_children = get_post_meta($cottage_people, '_children', true);
            $cottages_people += $cottage_children + $cottage_adults;
        }
        if ($cottages_people < $num_people) {
            echo '<strong>Number of Persons</strong> is greater than maximum <a href="javascript:history.back()">Go Back</a>';
            die();
        }
        foreach ($_cottages as $cottage) {
           $cottage_price = $cottage_prices[$cottage] = getCottagePrice($cottage, get_post_meta($cottage, '_nightly_rate', true), $arrival, $departure, true);
           $gross_total += $cottage_price;
        }
        $cottage_price *= $tax;
    } elseif (!empty($_offers)) {

        $offers = array();

        $_offers = explode(',', $_offers);

        foreach ($_offers as $offer) {
            $meta = get_post_meta($offer);

            $nights = $meta['_nights'][0];

            $departure = date('Y-m-d', strtotime("+$nights days", strtotime($arrival)));

            $_ocottages = $meta['_cottages'][0];

            $_ocottages = explode(',', $_ocottages);

            $ocottages = array();
            if (!empty($_ocottages)) {
                $_oc_peoples = 0;
                foreach ($_ocottages as $_oc_people) {
                    $_oc_adults = get_post_meta($_oc_people, '_people', true);
                    $_oc_children = get_post_meta($_oc_people, '_children', true);
                    $_oc_peoples += $_oc_adults + $_oc_children;
                }
                if ($_oc_peoples < $num_people) {
                    echo '<strong>Number of Persons</strong> is greater than maximum <a href="javascript:history.back()">Go Back</a>';
                    die();
                }
                foreach ($_ocottages as $_oc) {
                    $cottage_price = $ocottages[$_oc] = getCottagePrice($_oc, get_post_meta($_oc, '_nightly_rate', true), $arrival, $departure, true);
                     $gross_total += $cottage_price;
                }
            }

            $_oaddons = $meta['_addons'];

            $_oaddons = explode(',', $_oaddons);

            $oaddons = array();
            $oaddons_price = 0;
            if (!empty($_oaddons)) {
                foreach ($_oaddons as $_oaddon) {
                    list($oaid, $oaqnty) = explode('|', $_oaddon);
                    $gross_total += $price = $oaqnty * get_post_meta($oaid, '_price', true);
                    $oaddons_price += $price;
                    $oaddons[] = array(
                        'package_id' => $oaid,
                        'package_name' => get_the_title($oaid),
                        'package_quantity' => $oaqnty,
                        'package_price' => $price
                    );
                }
            }

            $offers[] = array("cottages" => $ocottages, "addons" => $oaddons, "addons_price" => $oaddons_price);
        }
    } else {
        echo "Nothing Selected for booking, please go back and try again!";
    }

    if (!empty($offers) || !empty($cottage_prices)) {

        if (!empty($user)) {

            //$gross_total *= $tax;
            
            $gross_total = $addons_price + $cottage_price;

            $inserted = $wpdb->insert(
                    $payment_table, array(
                'user_id' => $user_id,
                'fname' => $fname,
                'lname' => $fname,
                'address1' => $address1,
                'address2' => $address2,
                'country' => $country,
                'postal_code' => $postal_code,
                'city' => $city,
                'state' => $state,
                'mobile_phone' => $mobile_phone,
                'alt_phone' => $alt_phone,
                'card_type' => $card_type,
                'card_security' => $securitycode,
                'card_number' => $card_number,
                'card_exp' => $card_expire,
                'card_name' => $nameoncard,
                'gross_total' => $gross_total,
                'created' => date('Y-m-d H:i:s')
                    ), array(
                '%d',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s'
                    )
            );

            global $last_booking_id;

            $last_booking_id = $payinfo_id = $wpdb->insert_id;

            if (!empty($cottage_prices)) {

                $addons_added = false;

                $arrival_date = date('Y-m-d', strtotime($arrival));
                $departure_date = date('Y-m-d', strtotime($departure));

                foreach ($cottage_prices as $cottage_id => $cottage_price) {
                    $adults = get_post_meta($cottage_id, '_people', true);
                    $children = get_post_meta($cottage_id, '_children', true);
                    $people = $adults + $children;

                    if (!$addons_added && !empty($addons)) {
                        $addons = json_encode($addons);

                        $query = "INSERT INTO `" . $booking_table . "` (cottage_id,user_id,p_id,cottage_total,addons,cottage_arrival_date,cottage_departure_date,cottage_status,people) VALUES ($cottage_id, $user->ID, $payinfo_id, '" . (($cottage_price * $tax) + ($addons_price)) . "', '$addons', '$arrival_date', '$departure_date', 1, '$people')";
                        $addons_added = true;
                    } else {
                        $query = "INSERT INTO `" . $booking_table . "` (cottage_id,user_id,p_id,cottage_total,addons,cottage_arrival_date,cottage_departure_date,cottage_status,people) VALUES ($cottage_id, $user->ID, $payinfo_id, '" . $cottage_price * $tax . "', '', '$arrival_date', '$departure_date', 1, '$people')";
                    }
                    $wpdb->query($query);
                }
                send_booking_email_notification($user->ID);

                echo "Successfully booked!";
            } elseif (!empty($offers)) {
                foreach ($offers as $offer) {
                    $cottage_prices = $offer['cottages'];
                    $addons = $offer['addons'];
                    $addons_price = $offer['addons_price'];
                    if (!empty($cottage_prices)) {

                        $addons_added = false;

                        $arrival_date = date('Y-m-d', strtotime($arrival));
                        $departure_date = date('Y-m-d', strtotime($departure));

                        foreach ($cottage_prices as $cottage_id => $cottage_price) {
                            $adults = get_post_meta($cottage_id, '_people', true);
                            $children = get_post_meta($cottage_id, '_children', true);
                            $people = $adults + $children;
                            if (!$addons_added && !empty($addons)) {
                                $addons = json_encode($addons);

                                $query = "INSERT INTO `" . $booking_table . "` (cottage_id,user_id,p_id,cottage_total,addons,cottage_arrival_date,cottage_departure_date,cottage_status,people) VALUES ($cottage_id, $user->ID, $payinfo_id, '" . ($cottage_price + $addons_price) . "', '$addons', '$arrival_date', '$depature_date', 1, '$people')";
                                $addons_added = true;
                            } else {
                                $query = "INSERT INTO `" . $booking_table . "` (cottage_id,user_id,p_id,cottage_total,addons,cottage_arrival_date,cottage_departure_date,cottage_status,people) VALUES ($cottage_id, $user->ID, $payinfo_id, '" . $cottage_price * $tax . "', '', '$arrival_date', '$depature_date', 1, '$people')";
                            }
                            $wpdb->query($query);
                        }
                    }
                }
                send_booking_email_notification($user->ID);
                echo "Successfully booked!";
            }
        } else {
            echo "Couldn't get (or create) user with the specified email id, please go back and try again or contact the system administrator";
        }
    }
} else {
    ?>


    <style type="text/css">
        .chk-description h1, h4 {
            border-bottom: 1px solid #959595;
            color: #851640;
            float: left;
            font-family: 'impact',Sans-Serif;
            font-size: 25px;
            font-weight: normal;
            margin-top: 25px;
            padding-bottom: 14px;
            width: 100%;

        }
        .form {
            float: left;
            margin-top: 12px;
            width: 100%;
        }
        .form-row1 {
            float: left;
            width: 100%;
        }
        .form-row1 .col-1 {
            float: left;
            /*width: 20%;*/
        }
        .innerrow .form p, .form p {
            color: #2C2C2C;
            float: left;
            width: 100%;
        }
        .innerrow .form input, select, .form input, select {
            background: none repeat scroll 0 0 transparent;
            border: 1px solid #858164;
            float: left;
            height: 20px;
            margin: 2px 0;
        }

        .input-style1, .select-style3 {
            width: 146px;
        }


        .input-style, .select-style2 {
            width: 304px;
        }

        .form-row1 h6 {
            font-size: 12px;
            margin: 15px 0 5px 0;
        }
        .billing_form{
            /*display:none;*/
            float: none;
            width: 100%;
        }
        .dates_selector{
            width: 100%;
            position: relative;

        }
        .dates_selector .avl_date, .dates_selector .dpt_date{
            float: left;
            padding: 10px 20px;

        }
        .check_cottage{
            float: left;
            padding-top: 50px;
            position: relative;
            vertical-align: middle;
        }
        .cottages_display{
            width: 100%;
            float: left;

        }
        .check_availability{

        }
    </style>
    <div class="dates_selector">
        <form name="date_get" id="date_get" action="" >
            <div class="avl_date">
                <p>Arrival Date</p>
                <input type="text" class="datepicker required" readonly="true" name="arrival_date" id="arrival_date" />
            </div>
            <div class="dpt_date">
                <p>Departure Date</p>
                <input type="text" class="datepicker required" readonly="true" name="departure_date" id="departure_date" />

            </div>
            <div class="check_cottage"><a href="javascript:void(0)" class="button-primary" onclick="findOffersAndCottages();">Check</a> <a href="javascript:void(0)" class="button-primary" onclick="document.getElementById('date_get').reset();">Clear Dates</a></div>
        </form>
    </div>
    <div style="clear:both">&nbsp;</div>

    <div id="offers_div" style="width: 100%">

    </div>
    <div style="clear:both">&nbsp;</div>
    <div id="cottages_div" style="width: 100%">

    </div>
    <div style="clear:both">&nbsp;</div>
    <div id="addons_div" style="width: 100%">

    </div>
    <div style="clear:both">&nbsp;</div>

    <div class="billing_form">
        <form id="billinginfo_form" action="" method="post"> <!--FORM STARTS HERE  -->
            <div class="cottages_display"></div>
            <div class="chk-description">

                <div class="innerrow">
                    <div class="form" id="existing">
                        <p>Email Address</p>
                        <input type="text" value="" class="input-style" id="email" name="email" />

                    </div>
                </div>
                <div class="innerrow">
                    <div class="form" id="existing">
                        <p>Number of Persons</p>
                        <input type="text" value="" class="input-style" id="num_people" name="num_people" />

                    </div>
                </div>


                <h1>Billing Information</h1>
                <div class="form" id="billinginfo">
                    <div class="form-row1">
                        <div class="col-1">
                            <p>First Name</p>
                            <input id="fname" name="fname" type="text" value="" class="input-style1" />
                        </div>
                        <div class="col-1">
                            <p>Last Name</p>
                            <input id="lname" name="lname" type="text" value="" class="input-style1" />
                        </div>
                    </div>
                    <div class="form-row1">
                        <p>Address 1</p>
                        <input type="text" id="addr1" name="addr1" value="" class="input-style" />
                        <p>Address 2</p>
                        <input type="text" id="addr2" name="addr2" value="" class="input-style" />
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
                                    if ($ctry->country_id == 38) {
                                        $ctry_selected = 'selected="selected"';
                                    }
                                    echo '<option value="' . $ctry->country_id . '" ' . $ctry_selected . '>' . $ctry->name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-3">
                            <p>Postal Code</p>
                            <input type="text" id="pcode" name="pcode" value="" class="input-style2" />
                        </div>
                    </div>
                    <div class="form-row1">
                        <div class="col-4">
                            <p>City</p>
                            <input id="city" type="text" name="city" value="" class="input-style3" />
                        </div>
                        <div class="col-3 country_state">
                            <?php
                            $query_state = "SELECT * FROM `{$wpdb->prefix}bayview_zone` WHERE `country_id`=38";
                            $country_state = $wpdb->get_results($query_state);
                            ?>
                            <p>State</p>                                    
                            <select class="select-style1" name="select_state">
                                <?php
                                foreach ((array) $country_state as $state) {
                                    echo '<option value="' . $state->name . '" >' . $state->name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row1">
                        <h6>Contact Information</h6>
                        <div class="col-1">
                            <p>Mobile Phone</p>
                            <input id="phone" name="phone" type="text" value="" class="input-style1" />
                        </div>
                        <div class="col-1">
                            <p>Alternate Phone</p>
                            <input type="text" value="" name="alt_phone" id="alt_phone" class="input-style1" />
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
                            <input id="cardno" type="text" name="card_number" x-autocompletetype="cardno" placeholder="Card number" required="required" class="select-style">
                        </div>
                        <div class="col-3">
                            <p>Expiration (mm/yy or mm/yyyy)</p>
                            <input id="card_expire" name="card_expire" type="text" value="" x-autocompletetype="card_expire" placeholder="MM/YY" required="required" class="input-style2" maxlength="9" autocomplete="off" />
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

                <div class="form-row2">

                    <p>
                        <input type="hidden" name="order_placed" value="true"/>
                        <input type="hidden" id="booked_offers" name="booked_offers" value=""/>
                        <input type="hidden" id="booked_cottages" name="booked_cottages" value=""/>
                        <input type="hidden" id="booked_addons" name="booked_addons" value=""/>
                        <input type="hidden" id="booking_arrival" name="booking_arrival" value=""/>
                        <input type="hidden" id="booking_departure" name="booking_departure" value=""/>
    <!--                        <input type="image" id="submitform"  src="<?php echo get_template_directory_uri(); ?>/images/chkout-btn.png"/>-->
                    <div class="check_cottage"><a href="javascript:void(0)" class="button-primary" onclick="submitBooking();">Save Booking</a></div>

                    </p>
                    </span>
                </div>
            </div>

        </form> <!--FORM ENDS HERE  -->
    </div>

    <script type="text/javascript">
        function get_country_state(select){
            var id = select.value;
            jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', {'action': 'bayview_get_country_states', 'country_id': id}, function(data) {
                jQuery('div.country_state').html(data);
            });
            //               
        }
        function findOffersAndCottages(){
            var arrival = jQuery('#arrival_date').val();
            var departure = jQuery('#departure_date').val();
                                                    
            jQuery.post(ajaxurl, {
                'action': 'bayview_find_offers_and_cottages',
                'arrival_date':arrival, 
                'departure_date': departure
            }, function(r) {
                                                        
                if(r.status == undefined || r.status != 'success'){
                    if(r.msg == undefined) alert("Some error occured, please try again, later!");
                    else alert(r.msg);
                    return;
                }
                                                        
                if(r.offers != undefined && r.offers.length > 0){
                    jQuery('#offers_div').html("<div class='chk-description'><h1>Available Offers: </h1></div>");
                    for(var i=0; i<r.offers.length; i++){
                                                                
                                                                
                                                                
                        var div = jQuery("<div style='float: left; width: 280px; height: 200px; border: 1px solid #bfbfbf; margin: 2px'></div>");
                        jQuery("<div style='float: left; width: 25px; height: 180px;'><input name='offers[]' type='checkbox' value='"+r.offers[i].id+"' style='margin-top: 85px; cursor: pointer'/></div>").appendTo(div);
                        div.append("<h3>"+r.offers[i].title+"</h3>");
                        div.append(r.offers[i].img);
                        div.append("<span>"+r.offers[i].cottages+"<br/>"+r.offers[i].addons+"</span><br/>");
                                                                
                        div.append("<span>Nights: "+r.offers[i].nights+", People: "+r.offers[i].people+", Price: $"+r.offers[i].price+"<br/>Discounted Price: $"+r.offers[i].discounted_price+"<br/>Total Discount: $"+r.offers[i].discount+"</span>");                
                        div.appendTo(jQuery('#offers_div'));
                    }
                }else {
                    jQuery('#offers_div').html('&nbsp;');
                }
                if(r.cottages != undefined && r.cottages.length > 0){
                    jQuery('#cottages_div').html("<div class='chk-description'><h1>Available Cottages: </h1></div>");
                    for(var i=0; i<r.cottages.length; i++){
                                                                
                                                                
                                                                
                        var div = jQuery("<div style='float: left; width: 200px; min-height: 135px; border: 1px solid #bfbfbf; margin: 2px;'></div>");
                        jQuery("<div style='float: left; width: 25px; height: 130px;'><input name='cottages[]' type='checkbox' value='"+r.cottages[i].id+"' style='margin-top: 60px; cursor: pointer'/></div>").appendTo(div);
                        div.append("<h3>"+r.cottages[i].title+"</h3>");
                        div.append(r.cottages[i].img);
                                                                
                        div.append("<span>People: "+r.cottages[i].people+"<br/>Price: $"+r.cottages[i].price+"<br/></span>");
                        if(r.cottages[i].availability != undefined && r.cottages[i].availability > 0) {
                            div.append("<span>Available for only "+r.cottages[i].availability+" nights</span>");
                        }
                        div.appendTo(jQuery('#cottages_div'));
                    }
                }else {
                    jQuery('#cottages_div').html('&nbsp;');
                }
                if(r.addons != undefined && r.addons.length > 0){
                    jQuery('#addons_div').html("<div class='chk-description'><h1>Available Addons: </h1></div>");
                    for(var i=0; i<r.addons.length; i++){
                                                                
                                                                
                                                                
                        var div = jQuery("<div style='float: left; width: 250px; min-height: 110px; border: 1px solid #bfbfbf; margin: 2px;'></div>");
                        jQuery("<div style='float: left; width: 25px; height: 100px;'><input name='addons[]' type='checkbox' value='"+r.addons[i].id+"' style='margin-top: 45px; cursor: pointer'/></div>").appendTo(div);
                        div.append("<h3>"+r.addons[i].title+"</h3>");
                        div.append(r.addons[i].img);
                                                                
                        div.append("<span>Price: $"+r.addons[i].price+"<br/>Quantity: <input type='text' name='addon_"+r.addons[i].id+"_quantity' size='2'/></span>");
                                                                    
                        div.appendTo(jQuery('#addons_div'));
                    }
                }else {
                    jQuery('#addons_div').html('&nbsp;');
                }
            }, "json");
                                                    
        }
                                                    
        jQuery(document).ready(function(){
                                                    
            jQuery('#billinginfo_form').submit(function(){
                var offers = jQuery('input[name="offers[]"]:checked');
                var cottages = jQuery('input[name="cottages[]"]:checked');
                                                            
                if((offers == undefined || !offers.length) && (cottages == undefined || !cottages.length)) {
                    alert("Please select atleast a offer or a cottage");
                    return false;
                }
                                                            
                if((offers != undefined && offers.length) && (cottages != undefined && cottages.length)) {
                    alert("You can only select either from offers or from cottages and addons");
                    return false;
                }
                                                            
                var booked_offers = "";
                                                            
                if(offers != undefined && offers.length) {
                                                                
                    offers.each(function(){
                        booked_offers += jQuery(this).val()+",";
                    });
                                                                
                    //                booked_offers = offers[0].value;
                    //                for(var i=1; i < offers.length; i++){
                    //                    booked_offers += ","+offers[i].value;
                    //                }
                }
                                                            
                if(booked_offers != "") {
                    booked_offers = booked_offers.substring(0, booked_offers.length - 1);
                }
                                                            
                jQuery('#booked_offers').val(booked_offers);
                                                            
                var booked_cottages = "";
                                                            
                if(cottages != undefined && cottages.length) {
                    if(jQuery('#departure_date').val()==""){
                        alert("Departure date can not be left blank if you are booking cottages!");
                        return false;
                    }
                    cottages.each(function(){
                        booked_cottages += jQuery(this).val()+",";
                    });
                                                                
                    //                booked_cottages = cottages[0].value;
                    //                for(var i=1; i<cottages.length; i++){
                    //                    booked_cottages += ","+cottages[i].value;
                    //                }
                }
                                                            
                if(booked_cottages != "") {
                    booked_cottages = booked_cottages.substring(0, booked_cottages.length - 1);
                }
                                                            
                jQuery('#booked_cottages').val(booked_cottages);
                                                            
                                                            
                var addons = jQuery('input[name="addons[]"]:checked');

                var booked_addons = "";
                                                            
                if(addons != undefined && addons.length) {
                    var error = "";
                    addons.each(function(){
                        var quantity = jQuery('input[name="addon_'+jQuery(this).val()+'_quantity"]').val();
                        if(quantity == undefined || !quantity){
                            error = "You missed to fill in quantity for some addon, please fix it and then try again!";
                            jQuery(this).focus();
                            return false;
                        }
                        booked_addons += jQuery(this).val()+"|"+quantity+",";
                    });
                    if(error != "") {
                        alert(error);
                        return false;
                    }
                }
                                                            
                if(booked_addons != "") {
                    booked_addons = booked_addons.substring(0, booked_addons.length - 1);
                }
                                                            
                jQuery('#booked_addons').val(booked_addons);
                                  
                var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,4}$/i;
                var intRegex = /^\d+$/;
                var charset = /^[a-zA-Z\s]+$/i;
                                                            
                if(jQuery('#email').val()=="" || !pattern.test(jQuery('#email').val())) {
                    alert("Please fill in the email");
                    return false;
                }
                                                            
                if(!charset.test(jQuery('#fname').val()) || jQuery('#fname').val() =="") {
                    alert("Please fill in the first name and character only");
                    return false;
                }
                                                            
                if(!charset.test(jQuery('#lname').val()) || jQuery('#lname').val()=="") {
                    alert("Please fill in the last name and character only");
                    return false;
                }
                                                            
                if(jQuery('#addr1').val()=="") {
                    alert("Please fill in the address#1");
                    return false;
                }
                                                            
                if(jQuery('#addr2').val()=="") {
                    alert("Please fill in the address#2");
                    return false;
                }
                                       
                                
                                
                if(jQuery('#pcode').val()=="") {
                    alert("Please fill in the postal code");
                    return false;
                }
                                                            
                if(jQuery('#city').val()=="" || !charset.test(jQuery('#city').val())) {
                    alert("Please fill in the city and character only");
                    return false;
                }
                                     
                if(!intRegex.test(jQuery('#phone').val()) || jQuery('#phone').val() == ''){
                    alert("Please fill in the phone numeric value");
                    return false;
                }
                                       
                if(!intRegex.test(jQuery('#alt_phone').val()) && jQuery('#alt_phone').val() != ''){
                    alert("Please fill in the alternate phone numeric value");
                    return false;
                }

                var cardType = jQuery.payment.cardType(jQuery('#cardno').val());
                jQuery('#card').toggleClass('invalid', !(jQuery('#card').val() == cardType));
                jQuery('#cardno').toggleClass('invalid', !jQuery.payment.validateCardNumber(jQuery('#cardno').val()));
                jQuery('#card_expire').toggleClass('invalid', !jQuery.payment.validateCardExpiry(jQuery('#card_expire').payment('cardExpiryVal')));
                jQuery('#securitycode').toggleClass('invalid', !jQuery.payment.validateCardCVC(jQuery('#securitycode').val(), cardType));
                                            
                if(jQuery('#card').hasClass('invalid')){
                    alert('Please provide correct card type.\n');
                    return false;
                }
                if(jQuery('#cardno').hasClass('invalid')){
                    alert('Please provide correct card number.\n');
                    return false;
                }
                if(jQuery('#card_expire').hasClass('invalid')){
                    alert('Please provide correct expiry date.\n');
                    return false;
                }
                if(jQuery('#securitycode').hasClass('invalid')){
                    alert('Please provide correct security code.\n');
                    return false;
                }
                                                            
                if(!charset.test(jQuery('#nameoncard').val()) || jQuery('#nameoncard').val()=="") {
                    alert("Please fill in the name on card and character only");
                    return false;
                }
                                                            
                jQuery('#booking_arrival').val(jQuery('#arrival_date').val());
                jQuery('#booking_departure').val(jQuery('#departure_date').val());
                                                            
                return true;
            });
                                                    
        });
                                                    
        function submitBooking(){
            jQuery('#billinginfo_form').submit();
        }

    </script>
    <?php
}
?>
