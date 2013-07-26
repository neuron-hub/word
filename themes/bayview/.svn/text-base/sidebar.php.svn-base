<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<div class="inner-body-right">
    <?php if (is_active_sidebar('sidebar-1') || is_active_sidebar('sidebar-2')) : ?>
        <div class="br-top">
            <img src="<?php echo get_template_directory_uri(); ?>/images/right-top.png" alt="" />
        </div>
    <?php endif; ?>

    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <div class="br-mid">
            <div id="secondary" class="widget-area" role="complementary">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </div><!-- #secondary -->
        </div>
    <?php endif; ?>


    <?php if (is_active_sidebar('sidebar-2')) : ?>
        <div class="br-bottom">
            <div id="secondary" class="widget-area" role="complementary">
                <?php dynamic_sidebar('sidebar-2'); ?>
            </div>
            <!--h1>Guest Book</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since the 1500s.</p>
            <span>-- Erin Hoffman</span-->
        </div>
    <?php endif; ?>

</div>