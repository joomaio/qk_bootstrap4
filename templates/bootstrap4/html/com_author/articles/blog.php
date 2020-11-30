<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_author
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

$dispatcher = JFactory::getApplication();// JEventDispatcher::getInstance();

$this->category->text = $this->category->description;
$dispatcher->triggerEvent('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $dispatcher->triggerEvent('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $dispatcher->triggerEvent('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $dispatcher->triggerEvent('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));

?>
<div class="author <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Blog">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1 class="my-4">
				<?php echo $this->escape($this->params->get('page_heading')); ?>
				<?php if ($this->params->get('page_subheading')) : ?>
					<small><?php echo $this->params->get('page_subheading'); ?></small>
				<?php endif; ?>
			</h1>
		</div>
	<?php endif; ?>
	
	<?php echo $afterDisplayTitle; ?>

	<?php if (empty($this->items)) : ?>
		<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
	<?php endif; ?>

	<?php $articlecount = 0; ?>
	<?php foreach ($this->items as &$item) : ?>
		<div class="artilce-<?php echo $articlecount++; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
			itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
			<?php
			$this->item = &$item;
			echo $this->loadTemplate('item');
			?>
		</div>
	<?php endforeach; ?>

	<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
		<div class="pagination-wrapper">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
				<p class="counter"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?> </div>
	<?php endif; ?>
</div>