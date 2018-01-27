<?php
/**
 * Created by PhpStorm.
 * User: Madatic Dev1
 * Date: 18/09/2017
 * Time: 13:51
 */

namespace MailBundle\Form\Handler;

use Symfony\Component\DependencyInjection\ContainerInterface;
use MailBundle\Entity\MailPJ;

class recipientPJHandler {

    private $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getPieceJointe($request, $manager, $mail, $mailpj){
        if(null !== $mailpj->getFile()){
            $typeImage = array('jpg', 'jpeg', 'png', 'gif', 'tiff');
            $typeTexte = array('txt', 'doc', 'docx', 'pdf', 'xlsx');
            $typeVideo = array('mpeg', 'avi', 'flv', 'dat');

            if(in_array($mailpj->getFile()->guessExtension(), $typeTexte)){
                $mailpj->setTypePj(1);
                $upload_path = $this->container->getParameter('protec_document');
            }
            elseif(in_array($mailpj->getFile()->guessExtension(), $typeImage)){
                $mailpj->setTypePj(2);
                $upload_path = $this->container->getParameter('protec_image');
            }
            elseif(in_array($mailpj->getFile()->guessExtension(), $typeVideo)){
                $mailpj->setTypePj(3);
                $upload_path = $this->container->getParameter('protec_video');
            }
            else {
                $mailpj->setTypePj(0);
                $upload_path = null;
            }

            $fileName = sha1(uniqid()).'.'.$mailpj->getFile()->guessExtension();
            $mailpj->setNomPj($fileName);

            $mailpj->setIdBiblio(0);
            $mailpj->setMail($mail);
            $mailpj->setVersion('Aucun');
            $mail->addMailPJ($mailpj);

            if(null !== $upload_path){
                $mailpj->getFile()->move($upload_path, $fileName);
                $manager->persist($mailpj);
            }

            $mailpj->setFile(null);

            return $manager;
        }

        return false;
    }

    public function getDropboxLink($request, $manager, $mail) {
        $links = $request->request->get('dropbox_link');
        $dropbox_link = array();
        if($links !== "" && $links !== null) {
            $list = explode(",", $links);
            for($i=0; $i<count($list); $i++) {
                $dropbox_link[$i] = new MailPJ();
                $dropbox_link[$i]->setMail($mail);
                $dropbox_link[$i]->setTypePj(0);
                $dropbox_link[$i]->setNomPJ($list[$i]);
                $dropbox_link[$i]->setIdBiblio(0);
                $dropbox_link[$i]->setVersion(0);

                $mail->addMailPJ($dropbox_link[$i]);

                $manager->persist($dropbox_link[$i]);

            }

            return $manager;
        }
        return false;
    }

}