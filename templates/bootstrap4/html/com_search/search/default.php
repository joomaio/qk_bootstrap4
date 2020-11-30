<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div class="search <?php echo $this->pageclass_sfx; ?>">
	<div class="row">
		<div class="col-md-8">
			<?php if ($this->params->get('show_page_heading')) : ?>
				<h1 class="page-title my-4">
					<?php if ($this->escape($this->params->get('page_heading'))) : ?>
						<?php echo $this->escape($this->params->get('page_heading')); ?>
					<?php else : ?>
						<?php echo $this->escape($this->params->get('page_title')); ?>
					<?php endif; ?>
				</h1>
			<?php endif; ?>						
			<div class="searchintro <?php echo $this->params->get('pageclass_sfx'); ?>">
				<?php if (!empty($this->searchword)) : ?>
					<p class="mb-0">
						<?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', '<span class="badge badge-info">' . $this->total . '</span>'); ?>
					</p>
				<?php endif; ?>
			</div>	
			<?php if ($this->total > 0) : ?>
				<p class="counter">
					<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
			<?php endif; ?>
			<?php if ($this->error == null && count($this->results) > 0) : ?>
				<?php echo $this->loadTemplate('results'); ?>
			<?php else : ?>
				<?php echo $this->loadTemplate('error'); ?>
			<?php endif; ?>
		</div>
		<div class="col-md-4">
			<?php echo $this->loadTemplate('form'); ?>
		</div>	
	</div>
</div>
