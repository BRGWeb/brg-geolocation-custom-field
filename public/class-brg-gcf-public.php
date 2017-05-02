<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://brgweb.com.br/wordpress/plugins/brg-geolocation-custom-field
 * @since      0.1.0
 *
 * @package    BRG_GCF
 * @subpackage BR_GCF/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BRG_GCF
 * @subpackage BRG_GCF/public
 * @author     BRGWeb <wordpress@brgweb.com.br>
 */
class BRG_GCF_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $brg_gcf    The ID of this plugin.
	 */
	private $brg_gcf;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @param      string    $brg_gcf       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $brg_gcf, $version ) {

		$this->brg_gcf = $brg_gcf;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BRG_GCF_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BRG_GCF_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->brg_gcf, plugin_dir_url( __FILE__ ) . 'css/brg_gcf-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BRG_GCF_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BRG_GCF_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->brg_gcf, plugin_dir_url( __FILE__ ) . 'js/brg_gcf-public.js', array( 'jquery' ), $this->version, false );

	}

}
