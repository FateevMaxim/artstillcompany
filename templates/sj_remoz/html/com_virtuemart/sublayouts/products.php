<?php
/**
 * sublayout products
 *
 * @package VirtueMart
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL2, see LICENSE.php
 * @version $Id: cart.php 7682 2014-02-26 17:07:20Z Milbo $
 */

defined('_JEXEC') or die('Restricted access');
$products_per_row = empty($viewData['products_per_row'])? 1:$viewData['products_per_row'] ;
$currency = $viewData['currency'];
$showRating = $viewData['showRating'];
$verticalseparator = " vertical-separator";
echo shopFunctionsF::renderVmSubLayout('askrecomjs');

$ItemidStr = '';
$Itemid = shopFunctionsF::getLastVisitedItemId();
if(!empty($Itemid)){
    $ItemidStr = '&Itemid='.$Itemid;
}

$dynamic = false;
if (vRequest::getInt('dynamic',false)) {
    $dynamic = true;
}

foreach ($viewData['products'] as $type => $products ) {

    $col = 1;
    $nb = 1;
    $row = 1;

    if($dynamic){
        $rowsHeight[$row]['product_s_desc'] = 1;
        $rowsHeight[$row]['price'] = 1;
        $rowsHeight[$row]['customfields'] = 1;
        $col = 2;
        $nb = 2;
    } else {
        $rowsHeight = shopFunctionsF::calculateProductRowsHeights($products,$currency,$products_per_row);

        if( (!empty($type) and count($products)>0) or (count($viewData['products'])>1 and count($products)>0)){
            $productTitle = vmText::_('COM_VIRTUEMART_'.strtoupper($type).'_PRODUCT'); ?>
            <div class="category-view">
                <!-- <h3 class="form-group"><?php echo $productTitle ?></h3><div class="clear"></div> -->
            <?php // Start the Output
        }
    }

    // Calculating Products Per Row
    $cellwidth = ' width'.floor ( 100 / $products_per_row );

    $BrowseTotalProducts = count($products);

echo "<div class='row'> ";
    foreach ( $products as $product ) {
        if(!is_object($product) or empty($product->link)) {
            vmdebug('$product is not object or link empty',$product);
            continue;
        }
        // Show the horizontal seperator
        

        // this is an indicator wether a row needs to be opened or not
        

      // Do we need to close the current row now?
      ?>
    <div class="product vm-col<?php echo ' vm-col-' . $products_per_row . $show_vertical_separator ?>">
        <div class="spacer product-container">
            <div class="vm-product-media-container">
                <a title="<?php echo $product->product_name ?>" href="<?php echo $product->link.$ItemidStr; ?>">
                    <?php
                    if($product->images[0]->file_url != ''){ ?>

                    <img src="<?= $product->images[0]->file_url ?>" alt="<?php echo $product->product_name ?>">
                    <?php  
                }
                else{
                    echo $product->images[0]->displayMediaThumb('class="browseProductImage"', false);
                }
                ?>
            </a>
            <?php
            // echo "<pre>";
            // var_dump($product->prices); 
            // die;
            $discount= round($product->prices['discountAmount']);
            $price_old= round($product->prices['priceWithoutTax']);

            $sale= round(($product->prices['basePrice'] - $product->prices['salesPrice'] )/ $product->prices['basePrice'] *100);
            if($product->prices['basePrice'] != $product->prices['salesPrice']) { ?>
            <span class="sale_price">-<?php echo $sale;?>%</span>
            <?php } ?>
        </div>

        <div class="group-title-des vm-product-descr-container-<?php echo $rowsHeight[$row]['product_s_desc'] ?>">
            <h4 class="product-name"><?php echo JHtml::link ($product->link.$ItemidStr, $product->product_name); ?></h4>
        </div>

        <div class="vm-product-rating-container">

            <?php echo shopFunctionsF::renderVmSubLayout('rating',array('showRating'=>$showRating, 'product'=>$product));
            if ( VmConfig::get ('display_stock', 1)) { ?>
            <span class="vmicon vm2-<?php echo $product->stock->stock_level ?>" title="<?php echo $product->stock->stock_tip ?>"></span>
            <?php }
            echo shopFunctionsF::renderVmSubLayout('stockhandle',array('product'=>$product));
            ?>
        </div>

        <?php //echo $rowsHeight[$row]['price'] ?>
        <div class="group-price vm3pr-<?php echo $rowsHeight[$row]['price'] ?>"> <?php
        echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$product,'currency'=>$currency)); 
        ?>
        <div class="clear"></div>
    </div>
    <div class="group-title-des vm-product-descr-container-<?php echo $rowsHeight[$row]['product_s_desc'] ?>">
        <?php if(!empty($rowsHeight[$row]['product_s_desc'])){
            ?>
            <p class="product_s_desc">
                    <?php // Product Short Description
                    if (!empty($product->product_s_desc)) {
                        echo shopFunctionsF::limitStringByWord ($product->product_s_desc, 300, ' ...') ?>
                        <?php } ?>
                    </p>
                    <?php  } ?>
                </div>
                <?php //echo $rowsHeight[$row]['customs'] ?>
                <div class="group-addtocart vm3pr-<?php echo $rowsHeight[$row]['customfields'] ?>"> <?php
                echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$product,'rowHeights'=>$rowsHeight[$row], 'position' => array('ontop', 'addtocart'))); ?>
            </div>
            <?php if(vRequest::getInt('dynamic')){
                echo vmJsApi::writeJS();
            } ?>
        </div>
    </div>
        

<?php }

      echo "</div>";
      if(!empty($type)and count($products)>0){
        // Do we need a final closing row tag?
        //if ($col != 1) {
    ?>
    <div class="clear"></div>
</div>
<?php
    // }
}
}
