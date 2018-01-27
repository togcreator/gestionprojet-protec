<?php

namespace AppBundle\Entity;

class Date
{
	// consttructor
	public function __construct() {}

	// is_current_month
	public static function is_current_month( $date = null ) 
	{
		// check date
		$date = is_object($date)?$date:(is_string($date)?(new \DateTime($date)):(new \DateTime()));
		
		// test php
		if( !function_exists('date_diff') )
			return;
		// diff
		$diff = date_diff($date, new \DateTime());
		return $diff->format('%m')==0 ?true:false;
	}

	// getting date
	public static function getDate ($criteria, $date = null, $heure = false)
	{
		$date = is_object($date)?$date:(new \DateTime($date));

		// date
		if( $criteria == 'lastweek' )
		{
			$date = 7 - (int)$date->format('w');
			$date = $date<0?-$date:$date;
			$date = (new \DateTime())->modify('+'.$date.' days');
			return $date->format('Y-m-d');
		}

		if( $criteria == 'firstweek' )
		{
			$date = (int)$date->format('w')-1;
			$date = (new \DateTime())->modify('-'.$date.' days');
			return $date->format('Y-m-d');
		}

		// month
		if( $criteria == 'firstmonth' )
			return $date->format('Y-m-1');

		if($criteria == 'lastmonth')
			return (new \DateTime(date("Y-m-t", strtotime($date->format('Y-m-d')))))->format('Y-m-d');
	}
}