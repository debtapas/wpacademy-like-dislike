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
			wp_enqueue_style('wpac-css', WPAC_PLUGIN_DIR . 'assets/css/plugin-style.css');
			wp_enqueue_script('wpac-js', WPAC_PLUGIN_DIR . 'assets/js/main.js', "jquery", '1.0.0', true); // true -- add in footer section
		}
		add_action('wp_enqueue_scripts', 'wpac_plugin_scripts');
	}

	//Setting Menu Page HTML
	require plugin_dir_path(__FILE__). 'inc/settings.php';

	// Create table for like-dislike table
	require plugin_dir_path(__FILE__). 'inc/db.php';
	wpac_likes_table();
	

	//Create like and dislike button using filter ~~~~~
		function wpac_like_dislike_buttons($content){

			$like_btn_lebel = get_option('wpac_like_btn_label', 'Like');
			$dislike_btn_lebel = get_option('wpac_dislike_btn_label', 'Dislike');

			$like_btn_wrap = '<div class="wpac_wrap">';
			$like_btn = '<a href="javascript:;" class="wpac-btn like-btn">'.$like_btn_lebel.'</a>';	
			$dislike_btn = '<a href="javascript:;" class="wpac-btn dislike-btn">'.$dislike_btn_lebel.'</a>';
			$like_btn_wrap_end = '</div>';

			$content .= $like_btn_wrap;
			$content .= $like_btn;
			$content .= $dislike_btn;
			$content .= $like_btn_wrap_end;

			return $content;
		}
		add_filter('the_content', 'wpac_like_dislike_buttons');
	