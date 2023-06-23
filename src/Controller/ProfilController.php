<?php

namespace App\Controller;

use App\Entity\Command;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="app_profil")
     */
    public function index(UserRepository $repo): Response
    {

        $user = $this->getDoctrine()->getRepository(User::class)->findAll();


        return $this->render(
            'profil/index.html.twig',
            ['user' => $user,]
        );
    }
}
