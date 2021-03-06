<?php

namespace UsersBundle\Repository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * UserClientRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserClientRepository extends \Doctrine\ORM\EntityRepository
{
	//================================
	// ici nature = 2, est contact
	//================================
	public function findEmploye () {
		$contact = $this->createQueryBuilder('u')->where('u.iDNatureUser = :nature');
		$contact->setParameter('nature', 1);
		return $contact->getQuery()->execute();
	}

	/**
	 * Find Contact by entitej
	 */
	public function findContact ($entite_id = null) {
		$contact = $this->createQueryBuilder('u');

		if( $entite_id ) {
			$contact
				->innerJoin('UsersBundle:RelationUserEntite', 'rue', Join::WITH, 'rue.iDUser = u.id')
				->andWhere('rue.idEntiteJ = :entite_id')
				->setParameter('entite_id', $entite_id);
		}

		$contact->andWhere('u.iDNatureUser = 2');

		return $contact
			->orderBy('u.id', 'DESC')
			->getQuery()
			->execute();
	}

	//================================
	// ici nature = 1, est employé/salarié avec critère
	//================================
	public function findContactBy ($criteria, $join, $bu_id = 0) {

		if( !count($criteria) ) return;
		$contact = $this->createQueryBuilder('u');

		$where = [];
		$where_join = ' 1 = 1 ';
		foreach($criteria as $key => $criter) {
			if( $criter && is_string($criter) ) $where[] = "u.{$key} LIKE :{$key}";
			else if( $criter ) $where[] = "u.{$key} = :{$key}";
		}

		if( $join == 'or') $where_join = implode(' OR ', $where);
		else $where_join = implode(' AND ', $where);

		if( $bu_id ) {
			$contact
				->select('u as user', 'bu.id as bu_id')
				->innerJoin('UsersBundle:RelationUserEntite', 'rue', Join::WITH, 'rue.iDUser = u.id')
				->innerJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.id = rue.iDUserEntite')
				->innerJoin('UsersBundle:BusinessUnit', 'bu', Join::WITH, 'bu.id = rbe.iDBusinessUnit')
				->andWhere('rbe.iDBusinessUnit = :bu_id')
				->setParameter('bu_id', $bu_id);
		}

		$contact->andWhere('(' . $where_join . ') AND u.iDNatureUser = 2');

		foreach($criteria as $key => $criter) {
			if( $criter && is_string($criter) )  $criter = "%$criter%";
			$contact->setParameter($key, $criter);
		}
		return $contact->getQuery()->execute();
	}

