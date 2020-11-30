<?php defined( '_JEXEC' ) or die( 'Restricted access' );
use Joomla\CMS\Log\Log;

class bootstrap4InstallerScript
{
	/**
	 * Method to install the extension
	 * $parent is the class calling this method
	 *
	 * @return void
	 */
	function install($parent) 
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Fields to update.
		$fields = array(
			$db->quoteName('enabled') . ' = 1'
		);

		// Conditions for which records should be updated.
		$conditions = array(
			$db->quoteName('element') . ' = "jaio"', 
		);
		$query->update($db->quoteName('#__extensions'))->set($fields)->where($conditions);
		$db->setQuery($query);
		$result = $db->execute();
		if($result){
			echo JText::_('TPL_BOOTSTRAP4_INSTALL_SUCCESS');
		}
		else{
			echo JText::_('TPL_BOOTSTRAP4_INSTALL_ERROR');
		}
		
	}

	/**
	 * Method to uninstall the extension
	 * $parent is the class calling this method
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		echo JText::_('TPL_BOOTSTRAP4_UNINSTALL');
	}

	/**
	 * Method to update the extension
	 * $parent is the class calling this method
	 *
	 * @return void
	 */
	function update($parent) 
	{
		echo '<p>' . JText::_('TPL_BOOTSTRAP4_UPDATE') . $parent->get('manifest')->version . '.</p>';
	}
	// public function preflight($type, $parent) 
    // {
	// 	$filename = JPATH_ROOT . "/media/pkg_jaio/bootstrap4/";
	// 	if(!file_exists($filename)){
	// 		JLog::add(JText::_('TPL_BOOTSTRAP4_INSTALL_FALSE'), JLog::ERROR, 'jerror');
	// 		return false;
	// 	}
    // }
}