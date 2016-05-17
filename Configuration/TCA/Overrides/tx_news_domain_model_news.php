<?php

defined('TYPO3_MODE') or die();

$fields = array(

	'comments_enabled' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:vanilla_comments/Resources/Private/Language/locallang_db.xlf:tx_vanillacomments_domain_model_newsdefault.comments_enabled',
		'config' => array(
			'type' => 'check',
			'default' => 1
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news',$fields);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'comments_enabled');