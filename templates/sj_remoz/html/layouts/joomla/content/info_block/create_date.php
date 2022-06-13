<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

?>
<dd class="create-date">
	<time datetime="<?php echo JHtml::_('date', $displayData['item']->created, 'c'); ?>"  title="<?php echo JText::_('COM_CONTENT_CREATED_DATE'); ?>">
		<div class="day"><?php echo JHtml::_('date', $displayData['item']->created, JText::_('d')); ?></div>
		<div class="month"><?php echo JHtml::_('date', $displayData['item']->created, JText::_('M')); ?></div>
	</time>
</dd>