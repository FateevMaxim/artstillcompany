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
<dd class="modified">
	<i class="fa fa-calendar-o"></i>
	<time datetime="<?php echo JHtml::_('date', $displayData['item']->modified, 'c'); ?>"  title="<?php echo JText::_('COM_CONTENT_MODIFIED_DATE'); ?>">
		<?php echo JHtml::_('date', $displayData['item']->modified, JText::_('DATE_FORMAT_LC3')); ?>
	</time>
</dd>