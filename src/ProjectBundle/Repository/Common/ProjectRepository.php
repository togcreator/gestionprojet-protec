<?php

namespace ProjectBundle\Repository\Common;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Common\Collections\Criteria;

/**
 * ProjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectRepository extends \Doctrine\ORM\EntityRepository
{
    // for searching
    public function findBySearch ($project = [], $etapes = [], $operations = [], $date = [], $lib = 'lib0')
    {
        $array = [];
        $string = ['label', 'object', 'objet'];

        /* flag pour etape et opérations */
        $isEtape = false;
        $isOperation = false;

        // extract project
        if(count($project))
            foreach($project as $key => $value) {
                //==============================
                if( 'contact' == $key || 'idBusinessUnit' == $key || 'idRelationProfessionnelles'== $key ) continue;

                if( in_array($key, $string) && $value && $key != 'tri') {
                    $array[] = "p.$lib like :label";
                }
                elseif( $value && $value != 0 && (strpos($key, 'date') === false) )
                    $array[] = "p.$key = :$key";
            }

        // extract project
        if(count($etapes)) {
            foreach($etapes as $key => $value) {
                if( in_array($key, $string) && $value ) {
                    $array[] = "e.object like :label";
                    $isEtape = true;
                }
                elseif( $value && $value != 0 && (strpos($key, 'date') === false) ) {
                    $array[] = "e.$key = :$key";
                    $isEtape = true;   
                }
            }

            if( ($etapes['datedebutPrevue'] != "0000-00-00" && !empty($etapes['datedebutPrevue']))
             && (!empty($etapes['datefinPrevue']) && $etapes['datefinPrevue'] != "0000-00-00") ) 
            {
                $array[] = "( e.datedebutprevue BETWEEN :datedebutPrevueE AND :datefinPrevueE )";
                $array[] = "( e.datefinprevue BETWEEN :datedebutPrevueE AND :datefinPrevueE )";
                $isEtape = true;
            }
        }

        // extract project
        if(count($operations)) {
            foreach($operations as $key => $value) {
                if( in_array($key, $string) ) {
                    $array[] = "o.object like :label";
                    $isOperation = true;
                }
                elseif( $value && $value != 0 && (strpos($key, 'date') === false)) {
                    $array[] = "o.$key = :$key";
                    $isOperation = true;
                }
            }

            if( (!empty($operations['datedebutPrevue']) && $operations['datedebutPrevue'] != "0000-00-00") 
                && (!empty($operations['datefinPrevue']) && $operations['datefinPrevue'] != "0000-00-00") )
            {
                $array[] = "( o.datedebutprevue BETWEEN :datedebutPrevueO AND :datefinPrevueO )";
                $array[] = "( o.datefinprevue BETWEEN :datedebutPrevueO AND :datefinPrevueO )";
                $isOperation = true;
            }
        }

        $projects = $this->createQueryBuilder('p')->select('p');

        //============================= user contact ====================================
        $contact = (array_key_exists('contact', $project) && $project['contact']);
        $idBusinessUnit = (array_key_exists('idBusinessUnit', $project) && $project['idBusinessUnit']);
        $idRelationProfessionnelles = (array_key_exists('idRelationProfessionnelles', $project) && $project['idRelationProfessionnelles']);

        //================= 1 des 3 ==================
        if( ($contact || $idBusinessUnit || $idRelationProfessionnelles) ) 
        {
            $projects->innerJoin('ProjectBundle:Common\ProjectVersionUser', 'pv', Join::WITH, 'pv.idProjetVersion = p.id');
            $projects->innerJoin('UsersBundle:UserClient', 'u', Join::WITH, 'pv.idUser = u.id');
            $projects->innerJoin('UsersBundle:RelationBusinessUser', 'ru', Join::WITH, 'ru.iDUser = u.id');
            $projects->innerJoin('UsersBundle:RelationBusinessEntite', 'r', Join::WITH, 'r.iDBusinessUnit = ru.iDBusinessUnit');
            
            // c => id == pu => idUser
            // rbu => idUser == c => id
            // rbe => idBusinessUnit == rbu => idBusinessUnit


        }

        // for etapes
        if( $isEtape )
            $projects->innerJoin('ProjectBundle:Common\ProjectEtape', 'e', Join::WITH, 'e.idProjetVersion = p.id');

        // for operations
        if( $isOperation )
            $projects->innerJoin('ProjectBundle:Common\ProjectEtapesOperations', 'o', Join::WITH, 'o.idProjectVersion = p.id');

        // where condition
        if( count($array) )
            $projects->where(implode(' AND ', $array));

        //=========================
        if( !($contact && $idBusinessUnit && $idRelationProfessionnelles) ) {

            if( $contact )
                $projects->andWhere('pv.idUser = :contact AND u.iDNatureUser = 2');
            if( $idBusinessUnit )
                $projects->andWhere('ru.iDBusinessUnit = :idBusinessUnit');
            if( $idRelationProfessionnelles )
                $projects->andWhere('r.iDRelationsProfessionnelles = :idRelationProfessionnelles');

            if( $contact ) {
                $projects->setParameter('contact', $project['contact']);
            }
            if( $idBusinessUnit ) {
                $projects->setParameter('idBusinessUnit', $project['idBusinessUnit']);
            }
            if( $idRelationProfessionnelles ) {
                $projects->setParameter('idRelationProfessionnelles', $project['idRelationProfessionnelles']);
            }

            dump('madalo');
        }else {
            $projects->andWhere('pv.idUser = :contact AND us.iDNatureUser = 2 AND r.iDBusinessUnit = :idBusinessUnit AND r.iDRelationsProfessionnelles = :idRelationProfessionnelles');
            $projects->setParameters([
                'contact' => $project['contact'],
                'iDBusinessUnit' => $project['idBusinessUnit'],
                'iDRelationsProfessionnelles' => $project['idRelationProfessionnelles']
            ]);
        }

        // setting parameter
        if(count($project))
            foreach( $project as $key => $value ) {
                if( $value && $value !== 0  && (strpos($key, 'date') === false) && $key != 'tri' )
                    $projects->setParameter(in_array($key, $string) ? 'label' : $key, in_array($key, $string) ? "'%$value%'" : $value);
            }

        if(count($etapes)) {
            foreach( $etapes as $key => $value )
                if( $value && $value !== 0  && (strpos($key, 'date') === false) )
                    $projects->setParameter(in_array($key, $string) ? 'label' : $key, in_array($key, $string) ? "'%$value%'" : $value);

            // date
            if( ($etapes['datedebutPrevue'] != "0000-00-00" && !empty($etapes['datedebutPrevue']))
             && (!empty($etapes['datefinPrevue']) && $etapes['datefinPrevue'] != "0000-00-00") ) 
            { 
                $projects->setParameter('datedebutPrevueE', date('Y-m-d', strtotime($etapes['datedebutPrevue'])));
                $projects->setParameter('datefinPrevueE', date('Y-m-d', strtotime($etapes['datefinPrevue'])));
            }
        }   

        if(count($operations)) {
            foreach( $operations as $key => $value )
                if( $value && $value !== 0  && (strpos($key, 'date') === false) )
                    $projects->setParameter(in_array($key, $string) ? 'label' : $key, in_array($key, $string) ? "'%$value%'" : $value);

            // date
            if( (!empty($operations['datedebutPrevue']) && $operations['datedebutPrevue'] != "0000-00-00") 
                && (!empty($operations['datefinPrevue']) && $operations['datefinPrevue'] != "0000-00-00") )
            {
                $projects->setParameter('datedebutPrevueO', date('Y-m-d', strtotime($operations['datedebutPrevue'])));
                $projects->setParameter('datefinPrevueO', date('Y-m-d', strtotime($operations['datefinPrevue'])));
            }
        }

        /* pour tri */
        if( empty($project['tri']) || $project['tri'] == 0 )
            $project['tri'] = 'p.idLeader';
        $projects->orderBy( $project['tri'] );

        dump($projects->getQuery());

        // execute this
        $return = $projects->getQuery()->execute();
        return $return;
    }


    /**
    * Pour les critères de projet en mode d'accès
    * pour les propriétaires des données
    *
    * @param Array $criteria
    * @return result
    */ 
    public function findClient($id, $orderby = 'id') {

        dump($orderby);

        // test si utilisateur contact
        if( ($contact = $this->getEntityManager()->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $id, 'iDNatureUser' => 2])) ) {
            $projects = $this->createQueryBuilder('p');
            $projects->innerJoin('ProjectBundle:Common\ProjectVersionUser', 'v', Join::WITH, 'v.idProjetVersion = p.id');
            $projects->innerJoin('UsersBundle:UserClient', 'u', Join::WITH, 'u.id = v.idUser');
            $projects->where('u.iDNatureUser = 2 AND u.id = :id');
            $projects->setParameter('id', $id);
            $projects->orderBy('p.' . $orderby, 'DESC');
            return $projects->getQuery()->execute();
        }

        // test si utilisateur employe 
        $projects = $this->createQueryBuilder('p');
        $projects->where('p.modeAcces = :modeAcces OR p.idCreateur = :idCreateur');
        $projects->setParameters(['modeAcces' => 2, 'idCreateur' => $id]);
        return $projects->getQuery()->execute();
    }
}