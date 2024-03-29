<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package BayView
 * @subpackage Bayview
 */


$type = get_query_var('post_type');
if (in_array($type, array('cottage', 'addon'))) {
    get_template_part('search', $type);
} else {

    get_header();
    ?>

    <div id="body-section" class="site-content">
        <div class="wrapper">
            <div class="inner-body-left">
                <div class="bl-top">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/top-img.png" alt="" />
                </div>
                <div class="bl-mid" id="content" role="main">
			<?php 
                            $args = array('post_type'=>'post', 's'=> $_REQUEST['s']);
                            query_posts( $args );
                        
                        ?>
                    <?php if (have_posts()) : ?>

                        <header class="page-header">
                            <h1 class="page-title"><?php printf(__('Search Results for: %s', 'bayview'), '<span>' . get_search_query() . '</span>'); ?></h1>
                        </header>

                        <?php bayview_content_nav('nav-above'); ?>

                        <?php /* Start the Loop */ ?>
                        
                        <?php while (have_posts()) : the_post(); ?>
                            
                        <?php get_template_part('content','short'); ?>
                        <?php endwhile; ?>

                        <?php bayview_content_nav('nav-below'); ?>

                    <?php else : ?>

                        <article id="post-0" class="post no-results not-found">
                            <header class="entry-header">
                                <h1 class="entry-title"><?php _e('Nothing Found', 'bayview'); ?></h1>
                            </header>

                            <div class="entry-content">
                                <h3 style="text-align:center;"><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'bayview'); ?></h3>
                                <?php //get_search_form(); ?>
                            </div><!-- .entry-content -->
                        </article><!-- #post-0 -->

                    <?php endif; ?>

                </div>
                <div class="bl-bottom">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/bottom-img.png" alt="" />
                </div>
            </div>
            <?php get_sidebar(); ?>
            <?php get_sidebar('bottom'); ?>

        </div>
    </div>
    <?php get_footer();
}
?>
