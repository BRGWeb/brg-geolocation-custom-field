<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://brgweb.com.br/wordpress/plugins/brg-geolocation-custom-field
 * @since      0.1.0
 *
 * @package    BRG_GCF
 * @subpackage BRG_GCF/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    BRG_GCF
 * @subpackage BRG_GCF/admin
 * @author     BRGWeb <wordpress@brgweb.com.br>
 */
class BRG_GCF_Admin {

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
	 * The post-types that will receive the GCF.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      array    $gcf_post_types    The post-types that will receive the GCF.
	 */
	private $gcf_post_types;
	
	
	/**
	 * Google Maps API Key.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $gmaps_key    Google Maps API Key.
	 */
	private $gmaps_key;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @param      string    $brg_gcf       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 * @param      array     $gcf_post_types    The post-types that will receive the GCF.
	 * @param      string    $gmaps_key    Google Maps API Key.
	 */
	public function __construct( $brg_gcf, $version, $gcf_post_types, $gmaps_key ) {

		$this->brg_gcf = $brg_gcf;
		$this->version = $version;
		$this->gcf_post_types = $gcf_post_types;
		$this->gmaps_key = $gmaps_key;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_styles() {

		//main plugin css
		wp_enqueue_style( $this->brg_gcf, plugin_dir_url( __FILE__ ) . 'css/brg-gcf-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts($hook) {
		//check if it's an edit screen
		if ('post-new.php' === $hook || 'post.php' === $hook){
			global $post;		
			//check if it's the post-type we want
					
			if (in_array($post->post_type, $this->gcf_post_types)){
				$handler = $this->brg_gcf . '_js';
				//main plugin js
				wp_register_script( $handler , plugin_dir_url( __FILE__ ) . 'js/brg-gcf-admin.js', array( 'jquery' ), $this->version, false );
				//TODO bring map center and map zoom from plugin options
				//map options
				$options = array(
					"zoom" => 16,
					"center" => array(
						"lat" => -26.9195452,
						"lng" => -49.0686387,
						),
				);
				//localize options
				wp_localize_script( $handler, 'mapOptions', $options );
				//google maps plugin with callback to edit function in main plugin file
				wp_enqueue_script('gmaps_api','https://maps.googleapis.com/maps/api/js?key='.$this->gmaps_key.'&callback=editMap', array($handler), null, true);
			}
		}
	}

	/**
	 * Register the metabox for map edit
	 *
	 * @since    0.1.0
	 */

	function register_meta_boxes() {
		add_meta_box( 'brg-gcf-metabox', __( 'Locals', 'textdomain' ), array($this, 'display_metabox'), $this->gcf_post_types );
	}
	
 
	/**
	 * Meta box display callback.
	 *
	 * @param WP_Post $post Current post object.
	 */
	function display_metabox( $post ) {
		echo '<div id="locals_wrapper"></div>';
		// Retrieve locals saved in database
        $value = get_post_meta( $post->ID, '_brg_gcf_locals', true );
		if ($value){
			$id = 1;
			foreach ($values as $value){
				echo '<div class="local_wrap"><p>Local '.$id.'<div class="local-input-wrap"><input class="local" name="local['.$id.'][address]" data-marker="'.$id.'" type="textbox" placeholder="Local"><input name="local['.$id.'][title]" type="textbox" placeholder="Title"> <input name="local['.$id.'][description]" type="textbox" placeholder="Description"><input name="local['.$id.'][lat]" id="lat'.$id.'" type="hidden" value="0"><input id="lng'.$id.'" name="local['.$id.'][lng]" type="hidden" value="0"></p></div></div>';
			}
		}
		echo '<a id="addlocal">Novo Local</a>';
		echo '<div id="map-canvas" style="height:90%;"></div>';
		// Add an nonce field so we can check for it later.
        wp_nonce_field( 'brg_gcf_metabox', 'brg_gcf_nonce' ); 
	}
 
	/**
	 * Save meta box content.
	 *
	 * @param int $post_id Post ID
	 */
	function brg_gcf_save_local( $post_id ) {
		var_dump ($_POST);
		exit;
	}
	
}
