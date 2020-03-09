<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Reservation',
	'Reservation'
);

$pluginSignature = str_replace('_','',$_EXTKEY) . '_reservation';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_reservation.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'reservation');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_vitrolles_domain_model_reservations', 'EXT:vitrolles/Resources/Private/Language/locallang_csh_tx_vitrolles_domain_model_reservations.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_vitrolles_domain_model_reservations');
$GLOBALS['TCA']['tx_vitrolles_domain_model_reservations'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:vitrolles/Resources/Private/Language/locallang_db.xlf:tx_vitrolles_domain_model_reservations',
		'label' => 'id_users',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
		),
		'searchFields' => 'id_users,id_salles,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Reservations.php',
		//'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_vitrolles_domain_model_reservations.gif'
         'iconfile' => 'EXT:reservation/Resources/Public/Icons/tx_vitrolles_domain_model_reservations.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_vitrolles_domain_model_salles', 'EXT:vitrolles/Resources/Private/Language/locallang_csh_tx_vitrolles_domain_model_salles.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_vitrolles_domain_model_salles');
$GLOBALS['TCA']['tx_vitrolles_domain_model_salles'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:vitrolles/Resources/Private/Language/locallang_db.xlf:tx_vitrolles_domain_model_salles',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Salles.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_vitrolles_domain_model_salles.gif'
	),
);

if (!isset($GLOBALS['TCA']['fe_users']['ctrl']['type'])) {
	if (file_exists($GLOBALS['TCA']['fe_users']['ctrl']['dynamicConfigFile'])) {
		require_once($GLOBALS['TCA']['fe_users']['ctrl']['dynamicConfigFile']);
	}
	// no type field defined, so we define it here. This will only happen the first time the extension is installed!!
	$GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';
	$tempColumns = array();
	$tempColumns[$GLOBALS['TCA']['fe_users']['ctrl']['type']] = array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:vitrolles/Resources/Private/Language/locallang_db.xlf:tx_vitrolles.tx_extbase_type',
		'config' => array(
			'type' => 'select',
			'items' => array(),
			'size' => 1,
			'maxitems' => 1,
		)
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumns, 1);
}

$GLOBALS['TCA']['fe_users']['types']['Tx_Vitrolles_Users']['showitem'] = $TCA['fe_users']['types']['0']['showitem'];
$GLOBALS['TCA']['fe_users']['types']['Tx_Vitrolles_Users']['showitem'] .= ',--div--;LLL:EXT:vitrolles/Resources/Private/Language/locallang_db.xlf:tx_vitrolles_domain_model_users,';
$GLOBALS['TCA']['fe_users']['types']['Tx_Vitrolles_Users']['showitem'] .= '';

$GLOBALS['TCA']['fe_users']['columns'][$TCA['fe_users']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:vitrolles/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.Tx_Vitrolles_Users','Tx_Vitrolles_Users');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('fe_users', $GLOBALS['TCA']['fe_users']['ctrl']['type'],'','after:' . $TCA['fe_users']['ctrl']['label']);
