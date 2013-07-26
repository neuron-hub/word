<?php
/**
 * @package Bay View
 * @version 1.0
 */
/*
  Plugin Name: Bay View
  Plugin URI: http://neuronsoftsols.com
  Description: This implements the desired functionality of Bayview Project
  Version: 1.0
  Author URI: http://neuronsoftsols.com
 */

ob_start();
include_once(plugin_dir_path(__FILE__) . '/scheduler.php');

function bayview_init() {

    global $wp;

    $wp->add_query_var('arrival_date');
    $wp->add_query_var('departure_date');
    $wp->add_query_var('adults');
    $wp->add_query_var('children');


    $labels = array(
        'name' => 'Cottages',
        'singular_name' => 'Cottage',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Cottage',
        'edit_item' => 'Edit Cottage',
        'new_item' => 'New Cottage',
        'all_items' => 'All Cottages',
        'view_item' => 'View Cottage',
        'search_items' => 'Search Cottages',
        'not_found' => 'No Cottages found',
        'not_found_in_trash' => 'No Cottages found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Cottages'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'cottage'),
        'capability_type' => 'cottage',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'taxonomies' => array('station'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type('cottage', $args);

    $labels = array(
        'name' => _x('Stations', 'taxonomy general name'),
        'singular_name' => _x('Station', 'taxonomy singular name'),
        'search_items' => __('Search Stations'),
        'popular_items' => __('Popular Stations'),
        'all_items' => __('All Stations'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Station'),
        'update_item' => __('Update Station'),
        'add_new_item' => __('Add New Station'),
        'new_item_name' => __('New Station Name'),
        'separate_items_with_commas' => __('Separate stations with commas'),
        'add_or_remove_items' => __('Add or remove stations'),
        'choose_from_most_used' => __('Choose from the most used stations'),
        'menu_name' => __('Stations')
    );

    $args = array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'station')
    );

    register_taxonomy('station', 'cottage', $args);

    $labels = array(
        'name' => 'Addons',
        'singular_name' => 'Addon',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Addon',
        'edit_item' => 'Edit Addon',
        'new_item' => 'New Addon',
        'all_items' => 'All Addons',
        'view_item' => 'View Addon',
        'search_items' => 'Search Addons',
        'not_found' => 'No Addons found',
        'not_found_in_trash' => 'No Addons found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Addons'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'addon'),
        'capability_type' => 'addon',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        //'taxonomies' => array(),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
    );

    register_post_type('addon', $args);

    $labels = array(
        'name' => 'Special Offers',
        'singular_name' => 'offer',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Offer',
        'edit_item' => 'Edit Offer',
        'new_item' => 'New Offer',
        'all_items' => 'All Offers',
        'view_item' => 'View Offer',
        'search_items' => 'Search Offers',
        'not_found' => 'No Offers found',
        'not_found_in_trash' => 'No Offers found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Offers'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'offer'),
        'capability_type' => 'offer',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        //'taxonomies' => array(),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
    );

    //register_post_type('offer', $args);

    $labels = array(
        'name' => 'Special Days/Rates',
        'singular_name' => 'Special Day/Rate',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Special Day/Rate',
        'edit_item' => 'Edit Special Day/Rate',
        'new_item' => 'New Special Day/Rate',
        'all_items' => 'All Special Day/Rates',
        'view_item' => 'View Special Day/Rate',
        'search_items' => 'Search Special Day/Rates',
        'not_found' => 'No Special Day/Rates found',
        'not_found_in_trash' => 'No Special Day/Rates found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Special Day/Rates'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'specialday'),
        'capability_type' => 'specialday',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        //'taxonomies' => array(),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
    );

    //register_post_type('specialday', $args);
    $labels = array(
        'name' => 'Seasons',
        'singular_name' => 'Season',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Season',
        'edit_item' => 'Edit Season',
        'new_item' => 'New Season',
        'all_items' => 'All Season',
        'view_item' => 'View Season',
        'search_items' => 'Search Seasons',
        'not_found' => 'No Seasons found',
        'not_found_in_trash' => 'No Seasons found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Seasons'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'exclude_from_search' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'season'),
        'capability_type' => 'season',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        //'taxonomies' => array(),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
    );

    //register_post_type('season', $args);

    $labels = array(
        'name' => 'Home Slider',
        'singular_name' => 'Home Slider',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Image',
        'edit_item' => 'Edit Image',
        'new_item' => 'New Image',
        'all_items' => 'All Images',
        'view_item' => 'View Images',
        'search_items' => 'Search Images',
        'not_found' => 'No Images found',
        'not_found_in_trash' => 'No Image found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Home Slider'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'home_slider'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        //'taxonomies' => array('station'),
        'supports' => array('title', 'thumbnail')
    );

    register_post_type('home_slider', $args);
}

add_action('do_meta_boxes', 'home_slider_image_box');

function home_slider_image_box() {

    remove_meta_box('postimagediv', 'home_slider', 'side');

    add_meta_box('postimagediv', __('Home Slider Image'), 'post_thumbnail_meta_box', 'home_slider', 'normal', 'high');
}

function bayview_admin_init() {

    if (current_user_can('delete_seasons'))
        add_action('delete_post', 'bayview_season_delete_hook', 10);
    if (current_user_can('delete_specialdays'))
        add_action('delete_post', 'bayview_specialday_delete_hook', 10);
}

function bayview_season_delete_hook($pid) {
    global $wpdb;
    if ($wpdb->get_var($wpdb->prepare("SELECT season FROM {$wpdb->prefix}bayview_seasons WHERE season = %d", $pid))) {
        return $wpdb->query($wpdb->prepare('DELETE FROM {$wpdb->prefix}bayview_seasons WHERE season = %d', $pid));
    }
    return true;
}

function bayview_specialday_delete_hook($pid) {
    global $wpdb;

    if ($wpdb->get_var($wpdb->prepare("SELECT specialday FROM {$wpdb->prefix}bayview_specialdays WHERE specialday = %d", $pid))) {
        return $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->prefix}bayview_specialdays WHERE specialday = %d", $pid));
    }
    return true;
}

function bayview_enqueue_scripts() {
//    wp_deregister_script('jquery_1_4_2');
//    wp_deregister_script('jquery');
//    wp_deregister_script('jquery-easing');
//    wp_deregister_script('jquery-sweet-menu');
//    wp_register_script('jquery_1_4_2', get_template_directory_uri() . '/css/jquery-1.4.2.min.js');
//    wp_register_script('jquery-easing', get_template_directory_uri() . '/css/jquery.easing.js', array('jquery_1_4_2'));
//    wp_register_script('jquery-sweet-menu', get_template_directory_uri() . '/css/jquery.sweet-menu-1.0.js', array('jquery_1_4_2', 'jquery-easing'));
//
//    wp_deregister_script('jquery_1_8_2');
//    wp_deregister_script('jquery-ui');
//    wp_deregister_script('jquery-ui-tabs');
//    wp_register_script('jquery_1_8_2', get_template_directory_uri() . '/js/jquery-1.8.2.js');
//    wp_register_script('jquery-ui', get_template_directory_uri() . '/js/jquery-ui-1.9.0.custom.min.js', array('jquery_1_8_2'));
//    wp_register_script('jquery-ui-tabs', get_template_directory_uri() . '/js/jquery-ui-tabs-rotate.js', array('jquery-ui'));
//
//    wp_enqueue_script('jquery-sweet-menu');
//    wp_enqueue_script('jquery-ui-tabs');
}

/* Adds a box to the main column on the Post and Page edit screens */

function bayview_add_custom_box() {

    add_meta_box(
            'cottage_extra_info', __('Additional Info', 'bayview_textdomain'), 'bayview_cottage_inner_custom_box', 'cottage', 'normal'
    );
    add_meta_box(
            'addon_extra_info', __('Additional Info', 'bayview_textdomain'), 'bayview_addon_inner_custom_box', 'addon', 'normal'
    );
    add_meta_box(
            'specialday_extra_info', __('Additional Info', 'bayview_textdomain'), 'bayview_specialday_inner_custom_box', 'specialday', 'normal'
    );
    add_meta_box(
            'season_extra_info', __('Additional Info', 'bayview_textdomain'), 'bayview_season_inner_custom_box', 'season', 'normal'
    );

    add_meta_box(
            'offer_extra_info', __('Offer Info', 'bayview_textdomain'), 'bayview_offer_inner_custom_box', 'offer', 'normal'
    );
}

/* Prints the box content */

function bayview_cottage_inner_custom_box($post) {

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'bayview_cottage_nonce');

    // The actual fields for data entry
    // Use get_post_meta to retrieve an existing value from the database and use the value for the form

    $people = get_post_meta($post->ID, $key = '_people', $single = true);
    $children = get_post_meta($post->ID, $key = '_children', $single = true);
    $location = get_post_meta($post->ID, $key = '_location', $single = true);
    $location_link = get_post_meta($post->ID, $key = '_location_link', $single = true);
    $cottage_inventory = get_post_meta($post->ID, $key = '_inventory', $single = true);
    echo "<table>";
    echo '<tr><td><label for="bayview_cottage_sleeps">';
    _e("Inventory", 'myplugin_textdomain');
    echo '</label></td> ';
    echo '<td><input type="text" id="cottage_inventory" name="cottage_inventory" value="' . esc_attr($cottage_inventory) . '" size="5" /></td></tr>';

    echo '<tr><td><label for="bayview_cottage_people">';
    _e("Maximum people", 'myplugin_textdomain');
    echo '</label></td> ';
    echo '<td><input type="text" id="cottage_people" name="cottage_people" value="' . esc_attr($people) . '" size="5" /></td></tr></table>';

    echo '<hr style="border-width: 1px 0px 0px 0px; border-style: solid; border-color: #bfbfbf;"/>';
    echo '<table><tr><td><label for="bayview_cottage_people"><strong>';
    _e("Cottage Location", 'myplugin_textdomain');
    echo '</strong></label></td> ';
    echo '<td><input type="text" id="cottage_location" name="cottage_location" value="' . esc_attr($location) . '" size="25" /></td></tr>';
    echo '<tr><td><label for="bayview_cottage_people"><strong>';
    _e("Cottage Google Map Link", 'myplugin_textdomain');
    echo '</strong></label></td> ';
    echo '<td><input type="text" id="cottage_location_link" name="cottage_location_link" value="' . esc_attr($location_link) . '" size="25" /></td></tr></table>';
    echo '<hr style="border-width: 1px 0px 0px 0px; border-style: solid; border-color: #bfbfbf;"/>';
}

function bayview_offer_inner_custom_box($post) {

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'bayview_offer_nonce');

    // The actual fields for data entry
    // Use get_post_meta to retrieve an existing value from the database and use the value for the form

    $price = get_post_meta($post->ID, '_discount', true);
    $nights = get_post_meta($post->ID, '_nights', true);
    $end_date = get_post_meta($post->ID, '_end_date', true);
    $cottages = get_post_meta($post->ID, '_cottages', true);

    $end_date = ($end_date ? date('m/d/Y', strtotime($end_date)) : date('m/d/Y'));

    //print_r($cottages);

    $cottages = explode(',', $cottages);

    $_addons = get_post_meta($post->ID, '_addons', true);


    //print_r($_addons);

    $_addons = explode(',', $_addons);

    $addon_ids = array();
    $addon_quantities = array();

    foreach ($_addons as $a) {
        list($aid, $aq) = explode('|', $a);
        $addon_ids[] = $aid;
        $addon_quantities[$aid] = $aq;
    }


    $all_cottages = get_posts(array('post_type' => 'cottage', 'posts_per_page' => -1));
    $all_addons = get_posts(array('post_type' => 'addon', 'posts_per_page' => -1));



    echo "<table>";
    echo '<tr><td><label for="offer_price">';
    _e("Discount", 'myplugin_textdomain');
    echo '</label></td> ';
    echo '<td><input type="text" id="offer_price" name="offer_price" value="' . esc_attr($price) . '" size="5" style="text-align: right"/></td></tr>';
    echo '<tr><td><label for="offer_nights">';
    _e("Nights", 'myplugin_textdomain');
    echo '</label></td> ';
    echo '<td><input type="text" id="offer_nights" name="offer_nights" value="' . esc_attr($nights) . '" size="5" class="required"/></td></tr>';
    echo '<tr><td><label for="offer_end_date">';
    _e("End Date", 'myplugin_textdomain');
    echo '</label></td> ';
    echo '<td><input type="text" id="offer_end_date" name="offer_end_date" value="' . esc_attr($end_date) . '" size="12" class="datepicker"/></td></tr>';
    echo '</table>';
    echo "<div style='clear:both'>&nbsp;</div>";
    echo "Select Cottages:";
    echo '<hr style="border-width: 1px 0px 0px 0px; border-style: solid; border-color: #bfbfbf;"/>';

    foreach ($all_cottages as $ac) {
        echo "<div style='float:left; margin-right: 5px;'>";
        echo "<label for='cottage_$ac->ID'>";
        echo get_the_post_thumbnail($ac->ID, 'cottage-slider-thumb'); //, $size, $attr );
        echo "</label><br/>";
        if (in_array($ac->ID, $cottages)) {
            echo "<input type='checkbox' name='offer_cottages[]' value='$ac->ID' id='cottage_$ac->ID' style='vertical-align: top' checked='checked'/> ";
        } else {
            echo "<input type='checkbox' name='offer_cottages[]' value='$ac->ID' id='cottage_$ac->ID' style='vertical-align: top'/> ";
        }
        echo "<label for='cottage_$ac->ID'>";
        echo "$ac->post_title";
        echo "</label>";
        echo "</div>";
    }
    echo "<div style='clear:both'>&nbsp;</div>";
    echo "Select Addons:";
    echo '<hr style="border-width: 1px 0px 0px 0px; border-style: solid; border-color: #bfbfbf;"/>';

    foreach ($all_addons as $aa) {
        echo "<div style='float:left; margin-right: 5px;'>";
        echo "<label for='cottage_$aa->ID'>";
        echo get_the_post_thumbnail($aa->ID, 'cottage-slider-thumb'); //, $size, $attr );
        echo "</label><br/>";
        if (in_array($aa->ID, $addon_ids)) {
            echo "<input type='checkbox' name='offer_addons[]' value='$aa->ID' id='cottage_$aa->ID' style='vertical-align: top' checked='checked'/> ";
        } else {
            echo "<input type='checkbox' name='offer_addons[]' value='$aa->ID' id='cottage_$aa->ID' style='vertical-align: top'/> ";
        }
        echo "<label for='cottage_$aa->ID'>";
        echo "$aa->post_title";
        echo "</label>";
        echo "<br/>";
        echo "Quantity <select name='addon_quantity[$aa->ID]'>";
        for ($i = 1; $i <= 10; $i++) {
            if ($i == $addon_quantities[$aa->ID])
                echo "<option value='$i' selected='selected'>$i</option>";
            else
                echo "<option value='$i'>$i</option>";
        }
        echo "</select>";
        echo "</div>";
    }
    echo "<div style='clear:both'>&nbsp;</div>";

    echo '<hr style="border-width: 1px 0px 0px 0px; border-style: solid; border-color: #bfbfbf;"/>';
}

/* Prints the box content */

function bayview_addon_inner_custom_box($post) {

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'bayview_addon_nonce');

    // The actual fields for data entry
    // Use get_post_meta to retrieve an existing value from the database and use the value for the form
    $price = get_post_meta($post->ID, $key = '_price', $single = true);


    echo "<table>";
    echo '<tr><td><label for="bayview_addon_price">';
    _e("Price", 'myplugin_textdomain');
    echo '</label></td> ';
    echo '<td><input type="text" id="addon_price" name="addon_price" value="' . esc_attr($price) . '" size="5" /></td></tr></table>';

    echo '<hr style="border-width: 1px 0px 0px 0px; border-style: solid; border-color: #bfbfbf;"/>';
}

function bayview_specialday_inner_custom_box($post) {

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'bayview_specialday_nonce');


    global $wpdb;

    $times = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}bayview_specialdays WHERE `specialday`=$post->ID");

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Week Day</th><th>Day of Month</th><th>Month</th><th>Price</th><th>Minimum Bookings</th><th>Maximum Bookings</th><th>&nbsp;</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    echo "<tr id='specialday_inputs'>";
    echo "<td align='center'><select name='day_of_week' id='day_of_week' class='' style='text-align: center;'><option value='-1'>Any Day</option>";
    foreach (array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday") as $d => $l) {
        echo "<option value='$d'>$l</option>";
    }

    echo "</select></td><td align='center'><select name='day_of_month' id='day_of_month' class='' style='text-align: center;'><option value='-1'>Every Day</option>";
    for ($d = 1; $d <= 31; $d++) {
        echo "<option value='$d'>$d</option>";
    }

    echo "</select></td><td align='center'><select name='month' id='month' class='' style='text-align: center;'><option value='-1'>Every Month</option>";
    foreach (array(
"January",
 "February",
 "March",
 "April",
 "May",
 "June",
 "July",
 "August",
 "September",
 "October",
 "November",
 "December"
    ) as $m => $l) {
        echo "<option value='" . ($m + 1) . "'>$l</option>";
    }
    echo "</select></td><td align='center'><input type='text' name='price' id='price' style='text-align: center;'/></td><td align='center'><input type='text' name='min_nights' id='min_nights' style='text-align: center;'/></td><td align='center'><input type='text' name='max_nights' id='max_nights' style='text-align: center;'/></td><td align='center'><button type='button' onclick='add_specialday_times($post->ID);'>Add</button></td>";
    echo "</tr>";

    if (empty($times)) {
        echo "<tr id='specialday_norecords'>";
        echo "<td colspan='7' align='center'>No settings yet provided!</td>";
        echo "</tr>";
    } else {
        foreach ($times as $time) {
            echo "<tr id='specialday_time_$time->id'>";
            echo "<td align='center'>" . getDayOfWeek($time->day_of_week) . "</td>";
            echo "<td align='center'>" . getDayOfMonth($time->day_of_month) . "</td>";
            echo "<td align='center'>" . getMonthName($time->month) . "</td>";
            echo "<td align='center'>$time->price</td>";
            echo "<td align='center'>$time->min_nights</td>";
            echo "<td align='center'>$time->max_nights</td>";
            echo "<td><button type='button' onclick='delete_specialday_time($time->id)'>Delete</button></td>";
            echo "</tr>";
        }
    }

    echo "</tbody>";
    echo "</table>";
}

