<?php

namespace App\EventListener;
// src/App/EventListener/AuthenticationFailureListener.php
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthenticationSuccessListener
{

    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
//        $data = $event->getData();
//        $response = new JsonResponse();
//
//        // Customize the response data
//        $response->setData([
//            'message' => 'Authentication successful.',
//            'token' => $data['token'],
//            'custom_key' => 'Custom value',
//        ]);
//
//        $event->setResponse($response);
    }
}