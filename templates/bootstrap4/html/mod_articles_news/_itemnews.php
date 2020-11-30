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
<?php if ($params->get('image')==0):?>
	<div class="col">
		<div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div class="col col-lg-7 p-4 d-flex flex-column position-static news-content">
				<strong class="d-inline-block mb-2 text-primary"><?php echo $item->category_title; ?></strong>
				<?php if ($params->get('item_title')) : ?>
					<?php $item_heading = $params->get('item_heading', 'h4'); ?>
					<<?php echo $item_heading; ?> class="newsflash-title mb-0">
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

				<div class="mb-1 text-muted"><?php echo date("M y", strtotime($item->publish_up)); ?></div>

				<?php echo $item->beforeDisplayContent; ?>

				<?php if ($params->get('show_introtext', 1)) : ?>
					<p class="card-text mb-auto"><?php echo $item->introtext; ?></p>
				<?php endif; ?>
				<?php echo $item->afterDisplayContent; ?>
				<?php $readmoreText = (isset($item->alternative_readmore)) ? $item->alternative_readmore:$item->linkText; ?>
				<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
					<?php echo '<a class="readmore stretched-link" href="' . $item->link . '">' . $readmoreText . '</a>'; ?>
				<?php endif; ?>
			</div>
			<div class="col col-lg-5 d-none d-lg-block">
				<?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)) : ?>	
					<div class="position-relative h-100 overflow-hidden news-thumb">
						<img src="<?php echo $item->imageSrc; ?>" alt="<?php echo $item->imageAlt; ?>" class="bd-placeholder-img">
						<?php if (!empty($item->imageCaption)) : ?>
							<figcaption>
								<?php echo $item->imageCaption; ?>
							</figcaption>
						<?php endif; ?>
					</div>
				<?php endif; ?>			
			</div>
		</div>
	</div>
<?php else: ?>
	<div class="col">
		<div class="jumbotron p-4 p-md-5 mt-4 text-white rounded bg-dark">
			<div class="col-md-6 px-0">
				<?php if ($params->get('item_title')) : ?>
					<?php $item_heading = $params->get('item_heading', 'h1'); ?>
					<<?php echo $item_heading; ?> class="newsflash-title jumbotron-article-title font-italic">
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
					<p class="lead my-3"><?php echo $item->introtext; ?></p>
				<?php endif; ?>
				<?php echo $item->afterDisplayContent; ?>

				<?php $readmoreText = (isset($item->alternative_readmore)) ? $item->alternative_readmore:$item->linkText; ?>
				<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
					<?php echo '<p class="lead mb-0"><a class="readmore text-white font-weight-bold" href="' . $item->link . '">' . $readmoreText . '</a></p>'; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>