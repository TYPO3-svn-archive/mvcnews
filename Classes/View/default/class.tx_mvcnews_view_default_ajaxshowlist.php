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

require_once(t3lib_extMgm::extPath("mvc").'mvc/view/class.tx_mvc_view_ajaxJqueryView.php');

/**
 * A ListView based on jQuery Ajax View: Renders a ArrayObject
 *
 * @package TYPO3
 * @subpackage mvc
 * @version $Id$
 */
class tx_mvcnews_view_default_ajaxshowlist extends tx_mvc_view_ajaxJqueryView {

	protected $listView;
	protected $pagination;
	

	/**
	 * sets the subview
	 *
	 * @param tx_mvc_view_phpTemplate $paginationView
	 */
	public function setListViewSubView($listView) {
		$this->listView=$listView;

	}
	

	/**
	 * sets the subview
	 *
	 * @param tx_mvc_view_phpTemplate $paginationView
	 */
	public function setPaginationSubView($paginationView) {
		$this->pagination=$paginationView;
	}
	

	/**
	* needs to build the JQuery stuff like:
	* 	 jQuery('#testform')->html($response);
	* 		..
	*
	*/
	protected function buildJqueryCommands() {
		jQuery('#mvcnews-list')->html($this->listView->render())
							->css('background-color','yellow')-> animate (array('backgroundColor'=>'#ffffff'), 1500);
		jQuery('#mvcnews-pagination')->html($this->pagination->render())
								 ->css('background-color','red')-> animate (array('backgroundColor'=>'#ffffff'), 500);
		jQuery('#mvcnews-paginationtext')->html(sprintf('Displaying Page %d of %d / Items %d to %d of %d',$this->pagination->currentPageNr,$this->pagination->pageCount,$this->pagination->currentItemsFrom,$this->pagination->currentItemsTo, $this->pagination->pageCount));
		
	}

}
?>