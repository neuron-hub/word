<?php
/**
 * The template for displaying cottages page.
 *
 * @package BayView
 * @subpackage Bayview
 */
get_header();


global $nggdb;

$gal1_images = $nggdb->get_random_images(9, 1);
$gal2_images = $nggdb->get_random_images(9, 2);
$gal3_images = $nggdb->get_random_images(9, 3);

?>



<div id="body-section" class="site-content">
    <div class="wrapper">
        <div class="inner-body-left">
            <div class="bl-top">
                <img src="<?php echo get_template_directory_uri(); ?>/images/top-img.png" alt="" />
            </div>
            <div class="bl-mid" id="content" role="main"><h2>
                <?php echo "<a href='".  home_url('bayview-wildwood-resort')."'>"; ?><strong>Bayview Wildwood Resort</strong><?php echo "</a>"; ?>
                </h2>
<hr class="dotted"/>
<?php //echo nggShowGallery(1, '', 2); ?>
                
        <div id="flexslider1" class="flexslider">
          <ul class="slides">
            
            <?php foreach($gal1_images as $img) {
                echo "<li><img src='$img->thumbURL'/></li>";
            }
            ?>
            
            
          </ul>
        </div>



<!--&nbsp;
<h2>
<?php echo "<a href='".  home_url('the-cottages-at-port-stanton')."'>"; ?><strong>The Cottages at Port Stanton</strong><?php echo "</a>"; ?>
</h2>
<?php //echo nggShowGallery(2, '', 3); ?>
<hr class="dotted"/>
<div id="flexslider2" class="flexslider">
          <ul class="slides">
            
            <?php foreach($gal2_images as $img) {
                echo "<li><img src='$img->thumbURL'/></li>";
            }
            ?>
            
            
          </ul>
        </div>-->



<!--&nbsp;
<h2>
<?php echo "<a href='".  home_url('the-village-of-port-stanton')."'>"; ?><strong>The Village of Port Stanton</strong><?php echo "</a>"; ?>
</h2>
<hr class="dotted"/>
<?php //echo nggShowGallery(3, '', 2); ?>

<div id="flexslider3" class="flexslider">
          <ul class="slides">
            
            <?php foreach($gal3_images as $img) {
                echo "<li><img src='$img->thumbURL'/></li>";
            }
            ?>
            
          </ul>
        </div>-->

</div>
            <div class="bl-bottom">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bottom-img.png" alt="" />
            </div>
        </div>
        <?php get_sidebar(); ?>
        <?php get_sidebar('bottom');?>

    </div>
</div>


<script type="text/javascript">
$(window).load(function(){
      $('#flexslider1').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 200,
        itemMargin: 5//,
        //asNavFor: '#slider'
      });
      $('#flexslider2').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 200,
        itemMargin: 5//,
        //asNavFor: '#slider'
      });
      $('#flexslider3').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 200,
        itemMargin: 5//,
        //asNavFor: '#slider'
      });
      
      /*$('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });*/
    });

</script>
<?php get_footer(); ?>