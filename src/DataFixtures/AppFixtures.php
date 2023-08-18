<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Gains;
use App\Entity\Tickets;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;
    
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création d'un user "normal"
        $user = new User();
        $user->setEmail("user@bookapi.com");
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "password"));
        $manager->persist($user);
        
        // Création d'un user admin
        $userAdmin = new User();
        $userAdmin->setEmail("admin@bookapi.com");
        $userAdmin->setRoles(["ROLE_ADMIN"]);
        $userAdmin->setPassword($this->userPasswordHasher->hashPassword($userAdmin, "password"));
        $manager->persist($userAdmin);

        // Création des gains

        $gain1 = new gains();
        $gain1->setDescription("Infuseur à thé");
        $gain1->setPourcentage(60);
        $gain1->setValeur(0);
        $manager->persist($gain1);


        $gain2 = new gains();
        $gain2->setDescription("Boite de 100g d’un thé détox ou d’infusion");
        $gain2->setPourcentage(20);
        $gain2->setValeur(0);
        $manager->persist($gain2);

        $gain3 = new gains();
        $gain3->setDescription("Boite de 100g d’un thé signature");
        $gain3->setPourcentage(10);
        $gain3->setValeur(0);
        $manager->persist($gain3);

        $gain4 = new gains();
        $gain4->setDescription("Coffret découverte 39€");
        $gain4->setPourcentage(6);
        $gain4->setValeur(39);
        $manager->persist($gain4);

        $gain5 = new gains();
        $gain5->setDescription("Coffret découverte 69€");
        $gain5->setPourcentage(4);
        $gain5->setValeur(69);
        $manager->persist($gain5);


        
        // Création des Tickets

        $ticket = new Tickets();
        $ticket->setNumero("123456789A");
        // $ticket->setClient(60);
        // $ticket->setGain(0);
        $ticket->setUtilise(false);
        $manager->persist($ticket);

        $manager->flush();


    }
}