function bayview_season_inner_custom_box($post) {

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'bayview_season_nonce');


    global $wpdb;

    $times = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}bayview_seasons WHERE `season`=$post->ID");

    $cottages = get_posts(array(
        "post_type" => 'cottage'));

    $cottages_opt_tag = "";

    $cottages_ordered_by_id = array();

    foreach ($cottages as $cottage) {
        $cottages_opt_tag .= "<option value='$cottage->ID'>$cottage->post_title</option>";
        $cottage->permalink = get_post_permalink($cottage->ID);
        $cottages_ordered_by_id[$cottage->ID] = $cottage;
    }

    echo "<table style='width: 100%'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>From</th><th>To</th><th>Price</th><th>Minimum Bookings</th><th>Maximum Bookings</th><th>Cottages</th><th>&nbsp;</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    echo "<tr id='season_inputs'>";
    echo "<td align='center'><input type='text' name='from_date' id='from_date' class='datepicker' style='text-align: center;'/></td><td align='center'><input type='text' name='to_date' id='to_date' class='datepicker' style='text-align: center;'/></td><td align='center'><input type='text' name='price' id='price' style='text-align: center;'/></td><td align='center'><input type='text' name='min_nights' id='min_nights' style='text-align: center;'/></td><td align='center'><input type='text' name='max_nights' id='max_nights' style='text-align: center;'/></td><td align='center'><select name='cottages' id='cottages' multiple='true' size='3'><option value=''>All Cottages</option>$cottages_opt_tag</select></td><td align='center'><button type='button' onclick='add_season_times($post->ID);'>Add</button></td>";
    echo "</tr>";

    if (empty($times)) {
        echo "<tr id='season_norecords'>";
        echo "<td colspan='6' align='center'>No settings yet provided!</td>";
        echo "</tr>";
    } else {
        foreach ($times as $time) {

            echo "<tr id='season_time_$time->id'>";
            echo "<td align='center'>$time->from_date</td>";
            echo "<td align='center'>$time->to_date</td>";
            echo "<td align='center'>$time->price</td>";
            echo "<td align='center'>$time->min_nights</td>";
            echo "<td align='center'>$time->max_nights</td>";
            echo "<td align='center'>";
            if (empty($time->cottages)) {
                echo 'All';
            } else {
                $selected_cottages = explode(',', $time->cottages);
                if (!empty($selected_cottages)) {
                    echo "<a href='{$cottages_ordered_by_id[$selected_cottages[0]]->permalink}' title='{$cottages_ordered_by_id[$selected_cottages[0]]->post_title}' target='_blank'>{$cottages_ordered_by_id[$selected_cottages[0]]->ID}</a>";
                    for ($c = 1; $c < count($selected_cottages); $c++) {
                        echo ", <a href='{$cottages_ordered_by_id[$selected_cottages[$c]]->permalink}' title='{$cottages_ordered_by_id[$selected_cottages[$c]]->post_title}' target='_blank'>{$cottages_ordered_by_id[$selected_cottages[$c]]->ID}</a>";
                    }
                } else {
                    echo 'All';
                }
            }
            echo "</td>";
            echo "<td><button type='button' onclick='delete_season_time($time->id)'>Delete</button></td>";
            echo "</tr>";
        }
    }

    echo "</tbody>";
    echo "</table>";
}

/* When the post is saved, saves our custom data */

function bayview_save_postdata($post_id) {



    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    $post = get_post($post_id);
    switch ($post->post_type) {

        case 'cottage':

            // verify this came from the our screen and with proper authorization,
            // because save_post can be triggered at other times


            if (!isset($_POST['bayview_cottage_nonce']) || !wp_verify_nonce($_POST['bayview_cottage_nonce'], plugin_basename(__FILE__)))
                return;


            // Check permissions

            /* Get the post type object. */
            $post_type = get_post_type_object($post->post_type);

            /* Check if the current user has permission to edit the post. */
            if (!current_user_can($post_type->cap->edit_post, $post_id))
                return $post_id;

            // if ( !current_user_can( 'edit_cottage', $cottage_id ) )
            //      return;
            // OK, we're authenticated: we need to find and save the data
            //if saving in a custom table, get post_ID
            $post_ID = $_POST['post_ID'];

            // or a custom table (see Further Reading section below)
            //sanitize user input
            $data = sanitize_text_field($_POST['cottage_people']);
            $children = sanitize_text_field($_POST['cottage_children']);
            $location = sanitize_text_field($_POST['cottage_location']);
            $location_link = sanitize_text_field($_POST['cottage_location_link']);
            $cottage_inventory = sanitize_text_field($_POST['cottage_inventory']);
            // Do something with $mydata 
            // either using 
            add_post_meta($post_ID, '_people', $data, true) or update_post_meta($post_ID, '_people', $data);
            add_post_meta($post_ID, '_children', $children, true) or update_post_meta($post_ID, '_children', $children);
            add_post_meta($post_ID, '_location', $location, true) or update_post_meta($post_ID, '_location', $location);
            add_post_meta($post_ID, '_location_link', $location_link, true) or update_post_meta($post_ID, '_location_link', $location_link);
            add_post_meta($post_ID, '_inventory', $location_link, true) or update_post_meta($post_ID, '_inventory', $cottage_inventory);
            // or a custom table (see Further Reading section below)
            //sanitize user input
            //$data = sanitize_text_field($_POST['cottage_nightly_rate']);
            // Do something with $mydata 
            // either using 
            //add_post_meta($post_ID, '_nightly_rate', $data, true) or update_post_meta($post_ID, '_nightly_rate', $data);
            // or a custom table (see Further Reading section below)
            break;
        case 'addon':

            // verify this came from the our screen and with proper authorization,
            // because save_post can be triggered at other times


            if (!isset($_POST['bayview_addon_nonce']) || !wp_verify_nonce($_POST['bayview_addon_nonce'], plugin_basename(__FILE__)))
                return;


            // Check permissions

            /* Get the post type object. */
            $post_type = get_post_type_object($post->post_type);

            /* Check if the current user has permission to edit the post. */
            if (!current_user_can($post_type->cap->edit_post, $post_id))
                return $post_id;

            // if ( !current_user_can( 'edit_cottage', $cottage_id ) )
            //      return;
            // OK, we're authenticated: we need to find and save the data
            //if saving in a custom table, get post_ID
            $post_ID = $_POST['post_ID'];

            //sanitize user input
            $data = sanitize_text_field($_POST['addon_price']);
            // Do something with $mydata 
            // either using 
            $ret = add_post_meta($post_ID, '_price', $data, true) or update_post_meta($post_ID, '_price', $data);


            break;
        case 'specialday':

            // verify this came from the our screen and with proper authorization,
            // because save_post can be triggered at other times


            if (!isset($_POST['bayview_specialday_nonce']) || !wp_verify_nonce($_POST['bayview_specialday_nonce'], plugin_basename(__FILE__)))
                return;


            // Check permissions

            /* Get the post type object. */
            $post_type = get_post_type_object($post->post_type);

            /* Check if the current user has permission to edit the post. */
            if (!current_user_can($post_type->cap->edit_post, $post_id))
                return $post_id;

            // if ( !current_user_can( 'edit_cottage', $cottage_id ) )
            //      return;
            // OK, we're authenticated: we need to find and save the data
            //if saving in a custom table, get post_ID
            $post_ID = $_POST['post_ID'];

            break;
        case 'offer':

            // verify this came from the our screen and with proper authorization,
            // because save_post can be triggered at other times


            if (!isset($_POST['bayview_offer_nonce']) || !wp_verify_nonce($_POST['bayview_offer_nonce'], plugin_basename(__FILE__)))
                return;


            // Check permissions

            /* Get the post type object. */
            $post_type = get_post_type_object($post->post_type);

            /* Check if the current user has permission to edit the post. */
            if (!current_user_can($post_type->cap->edit_post, $post_id))
                return $post_id;

            // if ( !current_user_can( 'edit_cottage', $cottage_id ) )
            //      return;
            // OK, we're authenticated: we need to find and save the data
            //if saving in a custom table, get post_ID
            $post_ID = $_POST['post_ID'];

            //sanitize user input
            if (empty($_POST['offer_price'])) {

                return;
            }

            if (empty($_POST['offer_nights']) || !is_numeric($_POST['offer_nights'])) {

                return;
            }



            $data = sanitize_text_field($_POST['offer_price']);
            // Do something with $mydata 
            // either using 
            $ret = add_post_meta($post_ID, '_discount', $data, true) or update_post_meta($post_ID, '_discount', $data);

            //sanitize user input
            $data = sanitize_text_field($_POST['offer_nights']);
            // Do something with $mydata 
            // either using 
            $ret = add_post_meta($post_ID, '_nights', $data, true) or update_post_meta($post_ID, '_nights', $data);

            //sanitize user input
            $data = sanitize_text_field($_POST['offer_end_date']);
            $data = date('Y-m-d', strtotime($data));
            // Do something with $mydata 
            // either using 
            $ret = add_post_meta($post_ID, '_end_date', $data, true) or update_post_meta($post_ID, '_end_date', $data);

            //print_r($_POST['offer_cottages']);
            //sanitize user input
            $data = sanitize_text_field(implode(',', $_POST['offer_cottages']));
            // Do something with $mydata 
            // either using 
            $ret = add_post_meta($post_ID, '_cottages', $data, true) or update_post_meta($post_ID, '_cottages', $data);


            $addons = $_POST['offer_addons'];

            $addons_quantities = $_POST['addon_quantity'];

            $data = array();

            foreach ($addons as $a) {
                $data[] = "$a|" . $addons_quantities[$a];
            }

            $data = implode(',', $data);

            //sanitize user input
            $data = sanitize_text_field($data);
            // Do something with $mydata 
            // either using 
            $ret = add_post_meta($post_ID, '_addons', $data, true) or update_post_meta($post_ID, '_addons', $data);
//die;
            break;
    }
}

function bayview_register_menu_page() {
    add_menu_page('Booking Manager', 'Booking Manager', 'bayview_booking_manager', 'bayview/booking_manager.php', '', '', '6.1');
    add_submenu_page('bayview/booking_manager.php', 'Booking Manager', 'Booking Manager', 'bayview_booking_manager', 'bayview/booking_manager.php');
    add_submenu_page('bayview/booking_manager.php', 'Offline Punching', 'Offline Punching', 'bayview_offline_puncher', 'bayview/offline-punching.php');
    add_submenu_page('bayview/booking_manager.php', 'View Bookings', 'View Bookings', 'bayview_booking_manager', 'bayview/bookings.php');
    add_menu_page('My Bookings', 'My Bookings', 'customer', 'bayview/mybookings.php', '', '', '6.14');
    add_menu_page('Scheduler', 'Scheduler', 'bayview_booking_manager', 'scheduler', 'bayview_scheduler_page', '', '6.11');


//   
//   add_submenu_page('bayview/booking_manager.php','All Cottages', 'All Cottages', 'edit_cottages', 'edit.php?post_type=cottage');
//   add_submenu_page('bayview/booking_manager.php', 'Add New Cottage', 'Add New', 'edit_cottages', 'post-new.php?post_type=cottage');
//   add_submenu_page('bayview/booking_manager.php', 'All Stations', 'All Stations', 'manage_categories', 'edit-tags.php?taxonomy=station&post_type=cottage');
    //echo "<pre>";print_r($submenu); print_r($menu); die;
}

function bayview_posts_where($where) {


    return $where;
}

