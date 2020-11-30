<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$list = $displayData['list'];
?>
<ul class="pagination">
	<li class="page-item pagination-start <?php echo ($list['start']['active'] ? '':'disabled'); ?>"><span class="page-link"><?php echo $list['start']['data']; ?></span></li>
	<li class="page-item pagination-prev <?php echo ($list['previous']['active'] ? '':'disabled'); ?>"><span class="page-link"><?php echo $list['previous']['data']; ?></span></li>
	<?php foreach ($list['pages'] as $page) : ?>
		<?php echo '<li class="page-item '.($page['active'] ? '':'active').'"><span class="page-link">' . $page['data'] . '</span></li>'; ?>
	<?php endforeach; ?>
	<li class="page-item pagination-next <?php echo ($list['next']['active'] ? '':'disabled'); ?>"><span class="page-link"><?php echo $list['next']['data']; ?></span></li>
	<li class="page-item pagination-end <?php echo ($list['end']['active'] ? '':'disabled'); ?>"><span class="page-link"><?php echo $list['end']['data']; ?></span></li>
</ul>
