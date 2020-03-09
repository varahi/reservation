<?php
namespace Resa\Vitrolles\Domain\Model;


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
 * Reservations
 */
class Reservations extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * idUsers
	 *
	 * @var \Resa\Vitrolles\Domain\Model\Users
	 */
	protected $idUsers = NULL;

	/**
	 * idSalles
	 *
	 * @var \Resa\Vitrolles\Domain\Model\Salles
	 */
	protected $idSalles = NULL;
	
	/**
	 * starttime
	 * 
	 * @var \DateTime
	 */
	protected $starttime = NULL;
        
	/**
	 * endtime
	 * 
	 * @var \DateTime
	 */
	protected $endtime = NULL;
	
	/**
	 * hidden
	 *
	 * @var boolean
	 */
	protected $hidden = 0;

	/**
	 * Returns the idUsers
	 *
	 * @return \Resa\Vitrolles\Domain\Model\Users $idUsers
	 */
	public function getIdUsers() {
		return $this->idUsers;
	}

	/**
	 * Sets the idUsers
	 *
	 * @param \Resa\Vitrolles\Domain\Model\Users $idUsers
	 * @return void
	 */
	public function setIdUsers(\Resa\Vitrolles\Domain\Model\Users $idUsers) {
		$this->idUsers = $idUsers;
	}

	/**
	 * Returns the idSalles
	 *
	 * @return \Resa\Vitrolles\Domain\Model\Salles $idSalles
	 */
	public function getIdSalles() {
		return $this->idSalles;
	}

	/**
	 * Sets the idSalles
	 *
	 * @param \Resa\Vitrolles\Domain\Model\Salles $idSalles
	 * @return void
	 */
	public function setIdSalles(\Resa\Vitrolles\Domain\Model\Salles $idSalles) {
		$this->idSalles = $idSalles;
	}
	
	/**
	 * Returns the starttime
	 *
	 * @return \DateTime $starttime
	 */
	public function getStarttime() {
		return $this->starttime;
	}

	/**
	 * Sets the starttime
	 *
	 * @param \DateTime $starttime
	 * @return void
	 */
	public function setStarttime(\DateTime $starttime) {
		$this->starttime = $starttime;
	}
        
        /**
	 * Returns the endtime
	 *
	 * @return \DateTime $endtime
	 */
	public function getEndtime() {
		return $this->endtime;
	}

	/**
	 * Sets the endtime
	 *
	 * @param \DateTime $endtime
	 * @return void
	 */
	public function setEndtime(\DateTime $endtime) {
		$this->endtime = $endtime;
	}
	
	/**
	 * Returns the hidden
	 *
	 * @return boolean $hidden
	 */
	public function getHidden() {
		return $this->hidden;
	}

	/**
	 * Sets the hidden
	 *
	 * @param boolean $hidden
	 * @return void
	 */
	public function setHidden($hidden) {
		$this->hidden = $hidden;
	}

}