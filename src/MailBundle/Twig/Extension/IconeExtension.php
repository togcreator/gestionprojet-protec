<?php
/**
 * Created by PhpStorm.
 * User: HP4510
 * Date: 21/09/2017
 * Time: 16:49
 */

namespace MailBundle\Twig\Extension;


class IconeExtension extends \Twig_Extension {
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('icone', array($this, 'Icone')));
    }

    public function Icone($name, $type)
    {
        $typeTexte = array('txt'=>'icon-file-text2', 'doc'=>'icon-file-word', 'docx'=>'icon-file-word','xlsx'=>'icon-file-excel', 'pdf'=>'icon-file-pdf');
        $extension = explode('.', $name);
        $class = false;
        switch ($type) {
            case 1:
                if($extension[1] == 'txt') $class = $typeTexte[$extension[1]];
                if($extension[1] == 'doc') $class = $typeTexte[$extension[1]];
                if($extension[1] == 'docx') $class = $typeTexte[$extension[1]];
                if($extension[1] == 'xlsx') $class = $typeTexte[$extension[1]];
                if($extension[1] == 'pdf') $class = $typeTexte[$extension[1]];
                break;
            case 2:
                $class = " icon-file-picture";
                break;
            case 3:
                $class = "icon-file-video";
                break;
        }

        return $class;
    }

    public function getName()
    {
        return ' icone_extension';
    }
}