function bayview_activate() {


    remove_role("customer");
    remove_role("employee");

    $result = add_role('customer', 'Customer', array(
        'read' => true
            ));


    $result = add_role('employee', 'Employee', array(
        'read' => true,
        'delete_others_cottages' => true,
        'delete_cottages' => true,
        'delete_cottage' => true,
        'delete_private_cottages' => true,
        'delete_published_cottages' => true,
        'edit_others_cottages' => true,
        'edit_cottages' => true,
        'edit_cottage' => true,
        'edit_private_cottages' => true,
        'edit_published_cottages' => true,
        'publish_cottages' => true,
        'read_private_cottages' => true,
        'read_cottages' => true,
        'read_cottage' => true,
        'manage_stations' => true,
        'manage_station' => true,
        // Set capabilities to access/manage addons
        'delete_others_addons' => true,
        'delete_addons' => true,
        'delete_addon' => true,
        'delete_private_addons' => true,
        'delete_published_addons' => true,
        'edit_others_addons' => true,
        'edit_addons' => true,
        'edit_addon' => true,
        'edit_private_addons' => true,
        'edit_published_addons' => true,
        'publish_addons' => true,
        'read_private_addons' => true,
        'read_addons' => true,
        'read_addon' => true,
        // Set capabilities to access/manage offers
        'delete_others_offers' => true,
        'delete_offers' => true,
        'delete_offer' => true,
        'delete_private_offers' => true,
        'delete_published_offers' => true,
        'edit_others_offers' => true,
        'edit_offers' => true,
        'edit_offer' => true,
        'edit_private_offers' => true,
        'edit_published_offers' => true,
        'publish_offers' => true,
        'read_private_offers' => true,
        'read_offers' => true,
        'read_offer' => true,
        // Set capabilities to access/manage specialdays
        'delete_others_specialdays' => true,
        'delete_specialdays' => true,
        'delete_specialday' => true,
        'delete_private_specialdays' => true,
        'delete_published_specialdays' => true,
        'edit_others_specialdays' => true,
        'edit_specialdays' => true,
        'edit_specialday' => true,
        'edit_private_specialdays' => true,
        'edit_published_specialdays' => true,
        'publish_specialdays' => true,
        'read_private_specialdays' => true,
        'read_specialdays' => true,
        'read_specialday' => true,
        // Set capabilities to access/manage seasons
        'delete_others_seasons' => true,
        'delete_seasons' => true,
        'delete_season' => true,
        'delete_private_seasons' => true,
        'delete_published_seasons' => true,
        'edit_others_seasons' => true,
        'edit_seasons' => true,
        'edit_season' => true,
        'edit_private_seasons' => true,
        'edit_published_seasons' => true,
        'publish_seasons' => true,
        'read_private_seasons' => true,
        'read_seasons' => true,
        'read_season' => true,
        // Set capabilities to access booking manager section
        'bayview_booking_manager' => true,
        'bayview_offline_puncher' => true
            ));

    $user = get_userdata(get_current_user_id());


    $role = get_role('administrator');

    // Set capabilities to access/manage cottages
    $role->add_cap('delete_others_cottages');
    $role->add_cap('delete_cottages');
    $role->add_cap('delete_cottage');
    $role->add_cap('delete_private_cottages');
    $role->add_cap('delete_published_cottages');
    $role->add_cap('edit_others_cottages');
    $role->add_cap('edit_cottages');
    $role->add_cap('edit_cottage');
    $role->add_cap('edit_private_cottages');
    $role->add_cap('edit_published_cottages');
    $role->add_cap('publish_cottages');
    $role->add_cap('read_private_cottages');
    $role->add_cap('read_cottages');
    $role->add_cap('read_cottage');
    // Set capabilities to access/manage stations
    $role->add_cap('manage_stations');
    $role->add_cap('manage_station');
    // Set capabilities to access/manage addons
    $role->add_cap('delete_others_addons');
    $role->add_cap('delete_addons');
    $role->add_cap('delete_addon');
    $role->add_cap('delete_private_addons');
    $role->add_cap('delete_published_addons');
    $role->add_cap('edit_others_addons');
    $role->add_cap('edit_addons');
    $role->add_cap('edit_addon');
    $role->add_cap('edit_private_addons');
    $role->add_cap('edit_published_addons');
    $role->add_cap('publish_addons');
    $role->add_cap('read_private_addons');
    $role->add_cap('read_addons');
    $role->add_cap('read_addon');
    // Set capabilities to access/manage offers
    $role->add_cap('delete_others_offers');
    $role->add_cap('delete_offers');
    $role->add_cap('delete_offer');
    $role->add_cap('delete_private_offers');
    $role->add_cap('delete_published_offers');
    $role->add_cap('edit_others_offers');
    $role->add_cap('edit_offers');
    $role->add_cap('edit_offer');
    $role->add_cap('edit_private_offers');
    $role->add_cap('edit_published_offers');
    $role->add_cap('publish_offers');
    $role->add_cap('read_private_offers');
    $role->add_cap('read_offers');
    $role->add_cap('read_offer');
    // Set capabilities to access/manage specialdays
    $role->add_cap('delete_others_specialdays');
    $role->add_cap('delete_specialdays');
    $role->add_cap('delete_specialday');
    $role->add_cap('delete_private_specialdays');
    $role->add_cap('delete_published_specialdays');
    $role->add_cap('edit_others_specialdays');
    $role->add_cap('edit_specialdays');
    $role->add_cap('edit_specialday');
    $role->add_cap('edit_private_specialdays');
    $role->add_cap('edit_published_specialdays');
    $role->add_cap('publish_specialdays');
    $role->add_cap('read_private_specialdays');
    $role->add_cap('read_specialdays');
    $role->add_cap('read_specialday');
    // Set capabilities to access/manage seasons
    $role->add_cap('delete_others_seasons');
    $role->add_cap('delete_seasons');
    $role->add_cap('delete_season');
    $role->add_cap('delete_private_seasons');
    $role->add_cap('delete_published_seasons');
    $role->add_cap('edit_others_seasons');
    $role->add_cap('edit_seasons');
    $role->add_cap('edit_season');
    $role->add_cap('edit_private_seasons');
    $role->add_cap('edit_published_seasons');
    $role->add_cap('publish_seasons');
    $role->add_cap('read_private_seasons');
    $role->add_cap('read_seasons');
    $role->add_cap('read_season');
    // Set capabilities to access booking manager section
    $role->add_cap('bayview_booking_manager');
    $role->add_cap('bayview_offline_puncher');

    global $wpdb;

    $wpdb->query("
	DROP TABLE IF EXISTS {$wpdb->prefix}bayview_specialdays; 
");
    $wpdb->query("
        CREATE TABLE IF NOT EXISTS {$wpdb->prefix}bayview_specialdays
        (
        id INT AUTO_INCREMENT PRIMARY KEY,
        specialday INT NOT NULL,
        day_of_week INT NOT NULL,
        day_of_month INT NOT NULL,
        month INT NOT NULL,
        price VARCHAR(20) NOT NULL,
        min_nights INT DEFAULT '0',
        max_nights INT DEFAULT '-1'
        );
    ");
//    $wpdb->query("
//	DROP TABLE IF EXISTS {$wpdb->prefix}bayview_seasons;
//");
    $wpdb->query("
        CREATE TABLE IF NOT EXISTS {$wpdb->prefix}bayview_seasons
        (
        id INT AUTO_INCREMENT PRIMARY KEY,
        season INT NOT NULL,
        from_date DATE NOT NULL,
        to_date DATE NOT NULL,
        price VARCHAR(20) NOT NULL,
        min_nights INT DEFAULT '0',
        max_nights INT DEFAULT '-1',
        cottages VARCHAR(100)
        );
    ");
//    $wpdb->query("
//	DROP TABLE IF EXISTS {$wpdb->prefix}bayview_bookings;
//");
    $wpdb->query("
        CREATE TABLE IF NOT EXISTS {$wpdb->prefix}bayview_bookings
        (
        id INT AUTO_INCREMENT PRIMARY KEY,
        from_date DATE NOT NULL,
        to_date DATE NOT NULL,
        cottage INT NOT NULL,
        order_id INT NOT NULL,
        addon_ids VARCHAR(200)
        );
    ");
//    $wpdb->query("
//	DROP TABLE IF EXISTS {$wpdb->prefix}bayview_orders;
//");
    $wpdb->query("
        CREATE TABLE IF NOT EXISTS {$wpdb->prefix}bayview_orders
        (
        id INT AUTO_INCREMENT PRIMARY KEY,
        booking_ids VARCHAR(200) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        customer INT
        );
    ");
}

register_activation_hook(__FILE__, 'bayview_activate');


add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myStartSession');

function myStartSession() {
    if (is_admin())
        return;
    if (!session_id()) {
        session_start();
    }
}

function myEndSession() {
    session_destroy();
}

add_action('init', 'bayview_init');
add_action('admin_init', 'bayview_admin_init');
add_action('wp_enqueue_scripts', 'bayview_enqueue_scripts');

/* Define the custom box */

add_action('add_meta_boxes', 'bayview_add_custom_box');

// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'myplugin_add_custom_box', 1 );

/* Do something with the data entered */
add_action('save_post', 'bayview_save_postdata');

add_action('admin_menu', 'bayview_register_menu_page');



add_filter('posts_where', 'bayview_posts_where');

add_action('admin_enqueue_scripts', 'bayview_admin_enqueue_scripts');

function bayview_admin_enqueue_scripts() {
    wp_deregister_script('jquery_1_8_2');
    wp_deregister_script('jquery-ui');
    wp_deregister_script('jquery-ui-tabs');
    wp_register_script('jquery_1_8_2', get_template_directory_uri() . '/js/jquery-1.8.2.js');
    wp_register_script('jquery-ui', get_template_directory_uri() . '/js/jquery-ui-1.9.2.custom.min.js', array('jquery_1_8_2'));

    wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/css/jquery-ui/smoothness/jquery-ui-1.9.2.custom.min.css');

    wp_enqueue_script('jquery-ui');
}

add_action('admin_head', 'bayview_admin_head');

function bayview_admin_head() {
    ?>

    <style type="text/css">
        #season_inputs {
            width: 100%;
        }
        #season_inputs input {
            width: 98%;
        }
    </style>
    <script type="text/javascript" >
    <?php if ($_REQUEST['page'] != 'bayview/offline-punching.php') { ?>
            jQuery(document).ready(function(){
                jQuery( ".datepicker" ).datepicker({dateFormat:'yy-mm-dd'});
            });
                                                                                                               
    <?php } else { ?>
                                                    
            jQuery(document).ready(function(){
                jQuery( ".datepicker" ).datepicker({
                    minDate: new Date(), 
                    dateFormat: "yy-mm-dd",
                    firstDay: 1,
                    changeFirstDay: false,
                    beforeShowDay: function(date) {
                        return [(date.getDay() < 6), ''];
                    }
                });
            });
    <?php } ?>
                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                        
        function add_specialday_times(sday) {

            var day_of_week=jQuery('#day_of_week').val(), 
            day_of_month=jQuery('#day_of_month').val(), 
            month=jQuery('#month').val(),
            price=jQuery('#price').val(),
            min=jQuery('#min_nights').val(),
            max=jQuery('#max_nights').val();

            var data = {
                'action': 'specialday_add',
                'specialday': sday,
                'day_of_week': day_of_week,
                'day_of_month': day_of_month,
                'month': month,
                'price': price,
                'min_nights': min,
                'max_nights': max
            };

            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            jQuery.post(ajaxurl, data, function(response) {
                                                                                                                                                                                                                                                    
                if(response.result.toLowerCase() == "success"){
                    jQuery('#title').val() || jQuery('#title').val('Auto Drafted') && jQuery('#title').trigger('focus'); 
                    autosave();
                                                                                                                                                                                                                                                        
                    var new_row =   "<tr id='specialday_time_"+response.id+"'>"+
                        "<td align='center'>"+getDayOfWeek(response.day_of_week)+"</td>"+
                        "<td align='center'>"+getDayOfMonth(response.day_of_month)+"</td>"+
                        "<td align='center'>"+getMonthName(response.month)+"</td>"+
                        "<td align='center'>"+response.price+"</td>"+
                        "<td align='center'>"+response.min_nights+"</td>"+
                        "<td align='center'>"+response.max_nights+"</td>"+
                        "<td><button type='button' onclick='delete_specialday_time("+response.id+")'>Delete</button></td>"+
                        "</tr>";
                    jQuery('#specialday_norecords').remove();            
                    jQuery('#specialday_inputs').after(new_row);
                    jQuery('#specialday_inputs input[type=text]').val('');
                    alert("Added successfully");
                    jQuery('html, body').animate({scrollTop:jQuery('#specialday_inputs').offset().top}, 'slow');
                }else {
                    alert(
                    "Couldn't add timings! Please try again later."+
                        "\n"+
                        response.result
                );
                }
                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                    
            },"json");
                                                                                                                                                                                                                                                
        }
        function delete_specialday_time(tid) {

                                                                                                                                                                                                                                                
            var data = {
                'action': 'specialday_delete',
                'specialday_time_id': tid
            };

            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            jQuery.post(ajaxurl, data, function(response) {
                                                                                                                                                                                                                                                    
                if(response.search(/\bsuccess/i)>=0){
                    jQuery('#title').val() || jQuery('#title').val('Auto Drafted') && jQuery('#title').trigger('focus');
                    autosave();
                    jQuery('#specialday_time_'+tid).remove();
                }
                alert(response);
                                                                                                                                                                                                                                                    
            });
                                                                                                                                                                                                                                                
        }
        function add_season_times(season) {

            var from=jQuery('#from_date').val(), 
            to=jQuery('#to_date').val(), 
            price=jQuery('#price').val(), 
            min=jQuery('#min_nights').val(), 
            max=jQuery('#max_nights').val(),
            cottages = jQuery('#cottages').val();

            var data = {
                'action': 'season_add',
                'season': season,
                'from_date': from,
                'to_date': to,
                'price': price,
                'min_nights': min,
                'max_nights': max,
                'cottages': cottages
            };

            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            jQuery.post(ajaxurl, data, function(response) {
                                                                                                                                                                                                                                                    
                if(response.result.toLowerCase() == "success"){
                    jQuery('#title').val() || jQuery('#title').val('Auto Drafted') && jQuery('#title').trigger('focus'); 
                    autosave();
                                                                                                                                                                                                                                                        
                    var new_row =   "<tr id='season_time_"+response.id+"'>"+
                        "<td align='center'>"+response.from_date+"</td>"+
                        "<td align='center'>"+response.to_date+"</td>"+
                        "<td align='center'>"+response.price+"</td>"+
                        "<td align='center'>"+response.min_nights+"</td>"+
                        "<td align='center'>"+response.max_nights+"</td>"+
                        "<td align='center'>"+response.cottages+"</td>"+
                        "<td><button type='button' onclick='delete_season_time("+response.id+")'>Delete</button></td>"+
                        "</tr>";
                    jQuery('#season_norecords').remove();            
                    jQuery('#season_inputs').after(new_row);
                    jQuery('#season_inputs input[type=text]').val('');
                    alert("Added successfully");
                    jQuery('html, body').animate({scrollTop:jQuery('#season_inputs').offset().top}, 'slow');
                }else {
                    alert(
                    "Couldn't add timings! Please try again later."+
                        "\n"+
                        response.result
                );
                }
                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                    
            },"json");
                                                                                                                                                                                                                                                
        }
        function delete_season_time(tid) {

                                                                                                                                                                                                                                                
            var data = {
                'action': 'season_delete',
                'season_time_id': tid
            };

            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            jQuery.post(ajaxurl, data, function(response) {
                                                                                                                                                                                                                                                    
                if(response.search(/\bsuccess/i)>=0){
                    jQuery('#title').val() || jQuery('#title').val('Auto Drafted') && jQuery('#title').trigger('focus');
                    autosave();
                    jQuery('#season_time_'+tid).remove();
                }
                alert(response);
                                                                                                                                                                                                                                                    
            });
                                                                                                                                                                                                                                                
        }
                                                                                                                                                                                                                                            
        function getDayOfWeek($day){
            $day = parseInt($day);
            if(isNaN($day)) $day = -1;
            var $day_of_weeks = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            if($day >= 0 && $day < $day_of_weeks.length) {
                return $day_of_weeks[$day];
            }
            return "Any Day";
        }

        function getDayOfMonth($day) {
            $day = parseInt($day);
            if(isNaN($day)) $day = -1;
            if($day >= 1 && $day <= 31) return $day;
            return "Every Day";
        }

        function getMonthName($month) {
            $month = parseInt($month);
            if(isNaN($month)) $month = -1;
            var $months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ];
            $month--;
                                                                                                                                                                                                                                        
            if($month >= 0 && $month < $months.length) {
                return $months[$month];
            }
                                                                                                                                                                                                                                        
            return "Every Month";
        }
                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                        
    </script>
    <?php
}

add_action('wp_ajax_specialday_add', 'bayview_specialday_add');

function bayview_specialday_add() {
    global $wpdb; // this is how you get access to the database

    $res = $wpdb->insert(
            "{$wpdb->prefix}bayview_specialdays", array(
        'specialday' => $_POST['specialday'],
        'day_of_week' => $_POST['day_of_week'] >= 0 && $_POST['day_of_week'] < 7 ? $_POST['day_of_week'] : -1,
        'day_of_month' => $_POST['day_of_month'] > 0 && $_POST['day_of_month'] < 32 ? $_POST['day_of_month'] : -1,
        'month' => $_POST['month'] > 0 && $_POST['month'] < 13 ? $_POST['month'] : -1,
        'price' => $_POST['price'],
        'min_nights' => $_POST['min_nights'],
        'max_nights' => !empty($_POST['max_nights']) ? $_POST['max_nights'] : -1
            ), array(
        '%d',
        '%d',
        '%d',
        '%d',
        '%s',
        '%d',
        '%d'
            )
    );
    if ($res) {
//        echo "Successfully added";
        $time_id = $wpdb->insert_id;
        $timing = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}bayview_specialdays WHERE id=$time_id");
        $timing->result = "success";
        echo json_encode($timing);
    } else {
        echo json_encode(array("result" => "Error: " . $wpdb->last_error));
    }

    die(); // this is required to return a proper result
}

add_action('wp_ajax_specialday_delete', 'bayview_specialday_delete');

function bayview_specialday_delete() {
    global $wpdb; // this is how you get access to the database

    $query = $wpdb->prepare("
            DELETE FROM {$wpdb->prefix}bayview_specialdays 
            WHERE `id` = %d
            ", $_POST['specialday_time_id']);

    if ($wpdb->query($query)) {
        echo "Special day successfully deleted!";
    } else {
        echo "Deletion unsuccessful! Please try again.";
    }

    die(); // this is required to return a proper result
}

add_action('wp_ajax_season_add', 'bayview_season_add');

function bayview_season_add() {
    global $wpdb; // this is how you get access to the database

    $res = $wpdb->insert(
            "{$wpdb->prefix}bayview_seasons", array(
        'season' => $_POST['season'],
        'from_date' => date('Y-m-d', strtotime($_POST['from_date'])),
        'to_date' => date('Y-m-d', strtotime($_POST['to_date'])),
        'price' => $_POST['price'],
        'min_nights' => $_POST['min_nights'],
        'max_nights' => !empty($_POST['max_nights']) ? $_POST['max_nights'] : -1,
        'cottages' => !empty($_POST['cottages']) ? (is_array($_POST['cottages']) ? implode(',', $_POST['cottages']) : $_POST['cottages'] ) : ''
            ), array(
        '%d',
        '%s',
        '%s',
        '%s',
        '%d',
        '%d',
        '%s'
            )
    );
    if ($res) {
//        echo "Successfully added";
        $time_id = $wpdb->insert_id;
        $timing = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}bayview_seasons WHERE id=$time_id");

        $timing->result = "success";
        echo json_encode($timing);
    } else {
        echo json_encode(array("result" => "Error: " . $wpdb->last_error));
    }

    die(); // this is required to return a proper result
}

add_action('wp_ajax_season_delete', 'bayview_season_delete');

function bayview_season_delete() {
    global $wpdb; // this is how you get access to the database

    $query = $wpdb->prepare("
            DELETE FROM {$wpdb->prefix}bayview_seasons 
            WHERE `id` = %d
            ", $_POST['season_time_id']);

    if ($wpdb->query($query)) {
        echo "Special season successfully deleted!";
    } else {
        echo "Some error occurred! Please try again later.";
    }

    die(); // this is required to return a proper result
}

function getDayOfWeek($day) {
    $day_of_weeks = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
    if ($day >= 0 && $day < count($day_of_weeks)) {
        return $day_of_weeks[$day];
    }
    return "Any Day";
}

function getDayOfMonth($day) {
    if ($day >= 1 && $day <= 31)
        return $day;
    return "Every Day";
}

function getMonthName($month) {
    $months = array(
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    );
    $month--;

    if ($month >= 0 && $month < count($months)) {
        return $months[$month];
    }

    return "Every Month";
}

function getSpecialDays($date = '') {
    global $wpdb;
    if (!empty($date)) {
        $time = strtotime($date);
        list($day_of_week, $day_of_month, $month) = explode('/', date('w/j/n', $time));
        $query = "SELECT * FROM {$wpdb->prefix}bayview_specialdays WHERE ($day_of_week = `day_of_week` OR `day_of_week` < 0) AND ($day_of_month = `day_of_month` OR `day_of_month` <= 0) AND ($month = `month` OR `month` <= 0)";
    } else {
        $query = "SELECT * FROM {$wpdb->prefix}bayview_specialdays";
    }
    $sdays = $wpdb->get_results($query);
    return $sdays;
}

function getSeasons($date = '', $cottage_id = 0) {
    global $wpdb;
    if (!empty($date)) {
        $date = date('Y-m-d', strtotime($date));
        $query = "SELECT * FROM {$wpdb->prefix}bayview_seasons WHERE ((`from_date` <= '$date' AND `to_date` >= '$date') OR (`from_date`=''&&`to_date`='')) ";
        if (!empty($cottage_id)) {
            $cottage_id = intval($cottage_id);
            $query .= " AND (`cottages` REGEXP '[[:<:]]{$cottage_id}[[:>:]]' OR `cottages` = '') ";
        }
        $query .= " ORDER BY DATEDIFF(`to_date`, `from_date`) DESC, DATEDIFF('$date', `to_date`) DESC";
    } else {

        $query = "SELECT * FROM {$wpdb->prefix}bayview_seasons";

        if (!empty($cottage_id)) {
            $cottage_id = intval($cottage_id);
            $query .= " AND (`cottages` REGEXP '[[:<:]]{$cottage_id}[[:>:]]' OR `cottages` = '') ";
        }
    }

    $seasons = $wpdb->get_results($query);
    // echo $wpdb->last_query;
    return $seasons;
}

function getCottagePrice($cottage_id, $cottage_price, $date1, $date2, $sumup = false) {
    global $wpdb;


    $time1 = strtotime($date1);
    $time2 = strtotime($date2);

    if ($time1 > $time2) {
        $tmp = $date1;
        $date1 = $date2;
        $date2 = $tmp;
        $tmp = $time1;
        $time1 = $time2;
        $time2 = $tmp;
    }

    $day_interval = 24 * 60 * 60;

    $nights = ($time2 - $time1) / $day_interval;

    $weekends = 0;

    for ($time = $time1; $time < $time2; $time += $day_interval) {
        $day = date("N", $time);
        if ($day == 5 || $day == 6)
            $weekends+=1;
    }
    $weekends;
    $date1 = date('Y-m-d', $time1);
    $date2 = date('Y-m-d', $time2);

    $weekday_price = $wpdb->get_col("SELECT `schedule_price` FROM {$wpdb->prefix}bayview_schedule WHERE ('$date1' BETWEEN `schedule_from` AND `schedule_to`) AND  ('$date2' BETWEEN `schedule_from` AND `schedule_to`) AND `schedule_cottage` = $cottage_id AND `active` = '1' ORDER BY `ID` DESC LIMIT 0,1");

    $weekend_price = $wpdb->get_col("SELECT `weekend_price` FROM `{$wpdb->prefix}bayview_schedule` WHERE ('$date1' BETWEEN `schedule_from` AND `schedule_to`) AND  ('$date2' BETWEEN `schedule_from` AND `schedule_to`) AND `schedule_cottage` = $cottage_id AND `active` = '1' ORDER BY `ID` DESC LIMIT 0,1");

    $weekday_price = current($weekday_price);
    $weekend_price = current($weekend_price);

    $price = floatval($weekday_price) * intval($nights) + (floatval($weekend_price) - floatval($weekday_price)) * intval($weekends);

    return $price;
    //$alldbseasons = getSeasons(null, $cottage_id);

    /*

      if ($time1 > $time2) {
      $tmp = $date1;
      $date1 = $date2;
      $date2 = $tmp;
      $tmp = $time1;
      $time1 = $time2;
      $time2 = $tmp;
      }

      $day_interval = 24 * 60 * 60;

      $prices = array();

      for ($time = $time1; $time <= $time2; $time += $day_interval) {

      $date = date('Y-m-d', $time);
      $matched_seasons = findSeasons($date, $cottage_id); //, $alldbseasons);
      $price = $cottage_price;

      foreach ($matched_seasons as $ms) {
      $season_price = trim($ms->price);
      $percentage = false;
      if ($season_price[strlen($season_price) - 1] == '%') {
      $season_price = substr($season_price, 0, strlen($season_price) - 1);
      $percentage = true;
      }

      $modification_flag = 0; // replace current price

      if ($season_price[0] == '+') {
      // add to current price
      $modification_flag = 1;
      $season_price = intval($season_price);
      } elseif ($season_price[0] == '-') {
      // substract from current price
      $modification_flag = 2;
      $season_price = -intval($season_price);
      }

      switch ($modification_flag) {
      case 0:
      if ($percentage) {
      $price = $price * ($season_price / 100.0);
      } else {
      $price = $season_price;
      }
      break;
      case 1:
      if ($percentage) {
      $price += $price * ($season_price / 100.0);
      } else {
      $price += $season_price;
      }
      break;
      case 2:
      if ($percentage) {
      $price -= $price * ($season_price / 100.0);
      } else {
      $price -= $season_price;
      }
      break;
      }
      }


      $special_days = getSpecialDays($date);

      foreach ($special_days as $sd) {
      $sday_price = trim($sd->price);
      $percentage = false;
      if ($sday_price[strlen($sday_price) - 1] == '%') {
      $sday_price = substr($sday_price, 0, strlen($sday_price) - 1);
      $percentage = true;
      }
      $modification_flag = 0; // replace current price

      if ($sday_price[0] == '+') {
      // add to current price
      $modification_flag = 1;
      $sday_price = intval($sday_price);
      } elseif ($sday_price[0] == '-') {
      // substract from current price
      $modification_flag = 2;
      $sday_price = -intval($sday_price);
      }

      switch ($modification_flag) {
      case 0:
      if ($percentage) {
      $price = $price * ($sday_price / 100.0);
      } else {
      $price = $sday_price;
      }
      break;
      case 1:
      if ($percentage) {
      $price += $price * ($sday_price / 100.0);
      } else {
      $price += $sday_price;
      }
      break;
      case 2:
      if ($percentage) {
      $price -= $price * ($sday_price / 100.0);
      } else {
      $price -= $sday_price;
      }
      break;
      }
      }
      $prices[$date] = $price;
      }

      if ($sumup) {
      $sum = 0;

      foreach ($prices as $p)
      $sum += $p;

      return $sum;
      }

      return $prices; */
}

function findSeasons($date, $cottage_id = 0, $seasons = null) {
    $filtered_seasons = array();

    //  if(empty($seasons)) {
    $seasons = getSeasons($date, $cottage_id);
    $filtered_seasons = $seasons;
    //  }else {
    //TODO: Filter incoming seasons based on date specified
    //      $filtered_seasons = $seasons;
    //  }


    return $filtered_seasons;
}

add_action('wp_ajax_bayview_getBookedCottages', 'bayview_getBookedCottages_callback');

function bayview_getBookedCottages_callback() {
    global $wp_query;
    $date1 = $_POST['arrival_date'];
    $date2 = $_POST['departure_date'];
    $station = get_query_var("station");
    $args = array(
        'post_type' => 'cottage',
        'station' => $station
    );
    $booked = getBookedCottages($date1, $date2);

    if (!empty($booked)) {
        $args['post__not_in'] = $booked;
    }

    query_posts($args);
    if (have_posts()) :
        echo "<div style='clear:both'>&nbsp;</div>";
        echo "Select Cottages:";
        echo '<hr style="border-width: 1px 0px 0px 0px; border-style: solid; border-color: #bfbfbf;"/>';
        while (have_posts()): the_post();
            echo "<div style='float:left; margin-right: 5px;'>";
            echo "<label for='cottage_" . get_the_ID() . "'>";
            echo get_the_post_thumbnail(get_the_ID(), 'cottage-slider-thumb'); //, $size, $attr );
            echo "</label><br/>";
            echo "<input type='checkbox' name='offer_cottages[]' value='" . get_the_ID() . "' id='cottage_" . get_the_ID() . "' style='vertical-align: top'/> ";
            echo "<label for='cottage_" . get_the_ID() . "'>";
            echo get_the_title();
            echo "</label>";
            echo "</div>";

//            bayview_offer_inner_custom_box($post);
        endwhile;
        echo "<div style='clear:both'>&nbsp;</div>";
        echo "Select Addons:";
        echo '<hr style="border-width: 1px 0px 0px 0px; border-style: solid; border-color: #bfbfbf;"/>';
        $all_addons = get_posts(array('post_type' => 'addon', 'posts_per_page' => -1));
        foreach ($all_addons as $aa) {
            echo "<div style='float:left; margin-right: 5px;'>";
            echo "<label for='cottage_$aa->ID'>";
            echo get_the_post_thumbnail($aa->ID, 'cottage-slider-thumb'); //, $size, $attr );
            echo "</label><br/>";
            if (in_array($aa->ID, $addon_ids)) {
                echo "<input type='checkbox' name='offer_addons[]' value='$aa->ID' id='cottage_$aa->ID' style='vertical-align: top' checked='checked'/> ";
            } else {
                echo "<input type='checkbox' name='offer_addons[]' value='$aa->ID' id='cottage_$aa->ID' style='vertical-align: top'/> ";
            }
            echo "<label for='cottage_$aa->ID'>";
            echo "$aa->post_title";
            echo "</label>";
            echo "<br/>";
            echo "Quantity <select name='addons[$aa->ID][package_quantity]'>";
            for ($i = 1; $i <= 10; $i++) {
                if ($i == $addon_quantities[$aa->ID])
                    echo "<option value='$i' selected='selected'>$i</option>";
                else
                    echo "<option value='$i'>$i</option>";
            }
            echo "</select>";
            $addon_price = get_post_meta($aa->ID, $key = '_price', true);
            echo '<input type="hidden" name="addons[' . $aa->ID . '][package_price]" value="' . $addon_price . '"/>';
            echo '<input type="hidden" name="addons[' . $aa->ID . '][package_id]" value="' . $aa->ID . '"/>';
            echo '<input type="hidden" name="addons[' . $aa->ID . '][package_name]" value="' . get_the_title($aa->ID) . '"/>';
            echo "</div>";
        }
        echo "<div style='clear:both'>&nbsp;</div>";

        echo '<hr style="border-width: 1px 0px 0px 0px; border-style: solid; border-color: #bfbfbf;"/>';
    endif;

    die();
}

function getScheduleCottages($cottage = '', $date1, $date2 = '') {
    global $wpdb;
    $cottages = array();
    $start_date = date('Y-m-d', strtotime($date1));
    $end_date = (!empty($date2) ? date('Y-m-d', strtotime($date2)) : '');
    if (!empty($cottage)) {
        if (!empty($end_date) && !empty($start_date)) {
            $nights = round((strtotime($end_date) - strtotime($start_date)) / 60.0 / 60.0 / 24.0, 0);
            $cottages_query = "SELECT DISTINCT `schedule`.`schedule_cottage`
FROM wp_bayview_schedule schedule WHERE (
(
'$start_date'
BETWEEN schedule.schedule_from
AND schedule.schedule_to
)
AND (
'$end_date'
BETWEEN schedule.schedule_from
AND schedule.schedule_to
)
)
AND (
schedule.schedule_nights <=$nights
) AND active = '1'";
            $cottage_result = $wpdb->get_results($cottages_query);
            foreach ($cottage_result as $cottage) {
                $cottages[] = $cottage->schedule_cottage;
            }
            if (!empty($cottages))
                return $cottages;
            else
                return 0;
        }
    }
    else {
        if (!empty($end_date) && !empty($start_date)) {
            $nights = round((strtotime($end_date) - strtotime($start_date)) / 60.0 / 60.0 / 24.0, 0);
            $cottages_query = "SELECT DISTINCT `schedule`.`schedule_cottage`,`schedule`.`ID` 
FROM wp_bayview_schedule schedule WHERE (
(
'$start_date'
BETWEEN schedule.schedule_from
AND schedule.schedule_to
)
AND (
'$end_date'
BETWEEN schedule.schedule_from
AND schedule.schedule_to
)
)
AND (
schedule.schedule_nights <=$nights
) AND active = '1'";
            $cottage_result = $wpdb->get_results($cottages_query);
            foreach ($cottage_result as $cottage) {
                $cottages[$cottage->ID] = $cottage->schedule_cottage;
            }
            if (!empty($cottages)) {
                return $cottages;
            }
            else
                return 0;
        }
    }
}

function getBookedCottages($date1, $date2 = '') {
    global $wpdb;
    $cottages = array();
    $start_date = date('Y-m-d', strtotime($date1));
    $end_date = (!empty($date2) ? date('Y-m-d', strtotime($date2)) : '');
    if (!empty($end_date))
        $querylog = "Select DISTINCT cottage_id FROM {$wpdb->prefix}bookinglog WHERE `cottage_status` > 0 AND (('$start_date' BETWEEN cottage_arrival_date AND cottage_departure_date) OR ('$end_date' BETWEEN cottage_arrival_date AND cottage_departure_date) OR (cottage_arrival_date BETWEEN '$start_date' AND '$end_date') OR (cottage_departure_date BETWEEN '$start_date' AND '$end_date'))";
    else
        $querylog = "Select DISTINCT cottage_id FROM {$wpdb->prefix}bookinglog WHERE `cottage_status` > 0 AND ('$start_date' BETWEEN cottage_arrival_date AND cottage_departure_date) ";

    $rows = $wpdb->get_results($querylog);
    //echo $wpdb->last_query;

    foreach ($rows as $r) {
        $cottages[] = $r->cottage_id;
    }

    if (!empty($end_date) && !empty($start_date)) {
        $nights = round((strtotime($_SESSION['departure']) - strtotime($_SESSION['arrival'])) / 60.0 / 60.0 / 24.0, 0);
        //$querySchedule = "Select DISTINCT schedule_cottage FROM {$wpdb->prefix}bayview_schedule WHERE (('$start_date' NOT BETWEEN schedule_from AND schedule_to) AND ('$end_date' NOT BETWEEN schedule_from AND schedule_to) AND (schedule_nights != $nights))";
        //$querySchedule = "Select DISTINCT `schedule_cottage` FROM wp_bayview_schedule WHERE `schedule_cottage` NOT IN (SELECT `schedule`.`schedule_cottage` FROM wp_bayview_schedule schedule WHERE  schedule.schedule_inventory > (SELECT count(`log`.`cottage_id`) as total FROM wp_bayview_schedule schedule , wp_bookinglog log WHERE log.cottage_id = schedule.schedule_cottage  AND (('$start_date' BETWEEN schedule.schedule_from AND schedule.schedule_to) AND ('$end_date' BETWEEN schedule.schedule_from AND schedule.schedule_to)) AND (schedule.schedule_nights = $nights) AND log.cottage_status > 0) AND (('$start_date' BETWEEN schedule.schedule_from AND schedule.schedule_to) AND ('$end_date' BETWEEN schedule.schedule_from AND schedule.schedule_to)) AND (schedule.schedule_nights = $nights))";
        $querySchedule = "SELECT DISTINCT `schedule_cottage`
FROM wp_bayview_schedule
WHERE `schedule_cottage` NOT
IN (

SELECT `schedule`.`schedule_cottage`
FROM wp_bayview_schedule schedule, (

SELECT schedule.ID, count( `log`.`cottage_id` ) AS total
FROM wp_bayview_schedule schedule, wp_bookinglog log
WHERE log.cottage_id = schedule.schedule_cottage
AND (
(
'$start_date'
BETWEEN schedule.schedule_from
AND schedule.schedule_to
)
AND (
'$end_date'
BETWEEN schedule.schedule_from
AND schedule.schedule_to
)
)
AND (
schedule.schedule_nights =$nights
)
AND log.cottage_status >0
GROUP BY log.schedule_id
) AS result1
WHERE schedule.schedule_inventory > result1.total
AND schedule.ID = result1.ID
AND (
schedule.schedule_nights =$nights
)
)";
    } else {
        //$querySchedule = "Select DISTINCT `schedule_cottage` FROM wp_bayview_schedule WHERE `schedule_cottage` NOT IN (SELECT `schedule`.`schedule_cottage` FROM wp_bayview_schedule schedule WHERE  schedule.schedule_inventory > (SELECT count(`log`.`cottage_id`) as total FROM wp_bayview_schedule schedule , wp_bookinglog log WHERE log.cottage_id = schedule.schedule_cottage  AND (('$start_date' BETWEEN schedule.schedule_from AND schedule.schedule_to) AND (DATE_ADD( '$start_date', INTERVAL schedule_nights DAY) BETWEEN schedule.schedule_from AND schedule.schedule_to)) AND log.cottage_status > 0) AND (('$start_date' BETWEEN schedule.schedule_from AND schedule.schedule_to) AND (DATE_ADD( '$start_date', INTERVAL schedule_nights DAY) BETWEEN schedule.schedule_from AND schedule.schedule_to)))";
        $querySchedule = "SELECT DISTINCT `schedule_cottage`
FROM wp_bayview_schedule
WHERE `schedule_cottage` NOT
IN (SELECT `schedule`.`schedule_cottage` FROM wp_bayview_schedule schedule, ( SELECT schedule.ID , count( `log`.`cottage_id` ) AS total FROM wp_bayview_schedule schedule, wp_bookinglog log WHERE log.cottage_id = schedule.schedule_cottage AND ((
'$start_date' BETWEEN schedule.schedule_from AND schedule.schedule_to ) AND ( DATE_ADD( '$start_date', INTERVAL schedule_nights DAY ) BETWEEN schedule.schedule_from AND schedule.schedule_to )) AND log.cottage_status >0 GROUP BY log.schedule_id) as result1 WHERE schedule.schedule_inventory > result1.total AND schedule.ID = result1.ID)";
    }
    /*
     * SELECT DISTINCT `schedule_cottage`
      FROM wp_bayview_schedule
      WHERE `schedule_cottage` NOT
      IN (

      SELECT `schedule`.`schedule_cottage`
      FROM wp_bayview_schedule schedule
      WHERE schedule.schedule_inventory > (
      SELECT count( `log`.`cottage_id` ) AS total
      FROM wp_bayview_schedule schedule, wp_bookinglog log
      WHERE log.cottage_id = schedule.schedule_cottage
      AND (
      (
      '2013-12-24'
      BETWEEN schedule.schedule_from
      AND schedule.schedule_to
      )
      AND (
      DATE_ADD( '2013-12-24', INTERVAL schedule_nights
      DAY )
      BETWEEN schedule.schedule_from
      AND schedule.schedule_to )
      )
      AND log.cottage_status >0
      )
      AND (
      (
      '2013-12-24'
      BETWEEN schedule.schedule_from
      AND schedule.schedule_to
      )
      AND (
      DATE_ADD( '2013-12-24', INTERVAL schedule_nights
      DAY )
      BETWEEN schedule.schedule_from
      AND schedule.schedule_to
      )
      )
      )
     */

    //$querySchedule = "Select DISTINCT `schedule_cottage` FROM wp_bayview_schedule WHERE `schedule_cottage` NOT IN (SELECT `schedule`.`schedule_cottage` FROM wp_bayview_schedule schedule WHERE  schedule.schedule_inventory > (SELECT count(`log`.`cottage_id`) as total FROM wp_bayview_schedule schedule , wp_bookinglog log WHERE log.cottage_id = schedule.schedule_cottage  AND (('$start_date' BETWEEN schedule.schedule_from AND schedule.schedule_to) OR ('$end_date' BETWEEN schedule.schedule_from AND schedule.schedule_to)) AND (schedule.schedule_nights = $nights) AND log.cottage_status > 0) AND (('$start_date' BETWEEN schedule.schedule_from AND schedule.schedule_to) OR ('$end_date' BETWEEN schedule.schedule_from AND schedule.schedule_to)) AND (schedule.schedule_nights = $nights))";
    /*
     * Select DISTINCT `schedule_cottage` FROM wp_bayview_schedule WHERE `schedule_cottage` NOT IN (SELECT `schedule_cottage` FROM wp_bayview_schedule WHERE (('2013-12-24' BETWEEN schedule_from AND schedule_to) OR ('2013-12-27' BETWEEN schedule_from AND schedule_to)) AND (schedule_nights = 3))
     * 
     * SELECT `wp_bayview_schedule`.`schedule_cottage` , `wp_bookinglog`.`cottage_id` FROM wp_bayview_schedule, wp_bookinglog
     * 
     * 
     * SELECT `schedule`.`schedule_cottage`, `log`.`cottage_id`, count(`log`.`cottage_id`) as total
      FROM wp_bayview_schedule schedule , wp_bookinglog log WHERE log.cottage_id = schedule.schedule_cottage  AND (('2013-12-24' BETWEEN schedule.schedule_from AND schedule.schedule_to) OR ('2013-12-27' BETWEEN schedule.schedule_from AND schedule.schedule_to)) AND (schedule.schedule_nights = 3) AND log.cottage_status > 0
     * 
     * 
     * 
     * Select DISTINCT `schedule_cottage` FROM wp_bayview_schedule WHERE `schedule_cottage` NOT IN (SELECT `schedule`.`schedule_cottage` FROM wp_bayview_schedule schedule WHERE schedule.schedule_inventory > (SELECT count(`log`.`cottage_id`) as total FROM wp_bayview_schedule schedule , wp_bookinglog log WHERE log.cottage_id = schedule.schedule_cottage AND (('2013-12-24' BETWEEN schedule.schedule_from AND schedule.schedule_to) AND (DATE_ADD('2013-12-24', INTERVAL schedule.schedule_nights DAY) BETWEEN schedule.schedule_from AND schedule.schedule_to)) AND log.cottage_status > 0) AND (('2013-12-24' BETWEEN schedule.schedule_from AND schedule.schedule_to) AND (DATE_ADD('2013-12-24', INTERVAL schedule.schedule_nights DAY) BETWEEN schedule.schedule_from AND schedule.schedule_to))) 
     */

    $rowSchedule = $wpdb->get_results($querySchedule);
    //echo $wpdb->last_query;
    $cottages = array();

    foreach ($rowSchedule as $r) {
        $cottages[] = $r->schedule_cottage;
    }

    $cottages = array_unique($cottages);
    return $cottages;
}

function isValidBooking($schedule_id, $date1, $date2) {

    //$alldbseasons = getSeasons(null, $cottage_id);

    $time1 = strtotime($date1);
    $time2 = strtotime($date2);

    if ($time1 > $time2) {
        $msg = "<br><br><br><h3 style='text-align:center'>Please re-check the Arrival and Departure dates. Departure cannot be before Arrival!</h3>";
        return $msg;
    }
    /*
     * validation for checking that cottage selected is available for booking -- database and in session 
     */
/**
    if (!empty($schedule_id)) {

        global $wpdb;

        $start_date = date('Y-m-d', $time1);
        $end_date = date('Y-m-d', $time2);

        $exists = $wpdb->get_row("Select * FROM {$wpdb->prefix}bookinglog WHERE `cottage_status` > 0 AND schedule_id = $schedule_id AND (('$start_date' BETWEEN cottage_arrival_date AND cottage_departure_date) OR ('$end_date' BETWEEN cottage_arrival_date AND cottage_departure_date)) ");


        if (!empty($exists)) {
            $schedule_data = $wpdb->get_row("Select * FROM {$wpdb->prefix}bayview_schedule WHERE `ID` = $schedule_id ");
            $msg = ($schedule_data->schedule_cottage == 0 ? '' : get_post($schedule_data->schedule_cottage)->post_title) . " is already booked for $exists->cottage_arrival_date and $exists->cottage_departure_date, please try for another dates.";
            return $msg;
        }
 
        $exists = $wpdb->get_row("Select * FROM {$wpdb->prefix}bookinglog WHERE `cottage_status` > 0 AND cottage_id = $cottage_id AND ((cottage_arrival_date BETWEEN '$start_date' AND '$end_date') OR (cottage_departure_date BETWEEN '$start_date' AND '$end_date')) ");

        if (!empty($exists)) {
            $msg = get_post($cottage_id)->post_title . " is already booked for $exists->cottage_arrival_date and $exists->cottage_departure_date, please try for another dates.";
            return $msg;
        }
    }
**/

    /*
     * validation for checking that cottage selected is available for booking -- database and in session 
     */
/** 
    $day_interval = 24 * 60 * 60;

    $total_days = ($time2 - $time1) / $day_interval + 1;

    $season_passed = array();

    for ($time = $time1, $days_left = $total_days; $time <= $time2; $time += $day_interval, $days_left--) {
        $date = date('Y-m-d', $time);
        $matched_seasons = findSeasons($date, $cottage_id);

        foreach ($matched_seasons as $ms) {
            if (in_array($ms->id, $season_passed))
                continue;
            if ($ms->min_nights <= $days_left && ($ms->max_nights >= $days_left || $ms->max_nights < 0)) {
                $season_passed[] = $ms->id;
            } else {

                $msg = "You arrival date is falling under (" . get_the_title($ms->id) . ") season, but is not fulfilling its ($ms->min_nights) minimum and ($ms->max_nights) maximum nights booking limitation. Please adjust the booking dates and try again.";
                return $msg;
            }
        }
    }

   $sday_passed = array();

    for ($time = $time1, $days_left = $total_days; $time <= $time2; $time += $day_interval, $days_left--) {
        $date = date('Y-m-d', $time);
        $matched_sdays = getSpecialDays($date);

        foreach ($matched_sdays as $ms) {
            if (in_array($ms->id, $sday_passed))
                continue;
            if ($ms->min_nights <= $days_left && ($ms->max_nights >= $days_left || $ms->max_nights < 0)) {
                $sday_passed[] = $ms->id;
            } else {

                $msg = "Your chosen booking dates are falling under <b>" . get_post($ms->specialday)->post_title . "</b> special day, but are not fulfilling its <b>$ms->min_nights</b> minimum and <b>" . ($ms->max_nights < 0 ? 'unlimited' : $ms->max_nights) . "</b> maximum nights booking limitation. Please adjust the booking dates and try again.";
                return $msg;
            }
        }
    }

    if (empty($season_passed) && empty($sday_passed)) {
        // none of the season and special day matched with the dates added. Now check for global configurations.

        $min_nights = get_option("bayview_min_nights", 0);
        $max_nights = get_option("bayview_max_nights", -1);

        if ($total_days < $min_nights || ($total_days > $max_nights && $max_nights != -1)) {
            $msg = "$total_days nights booking not allowed at once. Please specify between " . $min_nights . " and " . ($max_nights < 0 ? 'unlimited' : $max_nights) . " nights";
            return $msg;
        }
    }  **/


    return true;
}

add_action('wp_ajax_bayview_get_payment_info', 'bayview_get_payment_info');
add_action('wp_ajax_nopriv_bayview_get_payment_info', 'bayview_get_payment_info');

function bayview_get_payment_info() {
    global $wpdb;
    $payment_id = intval($_POST["payment_id"]);

    $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}payment WHERE `ID` = $payment_id");
    $country = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}bayview_country WHERE `country_id` = {$row->country}");
    $row->country = $country->name;
    if (!empty($row)) {
        echo json_encode(array("status" => "success", "result" => $row));
        die;
    }
    echo json_encode(array("status" => "fail", "msg" => (!empty($wpdb->last_error) ? $wpdb->last_error : "Temporary error! Please try again later.")));
    die;
}

