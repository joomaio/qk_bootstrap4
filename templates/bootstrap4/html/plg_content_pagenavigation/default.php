<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagenavigation
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang = JFactory::getLanguage();

?>
<ul class="pager pagenav pagination justify-content-center mb-4">
<?php if ($row->prev) :
	$direction = $lang->isRtl() ? 'right' : 'left'; ?>
	<li class="page-item previous">
		<a class="page-link hasTooltip" title="<?php echo htmlspecialchars($rows[$location-1]->title); ?>" aria-label="<?php echo JText::sprintf('JPREVIOUS_TITLE', htmlspecialchars($rows[$location-1]->title)); ?>" href="<?php echo $row->prev; ?>" rel="prev">
			<?php echo '<i class="fa fa-long-arrow-' . $direction . '" aria-hidden="true"></i> <span aria-hidden="true">' . $row->prev_label . '</span>'; ?>
		</a>
	</li>
<?php endif; ?>
<?php if ($row->next) :
	$direction = $lang->isRtl() ? 'left' : 'right'; ?>
	<li class="page-item next">
		<a class="page-link hasTooltip" title="<?php echo htmlspecialchars($rows[$location+1]->title); ?>" aria-label="<?php echo JText::sprintf('JNEXT_TITLE', htmlspecialchars($rows[$location+1]->title)); ?>" href="<?php echo $row->next; ?>" rel="next">
			<?php echo '<span aria-hidden="true">' . $row->next_label . '</span> <i class="fa fa-long-arrow-' . $direction . '" aria-hidden="true"></i>'; ?>
		</a>
	</li>
<?php endif; ?>
</ul>