	public function findUsers ($user_id) {
		$users = $this->createQueryBuilder('u')
			->select('u', 'bu.nomBusinessUnit', 'c.raisonSociale')
			->innerJoin('UsersBundle:Users', 'ur', Join::WITH, 'ur.id = u.iDCompte')
			->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', Join::WITH, 'rbu.iDUser = u.id')
			->innerJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.iDBusinessUnit = rbu.iDBusinessUnit')
			->leftJoin('UsersBundle:Back\UsersParamRelationsFonctions', 'relf', Join::WITH, 'relf.id = rbu.iDBusinessUnit')
			->leftJoin('UsersBundle:BusinessUnit', 'bu', Join::WITH, 'bu.id = rbu.iDBusinessUnit')
			->leftJoin('ClientBundle:Client', 'c', Join::WITH, 'c.id = rbe.iDentite')
			->leftJoin('UsersBundle:Back\UsersParamService', 's', Join::WITH, 's.id = relf.iDService')
			// ->where('u.iDNatureUser = 2 AND ur.id = :user_id')
			->where('ur.id = :user_id')
			->setParameter('user_id', $user_id)
			->getQuery()
			->execute();

		if( count($users) ) {
			foreach($users as $key => $user) {
				$relation = $this->createQueryBuilder('u')
					->select('relf')
					->innerJoin('UsersBundle:Users', 'ur', Join::WITH, 'ur.id = u.iDCompte')
					->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', Join::WITH, 'rbu.iDUser = u.id')
					->innerJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.iDBusinessUnit = rbu.iDBusinessUnit')
					->leftJoin('UsersBundle:Back\UsersParamRelationsFonctions', 'relf', Join::WITH, 'relf.id = rbu.iDBusinessUnit')
					->where('u.id = :user_id')
					->setParameter('user_id', $user[0]->getId())
					->getQuery()
					->execute();

				if(count($relation))
					$users[$key]['fonction'] = $relation[0];

				$nature = $this->createQueryBuilder('u')
					->select('up')
					->innerJoin('UsersBundle:Users', 'ur', Join::WITH, 'ur.id = u.iDCompte')
					->innerJoin('UsersBundle:Back\UsersParamNature', 'up', Join::WITH, 'up.id = u.iDNatureUser')
					->where('u.id = :user_id')
					->setParameter('user_id', $user[0]->getId())
					->getQuery()
					->execute();

				if(count($nature))
					$users[$key]['nature'] = $nature[0];

				$service = $this->createQueryBuilder('u')
					->select('s')
					->innerJoin('UsersBundle:Users', 'ur', Join::WITH, 'ur.id = u.iDCompte')
					->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', Join::WITH, 'rbu.iDUser = u.id')
					->innerJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.iDBusinessUnit = rbu.iDBusinessUnit')
					->leftJoin('UsersBundle:Back\UsersParamRelationsFonctions', 'relf', Join::WITH, 'relf.id = rbu.iDBusinessUnit')
					->leftJoin('UsersBundle:BusinessUnit', 'bu', Join::WITH, 'bu.id = rbu.iDBusinessUnit')
					->leftJoin('ClientBundle:Client', 'c', Join::WITH, 'c.id = rbe.iDentite')
					->leftJoin('UsersBundle:Back\UsersParamService', 's', Join::WITH, 's.id = relf.iDService')
					->where('u.id = :user_id')
					->setParameter('user_id', $user[0]->getId())
					->getQuery()
					->execute();

				if(count($service))
					$users[$key]['service'] = $service[0];
			}
		}
		return $users;
	}

	public function findBU ($usercompte_id, $user_id = 0) {

		$user = $this->createQueryBuilder('u')
    		->innerJoin('UsersBundle:Users', 'uc', Join::WITH, 'uc.id = u.iDCompte')
    		->andWhere('uc.id = :usercompte_id')
    		->setParameter('usercompte_id', $usercompte_id);

    	if( $user_id ) {
    		$user
    			->andWhere('u.id = :user_id')
    			->setParameter('user_id', $user_id);
    	}

    	$user = $user->getQuery()->execute();
    	if( !count($user) ) return [];

    	/**
    	 * getting by nature user
    	 */
    	$res = $this->createQueryBuilder('u')->select('bu');
    	if( $user[0]->getIDNatureUser() == 1 ) {
    		$res
    			->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', JOIN::WITH, 'rbu.iDUser = u.id')
    			->innerJoin('UsersBundle:BusinessUnit', 'bu', Join::WITH, 'bu.id = rbu.iDBusinessUnit')
    			->where('rbu.iDUser = :user_id')
    			->setParameter('user_id', $user[0]->getId());
    	}

    	if( $user[0]->getIDNatureUser() == 2 ) {
    		$res
    			->innerJoin('UsersBundle:RelationUserEntite', 'rue', JOIN::WITH, 'rue.iDUser = u.id')
    			->innerJoin('UsersBundle:RelationBusinessEntite', 'rbe', JOIN::WITH, 'rbe.iDentite = rue.idEntiteJ')
    			->innerJoin('UsersBundle:BusinessUnit', 'bu', Join::WITH, 'bu.id = rbe.iDBusinessUnit')
    			->where('rue.iDUser = :user_id')
    			->setParameter('user_id', $user[0]->getId());
    	}

    	$return = $res->getQuery()->execute();
    	if( $return && $user_id ) 
    		return $return[0];
    	return $return;
	}

