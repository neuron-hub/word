<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
                <?php if (have_posts()) : ?>
                    <header class="archive-header">
                        <h1 class="archive-title"><?php
                if (is_day()) :
                    printf(__('Daily Archives: %s', 'bayview'), '<span>' . get_the_date() . '</span>');
                elseif (is_month()) :
                    printf(__('Monthly Archives: %s', 'bayview'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'bayview')) . '</span>');
                elseif (is_year()) :
                    printf(__('Yearly Archives: %s', 'bayview'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'bayview')) . '</span>');
                else :
                    _e('Archives', 'bayview');
                endif;
                    ?></h1>
                    </header><!-- .archive-header -->

                    <?php
                    /* Start the Loop */
                    while (have_posts()) : the_post();

                        /* Include the post format-specific template for the content. If you want to
                         * this in a child theme then include a file called called content-___.php
                         * (where ___ is the post format) and that will be used instead.
                         */
                        get_template_part('content', get_post_format());

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
        <?php get_sidebar('bottom');?>

    </div>
</div>
<?php get_footer(); ?>