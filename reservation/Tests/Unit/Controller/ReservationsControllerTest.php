<?php
namespace Resa\Vitrolles\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Piment Rouge <typo3@pimentrouge.fr>, Piment Rouge
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Resa\Vitrolles\Controller\ReservationsController.
 *
 * @author Piment Rouge <typo3@pimentrouge.fr>
 */
class ReservationsControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Resa\Vitrolles\Controller\ReservationsController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Resa\\Vitrolles\\Controller\\ReservationsController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllReservationssFromRepositoryAndAssignsThemToView() {

		$allReservationss = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$reservationsRepository = $this->getMock('Resa\\Vitrolles\\Domain\\Repository\\ReservationsRepository', array('findAll'), array(), '', FALSE);
		$reservationsRepository->expects($this->once())->method('findAll')->will($this->returnValue($allReservationss));
		$this->inject($this->subject, 'reservationsRepository', $reservationsRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('reservationss', $allReservationss);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenReservationsToView() {
		$reservations = new \Resa\Vitrolles\Domain\Model\Reservations();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('reservations', $reservations);

		$this->subject->showAction($reservations);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenReservationsToView() {
		$reservations = new \Resa\Vitrolles\Domain\Model\Reservations();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newReservations', $reservations);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($reservations);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenReservationsToReservationsRepository() {
		$reservations = new \Resa\Vitrolles\Domain\Model\Reservations();

		$reservationsRepository = $this->getMock('Resa\\Vitrolles\\Domain\\Repository\\ReservationsRepository', array('add'), array(), '', FALSE);
		$reservationsRepository->expects($this->once())->method('add')->with($reservations);
		$this->inject($this->subject, 'reservationsRepository', $reservationsRepository);

		$this->subject->createAction($reservations);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenReservationsToView() {
		$reservations = new \Resa\Vitrolles\Domain\Model\Reservations();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('reservations', $reservations);

		$this->subject->editAction($reservations);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenReservationsInReservationsRepository() {
		$reservations = new \Resa\Vitrolles\Domain\Model\Reservations();

		$reservationsRepository = $this->getMock('Resa\\Vitrolles\\Domain\\Repository\\ReservationsRepository', array('update'), array(), '', FALSE);
		$reservationsRepository->expects($this->once())->method('update')->with($reservations);
		$this->inject($this->subject, 'reservationsRepository', $reservationsRepository);

		$this->subject->updateAction($reservations);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenReservationsFromReservationsRepository() {
		$reservations = new \Resa\Vitrolles\Domain\Model\Reservations();

		$reservationsRepository = $this->getMock('Resa\\Vitrolles\\Domain\\Repository\\ReservationsRepository', array('remove'), array(), '', FALSE);
		$reservationsRepository->expects($this->once())->method('remove')->with($reservations);
		$this->inject($this->subject, 'reservationsRepository', $reservationsRepository);

		$this->subject->deleteAction($reservations);
	}
}
