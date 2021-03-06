<?php
/**
 *
 * Show the product details page
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen

 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_images.php 8657 2015-01-19 19:16:02Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
// Product Main Image
if (!empty($this->product->images[0])) {
    $width = VmConfig::get('img_width_full', 0);
    $height = VmConfig::get('img_height_full', 0);
?>
    <div class="main-image">
        <?php echo $this->product->images[0]->displayMediaThumb('class="img-large"',false,"rel='vm-additional-images'", true, true, false, $width, $height); ?>
    </div>
    <?php
}
?>

<?php
// Showing The Additional Images
if (!empty($this->product->images) and count ($this->product->images)>1) {   ?>
    <div id="addimgzoom" >   
        <div class="image-additional">
            <ul id="additional_images_gallery" class="">
                <?php
                // List all Images
                foreach ($this->product->images as $key=>$image) {
                    $imageslarge = $this->baseurl.'/'.$image->file_url;
                    echo '<li class="item"><div class="item-inner">';                
                    echo $image->displayMediaThumb("",true,"data-image='$imageslarge'",true,$image->file_description);
                    echo '</div></li>';
                ?>
                <?php } ?> 
            </ul>
        </div>                       
    </div>
<?php
} // Showing The Additional Images END ?>


<?php
$document = JFactory::getDocument();
$app = JFactory::getApplication();
$templateDir = JURI::base() . 'templates/' . $app->getTemplate();
?>
<script type="text/javascript" src="<?php echo $templateDir.'/js/jquery.elevateZoom-3.0.8.min.js' ?>"></script>
<!--
<script type="text/javascript" src="<?php //echo $templateDir.'/js/owl.carousel.js' ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php //echo $templateDir.'/css/owl.carousel.css'?>">
-->
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".item-inner a").removeAttr('href');
        var zoomCollection = '.main-image img';
		$( zoomCollection ).elevateZoom({
            gallery:'addimgzoom',
            cursor: 'crosshair',
            galleryActiveClass: 'active',
            easing:true,
			zoomType	: "inner",
			lensSize    : 150,
            debug: true,
           
        });
        /*$("#additional_images_gallery").owlCarousel({
            items :         4,
            nav: true,
            loop: true,
            margin: 5,
            responsive:{
                768:{
                    items: 3,
                    margin: 8,
                },
                992:{
                    items: 4,
                    margin: 8,
                },
                1200:{
                    items: 4,
                },
            },
            navText: '',
        });*/
       
    });
</script>
