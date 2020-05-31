<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/DevWael
 * @since      1.0.0
 *
 * @package    Wclp
 * @subpackage Wclp/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wclp
 * @subpackage Wclp/public
 * @author     Ahmad Wael <dev.ahmedwael@gmail.com>
 */
class Wclp_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wclp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wclp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wclp-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wclp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wclp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
//		wp_enqueue_script( 'location-pickerzz', 'https://cdn.jsdelivr.net/gmap3/7.2.0/gmap3.min.js', array( 'jquery' ), false, true );


		wp_enqueue_script( $this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'js/wclp-public.js',
			false, $this->version, true );


		wp_enqueue_script( 'google-mapszz',
			'https://maps.googleapis.com/maps/api/js?key=API_KEY&callback=initMap',
			false, 3, true );

	}
	function mind_defer_scripts( $tag, $handle, $src ) {
		$defer = array(
			'google-mapszz',
		);
		if ( in_array( $handle, $defer ) ) {
			return '<script src="' . $src . '" async defer type="text/javascript"></script>' . "\n";
		}

		return $tag;
	}
}