add_action('wp_ajax_get_updated_cottage_price_and_validate_booking', 'bayview_get_cottage_price_and_validate_booking');
add_action('wp_ajax_nopriv_get_updated_cottage_price_and_validate_booking', 'bayview_get_cottage_price_and_validate_booking');

function bayview_get_cottage_price_and_validate_booking() {
    $arrival = $_POST['arrival'];
    $departure = $_POST['departure'];
    $cottage_id = $_POST['cottage'];

    if (empty($arrival) || empty($departure)) {
        echo json_encode(array("result" => 'fail', 'msg' => 'Please enter the Arrival and the Depature date', 'price' => '0.0'));
        die;
    }

    $res = isValidBooking($cottage_id, $arrival, $departure);

    if ($res !== true) {
        echo json_encode(array("result" => 'fail', 'msg' => $res, 'price' => '0.0'));
        die;
    }

    $cottage_price = get_post_meta($cottage_id, '_nightly_rate', true);

//    $rates = getCottagePrice($cottage_id, 0, $arrival, $departure);

    $price = 0;

    foreach ($rates as $r)
        $price += $r;

    $price = getCottagePrice($cottage_id, 0, $arrival, $departure);
    ;

    echo json_encode(array("result" => 'success', 'msg' => 'Booking successful!', 'price' => $price, 'rates' => $rates));

    die;
}