	public function findUser ($user_id = 0, $bu_id) {
		$return  = $this->createQueryBuilder('u')->select('u');

		if( $user_id ) {
			$return
				->innerJoin('UsersBundle:Users', 'ur', Join::WITH, 'ur.id = u.iDCompte')
				->andWhere('u.id = :user_id')
				->setParameter('user_id', $user_id);
		}


		if( $bu_id && $bu_id > 0 ) {
	 		$return
	 			->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', Join::WITH, 'rbu.iDUser = u.id')
	 			->andWhere('rbu.iDBusinessUnit = :bu_id')
	 			->setParameter('bu_id', $bu_id);
		}

	 	return $return
	 		->andWhere('u.iDNatureUser = 1')
	 		->getQuery()
	 		->execute();
	}


	// getting all user the same name of user connected
	public function findByBU ($id_user) {
		if(!$id_user) return;
		
		// obtenir tout les utilisateur de même login que celui qui est logé
		$users = $this->createQueryBuilder('u')
			->innerJoin('UsersBundle:Users', 'ur', Join::WITH, 'ur.username = u.login')
		 	->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', Join::WITH, 'rbu.iDUser = u.id')
		 	->where('u.login = :login')
		 	->setParameter('id_user', $id_user)
			->getQuery();

		return $users->execute();
	}

	// get by bu user
	public function findBBU ($iDCompte, $bu_id, $one_by = false) {
		$users = $this->createQueryBuilder('u')
		 	->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', Join::WITH, 'rbu.iDUser = u.id')
		 	->where('u.iDCompte = :compte AND rbu.iDBusinessUnit = :bu_id')
		 	->setParameters(['compte' => $iDCompte, 'bu_id' => $bu_id]);
		$return = $users->getQuery()->execute();
		if(!count($return)) return null;

		if( $one_by ) $return = $return[0];
		return $return;
	}

