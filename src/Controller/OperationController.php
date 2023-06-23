<?php

namespace App\Controller;

use App\Entity\Command;
use App\Entity\Operation;
use App\Form\OperationType;
use App\Repository\OperationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OperationController extends AbstractController
{

    /**
     * @Route("/operation/statut/{id}", name="op_terminee")
     */
    public function operationTerminee(Operation $operation, EntityManagerInterface $manager, Request $request): Response 
    {
        if ($this->isCsrfTokenValid("SUP" . $operation->getId(), $request->get('_token'))) {

            $operation->setStatut('T');
            $manager->persist($operation);
            $manager->flush();
            $this->addFlash('success', "L'opération est terminée");

            return $this->redirectToRoute('liste_operations');
        }
    }

    /**
     * @Route("/operation/{id}", name="add_operation")
     */
    public function operation(Operation $operation = null, Command $command, Request $request, EntityManagerInterface $manager, OperationRepository $repo): Response
    {

        if (!$operation) {
            $operation = new Operation();
            $operation->setStatut('C');
        } else {
            $operation->setStatut('T');
        }
        
        //CODE ASSIA
        $operationsEnCours = $repo->findOperationEncours();
        $profil = $this->getUser()->getProfil();
        $mail = $this->getUser()->getEmail();
        $compteur = 0;

        foreach ($operationsEnCours as $key => $value) {
            if ($value->getEmailUser() == $mail) {
                $compteur++;
            };
        }

        if ($profil === "EXPERT" and $compteur < 5) {

            $form = $this->createForm(OperationType::class, $operation);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $manager->remove($command);
                $manager->persist($operation);
                $manager->flush();
                $this->addFlash('success', "L'ajout a bien été réalisé");

                return $this->redirectToRoute('liste_operations');
            }

            return $this->render('operation/addOperation.html.twig', [
                'command' => $command,
                'form' => $form->createView(),
            ]);
        } elseif (($profil === "SENIOR" and $compteur < 3)) {


            $form = $this->createForm(OperationType::class, $operation);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $manager->remove($command);
                $manager->persist($operation);
                $manager->flush();
                $this->addFlash('success', "L'ajout a bien été réalisée");

                return $this->redirectToRoute('liste_operations');
            }

            return $this->render('operation/addOperation.html.twig', [
                'command' => $command,
                'form' => $form->createView(),
            ]);
        } elseif (($profil === "APPRENTI" and $compteur < 1)) {


            $form = $this->createForm(OperationType::class, $operation);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $manager->persist($operation);
                $manager->flush();
                $this->addFlash('success', "L'ajout a bien été réalisée");

                return $this->redirectToRoute('liste_operations');
            }

            return $this->render('operation/addOperation.html.twig', [
                'command' => $command,
                'form' => $form->createView(),
            ]);
        } else {
            $this->addFlash('wrong', "Vous ne pouvez pas ajouter d'autres opérations. Vous avez dépassé le nombre autorisé. Veuillez finaliser vos opérations existantes.");
            return $this->redirectToRoute('recapCommand');
        }
    }

    /**
     * @Route("/operation", name="liste_operations")
     */
    public function listeOperations(OperationRepository $repo): Response
    {
        $operations = $repo->findAll();
        $operationsEnCours = $repo->NombreOperationEncours();

        return $this->render('operation/listeOperations.html.twig', [
            'operations' => $operations,
            'operationsEnCours' => $operationsEnCours,
        ]);
    }
}
