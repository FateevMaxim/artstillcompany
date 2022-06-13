<?php // no direct access
defined('_JEXEC') or die('Restricted access');
// echo "<pre>";
// var_dump($data);
// die;

//dump ($cart,'mod cart');
// Ajax is displayed in vm_cart_products
// ALL THE DISPLAY IS Done by Ajax using "hiddencontainer" ?>

<!-- Virtuemart 2 Ajax Card -->
<div class="vmCartModule <?php echo $params->get('moduleclass_sfx'); ?>" id="vmCartModule<?php echo $params->get('moduleid_sfx'); ?>">
	<?php
	if ($show_product_list) {
		?>
		<div class="hiddencontainer" style=" display: none; ">
			<div class="vmcontainer">
				<div class="product_row">
					<span class="product_name"></span>
					<span class="quantity"></span>&nbsp;x&nbsp;
					
					<?php if ($show_price and $currencyDisplay->_priceConfig['salesPrice'][0]) { ?>
					<div class="subtotal_with_tax"></div>
					<?php } ?>
					<?php if ( !empty($product['customProductData']) ) { ?>
					<div class="customProductData"><?php echo $product['customProductData'] ?></div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="minicart-header">
			<a href="#" class="shopcart" title="Shopping Cart">
				<span class="cart_ico"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
				<span class="cart-info">
					<span class="cart-title">
						<span class="title-cart">My Cart</span>
						<span id="CartCount" class="cout_cart"><span class="cout_item total_products"><?php echo  $data->totalProductTxt ?></span> items</span>
					</span>
				</span>
			</a>
			<div class="vm_cart_products">
				<div class="vmcontainer">

					<?php 

					if ($data->totalProduct == 0) { ?>
					<div class="no-items">
						<p>Your cart is currently empty.</p>
						<a href="index.php" class="btn continue-shopping" title="<?= vmText::_('COM_VIRTUEMART_CONTINUE_SHOPPING')?>"><?= vmText::_('COM_VIRTUEMART_CONTINUE_SHOPPING') ?>
						</a>
					</div>
					<?php  } ?>
					<?php if ($data->totalProduct >  0) {
						foreach ($data->products as $product){
							?>
							<div class="product_row clearfix">
								<div class="product-img-wrap">
									<a href="<?= $product['url'] ?>" title="<?= $product['product_name_no_link'] ?>">
										<?= $product['image'] ?>
									</a>
								</div>
								<div class="product-details">
									<span class="product_name"><?php echo  $product['product_name'] ?></span>
									<span class="quantity"><?= vmText::_('COM_VIRTUEMART_CART_QUANTITY') ?><?php echo  $product['quantity'] ?></span>&nbsp;x&nbsp;
									<?php if ($show_price and $currencyDisplay->_priceConfig['salesPrice'][0]) { ?>
									<div class="prices"><?php echo $product['prices'] ?></div>
									<?php } ?>
									<?php if ( !empty($product['customProductData']) ) { ?>
									<div class="customProductData"><?php echo $product['customProductData'] ?></div>
								</div>
								<?php } ?>

							</div>
							<?php } ?>
							<div class="total">
								<?php if ($data->totalProduct and $show_price and $currencyDisplay->_priceConfig['salesPrice'][0]) { ?>
								<?php echo $data->billTotal; ?>
								<?php } ?>
							</div>
							<div class="show_cart">
								<?php if ($data->totalProduct) echo  $data->cart_show; ?>
							</div>
							<?php } ?>

						</div>
					</div>
				</div>
			</div>
			<?php } ?>

			<noscript>
				<?php echo vmText::_('MOD_VIRTUEMART_CART_AJAX_CART_PLZ_JAVASCRIPT') ?>
			</noscript>
		</div>

