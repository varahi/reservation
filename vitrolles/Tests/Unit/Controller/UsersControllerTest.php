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
 * Test case for class Resa\Vitrolles\Controller\UsersController.
 *
 * @author Piment Rouge <typo3@pimentrouge.fr>
 */
class UsersControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Resa\Vitrolles\Controller\UsersController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Resa\\Vitrolles\\Controller\\UsersController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllUserssFromRepositoryAndAssignsThemToView() {

		$allUserss = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$usersRepository = $this->getMock('Resa\\Vitrolles\\Domain\\Repository\\UsersRepository', array('findAll'), array(), '', FALSE);
		$usersRepository->expects($this->once())->method('findAll')->will($this->returnValue($allUserss));
		$this->inject($this->subject, 'usersRepository', $usersRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('userss', $allUserss);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenUsersToView() {
		$users = new \Resa\Vitrolles\Domain\Model\Users();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('users', $users);

		$this->subject->showAction($users);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenUsersToView() {
		$users = new \Resa\Vitrolles\Domain\Model\Users();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newUsers', $users);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($users);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenUsersToUsersRepository() {
		$users = new \Resa\Vitrolles\Domain\Model\Users();

		$usersRepository = $this->getMock('Resa\\Vitrolles\\Domain\\Repository\\UsersRepository', array('add'), array(), '', FALSE);
		$usersRepository->expects($this->once())->method('add')->with($users);
		$this->inject($this->subject, 'usersRepository', $usersRepository);

		$this->subject->createAction($users);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenUsersToView() {
		$users = new \Resa\Vitrolles\Domain\Model\Users();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('users', $users);

		$this->subject->editAction($users);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenUsersInUsersRepository() {
		$users = new \Resa\Vitrolles\Domain\Model\Users();

		$usersRepository = $this->getMock('Resa\\Vitrolles\\Domain\\Repository\\UsersRepository', array('update'), array(), '', FALSE);
		$usersRepository->expects($this->once())->method('update')->with($users);
		$this->inject($this->subject, 'usersRepository', $usersRepository);

		$this->subject->updateAction($users);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenUsersFromUsersRepository() {
		$users = new \Resa\Vitrolles\Domain\Model\Users();

		$usersRepository = $this->getMock('Resa\\Vitrolles\\Domain\\Repository\\UsersRepository', array('remove'), array(), '', FALSE);
		$usersRepository->expects($this->once())->method('remove')->with($users);
		$this->inject($this->subject, 'usersRepository', $usersRepository);

		$this->subject->deleteAction($users);
	}
}
