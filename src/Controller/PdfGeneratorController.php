<?php

namespace App\Controller;


use Dompdf\Dompdf;
use App\Entity\Command;
use App\Entity\Operation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PdfGeneratorController extends AbstractController
{
    /**
     * @Route("/pdf/generator/{id}", name="app_pdf_generator")
     */
    public function index(Operation $operation): Response
    {

        // $data = $this->getDoctrine()->getRepository(Operation::class)->findAll();
        $html =  $this->renderView('pdf_generator/index.html.twig', ['operation' => $operation]);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();

        return new Response(
            $dompdf->stream('resume', ["Attachment" => false]),
            Response::HTTP_OK,
            ['Content-Type' => 'application/pdf']
        );
    }
    private function imageToBase64($path)
    {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}
