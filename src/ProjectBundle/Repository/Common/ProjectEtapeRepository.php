<?php

namespace ProjectBundle\Repository\Common;
use Doctrine\ORM\Query\Expr\Join;

/**
 * ProjectEtapeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectEtapeRepository extends \Doctrine\ORM\EntityRepository
{
	/**
     * Find by BU
     */
    public function findAllBy ($criter, $user_id = null, $bu_id = null, $orderby = null) {
        $projects = $this->createQueryBuilder('e')
        	->innerJoin('ProjectBundle:Common\Project', 'p', Join::WITH, 'e.idProjetVersion = p.id');

        if( $criter && count($criter) ) {
            foreach( $criter as $key => $value ) {
                $projects
                    ->andWhere("$key = :{$key}")
                    ->setParameter($key, $value);
            }
        }

        if( $bu_id ) {
            $projects
                ->innerJoin('UsersBundle:RelationBusinessEntite', 'rbe', Join::WITH, 'rbe.iDentite = p.idEntiteJ')
                ->andWhere('rbe.iDBusinessUnit = :bu_id')
                ->setParameter('bu_id', $bu_id);
        }

        if( $user_id ) {
            $projects
                ->innerJoin('UsersBundle:UserClient', 'u', Join::WITH, 'u.id = p.idCreateur')
                ->andWhere('u.id = :user_id or p.modeAcces = 2')
                ->setParameter('user_id', $user_id);
        }

        if( !$orderby ) $orderby = 'id';
        return $projects
                ->orderBy('e.' . $orderby, 'DESC')
                ->getQuery()
                ->execute();
    }
}
