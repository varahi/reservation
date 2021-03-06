<?php

namespace Resa\Vitrolles\Tests\Unit\Domain\Model;

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
 * Test case for class \Resa\Vitrolles\Domain\Model\Reservations.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Piment Rouge <typo3@pimentrouge.fr>
 */
class ReservationsTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Resa\Vitrolles\Domain\Model\Reservations
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Resa\Vitrolles\Domain\Model\Reservations();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getIdUsersReturnsInitialValueForUsers() {
		$this->assertEquals(
			NULL,
			$this->subject->getIdUsers()
		);
	}

	/**
	 * @test
	 */
	public function setIdUsersForUsersSetsIdUsers() {
		$idUsersFixture = new \Resa\Vitrolles\Domain\Model\Users();
		$this->subject->setIdUsers($idUsersFixture);

		$this->assertAttributeEquals(
			$idUsersFixture,
			'idUsers',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIdSallesReturnsInitialValueForSalles() {
		$this->assertEquals(
			NULL,
			$this->subject->getIdSalles()
		);
	}

	/**
	 * @test
	 */
	public function setIdSallesForSallesSetsIdSalles() {
		$idSallesFixture = new \Resa\Vitrolles\Domain\Model\Salles();
		$this->subject->setIdSalles($idSallesFixture);

		$this->assertAttributeEquals(
			$idSallesFixture,
			'idSalles',
			$this->subject
		);
	}
}
