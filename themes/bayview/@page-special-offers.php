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
                <?php query_posts(array('post_type' => 'offer')); // reset loop to fetch all posts ... ?>
                <?php if (have_posts()) : ?>
                    <div class="bl-heading">
                        <h1>Promo Offers:</h1>
                    </div>

                    <?php if (category_description()) : // Show an optional category description  ?>
                        <div class="archive-meta"><?php echo category_description(); ?></div>
                    <?php endif; ?>
                    <!-- .archive-header -->

                    <?php
                    /* Start the Loop */
                    while (have_posts()) : the_post();
                        $enddate = get_post_meta(get_the_ID(), '_end_date', true);
                        if (time() <= strtotime($enddate)):
                            ?>

                            <div class="bl-row-list">
                                <div class="bl-column-one-list">
                                    <div class="thum-img">
                                        <?php
                                        echo (get_the_post_thumbnail(get_the_ID(), 'offer-thumb') ? get_the_post_thumbnail(get_the_ID(), 'offer-thumb') : '<img height="100" width="160" alt="No Image" class="attachment-110x90 wp-post-image" src="' . get_bloginfo('template_directory') . '/images/160x100.jpg">' );
                                        ?>
            <!--                                    <img src="<?php echo get_template_directory_uri(); ?>/images/product_list/prodyct1.jpg" alt="" />-->
                                    </div>
                                    <div class="thum-img-shadow">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/product_list/list_shadow.png" alt="" />
                                    </div>
                                </div>
                                <div class="list_items">
                                    <h1>
                                        <a href="<?php echo the_permalink() ?>" style="color:#851640;">
                                            <?php echo get_the_title(); ?>
                                        </a>
                                    </h1>
                                    <h2>Offer till <?php echo $enddate; ?></h2>
                                    <h3><?php echo get_post_meta(get_the_ID(), '_discount', true); ?> Last Minute Discount </h3>
                                    <h4>Save <?php echo get_post_meta(get_the_ID(), '_discount', true); ?></h4>
                                    <div class="view_all"><a href="<?php echo the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/product_list/detail_button.png" alt="" /></a></div>
                                </div>
                            </div>

                            <?php
                        endif;
                    endwhile;
                    ?>

                <?php else : ?>
                    <article id="post-0" class="post no-results not-found">
                        <header class="entry-header">
                            <h1 class="entry-title"><?php _e('Promo Offers', 'bayview'); ?></h1>
                        </header>   

                        <div class="entry-content">
                            <h3 style="text-align:center"><?php _e('There are no promo offers right now. Please come back later.', 'bayview'); ?></h3>
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
        <?php //get_sidebar('bottom'); ?>

    </div>
</div>
<?php get_footer(); ?>
