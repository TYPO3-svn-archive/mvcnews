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
class tx_mvcnews_view_default_showlist extends tx_mvc_view_phpTemplate {

	/**
	 * The default template is used if o template is set
	 *
	 * @var string
	 */
	protected $defaultTemplate='EXT:mvcnews/templates/default/showlist.php';
	

	protected $listView;
	protected $pagination;
	protected $searchFormSubView;

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
	public function setSearchFormSubView($searchFormSubView) {
		$this->searchFormSubView=$searchFormSubView;
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
	 * Place where you can add viewspecific processing that is done before rendering
	 *
	 */
	protected function preRenderProcessing() {
	    if ($this->configuration->get('noJqueryInclude')!=1) {
		    $this->addJavaScriptInclude('EXT:mvcnews/templates/default/js/jquery-1.3.2.js');
		    $this->addJavaScriptInclude('EXT:mvcnews/templates/default/js/jquery-ui-1.7.custom.min.js');		    
		    $this->addJavaScriptInclude('EXT:mvc/contrib/jquery.php/javascript/jquery.php.js');
	    }
	   // $ajaxActionLink=$this->linkCreator->getAjaxActionLink('ajaxShowList')->makeUrl();
		$this->addJavaScriptInclude('EXT:mvcnews/templates/default/js/list.js',0);
		$this->addJavascript('
			$(document).ready(function() {
				list.init();
			});
		');
		//	var tx_mvcnews_default_ajaxShowListAction=\''.$ajaxActionLink.'\';
	}


}
?>