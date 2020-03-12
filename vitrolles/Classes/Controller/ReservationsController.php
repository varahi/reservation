<?php
namespace Resa\Vitrolles\Controller;


use \TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Piment Rouge <typo3@pimentrouge.fr>, Piment Rouge
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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

/**
 * ReservationsController
 */
class ReservationsController extends ActionController {

    /**
     * persistenceManager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager = null;

	/**
	 * reservationsRepository
	 *
	 * @var \Resa\Vitrolles\Domain\Repository\ReservationsRepository
	 * @inject
	 */
	protected $reservationsRepository = NULL;
	
	/**
	 * sallesRepository
	 *
	 * @var \Resa\Vitrolles\Domain\Repository\SallesRepository
	 * @inject
	 */
	protected $sallesRepository = NULL;
	
	/**
	 * usersRepository
	 *
	 * @var \Resa\Vitrolles\Domain\Repository\UsersRepository
	 * @inject
	 */
	protected $usersRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$reservations = $this->reservationsRepository->findAll();
		$this->view->assign('reservations', $reservations);
	}

	/**
	 * action show
	 *
	 * @param \Resa\Vitrolles\Domain\Model\Reservations $reservations
	 * @return void
	 */
	public function showAction(\Resa\Vitrolles\Domain\Model\Reservations $reservations) {
		$this->view->assign('reservations', $reservations);
	}

	/**
	 * action new
	 *
	 * @param \Resa\Vitrolles\Domain\Model\Reservations $newReservations
	 * @ignorevalidation $newReservations
	 * @return void
	 */
	public function newAction(\Resa\Vitrolles\Domain\Model\Reservations $newReservations = NULL) {
		$this->view->assign('newReservations', $newReservations);
		
		//on pourrait modifier dans le ext_table.php le champ disabled pour qu'il ne soit plus dans les enabled
		//mais si on fait ça, dans le BE de TYPO3, il n'y a plus l'ampoule
		$reservations = $this->reservationsRepository->findAllWithHidden();
		$this->view->assign('reservations', $reservations);
		
		$salles = $this->sallesRepository->findAll();
		$this->view->assign('salles', $salles);
	}

	/**
	 * action create
	 *
	 * @return void
	 */
	public function createAction() {
			//vérification que l'adresse mail est valide
			if (!filter_var($this->request->getArgument('email'), FILTER_VALIDATE_EMAIL)) {
				$json = array('status' => 'ko', 'msg' => 'Votre adresse mail est incorrecte !');
				echo json_encode($json);
				exit;
			}
			
			//création du compte utilisateur
				//vérification si l'utilisateur existe
				if($newUsers = $this->usersRepository->findOneByEmail($this->request->getArgument('email')) ){
						$updateUsers = 1;
				}else{
						$newUsers = new \Resa\Vitrolles\Domain\Model\Users();
						$updateUsers = 0;
				}
				
                $newUsers->setFirstName($this->request->getArgument('firstName'));
                $newUsers->setLastName($this->request->getArgument('lastName'));
                $newUsers->setEmail($this->request->getArgument('email'));
                $newUsers->setUsername($this->request->getArgument('email'));
                $newUsers->setTelephone($this->request->getArgument('telephone'));
				
				$saltedpasswordsInstance = \TYPO3\CMS\Saltedpasswords\Salt\SaltFactory::getSaltingInstance();
                $password = 'vitrolles123456';
                $encryptedPassword = $saltedpasswordsInstance->getHashedPassword($password);
                $newUsers->setPassword($encryptedPassword);

                if($updateUsers == 1){
					$this->usersRepository->update($newUsers);
				}else{
					$this->usersRepository->add($newUsers);
				}

                // on réinitialise la persistance afin de faire l'insert car à la fin de la fonction on fait un exit
				//$persistenceManager = $this->objectManager->get('Tx_Extbase_Persistence_Manager');
                $this->persistenceManager->persistAll();
				
				if(is_null($newUsers->getUid())){
                    $json = array('status' => 'ko');
                }else{
					$salle = $this->sallesRepository->findByUid($this->request->getArgument('idSalles'));
					if(!is_object($salle)){
						$json = array('status' => 'ko');
						echo json_encode($json);
						exit;
					}
					
					//vérification de la date
					$startDate = strtotime($this->request->getArgument('dateStart').' '.$this->request->getArgument('timeStart').':00:00');
					$endDate = strtotime($this->request->getArgument('dateEnd').' '.$this->request->getArgument('timeEnd').':00:00');
					if($endDate <= $startDate){
						$json = array('status' => 'ko', 'msg' => 'La date de fin est inférieure/égale à la date de commencement !');
						echo json_encode($json);
						exit;
					}
					
					//vérification qu'il n'y pas de réservation de salle sur ces horaires
					$salleOccupe = $this->reservationsRepository->checkReservation($salle->getUid(), $startDate, $endDate);
					
					if(is_array($salleOccupe) && count($salleOccupe) > 0){
						$json = array('status' => 'ko', 'msg' => 'Cette salle est déjà réservée pendant la période choisie !');
						echo json_encode($json);
						exit;
					}
							
					//création de la réservation
					$newReservations = new \Resa\Vitrolles\Domain\Model\Reservations();
					
					$newReservations->setIdUsers($newUsers);
					$newReservations->setIdSalles($salle);
					$newReservations->setHidden(1);
					
					$starttime = new \DateTime();
					$newReservations->setStarttime($starttime->setTimestamp($startDate));
					$endtime = new \DateTime();
					$newReservations->setEndtime($endtime->setTimestamp($endDate));
					
					$this->reservationsRepository->add($newReservations);
					
					// on réinitialise la persistance afin de faire l'insert car à la fin de la fonction on fait un exit
                    $this->persistenceManager->persistAll();
					
					//faire le lien pour la validation
					/** @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $cObj */
                    $cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
                    //$urlValidation = $cObj->typolink_URL(array('parameter' => '58', 'additionalParams' => '&tx_vitrolles_reservation[action]=validationReservation&tx_vitrolles_reservation[controller]=Reservations&tx_vitrolles_reservation[idResa]='.$newReservations->getUid(), 'forceAbsoluteUrl' => 1));
                    $urlValidation = $cObj->typolink_URL(array('parameter' => $this->settings['acceptPageUid'], 'additionalParams' => '&tx_vitrolles_reservation[action]=validationReservation&tx_vitrolles_reservation[controller]=Reservations&tx_vitrolles_reservation[idResa]='.$newReservations->getUid(), 'forceAbsoluteUrl' => 1));
					//faire le lien pour le refus
					/** @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $cObj */
                    $cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
                    //$urlRefus = $cObj->typolink_URL(array('parameter' => '59', 'additionalParams' => '&tx_vitrolles_reservation[action]=formRefus&tx_vitrolles_reservation[controller]=Reservations&tx_vitrolles_reservation[idResa]='.$newReservations->getUid(), 'forceAbsoluteUrl' => 1));
                    $urlRefus = $cObj->typolink_URL(array('parameter' => $this->settings['rejectPageUid'], 'additionalParams' => '&tx_vitrolles_reservation[action]=formRefus&tx_vitrolles_reservation[controller]=Reservations&tx_vitrolles_reservation[idResa]='.$newReservations->getUid(), 'forceAbsoluteUrl' => 1));

					//envoie du mail à la Mairie
					$contenuHTML = 'Bonjour,<br>Une nouvelle réservation de salle sur le site : <br><br>Nom : <strong>'.$newUsers->getFirstName().' '.$newUsers->getLastName().'</strong><br>Email : <strong>'.$newUsers->getEmail().'</strong><br>Téléphone : <strong>'.$newUsers->getTelephone().'</strong><br><br>Salle : <strong>'.$salle->getTitle().'</strong><br>Du : <strong>'.date('d/m/Y', $startDate).'</strong> à partir de <strong>'.$this->request->getArgument('timeStart').'h</strong><br>Au : <strong>'.date('d/m/Y', $endDate).'</strong> jusqu\'à <strong>'.$this->request->getArgument('timeEnd').'h</strong><br><br>Pour accepter cette réservation, veuillez cliquer sur <a href="'.$urlValidation.'">j\'accepte</a><br>Pour refuser cette réservation, veuillez cliquer sur <a href="'.$urlRefus.'">je refuse</a>';
					// $this->sendMail('nepasrepondre@vitrolles05.fr', 'Mairie Vitrolles 05', 'gap@pimentrouge.fr', 'Mairie de Vitrolles 05', '[ MAIRIE VITROLLES 05 ] nouvelle réservation de salle', $contenuHTML);
					$this->sendMail($this->settings['emailConfirmationSender'], 'From web site',$this->settings['emailConfirmationReciver'], 'To admin', $this->settings['emailConfirmationSubject'], $contenuHTML);
					
					$json = array('status' => 'ok', 'all' => serialize($newReservations));
				}

		
		echo json_encode($json);
		exit;
	}

	/**
	 * action edit
	 *
	 * @param \Resa\Vitrolles\Domain\Model\Reservations $reservations
	 * @ignorevalidation $reservations
	 * @return void
	 */
	public function editAction(\Resa\Vitrolles\Domain\Model\Reservations $reservations) {
		$this->view->assign('reservations', $reservations);
	}

	/**
	 * action update
	 *
	 * @param \Resa\Vitrolles\Domain\Model\Reservations $reservations
	 * @return void
	 */
	public function updateAction(\Resa\Vitrolles\Domain\Model\Reservations $reservations) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->reservationsRepository->update($reservations);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @return void
	 */
	public function deleteAction() {
		//$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		
		if($reservation = $this->reservationsRepository->findOneByUidWithHidden(intval($this->request->getArgument('idResa')))){
		
			$reservation = $reservation[0];
			
			//envoie du mail de confirmation au demandeur.
			$contenuHTML = 'Bonjour,<br><br>Nous sommes navré de vous annoncer que votre réservation a été refusée !<br>Ci-dessous le motif : <br><br>'.$this->request->getArgument('comment');
			$this->sendMail($this->settings['emailConfirmationSender'], 'From web site', $reservation->getIdUsers()->getEmail(), 'To user', $this->settings['emailConfirmationSubject'], $contenuHTML);//*/
			
			$this->reservationsRepository->remove($reservation);
			$this->addFlashMessage('La réservation a été refusée !');
		}else{
			$this->addFlashMessage('Erreur système !');
		}
	}

	/**
	 * action calendrierDisponibilite
	 *
	 * @return void
	 */
	public function calendrierDisponibiliteAction() {
			$salles = $this->sallesRepository->findAll();
			$this->view->assign('salles', $salles);
	}

	/**
	 * action validationReservation
	 *
	 * @return void
	 */
	public function validationReservationAction() {
			$update = 'ko';
			//on pourrait modifier dans le ext_table.php le champ disabled pour qu'il ne soit plus dans les enabled
			//mais si on fait ça, dans le BE de TYPO3, il n'y a plus l'ampoule
			if($reservation = $this->reservationsRepository->findOneByUidHidden(intval($this->request->getArgument('idResa')))){

				$reservation = $reservation[0];
				$reservation->setHidden(0);
				$this->reservationsRepository->update($reservation);
				$update = 'ok';
				
				//envoie du mail de confirmation au demandeur.
				$contenuHTML = 'Bonjour,<br><br>Nous vous confirmons que votre réservation a été acceptée !<br>Ci-dessous les détails : <br><br>Salle : <strong>'.$reservation->getIdSalles()->getTitle().'</strong><br>Du : <strong>'.date('d/m/Y', $reservation->getStarttime()->getTimestamp()).'</strong> à partir de <strong>'.date('H', $reservation->getStarttime()->getTimestamp()).'h</strong><br>Au : <strong>'.date('d/m/Y', $reservation->getEndtime()->getTimestamp()).'</strong> jusqu\'à <strong>'.date('H', $reservation->getEndtime()->getTimestamp()).'h</strong>';
				$this->sendMail($this->settings['emailConfirmationSender'], 'From web site', $reservation->getIdUsers()->getEmail(), 'To user', $this->settings['emailConfirmationSubject'], $contenuHTML);//*/
			}
			
			$this->view->assign('update', $update);
	}

	/**
	 * action formRefus
	 *
	 * @return void
	 */
	public function formRefusAction() {
		//on pourrait modifier dans le ext_table.php le champ disabled pour qu'il ne soit plus dans les enabled
		//mais si on fait ça, dans le BE de TYPO3, il n'y a plus l'ampoule
		if($reservation = $this->reservationsRepository->findOneByUidHidden(intval($this->request->getArgument('idResa')))){
			$reservation = $reservation[0];
			$this->view->assign('reservation', $reservation);
		}
		
	}
	
	// ---------------------------------------------------------------------
    //	Envoie un mail
    // ---------------------------------------------------------------------
    public function sendMail($emailEmetteur, $nomEmetteur, $emailDestinataire, $nomDestinataire, $sujet, $contenuHTML, $attachment=''){
		//$message = file_get_contents('fileadmin/templates/default/plugin_tpl/mail/email_default.html');
        $message = file_get_contents('typo3conf/ext/vitrolles/Resources/Private/Templates/Email/Default.html');
		// $message = str_replace('%message%', $body, $message);
		$replace_array = array(
			'%message%' => $contenuHTML,
			'%ndd%' => 'http://'.$_SERVER['HTTP_HOST'].'/'
		);
		$message = strtr($message, $replace_array);	
		
		//on declare l'objet mail
		$email= \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
		  //on parametre l'emetteur
		$email->setFrom(array($emailEmetteur => $nomEmetteur));
		  //on parametre le destinataire
		$email->setTo(array($emailDestinataire => $nomDestinataire));
		  //on parametre le sujet de l'email
		$email->setSubject($sujet);
		
		if($attachment != ''){
			// Create the attachment
			// * Note that you can technically leave the content-type parameter out
			$attachment = \Swift_Attachment::fromPath($attachment);

			// (optional) setting the filename
			//$attachment->setFilename('cool.jpg');

			// Attach it to the message
			$mail->attach($attachment);
		}
		  //on ajoute le contenu sans preciser si c'est du texte ou de l'HTML
		$email->setBody($message, 'text/html');
			//on ajoute le contenu pour la version texte
		$email->addPart(strip_tags($message), 'text/plain');
		  //on envoie l'email
		$email->send();
	}

}