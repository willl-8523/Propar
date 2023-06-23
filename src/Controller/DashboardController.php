<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\CommandRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(UserRepository $userRepo, CommandRepository $commandRepo): Response
    {
        // Récupère les données de la table User et Command
        $userRepo = $userRepo->findAll();
        $commandRepo = $commandRepo->findAll();

        // Si Utilisateur a role admin
        if ($this->getUser()->getRoles()[0] == "ROLE_ADMIN") {

            dump($this->getUser()->getRoles()[0]);
            return $this->render('Dashboard/expertDashboard.html.twig', [
                'commands' => $commandRepo,
            ]);
        } else {

            return $this->render('Dashboard/userDashboard.html.twig', [
                'userRepo' => $userRepo,
                'commands' => $commandRepo,
            ]);
        }
    }

    /**
     * @Route("/dashboard/employes", name="employes")
     */
    public function employes(UserRepository $userRepo): Response
    {
        // Récupère les données de la table Command
        $userRepo = $userRepo->findAll();

        return $this->render('Dashboard/employes.html.twig', [
            'users' => $userRepo,
        ]);
    }
}