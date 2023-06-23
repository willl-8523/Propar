<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class SecurityController extends AbstractController
{
    /**
     * @Route("/expert/edit/{id}", name="edit_user")
     * @Route("/expert/inscription", name="security_registration")
     */
    public function registration(User $user = null, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $encoder)
    {
        if (!$user) {
            # code...
            // Crée un ux vide
            $user = new User();      
        }

        // Génère le form en fction du form crée dans src/Form/RegistrationType
        // et donne ces valeurs à User
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            
            $siUser = $user->getId() !== null;

           // Hache le mdp 
            $hash = $encoder->hashPassword($user, $user->getPassword());

            // Modif mdp user avec mdp haché
            $user->setPassword($hash);
            
            $manager->persist($user);
            $manager->flush();
            $this->addFlash("success", ($siUser) ?  "La modification bien a été effectuée": "L'ajout a été éffectué"); // Se rassurer de l'afficher au template

            return $this->redirectToRoute('employes');
            // return $this->render('security/login.html.twig');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
            'isModif' => $user->getId() !== null,
        ]);
    }

    /**
     * @Route("/expert/supp_employe/{id}", name="supp_employe")
     */
    public function suppression(User $user, Request $request, EntityManagerInterface $manager): Response{

        // Securiser l'envoi de suppression d'un aliment
        if ($this->isCsrfTokenValid("SUP". $user->getId(), $request->get('_token'))) {
            $manager->remove($user);
            $manager->flush();
            $this->addFlash("success", "La suppression a été éffectuée");
            return $this->redirectToRoute("employes");
        }
    }

    /**
     * @Route("/connexion", name="security_login")
     */
     public function login(AuthenticationUtils $authenticationUtils, UserRepository $repo)
    {

        if ($this->getUser()) {
            // dump($this->getUser()->getRoles()[0]);
            return $this->redirectToRoute('dashboard');
        }
        
        // recuperer l'erreur de login
        $error = $authenticationUtils->getLastAuthenticationError();

        // recuperer le login
        $email = $authenticationUtils->getLastUsername(); 

        return $this->render('security/login.html.twig', ['email' => $email, 'error' => $error]);
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout()
    {
        return $this->render('blog/expert.html.twig'); 
    }

}