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
                $cart_detail = get_cart_detail('cottage_Id', get_the_ID());

                if (!empty($cart_detail['cottage_Id']) && $cart_detail['cottage_Id'] != get_the_ID()) {
                    unset($cart_detail);
                }

                //print_r($cart_detail);
                ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php $meta = get_post_meta(get_the_ID()); ?>
                    <div class="bl-heading">
                        <h1> <?php
            $terms = wp_get_object_terms( $post->ID, 'station' );            
            echo $terms[0]->name;
            
            ?> </h1>
                    </div>
                    <div id="featured" >
                        <?php
                        $attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => get_the_ID()));
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
                            echo '<img height="196" width="668" alt="' . get_the_title() . '" class="attachment-cottage-thumb wp-post-image" src="' . get_bloginfo('template_directory') . '/images/668x250.jpg"/>';
                            echo '</div>';
                        endif;
                        ?>



                    </div>
                    <div class="cd-description"><br><br>
                        <h1><?php the_title(); ?></h1>                        
     			
                        <div id="more-details" style="clear: both">
                            <br>
                            <?php the_content(); ?>
                        </div>

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


<?php get_footer(); ?>
