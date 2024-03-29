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
            	<!--<li><a href="<?php echo home_url("site-map"); ?>">Site Map</a></li> -->
                <li><a href="<?php echo home_url("privacy-policy");?>">Privacy Policy</a></li>
                <li><a href="<?php echo home_url("terms-conditions");?>">Terms & Conditions</a></li>
                <li><a href="<?php echo home_url("contact-us");?>">Contact Us</a></li>
            </ul>  
        </div>
	<div class="powered_by"><p>Designed & Developed By: <a href="http://www.neuronsoftsols.com/" target="_blank">Neuron Softtech LLC</a></p></div>
    </div>
</div>
</div>


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
