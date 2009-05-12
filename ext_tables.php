<?php
if (!defined ('TYPO3_MODE'))
	die ('Access denied.');

$TCA["tx_mvcnews_article"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_article',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs'=>1,
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_mvcnews_article.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "sys_language_uid, l18n_parent, l18n_diffsource, hidden, starttime, endtime, fe_group, title, date, description, image, categoryid, downloads",
	)
);

$TCA["tx_mvcnews_category"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_category',
		'label'     => 'title',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE, 
		'origUid' => 't3_origuid',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_mvcnews_category.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "sys_language_uid, l18n_parent, l18n_diffsource, hidden, starttime, endtime, fe_group, title",
	)
);
$TCA["tx_mvcnews_downloads"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_downloads',
		'label'     => 'title',
		'sortby' => 'sorting',
		'dividers2tabs'=>1,
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_mvcnews_downloads.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, starttime, endtime, fe_group, title, filepath, description, image, caption, flags, news",
	)
);

$pluginListTypeKey=$_EXTKEY.'_plugin';
t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginListTypeKey]= 'layout,select_key,pages,recursive';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginListTypeKey]='pi_flexform';
t3lib_extMgm::addPlugin(array('LLL:EXT:mvcnews/locallang_db.xml:tt_content.list_type_pi1',$pluginListTypeKey),'list_type');
t3lib_extMgm::addStaticFile($_EXTKEY,"configuration/static/","MVCNEWS Outputs");
t3lib_extMgm::addPiFlexFormValue($pluginListTypeKey, 'FILE:EXT:'.$_EXTKEY.'/configuration/flexform.xml');


//USER_INT controller:
$pluginListTypeKey=$_EXTKEY.'_plugin2';
t3lib_extMgm::addPlugin(array('LLL:EXT:mvcnews/locallang_db.xml:tt_content.list_type_pi2',$pluginListTypeKey),'list_type');
?>