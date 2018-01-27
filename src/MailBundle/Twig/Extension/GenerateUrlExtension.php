<?php
/**
 * Created by PhpStorm.
 * User: HP4510
 * Date: 21/09/2017
 * Time: 14:14
 */

namespace MailBundle\Twig\Extension;


class GenerateUrlExtension extends \Twig_Extension {
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('stringurl', array($this, 'StringUrl')));
    }

    public function StringUrl($name, $type)
    {
        $url = false;
        switch ($type) {
            case 1:
                $url = "uploads/document/".$name;
                break;
            case 2:
                $url = "uploads/image/".$name;
                break;
            case 3:
                $url = "uploads/video/".$name;
                break;
        }

        return $url;
    }

    public function getName()
    {
        return ' stringurl_extension';
    }
}