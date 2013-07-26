<?php
/**
 * The template for displaying Search Results pages.
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
                <?php
                global $wp_query;

                $adults = get_query_var("adults");
                $children = get_query_var("children");
                $arrival = get_query_var("arrival_date");
                $departure = get_query_var("departure_date");


                $station = get_query_var("station");

                $_SESSION['arrival'] = $arrival;
                $_SESSION['departure'] = $departure;
                $_SESSION['children'] = $children;
                $_SESSION['adults'] = $adults;
                $_SESSION['station'] = $station;

                $people = $children + $adults;
                if (empty($arrival)) {
                    $error = 'The Arrival Date you entered is Invalid.';
                } elseif (strtotime($arrival) < strtotime(date('Y-m-d'))) {
                    $error = "The Arrival Date you entered is Invalid. Please select the current or upcoming date.";
                } elseif (!empty($departure) && strtotime($departure) < strtotime(date('Y-m-d'))) {
                    $error = "Departure date you entered is Invalid. Please select the current or upcoming date.";
                } elseif (!empty($arrival) && !empty($departure)) {
                    $res = isValidBooking(0, $arrival, $departure);

                    if ($res !== true)
                        $error = $res;
                }

                if (!empty($error)) {
                    echo "<span style='color: #f00;'>$error</span> <a href='javascript:void(0)' onclick='history.back();'>Go Back</a>";
                } else {
                    $cottages = getScheduleCottages(null, $arrival, $departure);
			if(empty($cottages)) {
		$cottages = array(0);
}
                    $args = array(
                        'post_type' => 'cottage',
                        'station' => $station,
                        'post__in'=>$cottages,
                        'meta_query' => array(array(
                                'key' => '_people',
                                'compare' => '>=',
                                'value' => $people,
                                'type' => 'numeric',
                            )
                        )
                    );

                    //$exclude_cottages = getBookedCottages($arrival, $departure);

                    //print_r($exclude_cottages);

                    //if (!empty($exclude_cottages)) {
                      //  $args['post__not_in'] = $exclude_cottages;
                    //}

                    query_posts($args);


                    
                    ?>
<?php //echo $GLOBALS['wp_query']->request; ?>

                    <?php if (have_posts()) : ?>
                        <!--header class="archive-header">
                            <h1 class="archive-title"><?php printf(__('Category Archives: %s', 'bayview'), '<span>' . single_cat_title('', false) . '</span>'); ?></h1>

                        <?php if (category_description()) : // Show an optional category description    ?>
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
                            get_template_part('content', 'search');

                        endwhile;

                        bayview_content_nav('nav-below');



                        ?>

                    <?php else : 
			$the_slug = 'no-cottage-found';
			$args=array(
			  'name' => $the_slug,
			  'post_type' => 'page',
			  'post_status' => 'publish',
			  'posts_per_page' => 1
			);
			query_posts($args);
			while (have_posts()) : the_post();
                            /* Include the post format-specific template for the content. If you want to
                             * this in a child theme then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part('content', 'page');

                        endwhile;
                    endif;
                }
                ?>
            </div>
            <div class="bl-bottom">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bottom-img.png" alt="" />
            </div>
        </div>
        <?php get_sidebar('cottage'); ?>
        <?php get_sidebar('bottom'); ?>

    </div>
</div>
<?php get_footer(); ?>
