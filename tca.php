<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA["tx_mvcnews_article"] = array (
	"ctrl" => $TCA["tx_mvcnews_article"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "sys_language_uid,l18n_parent,l18n_diffsource,hidden,starttime,endtime,fe_group,title,date,description,image,category"
	),
	"feInterface" => $TCA["tx_mvcnews_article"]["feInterface"],
	"columns" => array (
		't3ver_label' => array (
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array (
				'type' => 'input',
				'size' => '30',
				'max'  => '30',
			)
		),
		'sys_language_uid' => array (
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l18n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_mvcnews_article',
				'foreign_table_where' => 'AND tx_mvcnews_article.pid=###CURRENT_PID### AND tx_mvcnews_article.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array (
			'config' => array (
				'type' => 'passthrough'
			)
		),
		'hidden' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'starttime' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'default'  => '0',
				'checkbox' => '0'
			)
		),
		'endtime' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0',
				'range'    => array (
					'upper' => mktime(0, 0, 0, 12, 31, 2020),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
				)
			)
		),
		'fe_group' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config'  => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		"title" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_article.title",
			"config" => Array (
				"type" => "input",
				"size" => "30",
			)
		),
		"date" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_article.date",
			"config" => Array (
				"type"     => "input",
				"size"     => "8",
				"max"      => "20",
				"eval"     => "date",
				"checkbox" => "0",
				"default"  => "0"
			)
		),
		"description" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_article.description",
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "5",
				"wizards" => Array(
					"_PADDING" => 2,
					"RTE" => array(
						"notNewRecords" => 1,
						"RTEonly" => 1,
						"type" => "script",
						"title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
						"icon" => "wizard_rte2.gif",
						"script" => "wizard_rte.php",
					),
				),
			)
		),
		"image" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_article.image",
			"config" => Array (
				"type" => "group",
				"internal_type" => "file",
				"allowed" => $GLOBALS["TYPO3_CONF_VARS"]["GFX"]["imagefile_ext"],
				"max_size" => 500,
				"uploadfolder" => "uploads/tx_objects",
				"show_thumbs" => 1,
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"category" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_article.category",
			"config" => Array (
				"type" => "select",
				"mvcAlias" => 'category',
				"foreign_table" => "tx_mvcnews_category",
				"foreign_table_where" => "ORDER BY tx_mvcnews_category.uid",
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
				//"MM" => "tx_mvcnews_article_category_mm",
			)
		),
		"downloads" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_article.downloads",
			"config" => Array (
				"type" => "inline",
				//"appearance" => Array ("useSortable" => 1),
				"foreign_table" => "tx_mvcnews_downloads",
				"foreign_field" => "objectreference",
				"foreign_label" => "title",
				"foreign_sortby" => "sorting",
				"size" => 10,
				"minitems" => 0,
				"maxitems" => 100,
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "--div--;Common,sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource, hidden;;1, title;;;;2-2-2, date;;;;3-3-3, description;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_objects/rte/], image, --div--;Relations,category, downloads")
	),
	"palettes" => array (
		"1" => array("showitem" => "starttime, endtime, fe_group")
	)
);



$TCA["tx_mvcnews_category"] = array (
	"ctrl" => $TCA["tx_mvcnews_category"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "sys_language_uid,l18n_parent,l18n_diffsource,hidden,starttime,endtime,fe_group,title"
	),
	"feInterface" => $TCA["tx_mvcnews_category"]["feInterface"],
	"columns" => array (
		't3ver_label' => array (
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array (
				'type' => 'input',
				'size' => '30',
				'max'  => '30',
			)
		),
		'sys_language_uid' => array (
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l18n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_mvcnews_category',
				'foreign_table_where' => 'AND tx_mvcnews_category.pid=###CURRENT_PID### AND tx_mvcnews_category.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array (
			'config' => array (
				'type' => 'passthrough'
			)
		),
		'hidden' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'starttime' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'default'  => '0',
				'checkbox' => '0'
			)
		),
		'endtime' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0',
				'range'    => array (
					'upper' => mktime(0, 0, 0, 12, 31, 2020),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
				)
			)
		),
		'fe_group' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config'  => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		"title" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_category.title",
			"config" => Array (
				"type" => "input",
				"size" => "30",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource, hidden;;1, title;;;;2-2-2")
	),
	"palettes" => array (
		"1" => array("showitem" => "starttime, endtime, fe_group")
	)
);



