<?php

namespace App\Controller;

use App\Entity\Command;
use App\Form\CommandFormType;
use App\Repository\CommandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandController extends AbstractController
{

    // Ajouter une commande
    /**
     * @Route("/command", name="app_command")
     * @Route("/command/{id}/edit", name="edit_command")
     */
    public function addCommand(Command $command = null,  Request $request, EntityManagerInterface $manager): Response
    {
        dump($request);

        if(!$command) {
            // Crée une commande vide
            $command = new Command();
        }

        $form = $this->createForm(CommandFormType::class, $command);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($command);
            $manager->flush();

            return $this->redirectToRoute('show_command', ['id' => $command->getId(),]);
        }
        
        return $this->render('command/addCommand.html.twig', [
            'command_form' => $form->createView(),
            'editMode' => $command->getId() !== null
        ]);

    }

    // Affiche La liste des commandes
    /**
     * @Route("/command/recap", name="recapCommand")
     */
    public function recapCommand(CommandRepository $commandRepository): Response
    {
        $commands = $commandRepository->findAll();

        return $this->render('command/recapCommand.html.twig', [
            'commands' => $commands,
        ]);
    }

    // Affiche une commande précise
    /**
     * @Route("/command/{id}", name="show_command")
     */
    public function showCommand(Command $command): Response
    {
        dump($command);
        return $this->render('command/showCommand.html.twig', [
            'show_command' => $command,
        ]);
    }

}