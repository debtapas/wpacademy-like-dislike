<?php
	/**
	 * Plugin Name:       wpacademy-like-dislike
	 * Plugin URI:        https://www.youtube.com/watch?v=po4I8Hq4qns
	 * Description:       Handle the basics with this plugin.
	 * Version:           1.0.0
	 * Requires at least: 5.2
	 * Requires PHP:      7.2
	 * Author:            Tapas Deb
	 * Author URI:        https://github.com/wpacademy/wpac-like-system
	 * License:           GPL
	 * Text-domain:		  wpaclike
	 */

	//if this file is called directly, abort
	if (!defined('WPINC')) {
		die;
	}

	if (!defined(('WPAC_PLUGIN_VERSION'))) {
		define('WPAC_PLUGIN_VERSION', '1.0.0');
	}

	if (!defined(('WPAC_PLUGIN_DIR'))) {
		define('WPAC_PLUGIN_DIR', plugin_dir_url(__FILE__)); // Plugin file path		
		//define('WPAC_PLUGIN_DIR', plugin_dir_path( __FILE__ )); // url
		
	}

	if (!function_exists('wpac_plugin_scripts')) {
		function wpac_plugin_scripts(){

			//plugin Frontend CSS
			wp_enqueue_style('wpac-css', WPAC_PLUGIN_DIR . 'assets/css/plugin-style.css');

			//Plugin Frontend JS
			wp_enqueue_script('wpac-js', WPAC_PLUGIN_DIR . 'assets/js/main.js', "jquery", '1.0.0', true); // true -- add in footer section

			//Plugin Ajax JS
			wp_enqueue_scripts();
		}
		add_action('wp_enqueue_scripts', 'wpac_plugin_scripts');
	}

	//Setting Menu Page HTML
	require plugin_dir_path(__FILE__). 'inc/settings.php';

	// Create table for like-dislike table
	require plugin_dir_path(__FILE__). 'inc/db.php';
	wpac_likes_table();
	

	//Create like and dislike button using filter ~~~~~
	require plugin_dir_path(__FILE__). 'inc/btns.php';