add_action('wp_ajax_get_updated_offer_price_and_validate_booking', 'bayview_get_offer_price_and_validate_booking');
add_action('wp_ajax_nopriv_get_updated_offer_price_and_validate_booking', 'bayview_get_offer_price_and_validate_booking');

function bayview_get_offer_price_and_validate_booking() {
    $arrival = $_POST['arrival'];
    $offer_id = $_POST['offer'];

    $meta = get_post_meta($offer_id);

    $end_date = $meta["_end_date"][0];

    if ((strtotime($arrival) > strtotime($end_date)) && (strtotime($arrival) >= time())) {
        echo json_encode(array("result" => "fail", "msg" => "Invalid arrival date! To avail this offer, please enter date between " . date('Y-m-d') . " and $end_date."));
        die;
    }

    if (empty($arrival)) {
        echo json_encode(array("result" => 'fail', 'msg' => 'Please enter the Arrival date', 'price_cottage' => 0, 'price_pkg' => 0, 'discounted_price' => 0));
        die;
    }

    if (empty($offer_id)) {
        echo json_encode(array("result" => 'fail', 'msg' => 'Offer ID missing!', 'price_cottage' => 0, 'price_pkg' => 0, 'discounted_price' => 0));
        die;
    }

    $meta = get_post_meta($offer_id);
    $nights = $meta['_nights'][0];

    $arrival_time = strtotime($arrival);
    $departure_time = strtotime("+" . ($nights - 1) . " days", $arrival_time);


    $arrival = date('Y-m-d', $arrival_time);
    $departure = date('Y-m-d', $departure_time);

    $cottages = $meta['_cottages'][0];
    $cottages = explode(',', $cottages);

    $_addons = $meta['_addons'][0];
    $_addons = explode(',', $_addons);
    $addons = array();
    foreach ($_addons as $addon) {
        list($id, $quantity) = explode('|', $addon);
        $addons[$id] = $quantity;
    }
    $discount = $meta['_discount'][0];

    if (!empty($arrival) && !empty($departure)) {


        foreach ($cottages as $c) {
            $res = isValidBooking($c, $arrival, $departure);

            if ($res !== true) {
                echo json_encode(array("result" => 'fail', 'msg' => $res, 'price' => '0.0'));
                die;
            }
        }


        $prices = array();
        foreach ($cottages as $c) {
            $prices[get_the_title($c)] = getCottagePrice($c, get_post_meta($c, '_nightly_rate', true), $arrival, $departure);
        }

        $total_price = 0;
        foreach ($prices as $cottage => $pp) {
            $price = 0;
            foreach ($pp as $p) {
                $price+=$p;
            }
            $prices[$cottage] = $price;
            $total_price += $price;
        }

        $cottage_price = $total_price;
        $addon_price = 0;
        $addon_prices = array();
        if (!empty($addons)) {
            foreach ($addons as $addon_id => $addon_qnty) {
                $total_price += $addon_price += $addon_prices[get_the_title($addon_id) . " ($addon_qnty)"] = get_post_meta($addon_id, '_price', true) * $addon_qnty;
            }
        }


        $discounted_price = getDiscountedPrice($total_price, $discount);
        $discount = $total_price - $discounted_price;

        echo json_encode(array("result" => 'success', 'msg' => 'Booking details successfully updated.', 'price_cottage' => $cottage_price, 'price_pkg' => $addon_price, 'discounted_price' => $discounted_price));

        die;
    }
}

add_action('wp_ajax_add_offer_to_cart', 'bayview_add_offer_to_cart');

add_action('wp_ajax_nopriv_add_offer_to_cart', 'bayview_add_offer_to_cart');

function bayview_add_offer_to_cart() {

    if (!session_id())
        session_start();

    $offer_id = $_POST['offer_id'];

    $meta = get_post_meta($offer_id);

    $end_date = $meta["_end_date"][0];

    $people = $_POST['people'];
    $nights = $_POST['nights'];
    $arrival_date = $_POST['arrival_date'];
    $price = $_POST['price'];

    if (strtotime($arrival_date) > strtotime($end_date)) {
        echo json_encode(array("result" => "fail", "msg" => "Arrival date missing!"));
        die;
    }

    if (empty($arrival_date) || $arrival_date == 'N/a') {
        echo json_encode(array("result" => 'fail', 'msg' => 'Arrival date missing!'));
        die;
    }
    $today = time();
    $arv = strtotime($arrival_date);
    if ($arv < $today) {
        echo json_encode(array("result" => 'fail', 'msg' => 'Please enter valid Arrival date.'));
        die;
    }


    if (empty($offer_id)) {
        echo json_encode(array("result" => 'fail', 'msg' => 'Please enter valid Departure date.'));
        die;
    }

    if (!isset($_SESSION["cart_offer_data"]))
        $_SESSION["cart_offer_data"] = array();


    $newdata = array(
        "offer_id" => $offer_id,
        "people" => $people,
        "nights" => $nights,
        "arrival_date" => $arrival_date,
        "price" => $price
    );

    foreach ($_SESSION["cart_offer_data"] as $key => $value) {
        if ($value["offer_id"] == $offer_id) {
            $_SESSION["cart_offer_data"][$key] = $newdata;
            echo json_encode('Booking details successfully added in the cart.');
            die;
        }
    }


    $_SESSION["cart_offer_data"][] = $newdata;

    echo json_encode(array("result" => 'success', 'msg' => 'Offer successfully added in the cart.'));

    die;
}

add_action('wp_ajax_add_data_to_cart', 'bayview_add_data_to_cart');

add_action('wp_ajax_nopriv_add_data_to_cart', 'bayview_add_data_to_cart');

function bayview_add_data_to_cart() {

    if (!session_id())
        session_start();

    $cottage_Id = $_POST['cottage_Id'];
    $cottage_title = $_POST['cottage_title'];
    $arrival_date = $_POST['arrival_date'];
    $depature_date = $_POST['depature_date'];
    $room_rate = $_POST['room_rate'];
    $total = $_POST['total'];
    $addons = $_POST['addons'];
    $people = $_POST['people'];

    $total_people = get_post_meta($cottage_Id, '_people', true);

    if ($total_people < $people) {
        echo json_encode(array("result" => 'fail', 'msg' => 'You have exceeded the limit. Maximum number of guests can only be ' . $total_people . '!'));
        die;
    }
    if (empty($arrival_date) || $arrival_date == 'N/a') {
        echo json_encode(array("result" => 'fail', 'msg' => 'Please enter valid Arrival date.'));
        die;
    }

    if (empty($depature_date) || $depature_date == 'N/a') {
        echo json_encode(array("result" => 'fail', 'msg' => 'Please enter valid Departure date.'));
        die;
    }

    $res = isValidBooking($cottage_Id, $arrival_date, $depature_date);

    if ($res !== true) {
        echo json_encode(array("result" => 'fail', 'msg' => $res, 'price' => '0.0'));
        die;
    }
//    $data_for_cart = array("cottage_Id"=>$cottage_Id, 'cottage_title'=>$cottage_title, 'room_rate'=>$room_rate ,'total'=>$total);

    /*
     * before adding cottage in cart do check that it is available for booking in database  and seesion for input dates....
     * Also adding package data is left that includes array 
     * 
     * array()
     *  
     */
    if (isset($_SESSION['data_for_cart'])) {  // if session already exists 
        $value = $_SESSION['data_for_cart'];



        $counter = count($_SESSION['data_for_cart']);
        $add = true;
        $edit = false;
        foreach ($value as $key => $cart) {

            if ($cart['cottage_Id'] == $cottage_Id) {

                $value[$key] = array('cottage_Id' => $cottage_Id
                    , 'cottage_title' => $cottage_title
                    , 'arrival_date' => $arrival_date
                    , 'depature_date' => $depature_date
                    , 'room_rate' => $room_rate
                    , 'total' => $total
                    , 'addons' => $addons
                    , 'people' => $people
                );
                $edit = true;
                $add = false;
            }
        }
        if ($edit == false && $add == true) {

            $session_list_item_data = array();
            $session_list_item_data = array('cottage_Id' => $cottage_Id
                , 'cottage_title' => $cottage_title
                , 'arrival_date' => $arrival_date
                , 'depature_date' => $depature_date
                , 'room_rate' => $room_rate
                , 'total' => $total
                , 'addons' => $addons
                , 'people' => $people
            );
            $value[$counter + 1] = $session_list_item_data;
        }


        $_SESSION['data_for_cart'] = $value;



        echo json_encode(array("result" => 'success', 'msg' => 'Booking details successfully updated.', 'price_cottage' => $cottage_price, 'price_pkg' => $addon_price, 'discounted_price' => $discounted_price));
        // echo json_encode($value);
        die;
    } else {

        $session_list_item_data[] = array('cottage_Id' => $cottage_Id
            , 'cottage_title' => $cottage_title
            , 'arrival_date' => $arrival_date
            , 'depature_date' => $depature_date
            , 'room_rate' => $room_rate
            , 'total' => $total
            , 'addons' => $addons
            , 'people' => $people
        );

        $_SESSION['data_for_cart'] = $session_list_item_data;

        echo json_encode(array("result" => 'success', 'msg' => 'Your booking details have been successully added to the cart. Continue booking more cottages or checkout to proceed further.', 'price_cottage' => $cottage_price, 'price_pkg' => $addon_price, 'discounted_price' => $discounted_price));
        // echo json_encode($_SESSION['data_for_cart']);
        die;
    }


//    if(empty($arrival) || empty($departure)) { echo json_encode(array("result"=>'fail', 'msg'=>'Booking dates invalid', 'price'=>'0.0')); die; }
//    
//    $res = isValidBooking($cottage_id, $arrival, $departure);
//    
//    if($res !== true) {  
//        echo json_encode(array("result"=>'fail', 'msg'=>$res, 'price'=>'0.0'));
//        die;
//    }
//    
//    $cottage_price = get_post_meta($cottage_id, '_nightly_rate', true);
//    
//    $rates = getCottagePrice($cottage_id, $cottage_price, $arrival, $departure);
//    
//    $price = 0;
//    
//    foreach($rates as $r) $price += $r;
//    
//    echo json_encode(array("result"=>'success', 'msg'=>'Booking dates valid', 'price'=>$price));
//    
//    die;
}