	public function findSalarierParBU ($rbu_id = 0, $id_nature_user = 0) {
        $users = $this->createQueryBuilder('u')
        	->select('u.id', 'u.firstname', 'u.lastname', 'bu.nomBusinessUnit')
        	// SELECT * FROM user_client
        	->innerJoin('UsersBundle:Back\UsersParamNature', 'upn', Join::WITH, 'upn.id = u.iDNatureUser')
			// INNER JOIN param_user_nature ON param_user_nature.IDNatureUser = USER.IDNatureUser
			->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', Join::WITH, 'rbu.iDUser = u.id')
			// INNER JOIN R_BU_User ON R_BU_User.IDUser = USER.IDUser
			->innerJoin('UsersBundle:Back\UsersParamRelationsFonctions', 'urf', Join::WITH, 'urf.id = rbu.iDRelation_Fonctionnelle')
			// INNER JOIN relations_fonctions ON relations_fonctions.ID = R_BU_User.IDRelation_Fonctionnelle
			->innerJoin('UsersBundle:BusinessUnit', 'bu', Join::WITH, 'bu.id = rbu.iDBusinessUnit')
			// INNER JOIN BusinessUnit ON BusinessUnit.IDBusinessUnit = R_BU_User.IDBusinessUnit
			->leftJoin('UsersBundle:RelationUserEntite', 'rue', Join::WITH, 'rue.iDUser = u.id')
			// LEFT JOIN r_user_entite_j ON r_user_entite_j.IDUser = USER.IDUser
			->leftJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.id = rue.iDUserEntite')
			// LEFT JOIN r_bu_entitej ON r_bu_entitej.ID = r_user_entite_j.Id_r_bu_entitej
			->leftJoin('ClientBundle:Client', 'c', Join::WITH, 'c.id = rue.idEntiteJ')
			// LEFT JOIN client ON client.IDEntite = r_user_entite_j.IdEntiteJ
			->leftJoin('UsersBundle:Back\UsersParamRelationsProfessionnelles', 'urp', Join::WITH, 'urp.id = rbe.iDRelationsProfessionnelles')
			// LEFT JOIN Relations_Professionnelles ON Relations_Professionnelles.IDRelations_Professionnelles = r_bu_entitej.IDRelations_Professionnelles
			->where('u.iDNatureUser = 1');
			
		if( $rbu_id != 0 )
			$users->andWhere('bu.id = :rbu_id'); //=== to find salarié par BU ===//

		// WHERE USER.IDNatureUser = 1 AND R_BU_User.IDBusinessUnit = 2 
		if( $rbu_id != 0 )
			$users->setParameter('rbu_id', $rbu_id);

		$return = $users->getQuery()->execute();
		if(count($return)) 
			foreach($return as $key => $retour) {
				$urf = $this->createQueryBuilder('u')->select('urf')
				// SELECT * FROM user_client
	        	->innerJoin('UsersBundle:Back\UsersParamNature', 'upn', Join::WITH, 'upn.id = u.iDNatureUser')
				// INNER JOIN param_user_nature ON param_user_nature.IDNatureUser = USER.IDNatureUser
				->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', Join::WITH, 'rbu.iDUser = u.id')
				// INNER JOIN R_BU_User ON R_BU_User.IDUser = USER.IDUser
				->innerJoin('UsersBundle:Back\UsersParamRelationsFonctions', 'urf', Join::WITH, 'urf.id = rbu.iDRelation_Fonctionnelle')
				// INNER JOIN relations_fonctions ON relations_fonctions.ID = R_BU_User.IDRelation_Fonctionnelle
				->innerJoin('UsersBundle:BusinessUnit', 'bu', Join::WITH, 'bu.id = rbu.iDBusinessUnit')
				// INNER JOIN BusinessUnit ON BusinessUnit.IDBusinessUnit = R_BU_User.IDBusinessUnit
				->leftJoin('UsersBundle:RelationUserEntite', 'rue', Join::WITH, 'rue.iDUser = u.id')
				// LEFT JOIN r_user_entite_j ON r_user_entite_j.IDUser = USER.IDUser
				->leftJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.id = rue.iDUserEntite')
				// LEFT JOIN r_bu_entitej ON r_bu_entitej.ID = r_user_entite_j.Id_r_bu_entitej
				->leftJoin('ClientBundle:Client', 'c', Join::WITH, 'c.id = rue.idEntiteJ')
				// LEFT JOIN client ON client.IDEntite = r_user_entite_j.IdEntiteJ
				->leftJoin('UsersBundle:Back\UsersParamRelationsProfessionnelles', 'urp', Join::WITH, 'urp.id = rbe.iDRelationsProfessionnelles')
				
				// LEFT JOIN Relations_Professionnelles ON Relations_Professionnelles.IDRelations_Professionnelles = r_bu_entitej.IDRelations_Professionnelles
				->where('u.iDNatureUser = 1 and u.id = :user_id and bu.nomBusinessUnit = :bu_name')
				->setParameter('user_id', $retour['id'])
				->setParameter('bu_name', $retour['nomBusinessUnit'])
				->getQuery()
				->execute();

				if(count($urf))
					$return[$key][] = $urf[0];
			}

		if(count($return)) 
			foreach($return as $key => $retour) {
				if( isset($retour[0])) {
					$service = $this->createQueryBuilder('u')->select('s')
						// SELECT * FROM user_client
			        	->innerJoin('UsersBundle:Back\UsersParamNature', 'upn', Join::WITH, 'upn.id = u.iDNatureUser')
						// INNER JOIN param_user_nature ON param_user_nature.IDNatureUser = USER.IDNatureUser
						->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', Join::WITH, 'rbu.iDUser = u.id')
						// INNER JOIN R_BU_User ON R_BU_User.IDUser = USER.IDUser
						->innerJoin('UsersBundle:Back\UsersParamRelationsFonctions', 'urf', Join::WITH, 'urf.id = rbu.iDRelation_Fonctionnelle')
						->leftJoin('UsersBundle:Back\UsersParamService', 's', Join::WITH, 's.id = urf.iDService')
						->where('urf.id = :urf_id')
						->setParameter('urf_id', $retour[0]->getId())
						->getQuery()
						->execute();

					if(count($service))
						$return[$key][] = $service[0];
				}
			}

		// dump($return);

		return $return;
    }

