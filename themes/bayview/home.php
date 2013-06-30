<?php get_header(); ?>

<div id="body-section" class="site-content">
    <div class="wrapper">
        <div class="body-left">
            <div class="bl-top">
                <img src="<?php echo get_template_directory_uri(); ?>/images/top-img.png" alt="" />
            </div>
            <div class="bl-mid" id="content" role="main">
                <div class="bl-heading">
                    <h1>Fractional Ownership</h1>
                    <h4>Cottage Financing is Now Available</h4>
                </div>
                <div class="bl-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/img001.png" alt="" />
                </div>
                <div class="bl-paragraph">
                    <p>We are proud to announce that The Cottages II at Port Stanton are now able to offer in house financing. You could be in one of our brand new lakefront cottages right now for little down. For more information on financing options or to arrange a guided tour please contact us by email or phone at 1-866-710-6776.</p>
                    <h3>Fractional Properties at The Cottages at Port Stanton</h3>
                    <p>Fractional property ownership at the Cottages of Port Stanton, located in a beautiful Muskoka lakeside setting, combines the flexibility and convenience of a resort vacation with the quality and privacy of exclusive cottage ownership at an affordable price. Our prices start at just $49,000, one of the most affordably priced fractional ownership resorts in Ontario.</p>
                    <p>Two and three bedroom riverfront cottages feature luxurious furnishings, screened Muskoka Rooms, fireplaces, fully equipped kitchens, high speed Internet, satellite TV's and much more. The luxurious Ontario lakeside cottages at our Ontario lodge were nominated for an Interior Design Award through the American Resort Development Association (ARDA) in 2003.</p>
                    <p><br /><a href="<?php echo home_url('fractional-ownership'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/more-info-btn.png" alt="" /></a></p>
                </div>
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
