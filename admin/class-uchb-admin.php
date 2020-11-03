<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       unitycode.tech
 * @since      1.0.0
 *
 * @package    Uchb
 * @subpackage Uchb/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Uchb
 * @subpackage Uchb/admin
 * @author     jnz93 <contato@unitycode.tech>
 */
class Uchb_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// Adc menu item
		add_action('admin_menu', array($this, 'create_admin_page'));

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Uchb_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Uchb_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/uchb-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Uchb_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Uchb_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/uchb-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Create page admin of plugin
	 * 
	 * @since 1.0.0
	 */
	public function create_admin_page()
	{
		$page_title = 'Unitycode Heartbeat';
		$menu_title = 'UC Heartbeat';
		$menu_slug 	= 'uchb';
		$capability = 10;
		$icon_url 	= 'dashicons-store';
		$position 	= 10;

		add_menu_page($page_title, $menu_title, $capability, $menu_slug, array($this, 'construct_admin_page'), $icon_url, $position);
	}

	/**
	 * Construct page admin function
	 * 
	 * @since 1.0.0
	 */
	public function construct_admin_page()
	{
		echo 'Construa a página aqui';
	}
}
