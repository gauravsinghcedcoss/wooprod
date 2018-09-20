<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       ced
 * @since      1.0.0
 *
 * @package    Ced_plug
 * @subpackage Ced_plug/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ced_plug
 * @subpackage Ced_plug/admin
 * @author     cedcoss <cedcoss@test.com>
 */
class Ced_plug_Admin {

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

		add_action('admin_menu', array($this,'ced_register_custom_order_menu_page'));
		add_action('wp_ajax_nopriv_deleteorder', array($this,'deleteorder'));
		add_action('wp_ajax_deleteorder', array($this,'deleteorder'));
		//add_action('admin_menu', array($this,'ced_register_custom_order_submenu_page'));

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
		 * defined in Ced_plug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_plug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ced_plug-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'datatables', 'https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css', array(), $this->version, 'all' );

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
		 * defined in Ced_plug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_plug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ced_plug-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'bootstrap2', plugin_dir_url( __FILE__ ) . 'js/popper.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'bootstrap1', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'datatables', 'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );

    		wp_localize_script( $this->plugin_name, 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	}

	public function ced_register_custom_order_menu_page() {
	    //add_menu_page('Create orders', 'Create orders', 'manage_options', 'create-orders', array($this,'_custom_product_page'), 12); 
		add_menu_page('Create orders', 'Create orders', 'manage_options', 'create-order', array($this,'_custom_product_page'), 12); 
    	add_submenu_page('create-order', 'Submenu Page Title', 'Add new order', 'manage_options', 'create-order' );
    	add_submenu_page('create-order', 'Submenu Page Title2', 'All Orders', 'manage_options', 'my-orders', array($this,'_ced_custom_submenu_page') );
    	add_submenu_page('create-order', 'Submenu Page Title3', '', 'manage_options', 'my-order-details', array($this,'_ced_custom_submenu_page_order_details') );
	}

	public function _ced_custom_submenu_page() {
		include_once "partials/ced_plug-admin-display_orders.php";
	}
	public function _ced_custom_submenu_page_order_details() {
		include_once "partials/ced_plug-admin-order-details.php";
	}
	
	public function deleteorder() {
		 $ceditem_id = $_POST['current_order_id'];
		wp_delete_post($ceditem_id,true);
		//wc_delete_order_item( $ceditem_id );
	}

	public function _custom_product_page() {
		$query = new WC_Product_Query( array(
	    'limit' => 10,
	    'orderby' => 'date',
	    'order' => 'DESC',
	    'return' => 'ids',
	) );
	$products = $query->get_products(); ?>
    <div class="ced_form_design_orders container">
        <h2 class="text-center">Create orders:</h2>
        <form method="post">
        	<div class="ced_section1">
            <h4>Product selection:</h4>
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="prods1">Product1:</label>
                    <select class="form-control" name="prods1" id="prods1">
                        <?php foreach ($products as $product_id) {
		 	// Get latest 3 products.
		$allproducts = wc_get_product($product_id);
		 					echo '<option value="'.$product_id.'">'.$allproducts->get_name().'</option>';
		 					}
		 					?>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="prods1">Product Quantity:</label>
                    <input class="form-control" type="number" name="qty1" placeholder="quantity">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="prods2">Product2:</label>
                    <select class="form-control" name="prods2" id="prods2">
                        <?php foreach ($products as $product_id) {
		 	// Get latest 3 products.
		$allproducts = wc_get_product($product_id);
		 					echo '<option value="'.$product_id.'">'.$allproducts->get_name().'</option>';
		 					}
		 					?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="prods1">Product Quantity:</label>
                    <input class="form-control" type="number" name="qty2" placeholder="quantity">
                </div>
            </div>
            </div>
            <div class="ced_section2">
            <h4>Billing/Shipping details:</h4>
            <div class="row">
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="first_name" value="" placeholder="first name">
                </div>
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="last_name" value="" placeholder="last name">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="address_1" value="" placeholder="address 1">
                </div>
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="address_2" value="" placeholder="address 2">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="address_1" value="" placeholder="address 1">
                </div>
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="address_2" value="" placeholder="address 2">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="company" value="" placeholder="company">
                </div>
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="email" value="" placeholder="email">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="phone" value="" placeholder="phone">
                </div>
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="state" value="" placeholder="state">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="country" value="" placeholder="country">
                </div>
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="city" value="" placeholder="city">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="postcode" value="" placeholder="post code">
                </div>
                <div class="form-group col-md-6">

                </div>
            </div>
            </div>
            <div class="ced_section3">
            <h4>Other details:</h4>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Order Status:</label>
                    <select class="form-control" name="order_status" id="order_status">
                        <option value="wc-pending">Pending payment</option>
                        <option value="wc-processing">Processing</option>
                        <option value="wc-on-hold">On hold</option>
                        <option value="wc-completed">Completed</option>
                        <option value="wc-cancelled">Cancelled</option>
                        <option value="wc-refunded">Refunded</option>
                        <option value="wc-failed">Failed</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Available gateways:</label>
                    <select class="form-control" name="payment_method" id="payment_method">
                        <?php
	           	 $available_gateways = WC()->payment_gateways->get_available_payment_gateways();
	            foreach ($available_gateways as $available_gatewaysa) {
	            	echo '<option value="'.$available_gatewaysa->id.'">'.$available_gatewaysa->id.'</option>';
	            }
            ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Customer note:</label>
                    <textarea class="form-control" name="note" id="note" placeholder="customer note"></textarea>
                </div>
                <div class="form-group col-md-6">

                </div>
            </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <input class="btn btn-primary" type="submit" name="createord" name="createord" value="create order">
                </div>
            </div>

        </form>
    </div>

    <?php
		if(isset($_POST['createord'])) {
		global $woocommerce;
		$prodid1 = $_POST['prods1'];
		$prodid2 = $_POST['prods2'];
		$qty1 = $_POST['qty1'];
		$qty2 = $_POST['qty2'];
		$note = $_POST['note'];
		$order_status = $_POST['order_status'];
		$cedpayment_method = $_POST['payment_method'];
  $address = array(
      'first_name' => $_POST['first_name'],
      'last_name'  => $_POST['last_name'],
      'company'    => $_POST['company'],
      'email'      => $_POST['email'],
      'phone'      => $_POST['phone'],
      'address_1'  => $_POST['address_1'],
      'address_2'  => $_POST['address_2'],
      'city'       => $_POST['city'],
      'state'      => $_POST['state'],
      'postcode'   => $_POST['postcode'],
      'country'    => $_POST['country']
 );
if(!empty($prodid1) && !empty($prodid2) && !empty($qty1) && !empty($qty2) && !empty($note) && !empty($order_status) && !empty($cedpayment_method) && !empty($address)) {
	echo '<script>alert("Order created successfully");</script>';
        $order = wc_create_order();

		$order->add_product( wc_get_product($prodid1), $qty1 ); //(get_product with id and next is for quantity)
		$order->add_product( wc_get_product($prodid2), $qty2 ); //(get_product with id and next is for quantity)
        $order->set_status($order_status);
       // $order->add_order_note( $note );
        $order->set_customer_note($note); 
        $order->set_payment_method($cedpayment_method);
        $order->set_address( $address, 'billing' );
        $order->set_address( $address, 'shipping' );
        $order->add_coupon( sanitize_text_field( 'fresher' ));
        $order->calculate_totals();
       // die();
    }
else {
	echo '<script>alert("Please fill all the fields");</script>';
}
}	 
	}
}