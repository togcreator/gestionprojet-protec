<?php

namespace ProjectBundle\Repository\Common;
use Doctrine\ORM\Query\Expr\Join;

/**
 * ProjectVersionUserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectVersionUserRepository extends \Doctrine\ORM\EntityRepository
{
	/**
	 * Fonction pour filtrer les employes
	 * @param  array  $criteria [Critère de requête sql]
	 * @return Array / null          
	 */
	public function findEmploye ($criteria = []) {
		$user = $this->createQueryBuilder('p');
		$user->innerJoin('UsersBundle:UserClient', 'c', Join::WITH, 'c.id = p.idUser');

		$where = [];
		foreach($criteria as $key => $value)
			$where[] = "p.{$key} = :{$key}";
		$implode = implode(' AND ', $where);
		$user->where(($implode ? $implode : '1 = 1') . ' AND c.iDNatureUser = :nature');

		$criteria['nature'] = 1;
		$user->setParameters($criteria);
		return $user->getQuery()->execute();
	}

	/**
	 * Focntion pour filtrer les contacts
	 * @param  array  $criteria [Critère de requête sql]
	 * @return Array / null       
	 */
	public function findContact ($project_id, $entite_id = null) {
		$contact = $this->createQueryBuilder('p')
			->select('u')
			->innerJoin('UsersBundle:UserClient', 'u', Join::WITH, 'u.id = p.idUser');

		if( $entite_id ) {
			$contact
				->innerJoin('UsersBundle:RelationUserEntite', 'rue', Join::WITH, 'rue.iDUser = u.id')
				->andWhere('rue.idEntiteJ = :entite_id')
				->setParameter('entite_id', $entite_id);
		}

		$contact
			->andWhere('u.iDNatureUser = 2 and p.idProjetVersion = :project_id')
			->setParameter('project_id', $project_id);

		return $contact
			->orderBy('u.id', 'DESC')
			->getQuery()
			->execute();
	}
}
