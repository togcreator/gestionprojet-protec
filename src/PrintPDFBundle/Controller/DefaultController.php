<?php

namespace PrintPDFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function pdfAction()
    {
        $template = $this->render('PrintPDFBundle:Default:index.html.twig');
        $html2pdf = $this->get('print_html2pdf');
        return $html2pdf->create($template);
    }
}
