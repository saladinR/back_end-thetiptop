<?php
// src/Service/TirageService.php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Tickets;
use App\Entity\Gains;

class TirageService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validerTicket($numero)
    {
        $ticketRepository = $this->em->getRepository(Tickets::class);
        $gainRepository = $this->em->getRepository(Gains::class);

        $ticket = $ticketRepository->findOneBy(['numero' => $numero, 'utilise' => false]);

        if (!$ticket) {
            return "Ticket invalide ou déjà utilisé.";
        }

        $gain = $this->choisirGain($gainRepository);
        $ticket->setUtilise(true);
        $ticket->setGain($gain);

        $this->em->flush();

        return $gain->getDescription();
    }

    private function choisirGain($gainRepository)
    {
        $randomValue = mt_rand(1, 100);

        // Utilisez une logique appropriée pour sélectionner un gain en fonction de $randomValue
        // ...

        return $gain;
    }
}
