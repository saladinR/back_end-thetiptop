<?php

namespace App\EventListener;
// src/App/EventListener/AuthenticationFailureListener.php
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User; // Make sure this points to the correct namespace

class AuthenticationSuccessListener
{
   // private $tokenStorage;
    private $jwtManager;
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager, JWTTokenManagerInterface $jwtManager)
    {
       // $this->tokenStorage = $tokenStorage;
        $this->jwtManager = $jwtManager;
        $this->entityManager = $entityManager;
    }
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $response = new JsonResponse();
        //dd($data["token"] );
        $tokenParts = explode(".",$data["token"]);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);


        // Find the user by ID
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findByEmail($jwtPayload->email);
        if (!$user) {
            throw new \RuntimeException('User not found'); // or handle the case as needed
        }
       // dd($user[0]->id);
        // Customize the response data
//        $response->setData([
//            'message' => 'Authentication successful.',
//            'token' => $data['token'],
//            'custom_key' => $user,
//        ]);
        $responseData = [
            'message' => 'Authentication successful.',
            'token' =>$data['token'],
            'user' => $user[0],
        ];

        // Set the custom response data in the event
        $event->setData($responseData);
        //return  $user;

        //$event->setResponse($response);
    }
}