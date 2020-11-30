<?php defined( '_JEXEC' ) or die( 'Restricted access' );

use Jaio\UI\bootstrap4;

/**
 * Bootstrap4 implement
 */

JHtml::_('stylesheet', 'tpl_bootstrap4/bootstrap.min.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'tpl_bootstrap4/font-awesome.min.css', array('version' => 'auto', 'relative' => true));

JHtml::_('script', 'tpl_bootstrap4/vendor/popper.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'tpl_bootstrap4/bootstrap/bootstrap.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'tpl_bootstrap4/page/Chart.js', array('version' => 'auto', 'relative' => true));

$app = JFactory::getApplication();

// Output as HTML5
$this->setHtml5(true);

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));

// Load optional rtl Bootstrap css and Bootstrap bugfixes
// JHtmlBootstrap::loadCss($includeMaincss = false, $this->direction);
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<jdoc:include type="head" />
</head>
<body class="contentpane rfmodal<?php echo $this->direction === 'rtl' ? ' rtl' : ''; ?>">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>
