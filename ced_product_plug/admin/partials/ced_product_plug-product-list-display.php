<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       ced_product_plug
 * @since      1.0.0
 *
 * @package    Ced_product_plug
 * @subpackage Ced_product_plug/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
 <div class="ced_all_orders container">
        <div class="row">
<div class="cedimgloader"><img src="<?php echo plugins_url(); ?>/ced_plug/admin/images/lg.-text-entering-comment-loader.gif" width="100"></div>
            <div class="col-md-12">
                <h4>All Products</h4>
                <div class="table-responsive">

                    <table id="mytable1" class="table table-bordred table-striped">

                        <thead>

                            <th>
                                <input type="checkbox" id="checkall" />
                            </th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Categories</th>
                            <th>Date</th>
                            <th>View</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                        	<?php
                        	$query = new WC_Product_Query( array(
      'limit' => 10,
      'orderby' => 'date',
      'order' => 'DESC',
      'return' => 'ids',
  ) );
$products = $query->get_products(); 
foreach ($products as $product_id) {
      // Get latest 3 products.
    $allproducts = wc_get_product($product_id);
             // echo '<option value="'.$product_id.'">'.$allproducts->get_name().'</option>';
              ?>

              <tr class="col<?php echo $allproducts->get_id(); ?>">
                                <td>
                                    <input type="checkbox" class="checkthis" />
                                </td>
                                <td>#<?php echo $allproducts->get_id(); ?></td>
                                <td><?php echo $allproducts->get_name(); ?></td>
                                <td><?php echo $allproducts->get_sku(); ?></td>
                                <td><?php echo $allproducts->get_stock_status(); ?></td>
                                <td><?php echo $allproducts->get_price(); ?></td>
                                <td><?php echo $allproducts->get_categories(); ?></td>
                                <td><?php echo $allproducts->get_date_created(); ?></td>
                                <td>
                                    
                                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                                        <a id="edit" href="http://192.168.0.184/woo/prodtest1/wp-admin/admin.php?page=my-product-single&pid=<?php echo $allproducts->get_id(); ?>" class="ced_view_record btn btn-primary btn-xs <?php echo $allproducts->get_id(); ?>"><span class="glyphicon glyphicon-pencil">-></span></a>
                                    </p>
                                </td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                                        <button id="<?php echo $allproducts->get_id(); ?>" class="ced_del_order btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash">X</span></button>
                                    </p>
                                </td>

                            </tr>
   

           <?php   }  ?>
             				
                            

    
                             <?php //} ?>

                        </tbody>

                    </table>

                    <div class="clearfix"></div>

                </div>

            </div>
        </div>
    </div>

