<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_mvcnews_object=1
');
t3lib_extMgm::addPageTSConfig('

	# ***************************************************************************************
	# CONFIGURATION of RTE in table "tx_mvcnews_object", field "description"
	# ***************************************************************************************
RTE.config.tx_mvcnews_object.description {
  hidePStyleItems = H1, H4, H5, H6
  proc.exitHTMLparser_db=1
  proc.exitHTMLparser_db {
    keepNonMatchedTags=1
    tags.font.allowedAttribs= color
    tags.font.rmTagIfNoAttrib = 1
    tags.font.nesting = global
  }
}
');

$pluginListTypeKey=$_EXTKEY.'_plugin2';
tx_mvc_extMgm::addSimplePluginController($_EXTKEY,$pluginListTypeKey,'UncachedTestController',1);

$pluginListTypeKey=$_EXTKEY.'_plugin';
tx_mvc_extMgm::addSwitchedPluginController($_EXTKEY,$pluginListTypeKey,array('NewsController','DownloadsController'),'commonsettings.field_controller',0);
tx_mvc_extMgm::addAjaxResponsePageType($_EXTKEY,$pluginListTypeKey,'NewsController',9112008,'mvcnews');


?>