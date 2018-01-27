<?php

namespace MailBundle\Repository;

use MailBundle\Entity\MailMessage;
use UsersBundle\Entity\UserClient;

class MailMessageRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByMessage(UserClient $user) {
        $qb = $this->createQueryBuilder('msg');
        $qb
            ->where("msg.user = :idUser")
            ->andWhere("msg.mail IS NULL")
            ->setParameter('idUser', $user->getId());
        return $qb
            ->getQuery()
            ->getResult();
    }

    public function countDraft(UserClient $user){
        $qb = $this->createQueryBuilder('d');
        $qb->select('COUNT(d.id)')
            ->where('d.user = :idUser')
            ->andWhere('d.mail IS NULL')
            ->setParameter('idUser', $user->getId());
        return $qb->getQuery()->getSingleScalarResult();
    }
}
