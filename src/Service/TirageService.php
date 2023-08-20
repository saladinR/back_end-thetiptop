<?php
// src/Service/TirageService.php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Tickets;
use App\Entity\Gains;
use App\Entity\User;
use DateTime;
use Symfony\Component\Security\Core\Security;

class TirageService
{
    private $em;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    public function validerTicket($numero,$idUser)
    {
        $ticketRepository = $this->em->getRepository(Tickets::class);
        $gainRepository = $this->em->getRepository(Gains::class);
        $userRepository = $this->em->getRepository(User::class);

        $ticket = $ticketRepository->findOneBy(['numero' => $numero, 'utilise' => false]);
        $gainIds = $gainRepository->findAllIds();

        if (!$ticket) {
            return "Ticket invalide ou déjà utilisé.";
        }
        $dateTirage = new \DateTimeImmutable();
        $gainId = $this->choisirGain($gainRepository,$gainIds);
        $gain = $gainRepository->findOneBy(['id' => $gainId]);
        $user = $userRepository->findOneBy(['id' => $idUser]);
        $ticket->setUtilise(true);
        $ticket->setGain($gain);
        $ticket->setCreatedAt($dateTirage);
        $ticket->setClient($user);

        


        $this->em->flush();

        return $gain->getDescription();
    }

    private function choisirGain($gainRepository,$gainIds)
    {
        // Choisissez un index aléatoire du tableau $gainIds
        $randomIndex = array_rand($gainIds);

        // Obtenez l'identifiant de gain réel à partir de cet index
        $randomGainId = $gainIds[$randomIndex]['id'];

        return $randomGainId;
    }
}
