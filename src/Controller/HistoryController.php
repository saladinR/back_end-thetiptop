<?php


namespace App\Controller;

use App\Repository\TicketsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Service\TirageService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Tickets;
use Symfony\Component\HttpFoundation\JsonResponse;



class HistoryController extends AbstractController
{

    #[Route('/tirage/history', name: 'tirage_history', methods: ['POST'])]

    public function __invoke(Request $request,TicketsRepository $ticketRepo,UserRepository $userRepo): Response
    {
        $data = json_decode($request->getContent(), true);
        $idUser = $data['idUser'] ?? null;

        if (!$idUser) {
            return new Response('Numéro manquant', Response::HTTP_BAD_REQUEST);
        }

        $user = $userRepo->findOneBy(['id' => $idUser]);
        $resultat = $ticketRepo->findHistoryByClient($user);

        return new JsonResponse($resultat);
    }
}



