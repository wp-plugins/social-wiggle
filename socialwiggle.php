<?php
/*
Plugin Name: SocialWiggle
Plugin URI: http://fooplugins.com/plugins/socialwiggle-lite/
Description: Social Tiles With A Difference!
Version: 0.8.2
Author: Brad Vincent
Author URI: http://fooplugins.com/
License: GPL2
*/

if (!class_exists('socialwiggle')) {

	// Includes
	require_once 'includes/wp_pluginbase_v2_3.php';
	require_once 'includes/button_generator.php';
	require_once 'includes/widget.php';
	require_once 'includes/admin_settings.php';
    require_once 'includes/networks_array.php';

	class socialwiggle extends wp_pluginbase_v2_3 {
		const JS = 'socialwiggle.js';
		const JS_TABLEDND = 'jquery.tablednd.0.7.min.js';
		const CSS = 'socialwiggle.css';
		const HOMEPAGE_URL = 'http://fooplugins.com/plugins/socialwiggle-lite/';
		const PRO_URL = 'http://fooplugins.com/plugins/socialwiggle-pro/';

		function init() {
			$this->plugin_slug = 'socialwiggle';
			$this->plugin_title = 'SocialWiggle';
			$this->plugin_version = '0.8.2';

			//call base init
			parent::init();

			add_action('plugins_loaded', array(&$this, 'load_text_domain') );

			if ( is_admin() ) {
				if ($this->check_admin_settings_page()) {
					add_action('admin_head', array(&$this, 'admin_inline_content') );
				}
				add_filter('socialwiggle-settings_summary', array(&$this, 'admin_settings_summary'));
			}

			add_action( 'widgets_init', create_function( '', 'register_widget( "socwig_widget" );' ) );

            new socwig_admin_settings(true);
		}

		/**
		* Loads the plugin text domain for translation
		*/
		public function load_text_domain() {
			$locale = apply_filters( 'plugin_locale', get_locale(), $this->plugin_slug );
			load_textdomain( $this->plugin_slug, WP_LANG_DIR.'/'.$this->plugin_slug.'/'.$this->plugin_slug.'-'.$locale.'.mo' );
			load_plugin_textdomain( $this->plugin_slug, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		} // end load_text_domain

		function admin_settings_summary() {
			$html = __('For more info about SocialWiggle, please visit the <a href="%s" target="_blank">SocialWiggle homepage</a>.', 'socialwiggle');
			return sprintf($html, self::HOMEPAGE_URL);
		}

		function admin_settings_title() {
			$title = __('%s Settings (v%s)', 'socialwiggle');
			return sprintf($title, $this->plugin_title, $this->plugin_version);
		}

		function admin_plugin_row_meta($links) {
			$links[] = sprintf('<a target="_blank" href="%s"><b>%s</b></a>', self::PRO_URL, __('Upgrade to the PRO version now!', 'socialwiggle'));
			return $links;
		}

		function custom_admin_settings_render( $args = array() ) {
			extract( $args );

			if ($type == 'debug_output') {
				echo '</td></tr><tr valign="top"><td colspan="2">';
				$this->render_debug_info();
			} else if ( $type == 'demo') {
				echo '</td></tr><tr valign="top"><td colspan="2">';
				$this->render_demo();
			} else if ( $type == 'socialnetworks') {
				echo '</td></tr><tr valign="top"><td colspan="2">';
				$this->render_networks_table();
			}
		}

		function render_networks_table() {
			require_once "includes/networks_table.php";
			socwig_render_networks_table($this->get_option('networks'));
		}

		function render_debug_info() {
			echo 'Settings:<br /><pre>';
			print_r( get_option( $this->plugin_slug ) );
			echo '</pre>';
		}

		function render_demo() {
			require_once "includes/demo.php";
			$demo_style = $this->get_option('demo_style');
			$demo_wiggle = $this->get_option('demo_wiggle');
			socwig_render_demo($demo_style, $demo_wiggle);
		}

		function frontend_init() {
			add_action('wp_print_styles', array(&$this, 'inline_dynamic_css') );
		}

		function admin_print_styles() {
			parent::admin_print_styles();
			$this->frontend_print_styles();
		}

		function admin_print_scripts() {
			parent::admin_print_scripts();
			$this->register_and_enqueue_js(self::JS);
			if ( $this->check_admin_settings_page() ) {
				$this->register_and_enqueue_js(self::JS_TABLEDND);
			}
		}

		function admin_inline_content() {
			$this->inline_dynamic_css();
		}

		function frontend_print_styles() {
			//enqueue socialwiggle CSS
			$this->register_and_enqueue_css(self::CSS);
		}

		function frontend_print_scripts() {
			//put JS in footer?
			$infooter = $this->is_option_checked( 'scripts_in_footer' );

			//enqueue socialwiggle script
			$this->register_and_enqueue_js(
				$file = self::JS,
				$d = $this->get_js_depends(),
				$v = false,
				$f = $infooter);
		}

		function inline_dynamic_css() {
			//get custom CSS from the settings page
			$custom_css = $this->get_option( 'custom_css', '' );

			echo '<style type="text/css">
	' . $custom_css;
			echo '
</style>';
		}

		function get_js_depends() {
			return array('jquery');
		}
	}

	//run the plugin!
    $GLOBALS['socialwiggle'] = new socialwiggle();
}