<?php get_header(); ?>

<div id="body-section" class="site-content">
    <div class="wrapper">
        <div class="body-left">
            <div class="bl-top">
                <img src="<?php echo get_template_directory_uri(); ?>/images/top-img.png" alt="" />
            </div>
            <div class="bl-mid" id="content" role="main">
                <?php
                if(have_posts()):
                    while(have_posts()): the_post();
                        the_content();
                    endwhile;
                endif;
                ?>
            </div>
            <div class="bl-bottom">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bottom-img.png" alt="" />
            </div>
        </div>

        <?php get_sidebar('home'); ?>
        <?php get_sidebar('bottom'); ?>

    </div>
</div>

<?php get_footer(); ?>