add_action('wp_ajax_bayview_remove_cart_detail', 'bayview_remove_cart_detail_callback');

add_action('wp_ajax_nopriv_bayview_remove_cart_detail', 'bayview_remove_cart_detail_callback');

function bayview_remove_cart_detail_callback() {


    if (!session_id())
        session_start();
    foreach ($_SESSION['data_for_cart'] as $key => $cart) {
        if ($cart['cottage_Id'] == $_POST['cottage_id']) {

            unset($_SESSION['data_for_cart'][$key]);
            break;
        }
    }
    ob_start();
    include_once(plugin_dir_path(__FILE__) . '/cart-widget.php');
    $output = ob_get_contents();

    ob_end_clean();
    //$output = str_replace(Array("\n", "\r"), Array("\\n", "\\r"), addslashes($output));
    echo $output;
    exit();
}

add_action('wp_ajax_bayview_remove_cart_offer', 'bayview_remove_cart_offer_callback');

add_action('wp_ajax_nopriv_bayview_remove_cart_offer', 'bayview_remove_cart_offer_callback');

function bayview_remove_cart_offer_callback() {


    if (!session_id())
        session_start();
    foreach ($_SESSION['cart_offer_data'] as $key => $cart) {
        if ($cart['offer_id'] == $_POST['offer_id']) {

            unset($_SESSION['cart_offer_data'][$key]);
            break;
        }
    }
    ob_start();
    include_once(plugin_dir_path(__FILE__) . '/cart-widget.php');
    $output = ob_get_contents();

    ob_end_clean();
    //$output = str_replace(Array("\n", "\r"), Array("\\n", "\\r"), addslashes($output));
    echo $output;
    exit();
}

class bayview_cart_widget extends WP_Widget {

    public function bayview_cart_widget() {
        // widget actual processes
        $widget_ops = array(
            'classname' => 'bayview_cart_widget',
            'description' => __('BayView Cart Widget', 'bayview')
        );

        $this->WP_Widget('bayview_cart', __('BayView Cart', 'bayview'), $widget_ops);
    }

    public function widget($args, $instance) {
        // outputs the content of the widget
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);

        $cart_data1 = isset($_SESSION['cart_offer_data'])? $_SESSION['cart_offer_data'] :  "";
        $cart_data2 = $_SESSION['data_for_cart'];

        if (!empty($cart_data1) || !empty($cart_data2)) {
            echo $before_widget;

            if (!empty($title))
                echo $before_title . $title . $after_title;
        }
        echo '<div class="bayview_cart_widget">';


        if (!empty($cart_data1)) {
            foreach ($cart_data1 as $value):
                ?>

                <div class="bl-chk-row-one">
                    <div class="widget-left" style="position: relative">

                        <?php // $large_image_url = wp_get_attachment_image_src( $value['cottage_Id'],array(110,90));         ?>
                        <?php echo (get_the_post_thumbnail($value['offer_id'], array(110, 90)) ? get_the_post_thumbnail($value['offer_id'], array(110, 90)) : '<img height="90" width="90" alt="No Image" class="attachment-110x90 wp-post-image" src="' . get_bloginfo('template_directory') . '/images/160x100.jpg">'); ?><span onclick="remove_cart_offer_detail(<?php echo $value['offer_id']; ?>)" style="top: 0;right: 0;
                              position: absolute; z-index: 12; font-weight: bold; font-size: larger; color: white; background-color: black; cursor: pointer">X</span>
                    </div>
                    <div class="widget-right">
                        <h2><?php echo get_the_title($value['offer_id']); ?></h2>
                        <div><a href="<?php echo get_permalink($value['offer_id']); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/detail-btn.png" alt="" /></a></div>
                        <h2>Total Price: <br/>$<?php echo round($value['price'], 2) ?></h2>
                    </div>
                </div>

                <?php
            endforeach;
        }


        if (!empty($cart_data2)) {
            foreach ($cart_data2 as $value):
                ?>

                <div class="bl-chk-row-one">
                    <div class="widget-left" style="position: relative">

                        <?php // $large_image_url = wp_get_attachment_image_src( $value['cottage_Id'],array(110,90));         ?>
                        <?php echo (get_the_post_thumbnail($value['cottage_Id'], array(110, 90)) ? get_the_post_thumbnail($value['cottage_Id'], array(110, 90)) : '<img height="90" width="90" alt="No Image" class="attachment-110x90 wp-post-image" src="' . get_bloginfo('template_directory') . '/images/160x100.jpg">' ); ?><span onclick="remove_cart_detail(<?php echo $value['cottage_Id']; ?>)" style="top: 0;right: 0;
                              position: absolute; z-index: 12; font-weight: bold; font-size: larger; color: white; background-color: black; cursor: pointer">X</span>
                <!--                        <img src="<?php echo get_template_directory_uri(); ?>/images/thum-imgs01.jpg" alt="" />-->
                    </div>
                    <div class="widget-right">
                        <h2><?php echo get_the_title($value['cottage_Id']); ?></h2>
                        <?php
                        $args = array(
                            'name' => 'my-reservation',
                            'post_type' => 'page',
                            'post_status' => 'publish',
                            'posts_per_page' => 1
                        );
                        $page = get_posts($args);
                        $page = $page[0];
                        ?>


                        <div><a href="<?php echo get_permalink($page) . '?house=' . $value['cottage_Id']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/detail-btn.png" alt="" /></a></div>
                        <h2>Total Price: $<?php echo $value['total'] ?></h2>
                    </div>
                </div>

                <?php
            endforeach;
        }
        if (!empty($cart_data1) || !empty($cart_data2)):
            ?>
            <div class="cd-checkout-btn" id="check_out_cart">
                <a href="<?php echo home_url() . '/checkout'; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/chkout-btn.png" alt="" /></a>
            </div>
            <?php
        endif;
        echo '</div>';
        if (!empty($cart_data1) || !empty($cart_data2)):
            echo $after_widget;
        endif;
    }

    // outputs the options form on admin
    public function form($instance) {
        global $wpdb;

        // Defaults
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('BayView Cart', 'text_domain');
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        // processes widget options to be saved
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

}

class bayview_facebook_widget extends WP_Widget {

    public function bayview_facebook_widget() {
        // widget actual processes
        $widget_ops = array(
            'classname' => 'bayview_facebook_widget',
            'description' => __('BayView facebook Widget', 'bayview')
        );

        $this->WP_Widget('bayview_facebook', __('BayView facebook', 'bayview'), $widget_ops);
    }

    public function widget($args, $instance) {
        include_once(plugin_dir_path(__FILE__) . '/facebook-feed.class.php');
        $count = (is_numeric($instance['facebook_count']) ? $instance['facebook_count'] : '5' );

        if (empty($count)) {
            $count = 5;
        }

        $feed = new uki_facebook_wall_feed($instance['facebook_id'], $instance['facebook_add_id'], $instance['facebook_app_secret'], $count);
        $feed->get_fb_wall_feed();

        $feed->display_fb_wall_feed();
    }

    // outputs the options form on admin
    public function form($instance) {
        global $wpdb;

        // Defaults
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('BayView facebook', 'text_domain');
        }
        if (isset($instance['facebook_id'])) {
            $facebook_id = $instance['facebook_id'];
        }
        if (isset($instance['facebook_add_id'])) {
            $facebook_add_id = $instance['facebook_add_id'];
        }
        if (isset($instance['facebook_app_secret'])) {
            $facebook_app_secret = $instance['facebook_app_secret'];
        }
        if (isset($instance['facebook_count'])) {
            $facebook_count = $instance['facebook_count'];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook_id'); ?>"><?php _e('Facebook ID:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('facebook_id'); ?>" name="<?php echo $this->get_field_name('facebook_id'); ?>" type="text" value="<?php echo esc_attr($facebook_id); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook_add_id'); ?>"><?php _e('Facebook Add ID:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('facebook_add_id'); ?>" name="<?php echo $this->get_field_name('facebook_add_id'); ?>" type="text" value="<?php echo esc_attr($facebook_add_id); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook_app_secret'); ?>"><?php _e('App Secret:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('facebook_app_secret'); ?>" name="<?php echo $this->get_field_name('facebook_app_secret'); ?>" type="text" value="<?php echo esc_attr($facebook_app_secret); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook_count'); ?>"><?php _e('Numbers:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('facebook_count'); ?>" name="<?php echo $this->get_field_name('facebook_count'); ?>" type="text" value="<?php echo esc_attr($facebook_count); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        // processes widget options to be saved
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['facebook_id'] = strip_tags($new_instance['facebook_id']);
        $instance['facebook_add_id'] = strip_tags($new_instance['facebook_add_id']);
        $instance['facebook_app_secret'] = strip_tags($new_instance['facebook_app_secret']);
        $instance['facebook_count'] = strip_tags($new_instance['facebook_count']);

        return $instance;
    }

}

add_action('widgets_init', create_function('', 'return register_widget("bayview_cart_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("bayview_facebook_widget");'));

function update_cart_widget() {
    ob_start();
    include_once(plugin_dir_path(__FILE__) . '/cart-widget.php');
    $output = ob_get_contents();

    ob_end_clean();
    //$output = str_replace(Array("\n", "\r"), Array("\\n", "\\r"), addslashes($output));
    echo $output;
    exit();
}

if (isset($_REQUEST['bayview_ajax_action']) && $_REQUEST['bayview_ajax_action'] == 'update_cart_widget') {
    add_action('init', 'update_cart_widget');
}

function bayview_checkout_submit() {
    
    global $wpdb, $table_prefix, $last_;
    
    $bookinglog_table = $table_prefix . 'bookinglog';

    if (is_user_logged_in()) {
        global $current_user;
        
        get_currentuserinfo();
        if (!is_admin()) {
            $current_user->add_cap('customer');
        }
        if (empty($current_user->user_firstname)) {
            wp_update_user(array('ID' => $current_user->ID, 'first_name' => $_POST['fname']));
        }
        if (empty($current_user->user_lastname)) {
            wp_update_user(array('ID' => $current_user->ID, 'last_name' => $_POST['lname']));
        }

        if (empty($current_user->display_name)) {
            if (!empty($current_user->user_lastname) || !empty($current_user->user_firstname)) {
                wp_update_user(array('ID' => $current_user->ID, 'display_name' => $current_user->user_firstname . ' ' . $current_user->user_lastname));
            } else {
                wp_update_user(array('ID' => $current_user->ID, 'display_name' => $_POST['fname'] . ' ' . $_POST['lname']));
            }
        }
        $metaArray = array();
        $metaArray['addr1'] = $_POST['addr1'];
        $metaArray['addr2'] = $_POST['addr2'];
        $metaArray['country'] = $_POST['select_country'];
        $metaArray['postcode'] = $_POST['pcode'];
        $metaArray['city'] = $_POST['city'];
        $metaArray['state'] = $_POST['select_state'];
        $metaArray['phone'] = $_POST['phone'];
        $metaArray['alt_phone'] = $_POST['alt_phone'];
        foreach ($metaArray as $meta_key => $meta_value) {
            update_user_meta($current_user->ID, $meta_key, $meta_value);
        }

        $errors = bayview_submit_form_data($current_user->ID);
        
        if (empty($errors)) {
            $msg = 1; //"Successfully booked!";
            
            //send_booking_email_notification($current_user->ID);
            update_user_meta($current_user->ID, '_odrerprocess', 'done');
            
        } else {
            $msg = 2; //"Some error occured while processing the order, please try again";

            $_SESSION['flash_errors'] = $flash_errors = $errors;
        }

        //$url = admin_url();
        $url = site_url('checkout');
        $url = add_query_arg('step', '1', $url);
        wp_redirect($url);
        exit;
    } else {
        // error .... hacking attempt.....
        $url = site_url();
        wp_redirect($url);
        exit();
    }
}

if (isset($_POST['order_confirm']) && $_POST['order_confirm'] == true) {
    add_action('init', 'bayview_checkout_submit');
}

function bayview_login_register() {
    global $wpdb;
    $action = $_POST['login_register'];
    switch ($action) {
        case 'login':
            $_POST_copy = array();
            foreach ($_POST as $pk => $pv) {
                $_POST_copy[$pk] = $pv;
            }
            $_SESSION_copy = array();

            foreach ($_SESSION as $pk => $pv) {
                $_SESSION_copy[$pk] = $pv;
            }

            $user = get_user_by('email', $_POST['email']);

            if (empty($user)) {
                $_SESSION['checkout_errors'] = "We don't have any registered user with the given email id. Please go back and try again.";
                $url = site_url('checkout');
                wp_redirect($url);
                exit();
            }

            $creds['user_login'] = $user->user_login;
            $creds['user_password'] = $_POST['password'];
            $creds['remember'] = false;
            $user = wp_signon($creds, false);

            foreach ($_POST_copy as $pk => $pv) {
                $_POST[$pk] = $pv;
            }


            foreach ($_SESSION_copy as $pk => $pv) {
                $_SESSION[$pk] = $pv;
            }

            if (is_wp_error($user)) {
                $_SESSION['checkout_errors'] = $user->get_error_message();
                $url = site_url('checkout');
                wp_redirect($url);
                exit();
            } else {

                $user->add_cap('customer');
                $_SESSION['nothing'] = 'nothing';
                $url = site_url('checkout');
                wp_redirect($url);
                exit();
            }
            break;
        case 'register':
            $_POST_copy = array();

            foreach ($_POST as $pk => $pv) {
                $_POST_copy[$pk] = $pv;
            }
            $_SESSION_copy = array();

            foreach ($_SESSION as $pk => $pv) {
                $_SESSION_copy[$pk] = $pv;
            }

            require_once( ABSPATH . WPINC . '/registration-functions.php');

            $user_login = sanitize_user($_POST['register_email']);
            $user_email = $_POST['register_email'];
            $password = $_POST['register_password'];
            $conf_password = $_POST['register_conf_password'];

            if (!is_email($user_email)) {
                $_SESSION['checkout_errors'] = "Please provide valid email id.";

                $url = site_url('checkout');
                wp_redirect($url);
                exit();
            }
            if ($password == '' || $conf_password == '') {
                $_SESSION['checkout_errors'] = "Password field cannot be left empty.";
                $url = site_url('checkout');
                wp_redirect($url);
                exit();
            }


            if ($password != $conf_password) {
                $_SESSION['checkout_errors'] = "The passwords provided do not match.";
                $url = site_url('checkout');
                wp_redirect($url);
                exit();
            }


            $tpp = 'customer';

            $errors = array();

            if ($user_login == '')
                $errors['user_login'] = __('<strong>ERROR</strong>: Please enter a username.', "ClassifiedTheme");

            /* checking e-mail address */
            if ($user_email == '') {
                $errors['user_email'] = __('<strong>ERROR</strong>: Please type your e-mail address.', "ClassifiedTheme");
            } else if (!is_email($user_email)) {
                $errors['user_email'] = __('<strong>ERROR</strong>: The email address isn&#8217;t correct.', "ClassifiedTheme");
                $user_email = '';
            }

            if (!validate_username($user_login)) {
                $errors['user_login'] = __('<strong>ERROR</strong>: This username is invalid.  Please enter a valid username.', "ClassifiedTheme");
                $user_login = '';
            }

            if (username_exists($user_login))
                $errors['user_login'] = __('<strong>ERROR</strong>: This username is already registered, please choose another one.', "ClassifiedTheme");


//            $key2 = $_POST['captcha'];
//
//            $key = substr($_SESSION['key'], 0, 5);
//            $number = $key2;
//            //print_r($_SESSION);
//            if (trim($number) != trim($key))
//                $errors['user_login'] = __('<strong>ERROR</strong>: Wrong validation Code.', "bayview");

            /* checking the email isn't already used by another user */
            $email_exists = $wpdb->get_row("SELECT user_email FROM $wpdb->users WHERE user_email = '$user_email'");
            if ($email_exists) {

                $_SESSION['checkout_errors'] .='<strong>ERROR</strong>: This email id is already registered. Please provide another email.';
                $url = site_url('checkout');
                wp_redirect($url);
                exit();
            }


            if (0 == count($errors)) {
                //$password = substr(md5(uniqid(microtime())), 0, 7);
                //$password = '123456';

                $user_id = wp_create_user($user_login, $password, $user_email);

                $user = get_userdata($user_id);
                $user->add_cap('customer');
                if (!$user_id)
                    $errors['user_id'] = sprintf(__('<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !', "ClassifiedTheme"), get_settings('admin_email'));
                else
                    my_new_user_notification($user_id, $password);

                $creds['user_login'] = $user_login;
                $creds['user_password'] = $password;
                $creds['remember'] = false;
                $user = wp_signon($creds, false);
                foreach ($_POST_copy as $pk => $pv) {
                    $_POST[$pk] = $pv;
                }


                foreach ($_SESSION_copy as $pk => $pv) {
                    $_SESSION[$pk] = $pv;
                }

                $_SESSION['checkout_errors'] = $errors['user_id'];
                if (is_wp_error($user)) {
                    $_SESSION['checkout_errors'] .= $user->get_error_message();
                    $url = site_url('checkout');
                    wp_redirect($url);
                    exit();
                } else {
                    ob_end_clean();

                    $url = site_url('checkout');
                    wp_redirect($url);
                    exit();
                }
            }
            break;
    }
}

