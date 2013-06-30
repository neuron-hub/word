<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
global $wpdb;
//echo '<pre>';
//print_r($_REQUEST);
//echo '</pre>';
if(isset($_REQUEST['order_place']) && $_REQUEST['order_place'] == true){
    if(isset($_REQUEST['offer_cottages']) && count($_REQUEST['offer_cottages']) > 0){
        foreach((array)$_REQUEST['offer_cottages'] as $ctg){
            
        }
    }
}
wp_enqueue_script('jquery-payment', get_template_directory_uri() . '/js/jquery.payment.js');
?>

<script src="<?php echo get_template_directory_uri() . '/js/jquery.payment.js'; ?>" type="text/javascript" ></script>
<script type="text/javascript"> 
    
    function toggleChange(a, arrival_id, departure_id, date_field) {
        
        var arrival = document.getElementById(arrival_id);
        var departure = document.getElementById(departure_id);
          
        if(arrival.value != '' && departure.value != ''){
            if(date_field != undefined && date_field) {
                var days = getDayDelta(Date.parse(arrival.value), Date.parse(departure.value));
                if(days < 0 ){
                    alert("Arrival date can not be in future than departure date");
                    return false;
                }
                if(!isNaN(days)) {
                    var date1 = jQuery.datepicker.formatDate('mm/dd/yy', new Date(arrival.value));
                    var date2 = jQuery.datepicker.formatDate('mm/dd/yy', new Date(departure.value));
                   
                    jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', {'action': 'bayview_getBookedCottages', 'arrival_date': date1, 'departure_date': date2}, function(data) {
                        jQuery('div.cottages_display').html(data);
                        jQuery('div.billing_form').show();
                    });
                        
                                       
                    
                }else {
                    alert("Arrival date and Departuer date should be selected!");
                }
            }else {
                alert("Arrival date and Departuer date should be selected!");
            }
                       
        }
        else{
            alert("Arrival date and Departuer date should be selected!");
        }
    }
    function getDayDelta(date1, date2){
        
        var delta = date2 - date1;

        return Math.round(delta / 1000.0 / 60.0 / 60.0 / 24.0);
    }
    
    function get_country_state(select){
        var id = select.value;
        jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', {'action': 'bayview_get_country_states', 'country_id': id}, function(data) {
            jQuery('div.country_state').html(data);
            
        });
        //               
    }
            
</script>
<style type="text/css">
    .chk-description h1, h4 {
        border-bottom: 1px solid #959595;
        color: #851640;
        float: left;
        font-family: 'impact',Sans-Serif;
        font-size: 25px;
        font-weight: normal;
        margin-top: 25px;
        padding-bottom: 5px;
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
        width: 20%;
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
        display:none;
        float: left;
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
<div class="wrap">
    <h2>Offline Booking</h2>
    <div class="dates_selector">
        <form name="date_get" id="date_get" action="" >
            <div class="avl_date">
                <p>Arrival Date</p>
                <input type="text" class="datepicker" readonly="true" name="arrival_date" id="arrival_date" />
            </div>
            <div class="dpt_date">
                <p>Departure Date</p>
                <input type="text" class="datepicker" readonly="true" name="departure_date" id="departure_date" />

            </div>
            <div class="check_cottage"><a href="javascript:void(0)" class="button-primary" onclick="toggleChange(this, 'arrival_date','departure_date', true)">Check</a></div>
        </form>
    </div>
    
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
                            <input type="text" value="" name="alt_phone" class="input-style1" />
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
                <h4>Guest Policies</h4>
                <div class="form-row2">
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
        <!--                            <span><a href="#">Click here to add Special Requests</a></span>-->
                    <span><a href="<?php echo home_url("privacy-policy"); ?>">View Privacy Policy</a></span>
                    <span>
                        <input type="checkbox" name="agreement" value="" /> <strong>I Agree to the Bayview Policies</strong> 

                        <p>
                                <input type="hidden" name="order_place" value="true"/>
                                <input type="image" id="submitform"  src="<?php echo get_template_directory_uri(); ?>/images/chkout-btn.png"/>

                           
                        </p>
                    </span>
                </div>
            </div>

        </form> <!--FORM ENDS HERE  -->
    </div>
    <script type="text/javascript">
        
        jQuery(document).ready(function(){ 
            if(jQuery('#submitform')) {
                var flag = false;
                jQuery('#cardno').payment('formatCardNumber');
                jQuery('#card_expire').payment('formatCardExpiry');
                jQuery('#securitycode').payment('formatCardCVC');
                jQuery('#submitform').click(function(){
                    jQuery('input').removeClass('invalid');
                    var cardType = jQuery.payment.cardType(jQuery('#cardno').val());
                    jQuery('#cardno').toggleClass('invalid', !jQuery.payment.validateCardNumber(jQuery('#cardno').val()));
                    jQuery('#card_expire').toggleClass('invalid', !jQuery.payment.validateCardExpiry(jQuery('#card_expire').payment('cardExpiryVal')));
                    jQuery('#securitycode').toggleClass('invalid', !jQuery.payment.validateCardCVC(jQuery('#securitycode').val(), cardType));
                    if ( jQuery('input.invalid').length ) {
                        flag = true;
                    } else {
                        flag = false;
                        jQuery('form#billinginfo_form').submit();
                    }
                        
                        
                });
            }
               
        });
    </script>
</div>