    public function findSalarierCom ($urf_id, $bu_id = 0) {
        $users = $this->createQueryBuilder('u')
        	->select('u.id', 'u.firstname', 'u.lastname')
        	->distinct()
        	// SELECT * FROM user_client
        	->innerJoin('UsersBundle:Back\UsersParamNature', 'upn', Join::WITH, 'upn.id = u.iDNatureUser')
			// INNER JOIN param_user_nature ON param_user_nature.IDNatureUser = USER.IDNatureUser
			->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', Join::WITH, 'rbu.iDUser = u.id')
			// INNER JOIN R_BU_User ON R_BU_User.IDUser = USER.IDUser
			->innerJoin('UsersBundle:Back\UsersParamRelationsFonctions', 'urf', Join::WITH, 'urf.id = rbu.iDRelation_Fonctionnelle')
			// INNER JOIN relations_fonctions ON relations_fonctions.ID = R_BU_User.IDRelation_Fonctionnelle
			->innerJoin('UsersBundle:BusinessUnit', 'bu', Join::WITH, 'bu.id = rbu.iDBusinessUnit')
			// LEFT JOIN r_user_entite_j ON r_user_entite_j.IDUser = USER.IDUser
			->leftJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.iDBusinessUnit = rbu.iDBusinessUnit')
			// LEFT JOIN r_bu_entitej ON r_bu_entitej.ID = r_user_entite_j.Id_r_bu_entitej
			->leftJoin('ClientBundle:Client', 'c', Join::WITH, 'c.id = rbe.iDentite')
			// LEFT JOIN client ON client.IDEntite = r_user_entite_j.IdEntiteJ
			->leftJoin('UsersBundle:Back\UsersParamRelationsProfessionnelles', 'urp', Join::WITH, 'urp.id = rbe.iDRelationsProfessionnelles')
			// LEFT JOIN Relations_Professionnelles ON Relations_Professionnelles.IDRelations_Professionnelles = r_bu_entitej.IDRelations_Professionnelles
			->where('u.iDNatureUser = 1');

		if(count($urf_id) > 0)
			foreach($urf_id as $urf)
				$users->andWhere("urf.id = :r_$urf");
		
		// WHERE USER.IDNatureUser = 1 AND R_BU_User.IDBusinessUnit = 2
		if(count($urf_id) > 0)
			foreach($urf_id as $urf)
				$users->setParameter("r_$urf", $urf);

		if( $bu_id ) {
			$users
				->andWhere('rbe.iDBusinessUnit = :bu_id')
				->setParameter('bu_id', $bu_id);
		}

		$return = $users->getQuery()->execute();
		if(count($return)) 
			foreach($return as $key => $retour) {
				$urf = $this->createQueryBuilder('u')->select('urf')
				// SELECT * FROM user_client
	        	->innerJoin('UsersBundle:Back\UsersParamNature', 'upn', Join::WITH, 'upn.id = u.iDNatureUser')
				// INNER JOIN param_user_nature ON param_user_nature.IDNatureUser = USER.IDNatureUser
				->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', Join::WITH, 'rbu.iDUser = u.id')
				// INNER JOIN R_BU_User ON R_BU_User.IDUser = USER.IDUser
				->innerJoin('UsersBundle:Back\UsersParamRelationsFonctions', 'urf', Join::WITH, 'urf.id = rbu.iDRelation_Fonctionnelle')
				// INNER JOIN relations_fonctions ON relations_fonctions.ID = R_BU_User.IDRelation_Fonctionnelle
				->innerJoin('UsersBundle:BusinessUnit', 'bu', Join::WITH, 'bu.id = rbu.iDBusinessUnit')
				// LEFT JOIN r_user_entite_j ON r_user_entite_j.IDUser = USER.IDUser
				->leftJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.iDBusinessUnit = bu.id')
				// LEFT JOIN r_bu_entitej ON r_bu_entitej.ID = r_user_entite_j.Id_r_bu_entitej
				->leftJoin('ClientBundle:Client', 'c', Join::WITH, 'c.id = rbe.iDentite')
				// LEFT JOIN client ON client.IDEntite = r_user_entite_j.IdEntiteJ
				->leftJoin('UsersBundle:Back\UsersParamRelationsProfessionnelles', 'urp', Join::WITH, 'urp.id = rbe.iDRelationsProfessionnelles')
				// LEFT JOIN Relations_Professionnelles ON Relations_Professionnelles.IDRelations_Professionnelles = r_bu_entitej.IDRelations_Professionnelles
				->where('u.iDNatureUser = 1 and u.id = :user_id')
				->setParameter('user_id', $retour['id'])
				->getQuery()
				->execute();

				if(count($urf))
					$return[$key][] = $urf[0];
			}
		return $return;
    }

