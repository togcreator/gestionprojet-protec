<?php
/**
 * Created by PhpStorm.
 * User: Madatic Dev1
 * Date: 03/10/2017
 * Time: 14:30
 */
//use Spipu\Html2Pdf\Html2Pdf;

namespace PrintPDFBundle\Services;


class Html2Pdf {

    private $pdf;

    public function create($template)
    {
        $this->pdf = new \Mpdf\Mpdf();
        $this->pdf->writeHTML($template);
        return $this->pdf->Output();
    }
}