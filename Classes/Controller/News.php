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
class Tx_Mvcnews_Controller_News extends tx_mvc_controller_action {
	
	/**
	 * @var        string
	 */
	protected $extensionKey = 'mvcnews';
	
	/**
	 * @var        string
	 */
	protected $defaultActionMethodName = 'showlistAction';
	
	/**
	 * @var        string
	 */
	protected $argumentsNamespace = 'mvcnews';
	
	/**
	 * array with list of arguments that should per default be forwarded (this is passed to the linkCreator)
	 * 
	 * @var array
	 */
	protected $keepArgumentKeys = array ('sword', 'withpictures', 'category' );
	
	/**
	 * Enter description here...
	 *
	 * @var tx_mvcnews_domain_model_objectRepository
	 */
	private $articleRepository = NULL;
	
	/**
	 * common controller initialization (called by framework)
	 *
	 */
	protected function initializeController() {
		$this->articleRepository = tx_picocontainer_IoC_manager::getSingleton ( 'tx_mvcnews_domain_model_articleRepository' );
	}
	
	/**
	 * Place to add controller specific processing.
	 * Use this to secure your arguments!
	 */
	protected function initializeArguments() {
		$this->arguments ['offset'] = tx_mvc_filter_factory::getIntPositiveFilter ()->filter ( $this->arguments ['offset'] );
		$this->arguments ['sorting'] = tx_mvc_filter_factory::getTextPlainFilter ()->filter ( $this->arguments ['sorting'] );
		$this->arguments ['sword'] = tx_mvc_filter_factory::getTextPlainFilter ()->filter ( $this->arguments ['sword'] );
	}
	
	/**
	 * Action renders the list of objects. If a search is active only the matching objects are in that list.
	 *  the view for the action itself is implemented as a composite view, so the three subviews (list. searchform and pagination) are initialised.
	 *  Therefore we use the widgets that comes with the MVC extension.
	 *
	 * @return string
	 */
	public function showlistAction() {
		
		$searchFormmodel = new tx_mvcnews_presentation_searchform ( );
		$searchFormmodel->setArguments ( $this->arguments );
		
		//only use criteria to search if searchform was valid
		if ($searchFormmodel->isValid () && $searchFormmodel->wasSent ()) {
			$criteria = $this->getCriteriaFromArguments ();
		} else {
			$criteria = new stdClass ( );
		}
		
		$paginationSubView = $this->getPaginationSubView ( $criteria );
		$listSubView = $this->getListSubView ( $this->getArticleCollection ( $criteria, $this->arguments ['offset'] ) );
		
		$searchFormSubView = new tx_mvcnews_view_default_subview_searchFormView ( );
		$this->initializeView ( $searchFormSubView );
		$searchFormSubView->setFormModel ( $searchFormmodel );
		
		if ($searchFormmodel->wasSent ()) {
			$searchFormSubView->showValidationMessages ();
		}
		// assign the subviews to the composite view and render
		$this->view->setPaginationSubView ( $paginationSubView );
		$this->view->setListViewSubView ( $listSubView );
		$this->view->setSearchFormSubView ( $searchFormSubView );
		return $this->view->render ();
	}
	
	/**
	 * The ajax action, that action answers AJAX requests. 
	 * 
	 * @return void	(json string is outputted)
	 */
	public function ajaxshowlistAction() {
		
		$searchFormmodel = new tx_mvcnews_presentation_searchform ( );
		$searchFormmodel->setArguments ( $this->arguments );
		//only use criteria to search if searchform was valid
		if ($searchFormmodel->isValid () && $searchFormmodel->wasSent ()) {
			$criteria = $this->getCriteriaFromArguments ();
		} else {
			$criteria = new stdClass ( );
		}
		
		$paginationSubView = $this->getPaginationSubView ( $criteria );
		$listSubView = $this->getListSubView ( $this->getArticleCollection ( $criteria, $this->arguments ['offset'] ) );
		$this->view->setPaginationSubView ( $paginationSubView );
		$this->view->setListViewSubView ( $listSubView );
		echo $this->view->render ();
		exit ();
	}
	
