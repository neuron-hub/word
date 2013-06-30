<?php
/**
 * The sidebar containing the front page widget areas.
 *
 */ ?>

<div class="body-right">
        	<div class="br-top">
            	<img src="<?php echo get_template_directory_uri(); ?>/images/right-top.png" alt="" />
            </div>
            <div class="br-mid">
                <?php if (is_active_sidebar('sidebar-2')) : ?>
                    <?php dynamic_sidebar('sidebar-home-page'); ?>
                <?php endif; ?>                               
<!--                <div class="booking-policy">
                    <a href="<?php echo home_url("rental-rates"); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/thum-img04.jpg" alt="" /></a>
                    <a href="<?php echo home_url("rental-rates"); ?>"><p>Rates are subject to change at any time without notice.
                            <span>View Booking Policies*</span></p></a>
                </div>
                <div class="thum-img-shadow-a">
                	<img src="<?php echo get_template_directory_uri(); ?>/images/thum-shadow.png" alt="" />
                </div> -->
                <div class="feature-offer">
                	<a href="<?php echo home_url("special-offers"); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/thum-img05.jpg" alt="" /></a>
                    <div>
                    	<a href="<?php echo home_url("special-offers"); ?>"><h1>Featured Offer
                                <span>Contrary to popular belief...</span></h1></a>
                    </div>
                    <h2 class="rm-btn">
                	<a href="<?php echo home_url("special-offers"); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/rm-btn.png" alt="" /></a>
                    </h2>
                </div>
                
                <div class="thum-img-shadow-a">
                	<img src="<?php echo get_template_directory_uri(); ?>/images/thum-shadow.png" alt="" />
                </div>
                <div class="widget_area">
                    <?php dynamic_sidebar('sidebar-4'); ?>
                </div>
            </div>
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