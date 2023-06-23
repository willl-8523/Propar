<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AcceuilController extends AbstractController
{
    // Acceuil
    /**
     * @Route("/",name="home")
     */
    public function home()
    {
        return $this->render(
            'accueil/home.html.twig',
            [
                'title' => 'Bienvenue chez PROPAR',
            ]
        );
    }
}
