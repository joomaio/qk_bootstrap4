<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//jimport('joomla.html.html.bootstrap');

$cparams = JComponentHelper::getParams('com_media');
$tparams = $this->item->params;

?>

<div class="contact <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Person">

	<?php if ($this->contact->name && $tparams->get('show_name')) : ?>
		<div class="page-header">
			<h1 class="my-4">
				<?php if ($this->item->published == 0) : ?>
					<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
				<?php endif; ?>
				<span class="contact-name" itemprop="name"><?php echo JText::_('TPL_BOOTSTRAP4_CONTACT_INFORMATION').$this->contact->name; ?></span>
			</h1>
		</div>
	<?php endif; ?>

	<?php $show_contact_category = $tparams->get('show_contact_category'); ?>

	<?php if ($show_contact_category === 'show_no_link') : ?>
		<h3>
			<span class="contact-category"><?php echo $this->contact->category_title; ?></span>
		</h3>
	<?php elseif ($show_contact_category === 'show_with_link') : ?>
		<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid); ?>
		<h3>
			<span class="contact-category"><a href="<?php echo $contactLink; ?>">
				<?php echo $this->escape($this->contact->category_title); ?></a>
			</span>
		</h3>
	<?php endif; ?>

	<?php echo $this->item->event->afterDisplayTitle; ?>

	<?php if ($tparams->get('show_contact_list') && count($this->contacts) > 1) : ?>
		<form action="#" method="get" name="selectForm" id="selectForm">
			<label for="select_contact"><?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?></label>
			<?php echo JHtml::_('select.genericlist', $this->contacts, 'select_contact', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link); ?>
		</form>
	<?php endif; ?>

	<?php if ($tparams->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>

	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php $presentation_style = $tparams->get('presentation_style'); ?>
	<?php $accordionStarted = false; ?>
	<?php $tabSetStarted = false; ?>

	<?php if($presentation_style == 'sliders'): ?>
		<div id="slide-contact" class="accordion">
	<?php endif; ?>
	<?php if($presentation_style == 'tabs'): ?>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<?php if ($this->params->get('show_info', 1)) : ?>
				<li class="nav-item">
					<a class="nav-link active" id="basic-details-tab" data-toggle="tab" href="#basic-details" role="tab" aria-controls="basic-details" aria-selected="true"><?php echo JText::_('COM_CONTACT_DETAILS'); ?></a>
				</li>
			<?php endif; ?>
			<?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
				<li class="nav-item">
					<a class="nav-link" id="display-form-tab" data-toggle="tab" href="#display-form" role="tab" aria-controls="display-form" aria-selected="true"><?php echo JText::_('COM_CONTACT_EMAIL_FORM'); ?></a>
				</li>
			<?php endif; ?>
			<?php if ($tparams->get('show_links')) : ?>
				<li class="nav-item">
					<a class="nav-link" id="display-links-tab" data-toggle="tab" href="#display-links" role="tab" aria-controls="display-links" aria-selected="true"><?php echo JText::_('COM_CONTACT_LINKS'); ?></a>
				</li>
			<?php endif; ?>
			<?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
				<li class="nav-item">
					<a class="nav-link" id="display-articles-tab" data-toggle="tab" href="#display-articles" role="tab" aria-controls="display-articles" aria-selected="true"><?php echo JText::_('JGLOBAL_ARTICLES'); ?></a>
				</li>
			<?php endif; ?>
			<?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
				<li class="nav-item">
					<a class="nav-link" id="display-profile-tab" data-toggle="tab" href="#display-profile" role="tab" aria-controls="display-profile" aria-selected="true"><?php echo JText::_('COM_CONTACT_PROFILE'); ?></a>
				</li>
			<?php endif; ?>
			<?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
				<?php $userFieldGroups = array(); ?>
				<?php foreach ($userFieldGroups as $groupTitle => $fields) : ?>
					<?php $id = JApplicationHelper::stringURLSafe($groupTitle); ?>
					<li class="nav-item">
						<a class="nav-link" id="display-<?php echo $id; ?>-tab" data-toggle="tab" href="#display-<?php echo $id; ?>" role="tab" aria-controls="display-<?php echo $id; ?>" aria-selected="true"><?php echo $groupTitle ?: JText::_('COM_CONTACT_USER_FIELDS'); ?></a>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
				<li class="nav-item">
					<a class="nav-link" id="display-misc-tab" data-toggle="tab" href="#display-misc" role="tab" aria-controls="display-misc" aria-selected="true"><?php echo JText::_('COM_CONTACT_OTHER_INFORMATION'); ?></a>
				</li>
			<?php endif; ?>
		</ul>
		<div id="tabs-contact" class="tab-content">
	<?php endif; ?>

	<?php if ($this->params->get('show_info', 1)) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<div class="card">
				<div class="card-header">
					<h2 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#basic-details" aria-expanded="true" aria-controls="basic-details">
							<?php echo JText::_('COM_CONTACT_DETAILS'); ?>
						</button>
					</h2>
				</div>
				<div id="basic-details" class="collapse show" data-parent="#slide-contact">
					<div class="card-body">
		<?php elseif ($presentation_style === 'tabs') : ?>
			<div class="tab-pane fade show active" id="basic-details" role="tabpanel" aria-labelledby="basic-details-tab">
		<?php elseif ($presentation_style === 'plain') : ?>
			<?php echo '<h3>' . JText::_('COM_CONTACT_DETAILS') . '</h3>'; ?>
		<?php endif; ?>
		
		<div class="row">
			<div class="col-lg-6">
				<?php if ($this->contact->image && $tparams->get('show_image')) : ?>
					<div class="thumbnail text-center mt-1">
						<?php echo JHtml::_('image', $this->contact->image, htmlspecialchars($this->contact->name,  ENT_QUOTES, 'UTF-8'), array('itemprop' => 'image')); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-lg-6">
				<?php if ($this->contact->con_position && $tparams->get('show_position')) : ?>
					<dl class="contact-position dl-horizontal">
						<dt><?php echo JText::_('COM_CONTACT_POSITION'); ?>:</dt>
						<dd itemprop="jobTitle">
							<?php echo $this->contact->con_position; ?>
						</dd>
					</dl>
				<?php endif; ?>
				<?php echo $this->loadTemplate('address'); ?>
			</div>
		</div>
		
		<?php if ($tparams->get('allow_vcard')) : ?>
			<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS'); ?>
			<a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
			<?php echo JText::_('COM_CONTACT_VCARD'); ?></a>
		<?php endif; ?>

		<?php if ($presentation_style === 'sliders') : ?>
					</div>
				</div>
			</div>
		<?php elseif ($presentation_style === 'tabs') : ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<div class="card">
				<div class="card-header">
					<h2 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#display-form" aria-expanded="true" aria-controls="display-form">
							<?php echo JText::_('COM_CONTACT_EMAIL_FORM'); ?>
						</button>
					</h2>
				</div>
				<div id="display-form" class="collapse" data-parent="#slide-contact">
				<div class="card-body">
		<?php elseif ($presentation_style === 'tabs') : ?>
			<div class="tab-pane fade" id="display-form" role="tabpanel" aria-labelledby="display-form-tab">
		<?php elseif ($presentation_style === 'plain') : ?>
			<?php echo '<h3 class="mt-4">' . JText::_('COM_CONTACT_EMAIL_FORM') . '</h3>'; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate('form'); ?>

		<?php if ($presentation_style === 'sliders') : ?>
					</div>
				</div>
			</div>
		<?php elseif ($presentation_style === 'tabs') : ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_links')) : ?>
		<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<div class="card">
				<div class="card-header">
					<h2 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#display-articles" aria-expanded="true" aria-controls="display-articles">
							<?php echo JText::_('JGLOBAL_ARTICLES'); ?>
						</button>
					</h2>
				</div>
				<div id="display-articles" class="collapse" data-parent="#slide-contact">
					<div class="card-body">
		<?php elseif ($presentation_style === 'tabs') : ?>
			<div class="tab-pane fade" id="display-articles" role="tabpanel" aria-labelledby="display-articles-tab">
		<?php elseif ($presentation_style === 'plain') : ?>
			<?php echo '<h3 class="mt-4">' . JText::_('JGLOBAL_ARTICLES') . '</h3>'; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate('articles'); ?>

		<?php if ($presentation_style === 'sliders') : ?>
					</div>
				</div>
			</div>
		<?php elseif ($presentation_style === 'tabs') : ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<div class="card">
				<div class="card-header">
					<h2 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#display-profile" aria-expanded="true" aria-controls="display-profile">
							<?php echo JText::_('COM_CONTACT_PROFILE'); ?>
						</button>
					</h2>
				</div>
				<div id="display-profile" class="collapse" data-parent="#slide-contact">
				<div class="card-body">
		<?php elseif ($presentation_style === 'tabs') : ?>
			<div class="tab-pane fade" id="display-profile" role="tabpanel" aria-labelledby="display-profile-tab">
		<?php elseif ($presentation_style === 'plain') : ?>
			<?php echo '<h3 class="mt-4">' . JText::_('COM_CONTACT_PROFILE') . '</h3>'; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate('profile'); ?>

		<?php if ($presentation_style === 'sliders') : ?>
					</div>
				</div>
			</div>
		<?php elseif ($presentation_style === 'tabs') : ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_user_custom_fields') && $this->contactUser) : ?>
		<?php //echo $this->loadTemplate('user_custom_fields'); ?>		
		<?php $userFieldGroups    = array(); ?>		
		<?php foreach ($this->contactUser->jcfields as $field) : ?>
			<?php if (!in_array('-1', $tparams->get('show_user_custom_fields')) && (!$field->group_id || !in_array($field->group_id, $tparams->get('show_user_custom_fields')))) : ?>
				<?php continue; ?>
			<?php endif; ?>
			<?php if (!key_exists($field->group_title, $userFieldGroups)) : ?>
				<?php $userFieldGroups[$field->group_title] = array(); ?>
			<?php endif; ?>
			<?php $userFieldGroups[$field->group_title][] = $field; ?>
		<?php endforeach; ?>

		<?php foreach ($userFieldGroups as $groupTitle => $fields) : ?>
			<?php $id = JApplicationHelper::stringURLSafe($groupTitle); ?>
			<?php if ($presentation_style == 'sliders') : ?>
				<div class="card">
					<div class="card-header">
						<h2 class="mb-0">
							<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#display-<? echo $id; ?>" aria-expanded="true" aria-controls="display-misc">
								<?php echo $groupTitle ?: JText::_('COM_CONTACT_USER_FIELDS'); ?>
							</button>
						</h2>
					</div>
					<div id="display-<? echo $id; ?>" class="collapse" data-parent="#slide-contact">
						<div class="card-body">
			<?php elseif ($presentation_style == 'tabs') : ?>
				<div class="tab-pane fade show active" id="display-<? echo $id; ?>" role="tabpanel" aria-labelledby="display-<? echo $id; ?>-tab">
			<?php elseif ($presentation_style == 'plain') : ?>
				<?php echo '<h3>' . ($groupTitle ?: JText::_('COM_CONTACT_USER_FIELDS')) . '</h3>'; ?>
			<?php endif; ?>

			<div class="contact-profile" id="user-custom-fields-<?php echo $id; ?>">
				<dl class="dl-horizontal">
				<?php foreach ($fields as $field) : ?>
					<?php if (!$field->value) : ?>
						<?php continue; ?>
					<?php endif; ?>

					<?php if ($field->params->get('showlabel')) : ?>
						<?php echo '<dt>' . JText::_($field->label) . '</dt>'; ?>
					<?php endif; ?>

					<?php echo '<dd>' . $field->value . '</dd>'; ?>
				<?php endforeach; ?>
				</dl>
			</div>

			<?php if ($presentation_style == 'sliders') : ?>
						</div>
					</div>
				</div>
			<?php elseif ($presentation_style == 'tabs') : ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<div class="card">
				<div class="card-header">
					<h2 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#display-misc" aria-expanded="true" aria-controls="display-misc">
							<?php echo JText::_('COM_CONTACT_OTHER_INFORMATION'); ?>
						</button>
					</h2>
				</div>
				<div id="display-misc" class="collapse" data-parent="#slide-contact">
					<div class="card-body">
		<?php elseif ($presentation_style === 'tabs') : ?>
			<div class="tab-pane fade" id="display-misc" role="tabpanel" aria-labelledby="display-misc-tab">
		<?php elseif ($presentation_style === 'plain') : ?>
			<?php echo '<h3 class="mt-4">' . JText::_('COM_CONTACT_OTHER_INFORMATION') . '</h3>'; ?>
		<?php endif; ?>

		<div class="contact-miscinfo">
			<dl class="dl-horizontal">
				<dt>
					<span class="<?php echo $tparams->get('marker_class'); ?>">
						<i class="fa fa-info-circle" aria-hidden="true"></i>
					</span>
				</dt>
				<dd>
					<span class="contact-misc">
						<?php echo $this->contact->misc; ?>
					</span>
				</dd>
			</dl>
		</div>

		<?php if ($presentation_style === 'sliders') : ?>
					</div>
				</div>
			</div>
		<?php elseif ($presentation_style === 'tabs') : ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if($presentation_style == 'sliders'): ?>
		</div>
	<?php endif; ?>
	<?php if($presentation_style == 'tabs'): ?>
		</div>
	<?php endif; ?>

	<?php echo $this->item->event->afterDisplayContent; ?>
</div>
