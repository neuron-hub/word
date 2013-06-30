jQuery().ready(function() {
    
   jQuery('#post').submit(function() {
    jQuery("#post").validate({
        'rules': {
            'offer_nights':{
                'required': true,
                'digits': true
            }
        }
    });
    
    if(jQuery('#post').valid())
        {
            jQuery("#ajax-loading").show();
            return true;
        }else{
            jQuery("#publish").removeClass().addClass("button-primary");
            jQuery("#ajax-loading").hide();
            setTimeout('post_spinner_trigger()', 1000);
            return false;
        }
        setTimeout('post_spinner_trigger()', 1000);
        return false;
    });
});
function post_spinner_trigger(){
    if(jQuery('#publishing-action .spinner').is(":visible")){
        jQuery('#publishing-action .spinner').hide();
        jQuery('#publish').removeClass('button-primary-disabled');
    }
}