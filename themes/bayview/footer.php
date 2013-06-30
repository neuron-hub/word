<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<div id="footer">
	<div class="wrapper">
    	<div class="footer-left">
		© 2009 - 2013 Port Stanton Resorts Inc.
        </div>
        <div class="footer-right">
        	<ul>
            	<li><a href="<?php echo home_url("site-map"); ?>">Site Map</a></li>
                <li><a href="<?php echo home_url("privacy-policy");?>">Privacy Policy</a></li>
                <li><a href="<?php echo home_url("terms-conditions");?>">Terms & Conditions</a></li>
                <li><a href="<?php echo home_url("contact-us");?>">Contact Us</a></li>
            </ul>  
        </div>
    </div>
</div>
</div>
<?php /*
</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'bayview_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'bayview' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'bayview' ); ?>"><?php printf( __( 'Proudly powered by %s', 'bayview' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->


*/ ?>

<script type="text/javascript">

function filterCottagesByStation(station) {
    station = station.toLowerCase();
    station = station.replace(/\s/g, '-');
    station = encodeURIComponent(station);
    var url = '<?php echo home_url().'/our-cottages/?station='?>' + station;
    location.href = url;
}

</script>

<?php wp_footer(); ?>
</body>
</html>
