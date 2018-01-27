<?php

namespace AppBundle\Repository\Front;

use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Entity\Common\Users;
use AppBundle\Entity\Common\Date;

/**
 * CompaignRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CompaignRepository extends \Doctrine\ORM\EntityRepository
{
	// for compaign and type
	public function findAllWithType ( $date ) 
	{
        // pour savoir le mois si le mois courant
        $diff = 100;
        if( $date != 'now' && is_string($date) )
            $diff = date_diff(new \DateTime($date), new \DateTime());

        /** these date */
        if( $date == 'now' || (is_object($diff) && $diff->format('%m') == 0) ) // momba n anio
        {
            $date_now = date('Y-m-d H:i:s');
            // date lat time
            $diff = date_diff(new \DateTime(), new \DateTime('00:00:00'));
            $date = new \DateTime();
            $date->modify( '-' . $diff->format('%H') . 'hour');
            $date_debut = $date->format('Y-m-d H:i:s');
        }
        else if( is_string($date) )  // momba n volana
        {
            // string
            $date_now = date("Y-m-t", strtotime($date));
            $date_debut = $date;
        }
        else if( is_object($date) && Date::is_current_month($date) ) 
        {
            // mois courant
            $date_now = (new \DateTime())->format('Y-m-d 01:00:00');
            $date_debut = $date->format('Y-m-d');

            // echo 'mi-exexute';
        }
        else // resaka lasa
        {
            // io ny date omaly
            $date_now = $date->format('Y-m-d 23:00:00');
            $date_debut = $date->format('Y-m-d 01:00:00');
        }

        print_r( '<!-- ' . $date_debut  . "-->\n" );
        print_r( '<!-- ' . $date_now  . "-->\n" );

        // print_r( $date_debut );

        // createQueryBuilder
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('UsersBundle:Users',
                'u',
                Join::WITH,
                'u.id = c.idUser')
            ->where('c.dateDebut BETWEEN :debut AND :now')
            ->setParameter('debut', $date_debut)
            ->setParameter('now', $date_now)
            ->getQuery();
        // return
        return $qb->getResult();
	}

    /** marketing */
    public function findMarketing ($date) 
    {
        $debut = $ydebut = null;
        $fin = $yfin = null;

        // the current_month
        $current_month = Date::is_current_month($date);
        if( $current_month )
        {
            // is_current_day
            $debut = Date::getDate('firstweek');
            $fin = Date::getDate('lastweek');

            // last week
            $yd = (new \DateTime($debut));
            $yd->modify('-1 week');
            $ydebut = $yd->format('Y-m-d');

            $yf = (new \DateTime($fin));
            $yf->modify('-1 week');
            $yfin = $yf->format('Y-m-d');

            // print_r( $ydebut );
        }
        else
        {
            // this month last
            $debut = Date::getDate('firstmonth', $date);
            $fin = Date::getDate('lastmonth', $date);

            $ydebut = Date::getDate('firstmonth', (new \DateTime($date))->modify('-1 month'));
            $yfin = Date::getDate('lastmonth', (new \DateTime($date))->modify('-1 month'));
        }

        // echo $debut;
        // echo $fin;
        $get = function($self, $debut, $fin){
            $qb = $self->createQueryBuilder('c')
                ->select('SUM(c.budget)')
                ->where('c.dateDebut BETWEEN :debut AND :now')
                ->setParameter('debut', $debut)
                ->setParameter('now', $fin)
                ->getQuery();
            $result = $qb->getResult();
            $result = count($result)?count($result[0])?$result[0][1]:0:0;
            $result = number_format((int)$result, 0);
            return $result;
        };

        $now = $get($this, $debut, $fin);
        $yesterday = $get($this, $ydebut, $yfin);
        
        // return
        $inf = $n_inf = $y_inf = 0;
        if( $now > 0 && $yesterday >0 )
        {
            $n_inf = round($now*100/$yesterday, 2);
            $y_inf = round($yesterday*100/$now, 2);
        }
        elseif( $now < 0)
        {
            $n_inf = 0;
            $y_inf = 100;
        }else {
            $n_inf = 100;
            $y_inf = 0;
        }

        $nows = new \stdClass;
        $nows->budget = $now;
        $nows->date = (new \DateTime($debut))->format('M d') . ' - ' . (new \DateTime($fin))->format('M d');
        $nows->inflation = ceil($n_inf);

        $yesterdays = new \stdClass;
        $yesterdays->budget = $yesterday;
        $yesterdays->date = (new \DateTime($ydebut))->format('M d') . ' - ' . (new \DateTime($yfin))->format('M d');
        $yesterdays->inflation = $y_inf;

        return array($nows, $yesterdays);
    }
}
