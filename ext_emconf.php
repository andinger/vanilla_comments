<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "vanilla_comments"
 *
 * Auto generated by Extension Builder 2016-05-14
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Vanilla Comments',
	'description' => 'Integration Vanilla Forum Comments into News',
	'category' => 'plugin',
	'author' => 'Andreas Keßler',
	'author_email' => 'typo3@andikessler.de',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => true,
	'version' => '1.0.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '7.6.0-7.6.99',
			'news' => '4.2.0-4.2.99',
			'routing' => '0.3.0-0.3.99'
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);