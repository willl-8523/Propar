<?php

namespace App\DataFixtures;

use App\Entity\Command;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CommandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $c1 = new Command();
        $c1->setNameCustomer("Badiashile")
            ->setEmailCustomer("yves@gmail.com")
            ->setDescription("Decription de la commande de Yves")
            ->setPrenomCustomer("yves")
            ->setAdress('1 rue du lexembourd Roubaix');
        $manager->persist($c1);

        $c2 = new Command();
        $c2->setNameCustomer("Atangana")
            ->setEmailCustomer("martial@gmail.com")
            ->setDescription("Decription de la commande de Martial")
            ->setPrenomCustomer("martial")
            ->setAdress('150 rue du lexembourd Roubaix');
        $manager->persist($c2);

        $c3 = new Command();
        $c3->setNameCustomer("Mbida")
            ->setEmailCustomer("joseph@gmail.com")
            ->setDescription("Decription de la commande de Joseph")
            ->setPrenomCustomer("joseph")
            ->setAdress('3 avenue francois mitterrand Arques');
        $manager->persist($c3);

        $manager->flush();
    }
}
