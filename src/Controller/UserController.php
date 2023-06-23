<?php

namespace App\Controller;

use App\Repository\CommandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/Ajout", name="ajout_user")
     */
    public function index(CommandRepository $repo): Response
    {
        $commands = $repo->findAll();
        return $this->render('security/registration.html.twig', [
            'commands' => $commands,
        ]);
    }
}