if (isset($_POST['login_register']) && $_POST['login_register'] != '') {
    add_action('template_redirect', 'bayview_login_register');
}

function bookCottage($cottage_id, $user_id, $price, $arrival, $departure, $addons, $people) {
    global $wpdb, $table_prefix, $current_user;



    $booking_table = $table_prefix . 'bookinglog';

    $arrival = date('Y-m-d', strtotime($arrival));
    $departure = date('Y-m-d', strtotime($departure));

    $query = "INSERT INTO `" . $booking_table . "` (cottage_id,user_id,p_id,cottage_total,addons,cottage_arrival_date,cottage_departure_date,cottage_status,people) VALUES ({$cottage_id},$user_id, 0, $price, '$addons', '$arrival', '$departure', 0, '$people')";

    $prepared_query = $wpdb->query($query);





    return $wpdb->insert_id;
}

function bayview_submit_form_data($user_id = null) {
    global $wpdb, $table_prefix, $current_user;


    get_currentuserinfo();

    if ($user_id == null) {
        $user_id = $current_user->ID;
    }

    $booking_table = $table_prefix . 'bookinglog';
    $payment_table = $table_prefix . 'payment';
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address1 = $_POST['addr1'];
    $address2 = $_POST['addr2'];
    $country = $_POST['select_country'];
    $postal_code = $_POST['pcode'];
    $city = $_POST['city'];
    $state = $_POST['select_state'];
    $mobile_phone = $_POST['phone'];
    $alt_phone = $_POST['alt_phone'];
    $card_type = $_POST['card_type'];
    $card_number = $_POST['card_number'];
    $card_expire = $_POST['card_expire'];
    $securitycode = $_POST['securitycode'];
    $nameoncard = $_POST['nameoncard'];


    $offers_to_be_booked = $_SESSION['cart_offer_data'];

    $errors = array();

    $total_price = 0;

    $offers = array();

    $booking_ids = array();
    $tax = floatval(get_option('bayview_booking_tax', 0));
    $tax = 1 + ($tax / 100.0);


    if (!empty($offers_to_be_booked)) {

        foreach ($offers_to_be_booked as $offer) {

            $offer_id = $offer["offer_id"];
            if (empty($offer_id))
                continue;

            $arrival = $offer["arrival_date"];
            $arrival = date("Y-m-d", strtotime($arrival));

            $meta = get_post_meta($offer_id);

            $nights = $meta["_nights"][0];
            $end_date = $meta["_end_date"][0];

            if (strtotime($arrival) > strtotime($end_date)) {
                $errors[] = "Invalid arrival date! To avail this offer, please enter date between " . date('Y-m-d') . " and $end_date.";
                continue;
            } elseif (!empty($arrival)) {
                $departure = date('Y-m-d', strtotime("+" . ($nights - 1) . " days", strtotime($arrival)));
            } else {
                $errors[] = "Invalid arrival date! To avail this offer, please enter date between " . date('Y-m-d') . " and $end_date.";
                continue;
            }



            $cottages = $meta["_cottages"][0];
            $cottages = explode(',', $cottages);

            $cottage_not_available = 0;

            foreach ($cottages as $cottage) {
                $res = isValidBooking($cottage, $arrival, $departure);
                if ($res !== true) {
                    $cottage_not_available = $cottage;
                    break;
                }
            }

            if (!empty($cottage_not_available)) {
                $errors[] = "Cottage: " . get_the_title($cottage_not_available) . " of Offer: " . get_the_title($offer_id) . " is already booked between $arrival and $departure. Please select a different date and book again.";
                continue;
            }

            $_oaddons = $meta['_addons'][0];
            $_oaddons = explode(',', $_oaddons);


            $addons_db = array();
            $addons_price = 0;
            foreach ($_oaddons as $addon) {
                list($id, $quantity) = explode('|', $addon);

                $price = $quantity * get_post_meta($id, "_price", true);
                $addons_db[] = array(
                    "package_name" => get_the_title($id),
                    "package_id" => $id,
                    "package_quantity" => $quantity,
                    "package_price" => $price
                );
                $addons_price += $price;
                //$total_price += $price;
            }



            foreach ($cottages as $cottage) {


                $price = getCottagePrice($cottage, get_post_meta($cottage, "_nightly_rate", true), $arrival, $departure, true);


                if (!empty($addons_db)) {
                    $addons_db = json_encode($addons_db);
                    //$addons_price *= $service;
                    $price += $addons_price;
                }

                $price *= $tax;

                $bookind_id = bookCottage($cottage, $user_id, $price, $arrival, $departure, $addons_db, get_post_meta($cottage, "_people", true));
                $booking_ids[$bookind_id] = $bookind_id;
                $total_price += $price;
                $addons_db = null;
            }
        }
    }
    unset($_SESSION['cart_offer_data']);

    $cart_data = $_SESSION['data_for_cart'];

    if (!empty($cart_data)) {
        foreach ($cart_data as $cottage) {
            $cottage_id = $cottage["cottage_Id"];
            if (empty($cottage_id))
                continue;

            $arrival = $cottage["arrival_date"];

            if (empty($arrival)) {
                $errors[] = "Arrival date not specified for Cottage: " . get_the_title($cottage_id) . ". Please specify a date and book again.";
                continue;
            }

            $departure = $cottage["depature_date"];

            if (empty($departure)) {
                $errors[] = "Departure date not specified for Cottage: " . get_the_title($cottage_id) . ". Please specify a date and book again.";
                continue;
            }

            $res = isValidBooking($cottage_id, $arrival, $departure);

            if ($res !== true) {
                $errors[] = "Cottage: " . get_the_title($cottage_id) . " is booked between $arrival and $departure. Please specify a different date and book again.";
                continue;
            }
            
            $people = $cottage["people"];

            $price = getCottagePrice($cottage_id, get_post_meta($cottage_id, "_nightly_rate", true), $arrival, $departure, true);


            $addons = $cottage["addons"];

            $addons_price = 0;

            if (!empty($addons)) {
                foreach ($addons as $a) {
                    $addons_price += $a["package_price"];
                }
                $addons = json_encode($addons);
//                $addons_price *= $service;
            }


            $price = $price + $addons_price;
            $price *= $tax;
            $bookind_id = bookCottage($cottage_id, $user_id, $price, $arrival, $departure, $addons, $people);
            $booking_ids[$bookind_id] = $bookind_id;
            $total_price += $price;
        }
    }

    unset($_SESSION['data_for_cart']);
    $inserted = $wpdb->insert(
            $payment_table, array(
        'user_id' => $user_id,
        'fname' => $fname,
        'lname' => $lname,
        'address1' => $address1,
        'address2' => $address2,
        'country' => $country,
        'postal_code' => $postal_code,
        'city' => $city,
        'state' => $state,
        'mobile_phone' => $mobile_phone,
        'alt_phone' => $alt_phone,
        'card_type' => $card_type,
        'card_security' => $securitycode,
        'card_number' => $card_number,
        'card_exp' => $card_expire,
        'card_name' => $nameoncard,
        'gross_total' => $total_price,
        'created' => date('Y-m-d H:i:s')
            ), array(
        '%d',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s'
            )
    );


    global $last_booking_id;

    $last_booking_id = $payinfo_id = $wpdb->insert_id;

    $wpdb->query("UPDATE $booking_table SET `p_id` = $payinfo_id WHERE `ID` IN (" . implode(',', $booking_ids) . ")");
    
    update_user_meta($user_id, '_last_booking_id', implode(',', $booking_ids));

    return $errors;
}

function _bayview_submit_form_data($user_id = null) {
    global $wpdb, $table_prefix, $current_user;


    get_currentuserinfo();

    if ($user_id == null) {
        $user_id = $current_user->ID;
    }

    $booking_table = $table_prefix . 'bookinglog';
    $payment_table = $table_prefix . 'payment';
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address1 = $_POST['addr1'];
    $address2 = $_POST['addr2'];
    $country = $_POST['select_country'];
    $postal_code = $_POST['pcode'];
    $city = $_POST['city'];
    $state = $_POST['select_state'];
    $mobile_phone = $_POST['phone'];
    $alt_phone = $_POST['alt_phone'];
    $card_type = $_POST['card_type'];
    $card_number = $_POST['card_number'];
    $card_expire = $_POST['card_expire'];
    $securitycode = $_POST['securitycode'];
    $nameoncard = $_POST['nameoncard'];

    $gross_total = bayview_total_cottages_price();
    $cart_data = $_SESSION['data_for_cart'];
    // print_r($cart_data);die;
    if ($user_id != 0) {
        $inserted = $wpdb->insert(
                $payment_table, array(
            'user_id' => $user_id,
            'fname' => $fname,
            'lname' => $fname,
            'address1' => $address1,
            'address2' => $address2,
            'country' => $country,
            'postal_code' => $postal_code,
            'city' => $city,
            'state' => $state,
            'mobile_phone' => $mobile_phone,
            'alt_phone' => $alt_phone,
            'card_type' => $card_type,
            'card_security' => $securitycode,
            'card_number' => $card_number,
            'card_exp' => $card_expire,
            'card_name' => $nameoncard,
            'gross_total' => $gross_total,
            'created' => date('Y-m-d H:i:s')
                ), array(
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s'
                )
        );


        $payinfo_id = $wpdb->insert_id;

        foreach ((array) $cart_data as $key => $cart_value) {

            $addons = json_encode($cart_value['addons']);

            $cart_value['arrival_date'] = date('Y-m-d', strtotime($cart_value['arrival_date']));
            $cart_value['depature_date'] = date('Y-m-d', strtotime($cart_value['depature_date']));

            $query = "INSERT INTO `" . $booking_table . "` (cottage_id,user_id,p_id,cottage_total,addons,cottage_arrival_date,cottage_departure_date,cottage_status,people) VALUES ({$cart_value['cottage_Id']},$user_id, $payinfo_id, '$cart_value[total]', '$addons', '$cart_value[arrival_date]', '$cart_value[depature_date]', 1, '$cart_value[people]')";
            $prepared_query = $wpdb->query($query);
        }

        unset($_SESSION['data_for_cart']);
        return true;
    }
    return false;
}

function bayview_total_cottages_price() {
    $cart_data = $_SESSION['data_for_cart'];
    $price = 0;
    foreach ((array) $cart_data as $key => $value) {
        $price += $value['total'];
    }
    return $price;
}

function my_new_user_notification($user_id, $plaintext_pass = '') {

    $user = new WP_User($user_id);

    $user_login = stripslashes($user->user_login);
    $user_email = stripslashes($user->user_email);
    $body_head = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Registration Email</title>
    </head>
    <body>';
    $body_foot = '</body></html>';


    $message = get_option("bayview_welcome_email", "");

    if (empty($message)) {

        $message = 'Login Details:\n';
        $message .= 'Username: ##USERNAME## \n';
        $message .= 'Password: ##PASSWORD## \n';
        $message .= 'Blog Name: ##BLOGNAME## \n';
        $message .= 'Site URl: ##SITEURL## \n';
        $message .= 'login URl: ##LOGINURL## \n';
        $message .= 'Useremail: ##USEREMAIL## \n';
    }

    $find = array('/##USERNAME##/i', '/##PASSWORD##/i', '/##BLOGNAME##/i', '/##SITEURL##/i', '/##LOGINURL##/i', '/##USEREMAIL##/i', '/##WEBSITE##/i');
    $replace = array($user_login, $plaintext_pass, get_settings('blogname'), get_settings('siteurl'), get_settings('siteurl') . '/wp-login.php', $user_email, get_settings('siteurl') . '/wp-login.php');

    
	$headers = "MIME-Version: 1.0\n" .
            "Content-Type: text/plain; charset=\"" . get_settings('blog_charset') . "\"\n" .
            "From: " . get_settings('admin_email') . "\n" .
            "CC: " . get_settings('admin_email') . "\n";		

    $subject = "Welcome to " . get_settings('blogname')  ;
    $subject = preg_replace($find, $replace, $subject);
    $subject = preg_replace("/##.*##/", "", $subject); //get rid of any remaining variables


    $message = preg_replace($find, $replace, $message);
    $message = preg_replace("/##.*##/", "", $message); //get rid of any remaining variables
    $message = $body_head . $message . $body_foot;
    	
	/**echo $user_email . "<br>";
	echo $subject ."<br>";
	echo $message ."<br>";
	echo $headers."<br>";
	die("I AM HERER"); **/
	    
	$message = $body_head . $message . $body_foot;
    add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
	
    wp_mail($user_email, $subject, $message, $headers);


}

global $last_booking_id;
$last_booking_id = -1;

