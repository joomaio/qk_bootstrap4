<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="col-12 col-md text-center mb-md-0 mb-5">

<?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)) : ?>	
	<figure class="newsflash-image">
		<img src="<?php echo $item->imageSrc; ?>" alt="<?php echo $item->imageAlt; ?>">
		<?php if (!empty($item->imageCaption)) : ?>
			<figcaption>
				<?php echo $item->imageCaption; ?>
			</figcaption>
		<?php endif; ?>
	</figure>
<?php endif; ?>

<?php if ($params->get('item_title')) : ?>
	<?php $item_heading = $params->get('item_heading', 'h4'); ?>
	<<?php echo $item_heading; ?> class="newsflash-title<?php echo $params->get('moduleclass_sfx'); ?>">
	<?php if ($item->link !== '' && $params->get('link_titles')) : ?>
		<a href="<?php echo $item->link; ?>">
			<?php echo $item->title; ?>
		</a>
	<?php else : ?>
		<?php echo $item->title; ?>
	<?php endif; ?>
	</<?php echo $item_heading; ?>>
<?php endif; ?>

<?php if (!$params->get('intro_only')) : ?>
	<?php echo $item->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $item->beforeDisplayContent; ?>

<?php if ($params->get('show_introtext', 1)) : ?>
	<?php echo $item->introtext; ?>
<?php endif; ?>

<?php echo $item->afterDisplayContent; ?>
<?php 
$readmoreText = (isset($item->alternative_readmore)) ? $item->alternative_readmore:$item->linkText;
?>
<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
	<?php echo '<a class="readmore btn btn-secondary" href="' . $item->link . '">' . $readmoreText . '</a>'; ?>
<?php endif; ?>
</div>
