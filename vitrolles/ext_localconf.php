<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Resa.' . $_EXTKEY,
	'Reservation',
	array(
		'Users' => 'list, show, new, create, edit, update, delete',
		'Reservations' => 'list, show, new, create, edit, update, delete, calendrierDisponibilite, validationReservation, formRefus',
		'Salles' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Reservations' => 'create, calendrierDisponibilite, validationReservation, delete',
		
	)
);