    /**
     * 
     * @param  integer $id_entite_juridique l'id du client en personne
     * @return Array   tableau d'objet ou null
     */
    public function findContactsClient ($id_entite_juridique = 0, $bu_id = 0) {
    	$users = $this->createQueryBuilder('u')
    		->select('u.id, u.firstname, u.lastname', 'bu.nomBusinessUnit', 'c.raisonSociale')
			->innerJoin('UsersBundle:RelationUserEntite', 'rue', Join::WITH, 'rue.iDUser = u.id')
			->leftJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.id = rue.iDUserEntite')
			->innerJoin('UsersBundle:BusinessUnit', 'bu', Join::WITH, 'bu.id = rbe.iDBusinessUnit')
			->leftJoin('ClientBundle:Client', 'c', Join::WITH, 'c.id = rue.idEntiteJ')
			->where('u.iDNatureUser = 2');

		if( $id_entite_juridique ) {
			$users
				->andWhere('c.id = :c_id')
				->setParameter('c_id', $id_entite_juridique);
		}

		if( $bu_id ) {
			$users
				->andWhere('bu.id = :bu_id')
				->setParameter('bu_id', $bu_id);
		}

		$return = $users->getQuery()->execute();

		if(count($return)) 
			foreach($return as $key => $retour) {
				$urf = $this->createQueryBuilder('u')->select('urf')
	        	// SELECT * FROM user_client
				->innerJoin('UsersBundle:RelationUserEntite', 'rue', Join::WITH, 'rue.iDUser = u.id')
				->innerJoin('UsersBundle:Back\UsersParamRelationsFonctions', 'urf', Join::WITH, 'urf.id = rue.iDRelationFonctionnelle')
				->leftJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.id = rue.iDUserEntite')
				->where('u.iDNatureUser = 2 and u.id = :user_id')
				->setParameter('user_id', $retour['id'])
				->getQuery()
				->execute();

				if(count($urf))
					$return[0]['urf'] = $urf[0];
			}
			
		if(count($return)) 
			foreach($return as $key => $retour) {
				if( isset($retour[0])) {
					$service = $this->createQueryBuilder('u')->select('s')
						// SELECT * FROM user_client
			        	->innerJoin('UsersBundle:Back\UsersParamNature', 'upn', Join::WITH, 'upn.id = u.iDNatureUser')
			        	// INNER JOIN BusinessUnit ON BusinessUnit.IDBusinessUnit = R_BU_User.IDBusinessUnit
						->innerJoin('UsersBundle:RelationUserEntite', 'rue', Join::WITH, 'rue.iDUser = u.id')
						// INNER JOIN R_BU_User ON R_BU_User.IDUser = USER.IDUser
						->innerJoin('UsersBundle:Back\UsersParamRelationsFonctions', 'urf', Join::WITH, 'urf.id = rue.iDRelationFonctionnelle')
						->leftJoin('UsersBundle:Back\UsersParamService', 's', Join::WITH, 's.id = urf.iDService')
						->where('urf.id = :urf_id')
						->setParameter('urf_id', $retour[0]->getId())
						->getQuery()
						->execute();

					if(count($service))
						$return[$key]['s'] = $service[0];
				}
			}

		if(count($return)) 
			foreach($return as $key => $retour) {
				$upp = $this->createQueryBuilder('u')->select('upp')
	        	// SELECT * FROM user_client
				->innerJoin('UsersBundle:RelationUserEntite', 'rue', Join::WITH, 'rue.iDUser = u.id')
				->innerJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.id = rue.iDUserEntite')
				->innerJoin('UsersBundle:Back\UsersParamRelationsProfessionnelles', 'upp', Join::WITH, 'upp.id = rbe.iDRelationsProfessionnelles')
				->where('u.iDNatureUser = 2 and u.id = :user_id')
				->setParameter('user_id', $retour['id'])
				->getQuery()
				->execute();

				if(count($urf))
					$return[$key]['upp'] = $upp[0];
			}

		// dump($return[3]); exit;
		return $return;
    }

