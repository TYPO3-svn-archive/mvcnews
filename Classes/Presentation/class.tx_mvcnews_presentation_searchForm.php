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
require_once(t3lib_extMgm::extPath("mvcnews").'domain/model/class.tx_mvcnews_domain_model_categoryRepository.php');
require_once t3lib_extMgm::extPath('mvc') . 'mvc/presentation/form/class.tx_mvc_presentation_form_simpleForm.php';

/**
 * searchform representing the search formular
 *
 * @author	Daniel Pötzinger
 * @package	TYPO3
 * @subpackage	objects
 */
class tx_mvcnews_presentation_searchform extends tx_mvc_presentation_form_simpleForm {
	
	/**
	 * inits the form structure
	 * @param array $arguments
	 */	
	public function __construct() {			
		$this->addElement(new tx_mvc_presentation_form_selectElement('withpicture','','radio',
															null,
															array('1'=>'ja','0'=>'nein')
															));
															
		$this->addElement(new tx_mvc_presentation_form_element('sword','','input',
														tx_mvc_validator_factory::getTextPlainValidator()		
														));

		$this->addElement(new tx_mvc_presentation_form_selectElement('category','1','select',
														null,
														$this->getSelectArrayForCategory()
														));													
														
			
		
	}
	/**
	* returns a array for the selectbox with categoryid => categoryname
	* 
	* @return array
	*/
	private function getSelectArrayForCategory() {
		$rep=tx_picocontainer_IoC_manager::getSingleton('tx_mvcnews_domain_model_categoryRepository');
		$categorys=$rep->findAll();
		
		$sel=array(''=>'');
		foreach ($categorys as $category) {
			$sel[$category->getUid()]=$category->getTitle();
		}
		return $sel;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/domain/class.x_objects_presentation_object.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/domain/class.x_objects_presentation_object.php']);
}

?>