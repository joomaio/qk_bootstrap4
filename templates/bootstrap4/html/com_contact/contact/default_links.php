<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if ($this->params->get('presentation_style') === 'sliders') : ?>
	<div class="card">
		<div class="card-header">
			<h2 class="mb-0">
				<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#display-links" aria-expanded="true" aria-controls="display-links">
					<?php echo JText::_('COM_CONTACT_EMAIL_FORM'); ?>
				</button>
			</h2>
		</div>
		<div id="display-links" class="collapse" data-parent="#slide-contact">
			<div class="card-body">
<?php endif; ?>
<?php if ($this->params->get('presentation_style') === 'tabs') : ?>
	<div class="tab-pane fade" id="display-links" role="tabpanel" aria-labelledby="display-links-tab">
<?php endif; ?>
<?php if ($this->params->get('presentation_style') === 'plain') : ?>
	<?php echo '<h3 class="mt-4">' . JText::_('COM_CONTACT_LINKS') . '</h3>'; ?>
<?php endif; ?>

<div class="contact-links">
	<ul class="nav nav-tabs nav-stacked">
		<?php
		// Letters 'a' to 'e'
		foreach (range('a', 'e') as $char) :
			$link = $this->contact->params->get('link' . $char);
			$label = $this->contact->params->get('link' . $char . '_name');

			if (!$link) :
				continue;
			endif;

			// Add 'http://' if not present
			$link = (0 === strpos($link, 'http')) ? $link : 'http://' . $link;

			// If no label is present, take the link
			$label = $label ?: $link;
			?>
			<li>
				<a href="<?php echo $link; ?>" itemprop="url">
					<?php echo $label; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

<?php if ($this->params->get('presentation_style') === 'sliders') : ?>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php if ($this->params->get('presentation_style') === 'tabs') : ?>
	</div>
<?php endif; ?>