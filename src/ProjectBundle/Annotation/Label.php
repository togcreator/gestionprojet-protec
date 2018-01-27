<?php

namespace ProjectBundle\Annotation;

use Doctrine\Common\Annotations\Reader;

/**
* @Annotation
*/
class Label 
{
	public $name;

	public function __construct($name)
	{
		// print_r($name); exit;
	}
}