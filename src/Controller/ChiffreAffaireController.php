<?php

namespace App\Controller;

use App\Entity\Operation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChiffreAffaireController extends AbstractController
{

    /**
     * @Route("expert/chiffreAffaire", name="app_chiffre_affaire")
     */
    public function index(EntityManagerInterface $entitymanager): Response
    {
        //Recuperer les grosses operations terminees
        $repository = $entitymanager->getRepository(Operation::class);
        $operation = $repository->findOperationTerminee();
        $t = 0;
        foreach ($operation as $key => $value) {
            if ($value->getTypeOperation() == 'GROSSE') {
                $t++;
            }
        };
        $tT = $t; //Ajout du nombre des grosses operations terminées
        $tG = $t ;
        $grosseOp = $t * 10; //Gains potentiels

        //Recuperer les moyennes operations terminees
        $repository = $entitymanager->getRepository(Operation::class);
        $operation = $repository->findOperationTerminee();
        $t = 0;
        foreach ($operation as $key => $value) {
            if ($value->getTypeOperation() == 'MOYENNE') {
                $t++;
            }
        };
        $tT += $t; //Ajout du nombre des moyennes operations terminées
        $tM = $t ;
        $moyenneOp = $t * 2.5; //Gains potentiels

        //Recuperer les petites operations terminees
        $repository = $entitymanager->getRepository(Operation::class);
        $operation = $repository->findOperationTerminee();
        $t = 0;
        foreach ($operation as $key => $value) {
            if ($value->getTypeOperation() == 'PETITE') {
                $t++;
            }
        };

        $tP = $t ;
        $petiteOp = $t ; //Gains potentiels
        $tT += $t; //Ajout du nombre des petites donc Nombre total operations terminées 

        $totalOp = $petiteOp + $moyenneOp + $grosseOp; // Total des gains générés.

        // *** OPERATIONS EN COURS ***

        //Recuperer les grosses operations en cours
        $repository = $entitymanager->getRepository(Operation::class);
        $enCours = $repository->findOperationEncours();
        $ec = 0;
        foreach ($enCours as $key => $value) {
            if ($value->getTypeOperation() == 'GROSSE') {
                $ec++;
            }
        };
        $ecT = $ec; //Ajout du nombre des grosses operations en cours
        $ecG = $ec ;
        $grosseEc = $ec * 10; //Gains potentiels

        //Recuperer les moyennes operations en cours
        $repository = $entitymanager->getRepository(Operation::class);
        $enCours = $repository->findOperationEncours();
        $ec = 0;
        foreach ($enCours as $key => $value) {
            if ($value->getTypeOperation() == 'MOYENNE') {
                $ec++;
            }
        };
        $ecT += $ec; //Ajout du nombre des moyennes operations en cours
        $ecM = $ec ;
        $moyenneEc = $ec * 2.5; //Gains potentiels

        //Recuperer les petites operations en cours
        $repository = $entitymanager->getRepository(Operation::class);
        $enCours = $repository->findOperationEncours();
        $ec = 0;
        foreach ($enCours as $key => $value) {
            if ($value->getTypeOperation() == 'PETITE') {
                $ec++;
            }
        };

        $ecP = $ec ;
        $petiteEc = $ec ; //Gains potentiels
        $ecT += $ec; //Nombre total operations en cours

        $totalEc = $petiteEc + $moyenneEc + $grosseEc; // Total des gains potentiels.


        return $this->render('chiffre_affaire/index.html.twig', [
            'opGrosse' => $grosseOp,
            'opMoyenne' => $moyenneOp,
            'opPetite' => $petiteOp,
            'totalOp' => $totalOp,
            'totalG' => $tG,
            'totalM' => $tM,
            'totalP' => $tP,
            'totalT' => $tT,
            'petiteEc' => $petiteEc,
            'moyenneEc' => $moyenneEc,
            'grosseEc' => $grosseEc,
            'totalEc' => $totalEc,
            'ecGrosse' => $ecG,
            'ecMoyenne' => $ecM,
            'ecPetite' => $ecP,
            'totalC' => $ecT,

        ]
                            );
    }
}
