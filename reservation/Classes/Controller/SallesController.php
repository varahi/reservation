<?php
namespace Resa\Vitrolles\Controller;


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
 * SallesController
 */
class SallesController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * sallesRepository
	 *
	 * @var \Resa\Vitrolles\Domain\Repository\SallesRepository
	 * @inject
	 */
	protected $sallesRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$salles = $this->sallesRepository->findAll();
		$this->view->assign('salles', $salles);
	}

	/**
	 * action show
	 *
	 * @param \Resa\Vitrolles\Domain\Model\Salles $salles
	 * @return void
	 */
	public function showAction(\Resa\Vitrolles\Domain\Model\Salles $salles) {
		$this->view->assign('salles', $salles);
	}

	/**
	 * action new
	 *
	 * @param \Resa\Vitrolles\Domain\Model\Salles $newSalles
	 * @ignorevalidation $newSalles
	 * @return void
	 */
	public function newAction(\Resa\Vitrolles\Domain\Model\Salles $newSalles = NULL) {
		$this->view->assign('newSalles', $newSalles);
	}

	/**
	 * action create
	 *
	 * @param \Resa\Vitrolles\Domain\Model\Salles $newSalles
	 * @return void
	 */
	public function createAction(\Resa\Vitrolles\Domain\Model\Salles $newSalles) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->sallesRepository->add($newSalles);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Resa\Vitrolles\Domain\Model\Salles $salles
	 * @ignorevalidation $salles
	 * @return void
	 */
	public function editAction(\Resa\Vitrolles\Domain\Model\Salles $salles) {
		$this->view->assign('salles', $salles);
	}

	/**
	 * action update
	 *
	 * @param \Resa\Vitrolles\Domain\Model\Salles $salles
	 * @return void
	 */
	public function updateAction(\Resa\Vitrolles\Domain\Model\Salles $salles) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->sallesRepository->update($salles);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Resa\Vitrolles\Domain\Model\Salles $salles
	 * @return void
	 */
	public function deleteAction(\Resa\Vitrolles\Domain\Model\Salles $salles) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->sallesRepository->remove($salles);
		$this->redirect('list');
	}

}