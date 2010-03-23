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
require_once(t3lib_extMgm::extPath("mvcnews").'domain/model/class.tx_mvcnews_domain_model_article.php');

tx_picocontainer_IoC_manager::registerSingleton('tx_mvcnews_domain_model_articleRepository');

/**
 * Domain Class "articleRepository". A Repository to get Articles
 *
 * @author	Daniel Pötzinger
 */
class tx_mvcnews_domain_model_articleRepository extends tx_mvc_domain_abstractRepository {
	
	/**
	 * A first prototype for a find by criteria.
	 * @todo implement criteria functionality
	 *
	 * @param stdClass $criteria
	 * @param int $offset
	 * @param int $limit
	 * @return ArrayObject Collection of objects
	 */
	public function findByCriteria($criteria,$offset=0,$limit=10,$sorting='') {
		$queryParts = $this->getSelectArrayForCriteria($criteria);
		if ($limit > 0) {
			$queryParts['LIMIT']=intval($offset).','.intval($limit);
		}
		if (in_array($sorting, array('title', 'date', 'image'))) {
			$queryParts['ORDERBY']=$sorting;
		}
		return $this->persitenceManager->getObjectCollection( $this->objectClassName , $queryParts ['WHERE'], $queryParts ['LIMIT'], $queryParts ['ORDERBY'], $queryParts ['GROUPBY']);
	}
	
	/**
	 * Returns the total amount of objects fitting the criterias
	 *
	 * @param unknown_type $criteria
	 * @return int
	 */
	public function countByCriteria($criteria) {
		$queryArray = $this->getSelectArrayForCriteria($criteria);
		return $this->persitenceManager->count( $this->objectClassName , $queryParts ['WHERE']);
	}
	
	/**
	 * Later this is the place where for example specific searches are transformed into the correct query
	 *
	 * @param unknown_type $criteria
	 * @return array
	 */
	private function getSelectArrayForCriteria($criteria) {
		$where=array();
		$where[]='1=1';
		if ($criteria->withpicture) {
			$where[]="image <> ''";
		}
		if ($criteria->sword) {
			$where[]="(title LIKE ('%".$criteria->sword."%') OR description LIKE ('%".$criteria->sword."%'))";			
		}	
		if ($criteria->category) {
			$where[]="categoryid=".intval($criteria->category);			
		}	
		$queryParts = array(
			'SELECT'  => '*',
			'FROM'    => 'tx_objects_object',
			'WHERE'   => implode(' AND ',$where),
			'GROUPBY' => '',
			'ORDERBY' => '',
			'LIMIT'   => ''
		);

		return $queryParts;
	}
	
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/domain/class.tx_mvcnews_objectRepository.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/objects/domain/class.tx_mvcnews_objectRepository.php']);
}

?>