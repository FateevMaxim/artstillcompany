<?php
/**
 * @package Sj Virtuemart for Virtuemart
 * @version 2.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2013 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */

defined( '_JEXEC' ) or die;
JHtml::stylesheet('modules/'.$module->module.'/assets/css/style.css');
//JHtml::stylesheet('components/com_virtuemart/assets/css/jquery.fancybox-1.3.4.css');
$count_item = count($list);
$nb_column0 = ($params->get('nb-column0',6) >= $count_item)?$count_item:$params->get('nb-column0',6);
$nb_column1 = ($params->get('nb-column1',6) >= $count_item)?$count_item:$params->get('nb-column1',6);
$nb_column2 = ($params->get('nb-column2',4) >= $count_item)?$count_item:$params->get('nb-column2',4);
$nb_column3 = ($params->get('nb-column3',2) >= $count_item)?$count_item:$params->get('nb-column3',2);
$nb_column4 = ($params->get('nb-column4',1) >= $count_item)?$count_item:$params->get('nb-column4',1);

$class_respl0= 'preset00-'.$nb_column0.' preset01-'.$nb_column1.' preset02-'.$nb_column2.' preset03-'.$nb_column3.' preset04-'.$nb_column4;

ImageHelper::setDefault($params);
$currency = CurrencyDisplay::getInstance();
$tag_id = 'sj-virturemart'.rand().time();
?>

<?php if($params->get('pretext') != '') { ?>
    <div class="pre-text"><?php echo $params->get('pretext'); ?></div>
<?php } ?>

<?php if( !empty($list)) { ?>

<!--[if lt IE 9]><div class="sj-virtuemart msie lt-ie9" id="<?php echo $tag_id; ?>"><![endif]-->
<!--[if IE 9]><div class="sj-virtuemart msie" id="<?php echo $tag_id; ?>"><![endif]-->
<!--[if gt IE 9]><!--><div class="sj-virtuemart" id="<?php echo $tag_id; ?>"><!--<![endif]-->
    <div class="item-wrap <?php echo $class_respl0; ?>">
    <?php $j = 0; foreach($list as $item) { $j++; ?>
        <div class="item-element ">
            <div class="item-inner" style="position:relative">
                <?php if( $params->get( 'item_title_display' ) == 1) { ?>
                    <div class="item-title">
                        <a href="<?php echo $item->link;?>" title="<?php echo $item->title ?>" <?php echo SjVirtueMartHelper::parseTarget($params->get('item_link_target')); ?>>
                            <?php echo SjVirtueMartHelper::truncate($item->title, $params->get('item_title_max_characs'));?>
                        </a>
                    </div>
                <?php } ?>
				
                <?php $img = SjVirtueMartHelper::getVmImage($item, $params);
                if($img){
                    ?>
                    <div class="item-image">
                        <a href="<?php echo $item->link;?>" title="<?php echo $item->title ?>" <?php echo SjVirtueMartHelper::parseTarget($params->get('item_link_target')); ?>>
                            <?php   echo SjVirtueMartHelper::imageTag($img);?>
                        </a>
                    </div>
                <?php } ?>
                <?php if((int)$params->get('item_price_display',1)){ ?>
                    <div class="item-price">
                        <?php
                       if (!empty($item->prices['salesPrice'])) {
                            echo $currency->createPriceDiv ('salesPrice', '', $item->prices, FALSE, FALSE, 1.0, TRUE);
                       }
                        if (!empty($item->prices['salesPriceWithDiscount'])) {
							$currency = CurrencyDisplay::getInstance( );
                            echo $currency->createPriceDiv ('salesPriceWithDiscount', '', $item->prices, FALSE, FALSE, 1.0, TRUE);
                        } ?>
                    </div>
                <?php } ?>
                <?php if( $params->get('item_desc_display') == 1 ){?>
                    <div class="item-description">
                        <?php echo $item->_description;?>
                    </div>

                    <?php if( ($params->get('item_readmore_display') == 1) && (SjVirtueMartHelper::_trimEncode( $item->_description ) != '')){?>
                        <div class="item-readmore">
                            <a href="<?php echo $item->link;?>" title="<?php echo $item->title ?>" <?php echo SjVirtueMartHelper::parseTarget($params->get('item_link_target')); ?>>
                                <?php echo $params->get('item_readmore_text');?>
                            </a>
                        </div>
                    <?php }?>
					
					<?php if ($params->get('item_addtocart_display', 1)) {
                            $_item['product'] = $item; ?>
                            <div class="item-addtocart">
                                <?php echo shopFunctionsF::renderVmSubLayout('addtocart', $_item); ?>
                            </div>
                    <?php } ?>

                <?php }?>

            </div>
        </div>
        <?php
        $clear = 'clr1';
        if ($j % 2 == 0) $clear .= ' clr2';
        if ($j % 3 == 0) $clear .= ' clr3';
        if ($j % 4 == 0) $clear .= ' clr4';
        if ($j % 5 == 0) $clear .= ' clr5';
        if ($j % 6 == 0) $clear .= ' clr6';
        ?>
        <div class="<?php echo $clear; ?>"></div>
    <?php } ?>
    </div>
</div>

<?php }
    else {  echo JText::_('Has no content to show!'); ?>
<?php }?>

<?php if($params->get('posttext') != '') {  ?>
    <div class="post-text"><?php echo $params->get('posttext'); ?></div>
<?php }?>
<script type="text/javascript">
	//<![CDATA[
    jQuery(document).ready(function ($) {
		if (typeof  Virtuemart !== 'undefined') {
            Virtuemart.addtocart_popup = "<?php echo VmConfig::get('addtocart_popup'); ?>";
            usefancy = "<?php echo VmConfig::get('usefancy')?>";
            vmLang = "<?php echo VmConfig::get('vmLang') != ''?VmConfig::get('vmLang'):"";?>";
            window.vmSiteurl = "<?php echo JUri::base();?>";
        }
	});
	//]]>
</script>

