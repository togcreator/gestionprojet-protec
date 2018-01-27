<?php

namespace UsersBundle\Repository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * RelationBusinessEntiteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RelationBusinessUserRepository extends \Doctrine\ORM\EntityRepository
{
	/**
	* find by User
	*/
	public function findByUser () {
		return $this->createQueryBuilder('r')
			->select('r')
			->innerJoin('UsersBundle:UserClient', 'u', Join::WITH, 'u.id = r.iDUser ')
			->where('u.iDNatureUser = 1')
			->getQuery()
			->execute();
	}
}
