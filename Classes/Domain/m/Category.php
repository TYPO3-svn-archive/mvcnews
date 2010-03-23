<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Daniel Pötzinger
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

tx_picocontainer_IoC_manager::registerPrototype('tx_mvcnews_domain_model_category');

//register this class to the class2TableMapping object
tx_picocontainer_IoC_manager::getSingleton('tx_mvc_system_persitence_class2TableMapping')->addMapping('tx_mvcnews_category','tx_mvcnews_domain_model_category');


/**
 * Domain Class "category"
 *
 * @author	Daniel Pötzinger
 */
class tx_mvcnews_domain_model_category extends tx_mvc_domain_abstractObject {

	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/domain/class.tx_mvcnews_object.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/domain/class.tx_mvcnews_object.php']);
}

?>