    /**
     * find user by bu_id and iDCompte
     */
    public function findUserByCompte ($bu_id, $usercompte_id) {
    	/**
    	 * user
    	 * user_compte
    	 * r_bu_user
    	 * r_bu_entitej
    	 * r_user_entitej
    	 */
    	$user = $this->createQueryBuilder('u')
    		->innerJoin('UsersBundle:Users', 'uc', Join::WITH, 'uc.id = u.iDCompte')
    		->andWhere('uc.id = :usercompte_id')
    		->setParameter('usercompte_id', $usercompte_id)
    		->getQuery()
    		->execute();

    	if( !count($user) ) return [];

    	/**
    	 * getting by nature user
    	 */
    	$res = $this->createQueryBuilder('u');
    	if( $user[0]->getIDNatureUser() == 1 ) {
    		$res
    			->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', JOIN::WITH, 'rbu.iDUser = u.id')
    			->where('rbu.iDBusinessUnit = :bu_id')
    			->andWhere('rbu.iDUser = :user_id')
    			->setParameter('user_id', $user[0]->getId())
    			->setParameter('bu_id', $bu_id);
    	}

    	if( $user[0]->getIDNatureUser() == 2 ) {
    		$res
    			->innerJoin('UsersBundle:RelationUserEntite', 'rue', JOIN::WITH, 'rue.iDUser = u.id')
    			->innerJoin('UsersBundle:RelationBusinessEntite', 'rbe', JOIN::WITH, 'rbe.iDentite = rue.idEntiteJ')
    			->where('rbe.iDBusinessUnit = :bu_id')
    			->andWhere('rue.iDUser = :user_id')
    			->setParameter('user_id', $user[0]->getId())
    			->setParameter('bu_id', $bu_id);
    	}

    	$return = $res->getQuery()->execute();
    	return count($return) ? $return[0] : null;
    }

    /**
     * Relation user
     */
    public function findRelation ($nature_id, $user_id, $bu_id) {
    	$user = $this->createQueryBuilder('u')
    		->distinct();

    	if( $nature_id == 1 ) {
    		$user
    			->select('rbu as businessUser', 'bu.nomBusinessUnit', 'rbu.iDRelation_Fonctionnelle')
    			->innerJoin('UsersBundle:RelationBusinessUser', 'rbu', Join::WITH, 'rbu.iDUser = u.id')
    			->innerJoin('UsersBundle:BusinessUnit', 'bu', Join::WITH, 'bu.id = rbu.iDBusinessUnit');
    	}

    	if( $nature_id == 2 ) {
    		$user
    			->select('rbe as businessEntite', 'bu.nomBusinessUnit', 'rue.iDRelationFonctionnelle')
    			->innerJoin('UsersBundle:RelationUserEntite', 'rue', Join::WITH, 'rue.iDUser = u.id')
    			->innerJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.id = rue.iDUserEntite')
    			->innerJoin('UsersBundle:BusinessUnit', 'bu', Join::WITH, 'bu.id = rbe.iDBusinessUnit');
    	}

    	if( $user_id ) {
    		$user
    			->andWhere('u.id = :user_id')
    			->setParameter('user_id', $user_id);
    	}

    	return $user->getQuery()->execute();
    }
}

