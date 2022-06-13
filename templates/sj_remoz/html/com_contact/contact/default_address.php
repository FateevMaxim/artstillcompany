<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */
?>
<dl class="contact-address dl-horizontal" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
	<?php if (($this->params->get('address_check') > 0) &&
	($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>

	<ul class="list-info">

		<?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
			<li class="item-info main-info">
				<div class="info-content"><i class="fa fa-map-marker"></i>


					<span class="des-info"><?php echo nl2br($this->contact->address); ?></span>
				</div>

			</li>
		<?php endif; ?>
		<?php /* if ($this->contact->email_to && $this->params->get('show_email')) : */?>
		<?php if(true) : ?>

			<li class="item-info email-info">
				<div class="info-content"><i class="fa fa-envelope"></i>

					Email:


					<span class="des-info"><a href="<?php echo $this->contact->email_to; ?>"><?php echo $this->contact->email_to; ?></a></span>
				</div>

			</li>
		<?php endif; ?>

		<?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
			<li class="item-info phone">
				<div class="info-content"><i class="fa fa-phone"></i>

					Phone:


					<span class="des-info"><a href="tel:<?php echo nl2br($this->contact->telephone); ?>"><?php echo nl2br($this->contact->telephone); ?></a></span>
				</div>

			</li>
		<?php endif; ?>

	</ul>

<?php endif; ?>

