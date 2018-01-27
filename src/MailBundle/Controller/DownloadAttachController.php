<?php
/**
 * Created by PhpStorm.
 * User: HP4510
 * Date: 21/09/2017
 * Time: 15:45
 */

namespace MailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Response;

class DownloadAttachController extends Controller {
    /**
     * Serve a file by forcing the download
     *
     */
    public function downloadFileAction($filename, $typepj)
    {
        switch ($typepj) {
            case 1:
                $filePath = $this->container->getParameter('protec_document').'/'.$filename;
                break;
            case 2:
                $filePath = $this->container->getParameter('protec_image').'/'.$filename;
                break;
            case 3:
                $filePath = $this->container->getParameter('protec_video').'/'.$filename;
                break;
        }

        // check if file exists
        $fs = new FileSystem();

        if (!$fs->exists($filePath)) {
            throw $this->createNotFoundException();
        }

        // prepare BinaryFileResponse
        $response = new BinaryFileResponse($filePath);
        $response->trustXSendfileTypeHeader();
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_INLINE,
            $filename,
            iconv('UTF-8', 'ASCII//TRANSLIT', $filename)
        );

        return $response;
    }
}