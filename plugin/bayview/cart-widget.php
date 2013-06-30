<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$cart_data1 = $_SESSION['cart_offer_data'];
if(!empty($cart_data1)):
foreach ($cart_data1 as $value):
?>

<div class="bl-chk-row-one">
    <div class="widget-left" style="position: relative">
        
        <?php // $large_image_url = wp_get_attachment_image_src( $value['cottage_Id'],array(110,90));   ?>
        <?php echo (get_the_post_thumbnail($value['offer_id'], array(110, 90)) ? get_the_post_thumbnail($value['offer_id'], array(110, 90)) :'<img height="90" width="110" alt="No Image" class="attachment-110x90 wp-post-image" src="'.  get_bloginfo('template_directory').'/images/160x100.jpg">'); ?><span onclick="remove_cart_offer_detail(<?php echo $value['offer_id']; ?>)" style="top: 0;right: 0;
              position: absolute; z-index: 12; font-weight: bold; font-size: larger; color: white; background-color: black; cursor: pointer">X</span>
    </div>
    <div class="widget-right">
        <h2><?php echo get_the_title($value['offer_id']); ?></h2>
        <div><a href="<?php echo get_permalink($value['offer_id']); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/detail-btn.png" alt="" /></a></div>
        <h2>Total Price: $<?php echo round($value['price'],2) ?></h2>
    </div>
</div>

<?php
endforeach;
endif;


$cart_data2 = $_SESSION['data_for_cart'];
if(!empty($cart_data2)):
foreach ($cart_data2 as $value):
?>

<div class="bl-chk-row-one">
    <div class="widget-left" style="position: relative">
        
        <?php // $large_image_url = wp_get_attachment_image_src( $value['cottage_Id'],array(110,90));   ?>
        <?php echo (get_the_post_thumbnail($value['cottage_Id'], array(110, 90)) ? get_the_post_thumbnail($value['cottage_Id'], array(110, 90)) : '<img height="90" width="110" alt="No Image" class="attachment-110x90 wp-post-image" src="'.  get_bloginfo('template_directory').'/images/160x100.jpg">'); ?><span onclick="remove_cart_detail(<?php echo $value['cottage_Id']; ?>)" style="top: 0;right: 0;
              position: absolute; z-index: 12; font-weight: bold; font-size: larger; color: white; background-color: black; cursor: pointer">X</span>
<!--                        <img src="<?php echo get_template_directory_uri(); ?>/images/thum-imgs01.jpg" alt="" />-->
    </div>
    <div class="widget-right">
        <h2><?php echo get_the_title($value['cottage_Id']); ?></h2>
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

        <div><a href="<?php echo get_permalink($page).'?house='.$value['cottage_Id']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/detail-btn.png" alt="" /></a></div>
        <h2>Total Price: <br/>$<?php echo $value['total'] ?></h2>
    </div>
</div>

<?php
endforeach;
endif;
if (!empty($cart_data1) || !empty($cart_data2)):

?>
<div class="cd-checkout-btn" id="check_out_cart">
    <a href="<?php echo home_url() . '/checkout'; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/chkout-btn.png" alt="" /></a>
</div>
<?php
endif;

?>
