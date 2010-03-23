<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008  Daniel Pötzinger <>
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

require_once(t3lib_extMgm::extPath("mvc").'mvc/view/class.tx_mvc_view_phpTemplate.php');

/**
 * A ListView based on php TemplateView: Renders a ArrayObject
 *
 * @package TYPO3
 * @subpackage mvc
 * @version $Id$
 */
class Tx_Mvcnews_View_Default_SubView_SearchForm extends tx_mvc_view_phpTemplate {
	
	/**
	 * The default template is used if o template is set
	 *
	 * @var string
	 */
	protected $defaultTemplate='EXT:mvcnews/templates/default/sub/sub_searchform.php';

	
	/**
	 * the form to be rendered
	 *
	 * @var tx_mvc_ddd_form_simpleForm
	 */
	protected $formModel;
	protected $showValidationMessages=FALSE;
	
	/**
	 * @param  $formModel
	 */
	public function setFormModel(tx_mvc_presentation_form_simpleForm $formModel) {
		$this->formModel = $formModel;
	}
	
	/**
	 * if elements in the form are not valid - the messages are shown
	 *
	 */
	public function showValidationMessages() {
		$this->showValidationMessages=TRUE;
	}
	
	protected function getValidationMessage($element,$message) {
		if ($this->showValidationMessages === TRUE && $element->isValid() === FALSE) {
			return '<span class="error">'.$message.'</span>';
		}
		else {
			return '';
		}
		
	}

}
?>