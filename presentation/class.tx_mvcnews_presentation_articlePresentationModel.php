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


/**
 * Example presentationmodel for Articles. 
 *
 * @author	Daniel Pötzinger
 * @package	TYPO3
 * @subpackage	objects
 */
class tx_mvcnews_presentation_articlePresentationModel extends tx_mvc_presentation_TCA {
	
	/**
	 * fields that should be answerd in the presentationobject itself needs to be configured here:
	 *
	 * @var array
	 */
	protected $localProcessingFields=array('title');
	
	/**
	 * Example of overriding the title output. Here some viewlogic is added.
	 *
	 * @return string
	 */
	public function getTitle() {
		$date=$this->mappedObject->getDate();
		$newdate=time()-360000;
		if($newdate>$date) 
			return '<span class="notnew">'.$this->mappedObject->getTitle().'</span>';
		else 
			return '<span class="new">'.$this->mappedObject->getTitle().'</span>';
		
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/domain/class.x_objects_presentation_object.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/domain/class.x_objects_presentation_object.php']);
}

?>