	/**
	 * detail action shows the single view of an object, if a detail view of an object is requested.
	 *
	 * @return string
	 */
	public function showdetailAction() {
		if (empty ( $this->arguments ['id'] )) {
			return 'no id given';
		}
		
		$this->view->setArticle ( new tx_mvcnews_presentation_articlePresentationModel ( $this->articleRepository->findById ( $this->arguments ['id'] ), $this->configuration->get ( 'presentationModel.article.' ), 'tx_mvcnews_article' ) );
		return $this->view->render ();
	}
	
	/**
	 * delete Action
	 *
	 * @return unknown
	 */
	public function deleteAction() {
		return 'not implemented yet';
		//return $this->view->render();
	}
	
	/**
	 * edit action
	 *
	 * @return unknown
	 */
	public function editAction() {
		return 'not implemented yet';
		//return $this->view->render();
	}
	
	/**
	 * asking the repository to get a list of objects (taking the current search and $itemsPerPage setting into account)
	 *
	 * @param boolean $doSearch	if the search should be used
	 */
	private function getArticleCollection($criteria, $offset) {
		$itemsPerPage = tx_mvc_filter_factory::getIntGreaterThanFilter ()->setMin ( 1 )->filter ( $this->configuration->get ( 'listsettings.itemsPerPage' ) );
		return $this->articleRepository->findByCriteria ( $criteria, $offset, $itemsPerPage );
	}
	
	/**
	 * wrap the domain object "object" with the presentationmodel for the class object
	 * 
	 * @param ArrayAccess of tx_mvcnews_object
	 * @return ArrayObject of tx_mvcnews_presentation_object
	 */
	private function wrapWithPresentationmodel(ArrayAccess $objectList) {
		$PM = new ArrayObject ( );
		foreach ( $objectList as $object ) {
			$PM->append ( new tx_mvcnews_presentation_articlePresentationModel ( $object, $this->configuration->get ( 'presentationModel.article.' ), 'tx_mvcnews_article' ) );
		}
		return $PM;
	}
	
	/**
	 * initialize the subview with pagination
	 * 
	 * @return tx_mvc_view_widget_pagination
	 *
	 */
	private function getPaginationSubView($criteria) {
		$paginationSubView = new tx_mvc_view_widget_pagination ( );
		$this->initializeView ( $paginationSubView );
		$paginationSubView->setCurrentOffset ( $this->arguments ['offset'] );
		$paginationSubView->setCount ( $this->articleRepository->countByCriteria ( $criteria ) );
		$paginationSubView->setItemsPerPage ( $this->configuration->get ( 'listsettings.itemsPerPage' ) );
		return $paginationSubView;
	}
	
	/**
	 * returns subview with list
	 *
	 * @param ArrayAccess	The list to render 
	 * @return tx_mvc_view_widget_phpTemplateListView
	 */
	private function getListSubView(ArrayAccess $objectCollectionForList) {
		$listSubView = new tx_mvc_view_widget_phpTemplateListView ( );
		$this->initializeView ( $listSubView );
		$listSubView->setFieldsToShow ( array ('uid', 'title', 'date', 'image') );
		$listSubView->setList ( $this->wrapWithPresentationmodel ( $objectCollectionForList ) );
		$listSubView->showActionLinks ();
		$listSubView->addSortingLinkForField ( 'title' );
		$listSubView->addSortingLinkForField ( 'date' );
		$listSubView->dontShowEditActionLink ();
		$listSubView->dontShowDeleteActionLink ();
		return $listSubView;
	}
	/**
	 * returns the criteria object (for now stdClass) for the current search 
	 *
	 * @return stdClass
	 */
	private function getCriteriaFromArguments() {
		$criteria = new stdClass ( );
		if ($this->arguments ['withpicture'] == '1') {
			$criteria->withpicture = TRUE;
		}
		$criteria->sword = $this->arguments ['sword'];
		if (is_numeric ( $this->arguments ['category'] ) && $this->arguments ['category'] != '') {
			$criteria->category = $this->arguments ['category'];
		}
		
		return $criteria;
	}
}
if (defined ( 'TYPO3_MODE' ) && $TYPO3_CONF_VARS [TYPO3_MODE] ['XCLASS'] ['ext/objects/controller/class.tx_mvcnews_controller_default.php']) {
	include_once ($TYPO3_CONF_VARS [TYPO3_MODE] ['XCLASS'] ['ext/objects/controller/class.tx_mvcnews_controller_default.php']);
}
?>