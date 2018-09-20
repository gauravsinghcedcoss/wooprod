<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       ced_product_plug
 * @since      1.0.0
 *
 * @package    Ced_product_plug
 * @subpackage Ced_product_plug/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ced_product_plug
 * @subpackage Ced_product_plug/admin
 * @author     cedcoss <test@cedcoss.com>
 */
class Ced_product_plug_Admin {

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
		add_action('admin_menu', array($this,'ced_register_product_menu_page'));
		add_action('wp_ajax_nopriv_deleteorder', array($this,'deleteorder'));
		add_action('wp_ajax_deleteorder', array($this,'deleteorder'));
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
		 * defined in Ced_product_plug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_product_plug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ced_product_plug-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		//wp_enqueue_style( $this->plugin_name.'editor', plugin_dir_url( __FILE__ ) . 'css/editor.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'datatables', 'https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), $this->version, 'all' );

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
		 * defined in Ced_product_plug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_product_plug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ced_product_plug-admin.js', array( 'jquery' ), $this->version, false );
				wp_enqueue_script( $this->plugin_name.'bootstrap2', plugin_dir_url( __FILE__ ) . 'js/popper.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'bootstrap1', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'datatables', 'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'tiny', 'https://cloud.tinymce.com/stable/tinymce.min.js', array( 'jquery' ), $this->version, false );
		//wp_enqueue_script( $this->plugin_name.'editor', plugin_dir_url( __FILE__ ) . 'js/editor.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	}

	public function ced_register_product_menu_page() {
		add_menu_page('All products', 'All products', 'manage_options', 'all-products', array($this,'_custom_listing_products'), 10);
		add_submenu_page('all-products', 'Submenu Page Title', 'All products', 'manage_options', 'all-products' );
		add_submenu_page('all-products', 'Submenu Page Title3', 'Add new product', 'manage_options', 'add-new-product', array($this,'_ced_custom_submenu_page_create_product') );
		//custom subpage for plugin
		add_submenu_page('all-products', 'Submenu Page Title3', '', 'manage_options', 'my-product-single', array($this,'_ced_custom_submenu_page_product_single') );
	}
	public function _custom_listing_products() {
		include_once 'partials/ced_product_plug-product-list-display.php';
	}
	public function _ced_custom_submenu_page_create_product() {
		include_once 'partials/ced_product_plug-addnew-product.php';
	}
	public function _ced_custom_submenu_page_product_single() {
		include_once 'partials/ced_product_plug-product-list-single.php';
	}
	public function deleteorder() {
		 $ceditem_id = $_POST['current_order_id'];
		wp_delete_post($ceditem_id,true);
		//wc_delete_order_item( $ceditem_id );
	}

}
