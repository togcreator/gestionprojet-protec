<?php
/**
 * Created by PhpStorm.
 * User: HP4510
 * Date: 21/09/2017
 * Time: 10:21
 */

namespace MailBundle\Twig\Extension;


class StringCutExtension extends \Twig_Extension {

    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('stringcut', array($this, 'StringCut')));
    }

    public function StringCut($string, $max_length)
    {
        if (strlen($string) <= $max_length)
            return $string."...";

        $string = mb_substr($string, 0, $max_length);
        $pos = mb_strrpos($string, " ");

        if ($pos === false)
            return mb_substr($string, 0, $max_length)."...";

        return mb_substr($string, 0, $pos)."...";
    }

    public function getName()
    {
        return ' stringcut_extension';
    }
}