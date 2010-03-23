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
 * USER_INT Controller for the 'mvcnews' extension. (Just for showing uncached USER_INT controllers)
 *
 * @author	 Daniel Pötzinger <poetzinger@aoemedia.de>
 * @package	TYPO3
 * @subpackage	tx_objects
 */
class tx_mvcnews_controller_uncachedtest extends tx_mvc_controller_action {

	/**
	 * @var        string
	 */
	protected $extensionKey = 'mvcnews';

	/**
	 * @var        string
	 */
	protected $defaultActionMethodName = 'showtimeAction';

	/**
	 * @var        string
	 */
	protected $argumentsNamespace = 'mvcnews2';


	protected function initializeController() {
		
	}
	/**
	 * the default action
	 *
	 * @return unknown
	 */
	public function showtimeAction() {		
		return 'just a simple example of a uncached controller output (USER_INT)'.(string) time();
	}

	
}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/controller/class.tx_mvcnews_controller_latest.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/controller/class.tx_mvcnews_controller_latest.php']);
}
?>