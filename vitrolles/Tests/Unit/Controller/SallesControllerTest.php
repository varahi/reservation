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
 * Test case for class Resa\Vitrolles\Controller\SallesController.
 *
 * @author Piment Rouge <typo3@pimentrouge.fr>
 */
class SallesControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Resa\Vitrolles\Controller\SallesController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Resa\\Vitrolles\\Controller\\SallesController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllSallessFromRepositoryAndAssignsThemToView() {

		$allSalless = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$sallesRepository = $this->getMock('Resa\\Vitrolles\\Domain\\Repository\\SallesRepository', array('findAll'), array(), '', FALSE);
		$sallesRepository->expects($this->once())->method('findAll')->will($this->returnValue($allSalless));
		$this->inject($this->subject, 'sallesRepository', $sallesRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('salless', $allSalless);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenSallesToView() {
		$salles = new \Resa\Vitrolles\Domain\Model\Salles();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('salles', $salles);

		$this->subject->showAction($salles);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenSallesToView() {
		$salles = new \Resa\Vitrolles\Domain\Model\Salles();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newSalles', $salles);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($salles);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenSallesToSallesRepository() {
		$salles = new \Resa\Vitrolles\Domain\Model\Salles();

		$sallesRepository = $this->getMock('Resa\\Vitrolles\\Domain\\Repository\\SallesRepository', array('add'), array(), '', FALSE);
		$sallesRepository->expects($this->once())->method('add')->with($salles);
		$this->inject($this->subject, 'sallesRepository', $sallesRepository);

		$this->subject->createAction($salles);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenSallesToView() {
		$salles = new \Resa\Vitrolles\Domain\Model\Salles();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('salles', $salles);

		$this->subject->editAction($salles);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenSallesInSallesRepository() {
		$salles = new \Resa\Vitrolles\Domain\Model\Salles();

		$sallesRepository = $this->getMock('Resa\\Vitrolles\\Domain\\Repository\\SallesRepository', array('update'), array(), '', FALSE);
		$sallesRepository->expects($this->once())->method('update')->with($salles);
		$this->inject($this->subject, 'sallesRepository', $sallesRepository);

		$this->subject->updateAction($salles);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenSallesFromSallesRepository() {
		$salles = new \Resa\Vitrolles\Domain\Model\Salles();

		$sallesRepository = $this->getMock('Resa\\Vitrolles\\Domain\\Repository\\SallesRepository', array('remove'), array(), '', FALSE);
		$sallesRepository->expects($this->once())->method('remove')->with($salles);
		$this->inject($this->subject, 'sallesRepository', $sallesRepository);

		$this->subject->deleteAction($salles);
	}
}
