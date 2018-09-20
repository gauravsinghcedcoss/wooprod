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
<?php
$pid = $_GET['pid'];
$allproducts = wc_get_product($pid);
?>
 <div class="ced_form_design_orders container">
        <h2 class="text-center">Update product informations:</h2>
        <form method="post">
          <div class="ced_section1">
            <h4>Product Information:</h4>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="prods1">Product Title:</label>
                    <input type="text" name="cedprod_title" class="form-control" placeholder="product title" value="<?php echo $allproducts->get_name(); ?>">
                </div>
            </div>
          </div>
          <div class="ced_section2">
           
                <h2 class="text-left">Description:</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 nopadding">
                         
                            <textarea name="cedprod_description" id="txtEditor"><?php echo $allproducts->get_description(); ?></textarea> 
                        </div>
                    </div>
                </div>
            
        </div>
        <div class="ced_section3">
                          
                <div class="container">
                    <div class="row">

                        <div class="col-md-4 nopadding">
                         <h5 class="text-left">Product Type:</h5>
                         <select id="product-type" name="ced_product_type" >
                            <optgroup label="Product Type">
                            <option <?php if ($allproducts->get_type() == 'simple' ) echo 'selected' ; ?> value="simple">Simple product</option>
                            <option <?php if ($allproducts->get_type() == 'grouped' ) echo 'selected' ; ?> value="grouped">Grouped product</option>
                            <option <?php if ($allproducts->get_type() == 'external' ) echo 'selected' ; ?> value="external">External/Affiliate product</option>
                            <option <?php if ($allproducts->get_type() == 'variable' ) echo 'selected' ; ?> value="variable">Variable product</option>
                            </optgroup>
                        </select>
                            
                        </div>
                    
                    
                        <div class="col-md-4 nopadding">
                          <h5 class="text-left">Product categories:</h5>
                          <ul>
                         <?php
                         $categories = get_categories( array(
                              'orderby' => 'name',
                              'taxonomy' => 'product_cat', 
                              'parent'  => 0
                          ) );
                         
                          $catval = array();
                          $terms = get_the_terms( $pid, 'product_cat' );
                          foreach ($terms as $term) {
                              $catval[] = $term->slug;
                              
                          }  
                            foreach ( $categories as $category ) {
                            ?>
                             <li id="product_cat<?php echo $category->term_id; ?>"><label class="selectit"><input value="<?php echo $category->slug; ?>" type="checkbox" name="ced_product_cat[]" id="in-product_cat-<?php echo $category->term_id; ?>" <?php if(in_array($category->slug,$catval)){echo 'checked';} ?>>

                               <?php printf(  esc_html( $category->name ) ); ?>
                              </label></li>
                           <?php }
                        //echo '<pre>'; print_r($catval);

                         ?>
                       </ul>
                        </div>
                    
                    
                        <div class="col-md-4 nopadding">
                         
                           <h5 class="text-left">Product Variations:</h5>
                          <ul>
                         <?php
                         if($allproducts->get_type()=='simple'){
                          echo "sorry! it's a simple product";

                         }elseif($allproducts->get_type()=='variable'){
                           $productvariations = $allproducts->get_variation_attributes();  
                           $productavlvariations = $allproducts->get_available_variations(); 
                          // echo '<pre>'; print_r($productvariations);
                             ?>
                            <select id="product-variations1" name="ced_product_variations1" >
                            <optgroup label="Product Variations">
                              <?php foreach ($productvariations['pa_color'] as $productvariation) { ?>
                            <option value="<?php echo $productvariation; ?>"><?php echo $productvariation; ?></option>
                            <?php } ?>
                            </optgroup>
                            </select>
                             <select id="product-variations1" name="ced_product_variations1" >
                            <optgroup label="Product Variations">
                              <?php foreach ($productvariations['pa_size'] as $productvariation) { ?>
                            <option value="<?php echo $productvariation; ?>"><?php echo $productvariation; ?></option>
                            <?php } ?>
                            </optgroup>
                            </select>
                              <?php
                               //echo '<pre>'; print_r($productvariation);
                             }
                         
                         ?>
                       </ul>
                           
                        </div>
                    </div>
                </div>
            
        </div>
        <div class="row">
          <div class="form-group col-md-12">
          <input class="btn btn-primary" type="submit" name="updateproduct" value="Update product">
          </div>
        </div>
        </form>
</div>

<?php
  if (isset($_POST['updateproduct'])) {
    echo '<script>alert("updated");</script>';
    $cedprod_title = $_POST['cedprod_title'];
    $cedprod_description = $_POST['cedprod_description'];
    $ced_product_cat = $_POST['ced_product_cat'];
    $ced_product_type = $_POST['ced_product_type'];

//merge attribute values
//     $attribute_name = 'pa_color'; //slug of the attribute(taxonomy) with prefix 'pa_'
// $attribute_value = array('fff', 'efef'); //slug of the attribute value (term)
//     $term_taxonomy_ids = wp_set_object_terms($pid, $attribute_value, $attribute_name, true);
//     $data = array(
//         $attribute_name => array(
//             'name' => $attribute_name,
//             'value' => '',
//             'is_visible' => '1',
//             'is_variation' => '0',
//             'is_taxonomy' => '1'
//         )
//     );
//     //First getting the Post Meta
//     $_product_attributes = get_post_meta($pid, '_product_attributes', TRUE);
//     //Updating the Post Meta
//     update_post_meta($pid, '_product_attributes', array_merge($_product_attributes, $data));
 
 wp_insert_term(
  'New Category', // the term 
  'product_cat', // the taxonomy
  array(
    'description'=> 'Category description',
    'slug' => 'new-category'
  )
); 

/*$allproducts_ORIGINAL = wc_get_product(95);

 wp_set_object_terms( $pid, $ced_product_cat, 'product_cat', false );
 wp_set_object_terms( $pid, 'gggtat', 'product_tag', false );
wp_set_object_terms( $pid, $ced_product_type, 'product_type', false );
$allproducts_MODIFIED = wc_get_product(95);



$allproducts_MODIFIED->save(); 

$allproducts_ORIGINAL->save(); */

$allproducts = wc_get_product(95);


update_post_meta($pid, '_product_type', $ced_product_type);
$attribute = new WC_Product_Attribute();
$attribute->set_id(wc_attribute_taxonomy_id_by_name('pa_color')); //if passing the attribute name to get the ID
$attribute->set_name('pa_color'); //attribute name
$attribute->set_options('red'); // attribute value
$attribute->set_position(1); //attribute display order
$attribute->set_visible(1); //attribute visiblity
$attribute->set_variation(1);//to use this attribute as varint or not
$raw_attributes[] = $attribute; //<--- storing the attribute in an array
$attribute = new WC_Product_Attribute();
$attribute->set_id(wc_attribute_taxonomy_id_by_name('pa_size'));
$attribute->set_name('pa_size');
$attribute->set_options('XL');
$attribute->set_position(2);
$attribute->set_visible(1);
$attribute->set_variation(1);
$raw_attributes[] = $attribute; //<--- storing the attribute in an array
$allproducts->set_name($cedprod_title);
$allproducts->set_description($cedprod_description);
//$allproducts->set_type();
$allproducts->set_attributes($raw_attributes); //Set product attributes.    

$allproducts->save(); 
die('gg');
  }
?>