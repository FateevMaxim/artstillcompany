<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

/* Let's see if we found the product */
if (empty($this->product)) {
	echo vmText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
	echo '<br /><br />  ' . $this->continue_link_html;
	return;
}

echo shopFunctionsF::renderVmSubLayout('askrecomjs',array('product'=>$this->product));

vmJsApi::jDynUpdate();
vmJsApi::addJScript('updDynamicListeners',"
	jQuery(document).ready(function() { // GALT: Start listening for dynamic content update.
    // If template is aware of dynamic update and provided a variable let's
    // set-up the event listeners.
		if (Virtuemart.container)
			Virtuemart.updateDynamicUpdateListeners();

	}); ");

	if(vRequest::getInt('print',false)){ ?>
	<body onload="javascript:print();">
		<?php } ?>
		<link href="/sj_remoz/components/com_sppagebuilder/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<div class="productdetails-view productdetails row">
			<button type="button" class="open-sidebar"><i class="fa fa-bars"></i> Меню</button>
			<?php
    // Product Navigation
			if (VmConfig::get('product_navigation', 1)) {
				?>
				<div class="product-neighbours">
					<?php
					if (!empty($this->product->neighbours ['previous'][0])) {
						$prev_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['previous'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
						echo JHtml::_('link', $prev_link, $this->product->neighbours ['previous'][0]
							['product_name'], array('rel'=>'prev', 'class' => 'previous-page','data-dynamic-update' => '0'));
					}
					if (!empty($this->product->neighbours ['next'][0])) {
						$next_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['next'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
						echo JHtml::_('link', $next_link, $this->product->neighbours ['next'][0] ['product_name'], array('rel'=>'next','class' => 'next-page','data-dynamic-update' => '0'));
					}
					?>
					<div class="clear"></div>
				</div>
    <?php } // Product Navigation END
    ?>
    <div class="row-demo">
    	<div class="col-md-5 col-sm-12 col-xs-12 " >

    		<?php echo $this->loadTemplate('images'); ?>

    	</div>
    	<div class="col-md-7 col-sm-12 col-xs-12">
    		<div class="vm-product-container">
    			<div class="vm-product-top-container">
					<?php // Back To Category Button
					if ($this->product->virtuemart_category_id) {
						$catURL =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$this->product->virtuemart_category_id, FALSE);
						$categoryName = $this->product->category_name ;
					} else {
						$catURL =  JRoute::_('index.php?option=com_virtuemart');
						$categoryName = vmText::_('COM_VIRTUEMART_SHOP_HOME') ;
					}
					?>


					<?php // Product Title   ?>
					<h1><?php echo $this->product->product_name ?></h1>
					<?php // Product Title END   ?>

				<?php // afterDisplayTitle Event
				echo $this->product->event->afterDisplayTitle ?>

				<?php
				// Product Edit Link
				echo $this->edit_link;
				// Product Edit Link END
				?>
				<?php
				// PDF - Print - Email Icon
				
				if (VmConfig::get('show_emailfriend') || VmConfig::get('show_printicon') || VmConfig::get('pdf_icon')) {
					?>
					<div class="icons">
						<?php

						$link = 'index.php?tmpl=component&option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->virtuemart_product_id;

						echo $this->linkIcon($link . '&format=pdf', 'COM_VIRTUEMART_PDF', 'pdf_button', 'pdf_icon', false);
					//echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon');
						echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon',false,true,false,'class="printModal"');
						$MailLink = 'index.php?option=com_virtuemart&view=productdetails&task=recommend&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component';
						echo $this->linkIcon($MailLink, 'COM_VIRTUEMART_EMAIL', 'emailButton', 'show_emailfriend', false,true,false,'class="recommened-to-friend"');
						?>
						<div class="clearfix"></div>
					</div>
				<?php } // PDF - Print - Email Icon END
				?>
				
			</div>
			<div class="vm-product-details-container"> 
				<?php
                //echo  shopFunctionsF::renderVmSubLayout('rating',array('showRating'=>$this->showRating,'product'=>$this->product));
				echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$this->product,'currency'=>$this->currency));
				?>

					<?php // Product Sku
					echo shopFunctionsF::renderVmSubLayout('stockhandle',array('product'=>$this->product));
					if (!empty($this->product->product_sku)) { ?>
					<p class="product_sku"><span class="text"><?php echo JText::_('COM_VIRTUEMART_PRODUCT_SKU'); ?></span>: <?php echo $this->product->product_sku; ?></p>
					<?php } ?>
					<?php
					// Manufacturer of the Product
					if (VmConfig::get('show_manufacturers', 1) && !empty($this->product->virtuemart_manufacturer_id)) { ?>
					<div class="form-group">
						<?php echo $this->loadTemplate('manufacturer');?>
					</div>
					<?php } ?>
					<?php
				// Product Short Description
					if (!empty($this->product->product_s_desc)) {
						?>
						<div class="product-short-description">

							<?php
							/** @todo Test if content plugins modify the product description */
							echo nl2br($this->product->product_s_desc);
							?>
						</div>
						<?php
				} // Product Short Description END
				?>
				<div class="spacer-buy-area clearfix">

					<?php
					// TODO in Multi-Vendor not needed at the moment and just would lead to confusion
					/* $link = JRoute::_('index2.php?option=com_virtuemart&view=virtuemart&task=vendorinfo&virtuemart_vendor_id='.$this->product->virtuemart_vendor_id);
					  $text = vmText::_('COM_VIRTUEMART_VENDOR_FORM_INFO_LBL');
					  echo '<span class="bold">'. vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS_VENDOR_LBL'). '</span>'; ?><a class="modal" href="<?php echo $link ?>"><?php echo $text ?></a><br />
					 
					?>
					<?php if (is_array($this->productDisplayShipments)) {
						foreach ($this->productDisplayShipments as $productDisplayShipment) {
						echo $productDisplayShipment . '';
						}
					}
					if (is_array($this->productDisplayPayments)) {
						foreach ($this->productDisplayPayments as $productDisplayPayment) {
						echo $productDisplayPayment . '';
						}
					} */

					//In case you are not happy using everywhere the same price display fromat, just create your own layout
					//in override /html/fields and use as first parameter the name of your file

					?>
					<?php
					echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$this->product));


					// Ask a question about this product
					if (VmConfig::get('ask_question', 0) == 1) {
						$askquestion_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component', FALSE);
						?>
						<div class="form-group">
							<div class="simpAskQuestion-Qcontent">
								<h4 class="simpAskQuestion-Qcontent-title"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ASK_QUESTION') ?></h4>
							</div>
							<a class="ask-a-question button" href="<?php echo $askquestion_url ?>" rel="nofollow" ><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ENQUIRY_LBL') ?></a>
						</div>
						<?php
					}
					?>

					

				</div>

				<!-- Item Social Button -->
				<?php /*<div class="itemSocialBlock">
					<label><?= vmText::_('SHARE') ?></label>
					<div class="addthis_inline_share_toolbox"></div>
					<!-- Go to www.addthis.com/dashboard to customize your tools -->
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-529be2200cc72db5"></script>
					
				</div>
*/?>

			</div>
			<div class="clear"></div>
		</div>
	</div>

	<div id="yt_tab_products" class="tab-product-detail col-md-12">
		<div class="tab-product">
			<ul class="nav nav-tabs" id="add-reviews" >
				<li class="active"><a  href="#description" data-toggle="tab"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DESC_TITLE') ?></a></li>
                <?php /*<li ><a href="#reviews" data-toggle="tab"><?php echo vmText::_('COM_VIRTUEMART_REVIEWS') ?></a></li>*/?>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="description">
					<?php
						// Product Description
					if (!empty($this->product->product_desc)) {
						?>
						<div class="product-description">
							<?php /** @todo Test if content plugins modify the product description */ ?>
							<?php echo $this->product->product_desc; ?>
						</div>
						<?php
						} // Product Description END
						?>
						<?php
						echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'ontop'));
						echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'normal'));
						echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'onbot'));

						// Product Packaging
						$product_packaging = '';
						if ($this->product->product_box) {
							?>
							<div class="product-box">
								<?php
								echo vmText::_('COM_VIRTUEMART_PRODUCT_UNITS_IN_BOX') .$this->product->product_box;
								?>
							</div>
							<?php } // Product Packaging END ?>
						</div>
                <?php /*
						<div class="tab-pane" id="reviews">
							<?php echo $this->loadTemplate('reviews'); ?>
						</div>
                */?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>

			<?php


		// event onContentBeforeDisplay
			echo $this->product->event->beforeDisplayContent; ?>
			<div class="col-md-12">

				<?php

				echo shopFunctionsF::renderVmSubLayout('related_products',array('product'=>$this->product,'position'=>'related_products','class'=> 'product-related-products','customTitle' => true ));

				echo shopFunctionsF::renderVmSubLayout('related_categories',array('product'=>$this->product,'position'=>'related_categories','class'=> 'product-related-categories'));

				?>
			</div>

			<div class="clear"></div>
		<?php // onContentAfterDisplay event
		echo $this->product->event->afterDisplayContent;
		echo vmJsApi::writeJS();
		?>
	</div>
</div>


<script>
    // GALT
    /*
     * Notice for Template Developers!
     * Templates must set a Virtuemart.container variable as it takes part in
     * dynamic content update.
     * This variable points to a topmost element that holds other content.
     */
    // If this <script> block goes right after the element itself there is no
    // need in ready() handler, which is much better.
    //jQuery(document).ready(function() {
    	Virtuemart.container = jQuery('.productdetails-view');
    	Virtuemart.containerSelector = '.productdetails-view';
    //Virtuemart.container = jQuery('.main');
    //Virtuemart.containerSelector = '.main';
    //});
</script>

