<?php
/**
 * Created by PhpStorm.
 * User: HP4510
 * Date: 25/09/2017
 * Time: 12:43
 */

namespace MailBundle\Twig\Extension;

class PrioriteExtension extends \Twig_Extension {

    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('priorite', array($this, 'Priorite')));
    }

    public function Priorite($type)
    {
        $url = false;
        switch ($type) {
            case 1:
                $url = 'normal.png';
                break;
            case 2:
                $url = 'haute.png';
                break;
            case 3:
                $url = 'immediate.png';
                break;
            case 4:
                $url = 'a_surveiller.png';
                break;
        }

        return $url;
    }

    public function getName()
    {
        return ' priorite_extension';
    }
}