function confirmation_email_notification($status, $booking_id) {
    global $last_booking_id, $wpdb;   
    
    
    $booking = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}bookinglog` WHERE `ID` = $booking_id");
    $user = new WP_User($booking[0]->user_id);
	$user_info = get_userdata($booking[0]->user_id);
    $name = ucfirst($user_info-> user_firstname ." ".$user_info-> user_lastname);

    $last_booking_id = $booking[0]->ID;
    $cottage_id = $booking[0]->cottage_id;
    $cottage_title = get_the_title($cottage_id);   
    $booking_Arrival = $booking[0]->cottage_arrival_date;
    $booking_departure = $booking[0]->cottage_departure_date;
	$nights = round((strtotime($booking_departure) - strtotime($booking_Arrival))/86400, 0);
	$cottage_total = $booking[0]->cottage_total;
	$people = $booking[0]->people;	
	


	
    $user_login = stripslashes($user->user_login);
    $user_email = stripslashes($user->user_email); 
    


    $status_got = '';
	$sub ='';
    $message = get_option("bayview_confirmation_email", "");
    switch ($status) {
        case '0':
            $status_got = 'Pending';
			$sub = " Pending ";
            $message = get_option("bayview_booking_email", TRUE);
            break;
        case '1':
            $status_got = 'Approved';
			$sub = " Confirmation ";
            $message = get_option("bayview_confirmation_email", TRUE);
            break;
        case '-1':
            $status_got = 'Canceled';
			$sub = " Cancellation ";
            $message = get_option("bayview_cancellation_email", TRUE);
            break;
    }
    $body_head = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Booking Status email</title>
    </head>
    <body>';
    $body_foot = '</body></html>';



    if (empty($message)) {

        $message = 'THANK YOU!\n
\n
Your request has been processed.  We will contact you within\n
48 hours to confirm your reservation.\n
\n
Request No.  ODR-' . $last_booking_id . '\n
Please write down the request number!\n
\n
All reservations are subject to approval by the Resort.\n';
    }

    $find = array('/##BOOKINGSTATUS##/i', '/##COTTAGENAME##/i', '/##ARRIVALDATE##/i', '/##DEPARTUREDATE##/i', '/##USERNAME##/i', '/##BLOGNAME##/i', '/##SITEURL##/i', '/##LOGINURL##/i', '/##USEREMAIL##/i', '/##WEBSITE##/i', '/##REQUESTNO##/i', '/##COST##/i', '/##PERSON##/i', '/##COTTAGENAME##/i', '/##NIGHTS##/i', '/##NAME##/i');
    $replace = array($status_got, get_post($cottage_id)->post_title, $booking_Arrival, $booking_departure, $user_login, get_settings('blogname'), get_settings('siteurl'), get_settings('siteurl') . '/wp-login.php', $user_email, get_settings('siteurl') . '/wp-login.php', $last_booking_id,$cottage_total,$people,$cottage_title,$nights,$name);
 
    $headers = "MIME-Version: 1.0\n" .
            "Content-Type: text/plain; charset=\"" . get_settings('blog_charset') . "\"\n" .
            "From: " . get_settings('admin_email') . "\n" .
            "CC: " . get_settings('admin_email') . "\n";

    $subject = "Booking".$sub."at ". get_settings('blogname') ;
    $subject = preg_replace($find, $replace, $subject);
    $subject = preg_replace("/##.*##/", "", $subject); //get rid of any remaining variables


    $message = preg_replace($find, $replace, $message);
    $message = preg_replace("/##.*##/", "", $message); //get rid of any remaining variables
    $message = $body_head . $message . $body_foot;
    add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
    wp_mail($user_email, $subject, $message, $headers);
}

function send_offline_email_notification($user_id, $booking_id) {
    global $last_booking_id,$wpdb;;
    $user = new WP_User($user_id);

  $booking = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}bookinglog` WHERE `ID` = $booking_id");
  $purchase = $wpdb->get_row("SELECT * FROM `{$wpdb->prefix}payment` WHERE `ID` = {$booking[0]->p_id}");
    $user = new WP_User($booking[0]->user_id);
	$user_info = get_userdata($booking[0]->user_id);
	$name = ucfirst($purchase->fname." ".$purchase->lname);

    $last_booking_id = $booking[0]->ID;
    $cottage_id = $booking[0]->cottage_id;
    $cottage_title = get_the_title($cottage_id);   
    $booking_Arrival = $booking[0]->cottage_arrival_date;
    $booking_departure = $booking[0]->cottage_departure_date;
	$nights = round((strtotime($booking_departure) - strtotime($booking_Arrival))/86400,0);
	$cottage_total = $booking[0]->cottage_total;
	$people = $booking[0]->people;	
	
	
    $user_login = stripslashes($user->user_login);
    $user_email = stripslashes($user->user_email);

    $body_head = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Booking Email</title>
    </head>
    <body>';
    $body_foot = '</body></html>';

    $message = get_option("bayview_confirmation_email", "");

    if (empty($message)) {

        $message = 'THANK YOU!\n
\n
Your request has been processed.  We will contact you within\n
48 hours to confirm your reservation.\n
\n
Request No.  ODR-' . $last_booking_id . '\n
Please write down the request number!\n
\n
All reservations are subject to approval by the Resort.\n';
    }
  $find = array('/##BOOKINGSTATUS##/i', '/##COTTAGENAME##/i', '/##ARRIVALDATE##/i', '/##DEPARTUREDATE##/i', '/##USERNAME##/i', '/##BLOGNAME##/i', '/##SITEURL##/i', '/##LOGINURL##/i', '/##USEREMAIL##/i', '/##WEBSITE##/i', '/##REQUESTNO##/i', '/##COST##/i', '/##PERSON##/i', '/##COTTAGENAME##/i', '/##NIGHTS##/i', '/##NAME##/i');
    $replace = array($status_got, get_post($cottage_id)->post_title, $booking_Arrival, $booking_departure, $user_login, get_settings('blogname'), get_settings('siteurl'), get_settings('siteurl') . '/wp-login.php', $user_email, get_settings('siteurl') . '/wp-login.php', $last_booking_id,$cottage_total,$people,$cottage_title,$nights,$name);
 
  
    $headers = "MIME-Version: 1.0\n" .
            "Content-Type: text/plain; charset=\"" . get_settings('blog_charset') . "\"\n" .
            "From: " . get_settings('admin_email') . "\n" .
            "CC: " . get_settings('admin_email') . "\n";

    $subject = "Booking Confirmation at " . get_settings('blogname') ;
    $subject = preg_replace($find, $replace, $subject);
    $subject = preg_replace("/##.*##/", "", $subject); //get rid of any remaining variables


    $message = preg_replace($find, $replace, $message);
    $message = preg_replace("/##.*##/", "", $message); //get rid of any remaining variables
    $message = $body_head . $message . $body_foot;
    add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
    wp_mail($user_email, $subject, $message, $headers);
}

function send_booking_email_notification($user_id) {
    global $last_booking_id;
    $last_booking_id = get_user_meta($user_id, '_last_booking_id', true);
    delete_user_meta($user_id, '_last_booking_id');
    $user = new WP_User($user_id);

    $user_login = stripslashes($user->user_login);
    $user_email = stripslashes($user->user_email);

    $body_head = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Booking Email</title>
    </head>
    <body>';
    $body_foot = '</body></html>';

    $message = get_option("bayview_booking_email", true);

    if (empty($message)) {

        $message = 'THANK YOU!\n
\n
Your request has been processed.  We will contact you within\n
48 hours to confirm your reservation.\n
\n
Request No.  ODR-' . $last_booking_id . '\n
Please write down the request number!\n
\n
All reservations are subject to approval by the Resort.\n';
    }

    $find = array('/##USERNAME##/i', '/##PASSWORD##/i', '/##BLOGNAME##/i', '/##SITEURL##/i', '/##LOGINURL##/i', '/##USEREMAIL##/i', '/##WEBSITE##/i', '/##REQUESTNO##/i');
    $replace = array($user_login, $plaintext_pass, get_settings('blogname'), get_settings('siteurl'), get_settings('siteurl') . '/wp-login.php', $user_email, get_settings('siteurl') . '/wp-login.php', $last_booking_id);

    $headers = "MIME-Version: 1.0\n" .
            "Content-Type: text/plain; charset=\"" . get_settings('blog_charset') . "\"\n" .
            "From: " . get_settings('admin_email') . "\n" .
            "CC: " . get_settings('admin_email') . "\n";

    $subject = "Booking Confirmation at " . get_settings('blogname') ;
//    $subject = preg_replace($find, $replace, $subject);
//    $subject = preg_replace("/##.*##/", "", $subject); //get rid of any remaining variables


    $message = preg_replace($find, $replace, $message);
    $message = preg_replace("/##.*##/", "", $message); //get rid of any remaining variables
    $message = $body_head . $message . $body_foot;
    add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
    //print($headers);
  //print($user_email.$subject.$message.$headers);
   
    wp_mail($user_email, $subject, $message, $headers);
    
}

add_action('wp_ajax_bayview_update_booking_status', 'bayview_update_booking_status');

add_action('wp_ajax_nopriv_bayview_update_booking_status', 'bayview_update_booking_status');

function bayview_update_booking_status() {
    global $wpdb;

    $wpdb->last_error = null;

    $status = intval($_POST['status']);
    $booking_id = intval($_POST['booking_id']);

    $booking = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}bookinglog WHERE `ID` = $booking_id");

    $res = isValidBooking($booking->schedule_id, $booking->cottage_arrival_date, $booking->cottage_departure_date);

    if ($res !== true) {
        $wpdb->query("UPDATE {$wpdb->prefix}bookinglog SET `cottage_status` = '-1' WHERE `p_id` = $booking->p_id");
        echo json_encode(array("status" => "fail", "msg" => "Cancelling the full order #$booking->p_id because: " . str_replace(', please try for another dates.', '', $res)));
        die();
    }
    $res = true;
    $bookings = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}bookinglog WHERE `cottage_status` <= 0 AND `p_id` = $booking->p_id");

    foreach ($bookings as $cottage) {

        $res = isValidBooking($cottage->cottage_id, $cottage->cottage_arrival_date, $cottage->cottage_departure_date);

        if ($res !== true) {
            $wpdb->query("UPDATE {$wpdb->prefix}bookinglog SET `cottage_status` = '-1' WHERE `p_id` = $booking->p_id");
            echo json_encode(array("status" => "fail", "msg" => "Cancelling the full order #$booking->p_id because: " . str_replace(', please try for another dates.', '', $res)));
            die();
        }
    }


    $wpdb->query("UPDATE {$wpdb->prefix}bookinglog SET `cottage_status` = $status WHERE `ID` = $booking_id");

    if (empty($wpdb->last_error)) {
        confirmation_email_notification($status, $_POST['booking_id']);
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "fail", "msg" => $wpdb->last_error));
    }

    die;
}

add_action('wp_ajax_bayview_get_country_states', 'bayview_get_country_states_callback');

add_action('wp_ajax_nopriv_bayview_get_country_states', 'bayview_get_country_states_callback');

function bayview_get_country_states_callback() {
    global $wpdb;
    $country_id = ((!empty($_POST['country_id']) && isset($_POST['country_id'])) ? $_POST['country_id'] : 0);

    if ($country_id == 38 || $country_id == 223) {
        $query = "SELECT * FROM `{$wpdb->prefix}bayview_zone` WHERE `country_id`={$country_id}";
        $result = $wpdb->get_results($query);
        echo '<p>State</p>';
        echo '<select class = "select-style1" name = "select_state">';


        foreach ((array) $result as $state) {
            echo '<option value="' . $state->name . '" >' . $state->name . '</option>';
        }
        echo '</select>';
        die();
    } elseif (is_numeric($country_id)) {
        $query = "SELECT * FROM `{$wpdb->prefix}bayview_zone` WHERE `country_id`={$country_id}";
        $result = $wpdb->get_results($query);
        echo '<p>State</p>';
        echo '<select class = "select-style1" name = "select_state">';


        foreach ((array) $result as $state) {
            echo '<option value="' . $state->name . '" >' . $state->name . '</option>';
        }
        echo '</select>';
        die();
    } else {
        echo '<p>State</p>';
        echo '<input type="text" name="select_state" value="" class="input_style" required="required"/>';
        die();
    }
}

add_action('wp_ajax_bayview_profile_country_states', 'bayview_profile_country_states_callback');

function bayview_profile_country_states_callback() {
    global $wpdb;
    $country_id = ((!empty($_POST['country_id']) && isset($_POST['country_id'])) ? $_POST['country_id'] : 0);

    if ($country_id == 38 || $country_id == 223) {
        $query = "SELECT * FROM `{$wpdb->prefix}bayview_zone` WHERE `country_id`={$country_id}";
        $result = $wpdb->get_results($query);

        echo '<select class = "select-style1" name = "select_state">';


        foreach ((array) $result as $state) {
            echo '<option value="' . $state->name . '" >' . $state->name . '</option>';
        }

        die();
    } elseif (is_numeric($country_id)) {
        $query = "SELECT * FROM `{$wpdb->prefix}bayview_zone` WHERE `country_id`={$country_id}";
        $result = $wpdb->get_results($query);

        echo '<select class = "select-style1" name = "select_state">';


        foreach ((array) $result as $state) {
            echo '<option value="' . $state->name . '" >' . $state->name . '</option>';
        }
        echo '</select>';
        die();
    } else {

        echo '<input type="text" name="select_state" value="" class="input_style" required="required"/>';
        die();
    }
}

function getDiscountedPrice($price, $discount) {

    $percentage = false;
    if ($discount[strlen($discount) - 1] == '%') {
        $discount = intval(substr($discount, 0, strlen($discount) - 1));
        $percentage = true;
    }

    if ($percentage) {
        $price -= $price * ($discount / 100.0);
    } else {
        $price -= $discount;
    }

    return $price;
}

function findOffers($date = '', $nights = 0, $available_cottages = array()) {
    global $wpdb;

    $args = array('post_type' => 'offer', 'posts_per_page' => -1);

    if (!empty($date)) {
        if (empty($args['meta_query']))
            $args['meta_query'] = array();
        $args['meta_query'][] = array(
            'key' => '_end_date',
            'value' => date('Y-m-d', strtotime($date)),
            'compare' => '>=',
            'type' => 'DATE'
        );
    }

    if (!empty($nights)) {
        if (empty($args['meta_query']))
            $args['meta_query'] = array();

        if (is_array($nights)) {
            $args['meta_query'][] = array(
                'key' => '_nights',
                'value' => array(next($nights), next($nights)),
                'compare' => 'BETWEEN',
                'type' => 'UNSIGNED'
            );
        } else {
            $args['meta_query'][] = array(
                'key' => '_nights',
                'value' => $nights,
                'compare' => '=',
                'type' => 'UNSIGNED'
            );
        }
    }


    //print_r($args);

    $dboffers = get_posts($args);

    //print_r($dboffers);

    if (!empty($available_cottages)) {

        if (!is_array($available_cottages))
            $available_cottages = array($available_cottages);

        $offers = array();

        foreach ($dboffers as $dboffer) {

            $offer_cottages = get_post_meta($dboffer->ID, '_cottages', true);
            $offer_cottages = explode(',', $offer_cottages);
            $passed = true; // a flag to check if all the cottages linked with offer are available cottages or not...first lets set it to true.
            foreach ($offer_cottages as $offer_cottage) {
                if (!in_array($offer_cottage, $available_cottages)) {
                    $passed = false;
                    break;
                }
            }
            if ($passed) {
                $offers[$dboffer->ID] = $dboffer;
            }
        }
    } else {
        $offers = $dboffers;
    }

    return $offers;
}

function findCottages($arrival, $departure = '', $people = '') {

    $cottages_available = getScheduleCottages(null, $arrival, $departure);
    if (!empty($cottages_available)) {
        $args = array(
            'post_type' => 'cottage',
            'post__in' => $cottages_available,
            'posts_per_page' => -1,
            'meta_query' => array(array(
                    'key' => '_people',
                    'compare' => '>=',
                    'value' => $people,
                    'type' => 'numeric',
                )
            )
        );

//    if (!empty($booked_cottages)) {
//        $args['post__not_in'] = $booked_cottages;
//    }

        $cottages = get_posts($args);

        if (empty($departure)) {

            foreach ($cottages as $key => $cottage) {
                $cottages[$key]->available_for = getCottageAvailability($cottage->ID, $arrival);
            }
        }
        return $cottages;
    }
    return ;
    
}

function getCottageAvailability($cottage_id, $date) {
    global $wpdb;
    $cottage_id = intval($cottage_id);
    $date = date('Y-m-d', strtotime($date));
    $available_nights = $wpdb->get_var("SELECT MIN(DATEDIFF(`cottage_arrival_date`, '$date')) as nights FROM {$wpdb->prefix}bookinglog WHERE `cottage_id` = $cottage_id AND `cottage_status` > 0 ");
    if (empty($available_nights))
        $available_nights = -1;
    return $available_nights;
}

add_action('wp_ajax_bayview_find_offers_and_cottages', 'bayview_find_offers_and_cottages');

//add_action('wp_ajax_nopriv_bayview_find_offers', 'bayview_find_offers');

function bayview_find_offers_and_cottages() {
    $arrival = $_POST['arrival_date'];
    $departure = $_POST['departure_date'];
    $people = $_POST['people'];

    if (empty($arrival) || strtotime($arrival) < strtotime(date('Y-m-d'))) {
        echo json_encode(array('status' => 'error', 'result' => null, 'msg' => 'The Arrival Date you entered is Invalid. Please select the current or upcoming date.'));
        die;
    }

    $nights = 0;

    $cottage_ids = array();

    if (!empty($departure)) {
        if (strtotime($departure) < strtotime($arrival)) {
            echo json_encode(array('status' => 'error', 'result' => null, 'msg' => 'Departure date cannot be before the arrival date! Please make sure that it`s after the arrival date.'));
            die;
        }
        $nights = floor((strtotime($departure) - strtotime($arrival)) / (3600 * 24)) + 1;

        $_cottages = findCottages($arrival, $departure, $people);
    } else {
        $_cottages = findCottages($arrival, $departure = '', $people);
    }

    if (!empty($_cottages)) {
        foreach ($_cottages as $cottage) {
            $cottage_ids[] = $cottage->ID;
        }
    }

    $cottages = array(); // available cottages array for json encoding
    $offer_cottage_data = array(); // for storing some of the cottage data required for preparing offers array..


    foreach ($_cottages as $cottage) {
        $c = array();
        $c['title'] = $cottage->post_title;
        $offer_cottage_data[$cottage->ID]['title'] = $c['title'];
        $c['img'] = get_the_post_thumbnail($cottage->ID, 'cottage-slider-thumb', array('style' => 'float:left;margin: 5px'));
        $c['id'] = $cottage->ID;

        $meta = get_post_meta($cottage->ID);

        if (!empty($departure)) {
            $c['price'] = getCottagePrice($cottage->ID, $meta['_nightly_rate'][0], $arrival, $departure, true);
            $offer_cottage_data[$cottage->ID]['price'] = $c['price'];
        } else {
            $c['price'] = 0;
            $c['availability'] = $cottage->available_for;
        }
        $c['people'] = intval($meta['_people'][0]);

        $offer_cottage_data[$cottage->ID]['people'] = $c['people'];

        $cottages[] = $c;
    }


    $_addons = get_posts(array(
        'post_type' => 'addon',
        'posts_per_page' => -1,
            ));

    $addons = array();

    foreach ($_addons as $addon) {
        $a = array();
        $a['title'] = $addon->post_title;
        $a['img'] = get_the_post_thumbnail($addon->ID, 'cottage-slider-thumb', array('style' => 'float:left;margin: 5px'));
        $a['id'] = $addon->ID;
        $a['price'] = get_post_meta($addon->ID, '_price', true);
        $addons[] = $a;
    }

    echo json_encode(array(
        'status' => 'success',
        'offers' => $offers,
        'cottages' => $cottages,
        'addons' => $addons
    ));

    die;
}

add_action('admin_head', 'admin_offline_punching');

function admin_offline_punching() {
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.payment.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function(){ 
            if(jQuery('#billinginfo_form')) {
                var flag = false;                    
                jQuery('#cardno').payment('formatCardNumber');
                jQuery('#card_expire').payment('formatCardExpiry');
                jQuery('#securitycode').payment('formatCardCVC');
            }
        });
    </script>
    <?php
}

add_action('admin_enqueue_scripts', 'add_bayview_js');

function add_bayview_js() {
    wp_enqueue_script('offer_validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'));
    wp_enqueue_script('bayview_script_js', get_template_directory_uri() . '/js/bayview-script.js');
    wp_enqueue_style('bayview_admin_css', get_template_directory_uri() . '/css/bayview-style.css');
}
?>
