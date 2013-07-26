<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header();
?>
<div id="body-section" class="site-content">
    <div class="wrapper">
        <div class="inner-body-left">
            <div class="bl-top">
                <img src="<?php echo get_template_directory_uri(); ?>/images/top-img.png" alt="" />
            </div>
            <div class="bl-mid" id="content" role="main">
                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('content', get_post_format()); ?>

                    <nav class="nav-single">
                        <h3 class="assistive-text"><?php _e('Post navigation', 'bayview'); ?></h3>
                        <span class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'bayview') . '</span> %title'); ?></span>
                        <span class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'bayview') . '</span>'); ?></span>
                    </nav><!-- .nav-single -->

                    <?php comments_template('', true); ?>

                <?php endwhile; // end of the loop.  ?>

            </div>
            <div class="bl-bottom">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bottom-img.png" alt="" />
            </div>
        </div>
        <?php get_sidebar(); ?>
        <?php get_sidebar('bottom');?>

    </div>
</div>
<?php get_footer(); ?>