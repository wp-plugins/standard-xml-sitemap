<?php
/*
Plugin Name: Standard XML Sitemap Generator
Plugin URI: http://patrick.bloggles.info/
Description: Automatic generate standard XML sitemap that supports the protocol including Google, Yahoo, MSN, Ask.com, and others. No file store your disk, just generate when it need like feed.
Version: 1.0
Author: Patrick Chia
Author URI: http://blogates.com/
Donate link:https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mypatricks@gmail.com&item_name=Donate%20to%20Patrick%20Chia&item_number=1216826058&amount=5.00&no_shipping=0&no_note=1&tax=0&currency_code=USD&bn=PP%2dDonationsBF&charset=UTF%2d8&return=http://patrick.bloggles.info
*/

/*  Copyright 2008  Patrick Chia  (http://patrick.bloggles.info/ email : mypatricks@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

    Thank you for keep the credit link.
*/

function sitemap_flush_rules() {
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}

add_action('init', 'sitemap_flush_rules');

function xml_feed_rewrite($wp_rewrite) {
	$feed_rules = array(
		//'.*wp-sitemap.php$' => 'index.php?feed=sitemap',
		'.*sitemap.xml$' => 'index.php?feed=sitemap'
	);

	$wp_rewrite->rules = $feed_rules + $wp_rewrite->rules;
}

add_filter('generate_rewrite_rules', 'xml_feed_rewrite');

function do_feed_sitemap() {
	load_template( ABSPATH . WPINC . '/feed-sitemap.php' );
}

add_action('do_feed_sitemap', 'do_feed_sitemap', 10, 1);

function sitemap_robots() {
	echo "Sitemap: ".get_option('siteurl')."/sitemap.xml\n\n";
}

add_action('do_robotstxt', 'sitemap_robots');
?>