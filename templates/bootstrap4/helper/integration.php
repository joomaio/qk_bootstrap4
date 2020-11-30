<?php defined( '_JEXEC' ) or die( 'Restricted access' );

use Jaio\UI\bootstrap4;

/**
 * Class to support template integrate UI
 *  
 */

abstract class IntegrationHelper{

    public static function solveConflict(){
        
        $doc = \JFactory::getDocument();
		$headerdata = $doc->getHeadData();	
		$scripts = (isset($headerdata['scripts']) && is_array($headerdata['scripts'])) ? $headerdata['scripts'] : array();
		$headerdata['scripts'] = array();

		/**
		 * Solve conflict
		 */
		$replace = [ 
			'media/jui/js/jquery.js' => 'jquery',
			'media/jui/js/jquery.min.js' => 'jquery',
			'media/jui/js/bootstrap.js' => 'bootstrap',
			'media/jui/js/bootstrap.min.js' => 'bootstrap',
			//'media/system/js/mootools'  => '-remove-',
			//'media/media/js/mediafield-mootools' => '-remove-'
			//'media/system/js/frontediting.js' => '-remove-', // => turn off in backend
		]; /// media/jui/js/jquery.min

		foreach( $scripts as $id => $script){

			$found = false;
			foreach($replace as $rid=>$asset){
				if( strpos($id, $rid) !== false )
					$found = $asset;
			}

			if( $found ) { 

				if( $found != '-remove-') {

					$links = self::getLinks($found);
		
					foreach($links as $link) {
						self::array_insert($scripts, $id, [ JUri::root(true). '/'.$link => []]);
					}

				}

				unset($scripts[$id]);

			}
		}
		
		$unique = array_unique(array_keys($scripts));
		$filtered = [];
		foreach($unique as $id){
			$filtered[$id] = $scripts[$id];
		}
		
		$headerdata['scripts'] = $filtered;
		$doc->setHeadData($headerdata);	

	}
	
	public static function getLinks($key){

		list($links, $parents) = bootstrap4::findJs($key, true);

		foreach($parents as $key) {
			$arr = self::getLinks($key);
			foreach($arr as $lnk) array_unshift($links, $lnk );
		}

		return $links;
	}

	/**
	 * @param array      $array
	 * @param int|string $position
	 * @param mixed      $insert
	 */
	public static function array_insert(&$array, $position, $insert)
	{
		if (is_int($position)) {
			array_splice($array, $position, 0, $insert);
		} else {
			$pos   = array_search($position, array_keys($array));
			$array = array_merge(
				array_slice($array, 0, $pos),
				$insert,
				array_slice($array, $pos)
			);
		}
	}
}