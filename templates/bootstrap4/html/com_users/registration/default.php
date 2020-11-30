<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

?>
<div class="row">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<h1 class="form-heading">
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	<?php endif; ?>
	<div class="offset-md-3 col-md-6">
			<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
				<div class="panel">
			<?php endif; ?>
				<?php if ($this->params->get('logindescription_show') == 1) : ?>
					<p>
						<?php echo $this->params->get('login_description'); ?>
					</p>
				<?php endif; ?>

				<?php if (($this->params->get('login_image') != '')) :?>
					<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image mx-auto d-block" alt="<?php echo JTEXT::_('COM_USERS_LOGIN_IMAGE_ALT')?>"/>
				<?php endif; ?>

			<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
				</div>
			<?php endif; ?>
			<form action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="needs-validation" novalidate id="Login">
			<?php // Iterate through the form fieldsets and display each one. ?>
				<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
					<?php $fields = $this->form->getFieldset($fieldset->name); ?>
					<?php if (count($fields)) : ?>
						<?php // If the fieldset has a label set, display it as the legend. ?>
						<?php if (isset($fieldset->label)) : ?>
							<h1 class="my-4"><?php echo JText::_($fieldset->label); ?></h1>
						<?php endif; ?>
						<?php // Iterate through the fields in the set and display them. ?>
						<?php foreach ($fields as $field) : ?>
							<?php // If the field is hidden, just display the input. ?>
							<?php if ($field->hidden) : ?>
								<?php echo $field->input; ?>
							<?php else : ?>
								<div class="form-group">
									<?php echo JText::_($field->label); ?>
									<?php if (!$field->required && $field->type !== 'Spacer') : ?>
										<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
									<?php endif; ?>
									<?php echo $field->input; ?>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<div class="form-group text-right">
					<button type="submit" class="btn btn-primary mr-3">
						<?php echo JText::_('JREGISTER'); ?>
					</button>
					<a class="btn btn-light" href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>">
						<?php echo JText::_('JCANCEL'); ?>
					</a>
					<input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="registration.register" />
				</div>
				<?php echo JHtml::_('form.token'); ?>
			</form>
	</div>
</div>