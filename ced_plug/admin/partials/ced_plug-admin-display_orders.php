<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       ced
 * @since      1.0.0
 *
 * @package    Ced_plug
 * @subpackage Ced_plug/admin/partials
 */
?>

    <!-- This file should primarily consist of HTML with a little bit of PHP. -->
    <div class="ced_all_orders container">
        <div class="row">
<div class="cedimgloader"><img src="<?php echo plugins_url(); ?>/ced_plug/admin/images/lg.-text-entering-comment-loader.gif" width="100"></div>
            <div class="col-md-12">
                <h4>All orders</h4>
                <div class="table-responsive">

                    <table id="mytable" class="table table-bordred table-striped">

                        <thead>

                            <th>
                                <input type="checkbox" id="checkall" />
                            </th>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>View</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                        	<?php
                        	$query = new WC_Order_Query( array(
						    'limit' => -1,
						    'orderby' => 'date',
						    'order' => 'DESC',
						    'return' => 'ids',
						) );
						$orders = $query->get_orders();
						foreach($orders as $order_id) {
						$order = wc_get_order( $order_id );
             				?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="checkthis" />
                                </td>
                                <td>#<?php echo $order->get_id(); ?></td>
                                <td><?php echo $order->order_date; ?></td>
                                <td><?php echo $order->get_status(); ?></td>
                                <td><?php echo $order->get_total(); ?></td>
                                <td>
                                    
                                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                                        <button id="<?php echo $order->get_id(); ?>" href="" class="ced_view_record btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#<?php echo $order->get_id(); ?>"><span class="glyphicon glyphicon-pencil">-></span></button>
                                    </p>
                                </td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                                        <button id="<?php echo $order->get_id(); ?>" class="ced_del_order btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash">X</span></button>
                                    </p>
                                </td>

                            </tr>

  
                             <?php } ?>

                        </tbody>

                    </table>

                    <div class="clearfix"></div>

                </div>

            </div>
        </div>
    </div>


   