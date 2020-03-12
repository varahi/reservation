<?php
namespace Resa\Vitrolles\Domain\Repository;


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
 * The repository for Reservations
 */
class ReservationsRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	//on pourrait modifier dans le ext_table.php le champ disabled pour qu'il ne soit plus dans les enabled
	//mais si on fait ça, dans le BE de TYPO3, il n'y a plus l'ampoule
	public function findAllWithHidden(){
			$query = $this->createQuery();

            $query->statement("SELECT * FROM tx_vitrolles_domain_model_reservations WHERE NOT `deleted`");
//    		$query->getQuerySettings()->setIgnoreEnableFields(TRUE);
//			$query->getQuerySettings()->setEnableFieldsToBeIgnored(array('disabled'));
			
			return $query->execute();
	}
	
	//on pourrait modifier dans le ext_table.php le champ disabled pour qu'il ne soit plus dans les enabled
	//mais si on fait ça, dans le BE de TYPO3, il n'y a plus l'ampoule
	public function findOneByUidWithHidden($idReservation){

        $query = $this->createQuery();
        $query->statement("SELECT * FROM tx_vitrolles_domain_model_reservations WHERE `uid` ='$idReservation' AND NOT `deleted`");
        $result=$query->execute()->toArray();

		return $result;
	}

    public function findOneByUidHidden($idReservation){

        $query = $this->createQuery();
        $query->statement("SELECT * FROM tx_vitrolles_domain_model_reservations WHERE `uid` ='$idReservation' AND `hidden` AND NOT `deleted`");
        $result=$query->execute()->toArray();

        return $result;
    }

    public function checkReservation($idSalle, $starttime, $endtime){
	    // ToDo: re-write method
    }

	public function _checkReservation($idSalle, $starttime, $endtime){
			$query = $this->createQuery();
			
			$requete = 'SELECT * 
                            FROM tx_vitrolles_domain_model_reservations
                            WHERE ((endtime > '.$starttime.' AND endtime <= '.$endtime.')
								OR (starttime >= '.$starttime.' AND starttime < '.$endtime.')
								OR (starttime <= '.$starttime.' AND endtime >= '.$endtime.'))
								AND id_salles = '.$idSalle.'
								AND deleted = 0';
/*
echo'<pre>';
print_r($requete);
echo'</pre>';//*/
			$query->statement($requete);

			return $query->execute()->toArray();
	}
}