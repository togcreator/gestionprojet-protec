<?php
/**
 * Created by PhpStorm.
 * User: Madatic Dev
 * Date: 14/09/2017
 * Time: 11:50
 */

namespace MailBundle\Services;


class GenerateCodeMail {

    /**
     * @return string
     */
    public function getCode()
    {
        $date = new \DateTime('now');
        return substr(uniqid($date->getTimestamp(), false), 0);
    }
}