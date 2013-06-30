<div class="inner-body-right">
        	<div class="inner-br-top-right">
            	<h2>Check Availability</h2>
            </div>
        	<div class="br-top">
            	<img src="<?php echo get_template_directory_uri(); ?>/images/right-top.png" alt="" />
            </div>
            <div class="inner-br-mid">
            	<div class="grey-box">
                    <form id="check_availabilty" name="check_availabilty" action="<?php echo home_url();?>" method="get">
                	<h3>Arrival Date:</h3>
                    <input type="text" name="arrival_date" class="datepicker required" value="<?php echo (!empty($_SESSION['arrival']) ? $_SESSION['arrival'] : '');?>"/>
                    <h3>Departure Date:</h3>
                    <input type="text" name="departure_date" class="datepicker required" value="<?php echo (!empty($_SESSION['departure']) ? $_SESSION['departure'] : '');?>"/>
                    <div class="col">
                    	<h3>Adults:</h3>
                    	<select class="select required" name="adults"><option value="">Select</option>
                                            <?php 
                                            for($i=1; $i<=10; $i++) {
                                                echo "<option value='$i'".(!empty($_SESSION['adults']) && $_SESSION['adults'] == $i ? ' selected="selected"' : '').">$i</option>";
                                            }
                                            ?>
                                        </select>
                    </div>
                    <div class="col-a">
                    	<h3>Children (Age 3-12)</h3>
                    	<select class="select" name="children"><option value="0">Select</option>
                                        <?php 
                                            for($i=1; $i<=10; $i++) {
                                                echo "<option value='$i'".(!empty($_SESSION['children']) && $_SESSION['children'] == $i ? ' selected="selected"' : '').">$i</option>";
                                            }
                                        ?>
                                        </select>
                    </div>
					<div style="color:#fd3434;">* Saturday arrivals and departures not permitted.</div>
                    <div class="inner-chk-btn">		
                    	<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/chk-avlb-btn01.png" alt="" />
                    </div>
                     <input type="hidden" name="s" value="cottage" />
                                <input type="hidden" name="post_type" value="cottage" /> 
								
                                </form>
                    <script type="text/javascript">
                                            $().ready(function() {
                                                // validate the comment form when it is submitted
                                                $("#check_availabilty").validate();
                                            });
                                    </script>
                </div>
                <div class="booking-policy">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/CAPS-CRDA-2013-MEMBERSHIP-CERT.jpg" alt="CAPS-CRDA-2013-MEMBERSHIP">
                </div>
                <div class="booking-policy">
                    <a href="<?php echo home_url("rental-rates"); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/thum-img04.jpg" alt="" /></a>
                    <a href="<?php echo home_url("rental-rates"); ?>"><p>Rates are subject to change at any time without notice.
                            <span>View Booking Policies*</span></p></a>
                </div>
                <div class="thum-img-shadow-a">
                	<img src="<?php echo get_template_directory_uri(); ?>/images/thum-shadow.png" alt="" />
                </div>
                <div class="feature-offer">
                	<a href="<?php echo home_url("featured-offers"); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/thum-img05.jpg" alt="" /></a>
                    <div>
                    	<a href="<?php echo home_url("featured-offers"); ?>"><h1>Featured Offer
                                <span>Contrary to popular belief...</span></h1></a>
                    </div>
                    <h2 class="rm-btn">
                	<a href="<?php echo home_url("featured-offers"); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/rm-btn.png" alt="" /></a>
                    </h2>
                </div>
                
                <div class="thum-img-shadow-a">
                	<img src="<?php echo get_template_directory_uri(); ?>/images/thum-shadow.png" alt="" />
                </div>
                <div class="widget_area">
                    <?php dynamic_sidebar('sidebar-4'); ?>
                </div>
            </div>
            <div class="inner-br-bottom"></div>
        </div>