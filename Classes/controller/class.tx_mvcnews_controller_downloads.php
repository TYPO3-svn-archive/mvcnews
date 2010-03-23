<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008  <>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/




/**
 * Default Controller for the 'objects' extension.
 *
 * @author	 Daniel Pötzinger <poetzinger@aoemedia.de>
 * @package	TYPO3
 * @subpackage	tx_objects
 */
class tx_mvcnews_controller_downloads extends tx_mvc_controller_action {

	/**
	 * @var        string
	 */
	protected $extensionKey = 'objects';

	/**
	 * @var        string
	 */
	protected $defaultActionMethodName = 'showlistAction';

	/**
	 * @var        string
	 */
	protected $argumentsNamespace = 'objects';


	
	/**
	 * Action renders the list of objects. If a search is active only the matching objects are in that list.
	 * The listview has normally a pagination and a searchform (todo)
	 *
	 * @return string
	 */
	public function showlistAction() {		
		return $this->view->render();
	}
	
}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/controller/class.tx_mvcnews_controller_default.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/controller/class.tx_mvcnews_controller_default.php']);
}
?>