<?php
// src/Controller/TirageController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Service\TirageService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class TirageController extends AbstractController
{

    private $tirageService;

    public function __construct(TirageService $tirageService)
    {
        $this->tirageService = $tirageService;
    }

    #[Route('/tirage/valide', name: 'tirage_valide', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $numero = $data['numero'] ?? null;

        if (!$numero) {
            return new Response('Numéro manquant', Response::HTTP_BAD_REQUEST);
        }

        $resultat = $this->tirageService->validerTicket($numero);
        return new Response($resultat);
    }
}



