<?php
/**
 * The template for displaying blog page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package BayView
 * @subpackage Bayview
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
                <?php query_posts(array('post_type'=>'post')); // reset loop to fetch all posts ... ?>
                <?php if (have_posts()) : ?>
                    <!--header class="archive-header">
                        <h1 class="archive-title"><?php printf(__('Category Archives: %s', 'bayview'), '<span>' . single_cat_title('', false) . '</span>'); ?></h1>

                        <?php if (category_description()) : // Show an optional category description  ?>
                            <div class="archive-meta"><?php echo category_description(); ?></div>
                        <?php endif; ?>
                    </header--><!-- .archive-header -->

                    <?php
                    /* Start the Loop */
                    while (have_posts()) : the_post();

                        /* Include the post format-specific template for the content. If you want to
                         * this in a child theme then include a file called called content-___.php
                         * (where ___ is the post format) and that will be used instead.
                         */
                        get_template_part('content', 'short');

                    endwhile;

                    bayview_content_nav('nav-below');
                    ?>

                <?php else : ?>
                    <?php get_template_part('content', 'none'); ?>
                <?php endif; ?>
            </div>
            <div class="bl-bottom">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bottom-img.png" alt="" />
            </div>
        </div>
        <?php get_sidebar(); ?>
        <?php //get_sidebar('bottom');?>

    </div>
</div>
<?php get_footer(); ?>