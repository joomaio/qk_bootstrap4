<?php
/**
 * @package     Joomla.Site
 * @subpackage  Template.system
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/*
 * container (chosen container)
 */
function modChrome_container($module, &$params, &$attribs)
{

	$moduleTag      = htmlspecialchars($params->get('module_tag', 'div'), ENT_QUOTES, 'UTF-8');
	$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
	$moduleClass    = $bootstrapSize !== 0 ? ' span' . $bootstrapSize : '';
	$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

	// Temporarily store header class in variable
	$headerClass    = $params->get('header_class');
	$headerClass    = $headerClass ? ' class="' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : '';

	if (!empty ($module->content)) : ?>
		<?php if (strpos($moduleclass_sfx,'fluid')!==false) : ?>
			<div class="container-fluid">
				<div class="row">
					<<?php echo $moduleTag; ?> class="w-100 moduletable <?php echo $moduleclass_sfx . $moduleClass; ?>">
						<?php if ((bool) $module->showtitle) : ?>
							<<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>>
						<?php endif; ?>
						<?php echo $module->content; ?>
					</<?php echo $moduleTag; ?>>				
				</div>
			</div>
		<?php else: ?>
			<div class="container">
				<div class="row">
					<<?php echo $moduleTag; ?> class="w-100 moduletable <?php echo $moduleclass_sfx . $moduleClass; ?>">
						<?php if ((bool) $module->showtitle) : ?>
							<<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>>
						<?php endif; ?>
						<?php echo $module->content; ?>
					</<?php echo $moduleTag; ?>>
				</div>
			</div>
		<?php endif; ?>
	<?php endif;
}

/*
 * html5 (chosen html5 tag and font header tags)
 */
function modChrome_card($module, &$params, &$attribs)
{
	$moduleTag      = htmlspecialchars($params->get('module_tag', 'div'), ENT_QUOTES, 'UTF-8');
	$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
	$moduleClass    = $bootstrapSize !== 0 ? ' span' . $bootstrapSize : '';

	// Temporarily store header class in variable
	$headerClass    = $params->get('header_class');
	$headerClass    = $headerClass ? ' class="' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : '';

	if (!empty ($module->content)) : ?>
		<<?php echo $moduleTag; ?> class="w-100 moduletable <?php echo htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass; ?>">
			<div class="card my-4">
				<?php if ((bool) $module->showtitle) : ?>
					<div class="card-header"><<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>></div>
				<?php endif; ?>
				<div class="card-body"><?php echo $module->content; ?></div>
			</div>
		</<?php echo $moduleTag; ?>>
	<?php endif;
}
