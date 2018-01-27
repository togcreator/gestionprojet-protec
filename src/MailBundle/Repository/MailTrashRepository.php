<?php

namespace MailBundle\Repository;

use MailBundle\Doctrine\Query\GroupConcat;
use UsersBundle\Entity\UserClient;
/**
 * MailTrashRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MailTrashRepository extends \Doctrine\ORM\EntityRepository
{
	public function countTrash(UserClient $user){
		$qb = $this->createQueryBuilder('mt');
		$qb->select('COUNT(mt.id)')
                    ->join('mt.mailPeople', 'mp')
                    //->join('mp.mail', 'm')
					//->where('m.user = :idUser')
                    ->where('mp.userTo = :idUser')
                    ->orWhere('mp.userFrom = :idUser')
            		->setParameter('idUser', $user->getId());
		return $qb->getQuery()->getSingleScalarResult();
	}

    public function dataTrash(UserClient $user){
        $qb = $this->createQueryBuilder('mt');
        $qb->select('GROUP_CONCAT(DISTINCT mt.mailPeople)')
            ->join('mt.mailPeople', 'mp')
            //->join('mp.mail', 'm')
            ->where('mp.userTo = :idUser')
            ->orWhere('mp.userFrom = :idUser')
            ->setParameter('idUser', $user->getId());
        $result = $qb->getQuery()->getOneOrNullResult();

        return ($result[1] === null) ? 0 : $result[1];
    }

    public function findByTrashList(UserClient $user){
        $qb = $this->createQueryBuilder('mt');
        $qb
        ->join('mt.mailPeople', 'mp')
        ->join('mp.mail', 'm')
        ->where('mp.userTo = :idUser')
        ->orWhere('mp.userFrom = :idUser')
        //->where('m.user = :idUser')
        ->setParameter('idUser', $user->getId());
        return $qb->getQuery()->getResult();
    }
    /*public function findByTrashList(User $user){
        $qb = $this->createQueryBuilder('mt');
        $qb->select('mt, mp as people, GROUP_CONCAT(DISTINCT mp.to1) as customer')
        ->join('mt.mailPeople', 'mp')
        ->join('mp.mail', 'm')
        ->where('mp.userTo = :idUser')
        ->orWhere('mp.userFrom = :idUser')
        //->where('m.user = :idUser')
        ->setParameter('idUser', $user->getId())
        ->groupBy('m.id');
        return $qb->getQuery()->getResult();
    }*/
}