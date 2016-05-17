<?php

defined('TYPO3_MODE') or die();

$fields = array(

	'vanilla_forum_id' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:vanilla_comments/Resources/Private/Language/locallang_db.xlf:vanilla_forum_id',
		'config' => array(
			'type' => 'input',
			'size' => 5,
			'default' => '0',
			'eval' => 'int'
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_category', $fields);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', 'vanilla_forum_id');