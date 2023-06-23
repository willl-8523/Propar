<?php

namespace App\Controller;

use App\Entity\Operation;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MailsController extends AbstractController
{

    /**
     * @Route("/mail/{id}", name="envoyer_mail")
     */
    public function envoyerMail(Operation $operation, TransportInterface $mailer): Response
    {

        $name_user = $this->getUser()->getNom();
        $prenom_user = $this->getUser()->getPrenom();
        $email_user = $operation->getEmailUser();
        $email_customer = $operation->getEmailCustomer();
        $num_command = $operation->getNumCommand();

        $email = (new Email())
            ->from($email_user)
            ->to($email_customer)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html("<p> Mr name_customer votre commande n°{$num_command} est prête a être expédiée.<br>Cordialement,<br> PROPAR </p>");

        $mailer->send($email);
        $this->addFlash("mailSuccess", "Mail envoyé");
        dump($name_user, $prenom_user);
        dump($operation);
        return $this->redirectToRoute('liste_operations');
    }

}
