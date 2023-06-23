<?php

use Dompdf\Dompdf;
use Dompdf\Options;

class pdfService {


    private $domPdf;

    /**
     * @Route("Route", name="RouteName")
     */
    public function __construct()
    {
        $this->domPdf = new Dompdf();
        $options = new Options();
        $options->set('defaultFont', 'Roboto');


        $this->domPdf->setOptions($options);

    }
    
   
    public function showPdfFile($html)
    {
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->stream("details.pdf", [
            "Attachment" => false
        ]);
    }

    public function generateBinaryPDF($html)
    {
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->output();
    }
    

}