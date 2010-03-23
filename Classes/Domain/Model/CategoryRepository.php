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

require_once(t3lib_extMgm::extPath("mvcnews").'domain/model/class.tx_mvcnews_domain_model_category.php');

tx_picocontainer_IoC_manager::registerSingleton('tx_mvcnews_domain_model_categoryRepository');

/**
 * Domain Class "articleRepository". A Repository to get Articles
 *
 * @author	Daniel Pötzinger
 */
class tx_mvcnews_domain_model_categoryRepository extends tx_mvc_domain_abstractRepository {
	
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/domain/class.tx_mvcnews_objectRepository.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/domain/class.tx_mvcnews_objectRepository.php']);
}

?>