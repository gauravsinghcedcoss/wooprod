<?php
/**
 * Plugin Name: prodtest1
 * Plugin URI: http://woocommerce.com/products/woocommerce-extension/
 * Description: Your extension's description text.
 * Version: 1.0.0
 * Author: Cedcoss
 * Author URI: http://localhost.com/
 * Developer: cedcoss team
 * Developer URI: http://localhost.com/
 * Text Domain: woocommerce-extension
 * Domain Path: /languages
 *
 * Woo: 12345:342928dfsfhsf8429842374wdf4234sfd
 * WC requires at least: 2.2
 * WC tested up to: 2.3
 *
 * Copyright: © 2009-2015 WooCommerce.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
function register_custom_product_page() {
    add_menu_page('custom products', 'custom products', 'add_users', 'custompage', '_custom_product_page', 12); 
}
add_action('admin_menu', 'register_custom_product_page');

function _custom_product_page() {
$args = array(
        'post_type'      => 'product',
        'posts_per_page' => 10,
        //'product_cat'    => 'hoodies'
    );

    $loop = new WP_Query( $args );

?>
    <div class="form_design">
    <h2>Product details</h2>
        <form method="post">
            <div>
               <label for="prods">All products:</label>
               <select name="prods" id="prods">
<?php
while ( $loop->have_posts() ) : $loop->the_post();
        global $product;
?>
                <option value="<?php echo get_the_ID(); ?>"><?php echo get_the_title() ?><option>
<?php
endwhile;
wp_reset_query();
?>
               </select>
            </div>
            <div>

           </div>
           <input type="text" name="first_name" value="" placeholder="first name">
            <input type="text" name="last_name" value="" placeholder="last name">
            <input type="text" name="company" value="" placeholder="company">
            <input type="text" name="email" value="" placeholder="email">
            <input type="text" name="phone" value="" placeholder="phone">
            <input type="text" name="address_1" value="" placeholder="address 1">
            <input type="text" name="address_2" value="" placeholder="address 2"> 
            <input type="text" name="city" value="" placeholder="city">
            <input type="text" name="state" value="" placeholder="state">
            <input type="text" name="country" value="" placeholder="country">
            <input type="text" name="postcode" value="" placeholder="post code">
           <input type="submit" name="createord" name="createord" value="create order">
        </form>
    </div>
<?php  
}