$TCA["tx_mvcnews_downloads"] = array (
	"ctrl" => $TCA["tx_mvcnews_downloads"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,starttime,endtime,fe_group,title,description,image,caption,flags,news",
	),
	'feInterface' => $TCA['tx_mvcnews_downloads']['feInterface'],
	'columns' => array (
		'hidden' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'starttime' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'default'  => '0',
				'checkbox' => '0'
			)
		),
		'endtime' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0',
				'range'    => array (
					'upper' => mktime(0, 0, 0, 12, 31, 2020),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
				)
			)
		),
		'fe_group' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config'  => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		'title' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_downloads.title',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
			)
		),
		'filepath' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_downloads.filepath',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => '',
				'disallowed' => 'php,php3',
				'max_size' => 16000,
				'uploadfolder' => 'uploads/tx_objects',
				'show_thumbs' => 1,
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			)
		),

		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_downloads.description',
			'config' => Array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'image' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_downloads.image',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => 500,
				'uploadfolder' => 'uploads/tx_newsdownloads',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'caption' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_downloads.caption',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
			)
		),
		'flags' => Array (
		      'exclude' => 1,
		      'label' => 'LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_downloads.flags',
		      'config' => Array (
		        'type' => 'select',
		        'foreign_table' => 'sys_language',
		        'foreign_table_where' => 'ORDER BY sys_language.title',
		        'size' => 10,
		        'minitems' => 0,
		        'maxitems' => 100,
		      )
    	),
    	'objectreference' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:mvcnews/locallang_db.xml:tx_mvcnews_downloads.news',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('',0),
				),
				'foreign_table' => 'tt_news',
				'foreign_table_where' => 'ORDER BY tt_news.uid',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			)
		),

	),
	'types' => array (
		'0' => array('showitem' => '--div--;Common,###FILE###, title;;;;2-2-2,  description, --div--;Details,image, caption, news, flags, --div--;Visibility,hidden;;1;;1-1-1')
	),
	'palettes' => array (
		'1' => array('showitem' => 'starttime, endtime, fe_group')
	)
);

$conf=unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['objects']);
if ($conf['usedam']) {
	$TCA["tx_mvcnews_downloads"]['columns']['filepathdam'] = txdam_getMediaTCA('media_field','tx_newsdownloads_filepathdam');
	$TCA['tx_mvcnews_downloads']['columns']['filepathdam']['config']['size'] = 1;
	$TCA['tx_mvcnews_downloads']['columns']['filepathdam']['config']['maxitems'] = 1;

	$TCA["tx_mvcnews_downloads"]['interface']['showRecordFieldList'] .= ',filepathdam';
	$TCA["tx_mvcnews_downloads"]['types']['0']['showitem'] = str_replace('###FILE###','filepathdam;;;;3-3-3',$TCA["tx_mvcnews_downloads"]['types']['0']['showitem']);
	$TCA['tx_mvcnews_downloads']['columns']['filepathdam']['config']['max_size'] = 1000000;
}
else {
	$TCA["tx_mvcnews_downloads"]['interface']['showRecordFieldList'].= ',filepath';
	$TCA["tx_mvcnews_downloads"]['types']['0']['showitem'] = str_replace('###FILE###','filepath;;;;3-3-3',$TCA["tx_mvcnews_downloads"]['types']['0']['showitem']);
}


?>