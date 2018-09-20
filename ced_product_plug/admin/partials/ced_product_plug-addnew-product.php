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
<div class="ced_form_design_orders container">
        <h2 class="text-center">Create orders:</h2>
        <form method="post">
          <div class="ced_section1">
            <h4>Product Information:</h4>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="prods1">Product Title:</label>
                    <input type="text" name="cedprod_title" class="form-control" placeholder="product title">
                </div>
            </div>
          </div>
          <div class="ced_section2">
           
                <h2 class="text-left">Description:</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 nopadding">
                            <textarea name="cedprod_description" id="txtEditor"></textarea> 
                        </div>
                    </div>
                </div>
            
        </div>
        </form>
</div>

