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
<div class="contact-category-list <?php echo $this->pageclass_sfx; ?>">
    <?php
        $this->subtemplatename = 'items';
        echo JLayoutHelper::render('joomla.content.category_default', $this);
    ?>
</div>