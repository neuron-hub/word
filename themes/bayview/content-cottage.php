<?php
/**
 * The template used for displaying cottage content
 *
 * @package BayView
 * @subpackage Bayview
 */
?>

<?php $custom_fields = get_post_custom();?>

<div id="post-<?php the_ID(); ?>" class="bl-row-one">
    <div class="bl-column-one">
        <div class="thum-img">
            <?php
            if (has_post_thumbnail()):
                the_post_thumbnail('cottage-thumb');
            else:
                echo '<img height="153" width="272" alt="' . get_the_title() . '" class="attachment-cottage-thumb wp-post-image" src="' . get_bloginfo('template_directory') . '/images/160x116.jpg"/>';
            endif;
            ?>
        </div>
        <div class="thum-img-shadow">
            <img src="<?php echo get_template_directory_uri(); ?>/images/thum-shadow.png" alt="" />
        </div>
    </div>
    <div class="bl-column-two">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <p>
            <?php
            $terms = wp_get_object_terms( $post->ID, 'station' );            
            echo $terms[0]->name;
            
            ?>
        </p>
        <p><h6>Maximum Person: <?php echo current($custom_fields['_people']) + current($custom_fields['_children']); ?></h6>        
         </p>
        <h5><br>Description : </h5>

        <p><?php the_excerpt(); ?></p>
           <div><a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/read-btn.png" alt="" /></a></div>
    </div>
</div>
