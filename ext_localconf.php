<?php

defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Andinger.'.$_EXTKEY,
    'API',
    [
        'Sso' => 'sso'
    ],
    [
        'Sso' => 'sso'
    ]
);

$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/NewsDefault'][] = 'vanilla_comments';
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/Category'][] = 'vanilla_comments';
