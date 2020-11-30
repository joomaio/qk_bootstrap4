<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();

?>
<div class="card mt-4">
	<div class="card-header"><h4 class="mb-0"><?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?></h4></div>		
	<div class="card-body">		
		<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search'); ?>" method="post" class="searchform">
			<label for="search-searchword" class="element-invisible d-none">
				<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>
			</label>
			<div class="form-inline mb-2">
				<input required type="text" name="searchword" title="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="form-control mr-2 mb-md-2 mb-xl-0 mw-100 " />
				<button name="Search" onclick="this.form.submit()" class="btn btn-outline-success my-2 my-sm-0 hasTooltip" title="<?php echo JHtml::_('tooltipText', 'COM_SEARCH_SEARCH');?>">
					<i class="fa fa-search" aria-hidden="true"></i>
					<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>
				</button>
			</div>
			<input type="hidden" name="task" value="search" />	
			<?php if ($this->params->get('search_phrases', 1)) : ?>
				<fieldset class="phrases mb-2">
					<legend>
						<?php echo JText::_('COM_SEARCH_FOR'); ?>
					</legend>
					<div class="phrases-box">
						<?php echo $this->lists['searchphrase']; ?>
					</div>
				</fieldset>
			<?php endif; ?>
			<?php if ($this->params->get('search_areas', 1)) : ?>
				<fieldset class="only mb-2">
					<legend>
						<?php echo JText::_('COM_SEARCH_SEARCH_ONLY'); ?>
					</legend>
					<?php foreach ($this->searchareas['search'] as $val => $txt) : ?>
						<?php $checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : ''; ?>
						<label for="area-<?php echo $val; ?>" class="checkbox">
							<input type="checkbox" name="areas[]" value="<?php echo $val; ?>" id="area-<?php echo $val; ?>" <?php echo $checked; ?> />
							<?php echo JText::_($txt); ?>
						</label>
					<?php endforeach; ?>
				</fieldset>
			<?php endif; ?>
			<?php if ($this->params->get('search_phrases', 1)) : ?>
				<div class="ordering-box mb-2">
					<legend class="ordering">
						<?php echo JText::_('COM_SEARCH_ORDERING'); ?>
					</legend>
					<?php echo $this->lists['ordering']; ?>
				</div>
			<?php endif; ?>
			<?php if ($this->total > 0) : ?>
				<div class="limitbox form-limit mb-2">
					<legend for="limit">
						<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
					</legend>
					<?php echo $this->pagination->getLimitBox(); ?>
				</div>
			<?php endif; ?>
		</form>
	</div>
</div>