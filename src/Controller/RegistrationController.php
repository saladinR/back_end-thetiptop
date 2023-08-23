<?php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\AbstractList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegistrationController extends AbstractController
{
    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        //$this->passwordEncoder = $passwordEncoder;
    }

    public function __invoke(Request $request,UserPasswordHasherInterface $passwordEncoder)
    {

        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setEmail($data['email']);

        // Hash the password using UserPasswordHasherInterface
        $hashedPassword = $passwordEncoder->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);

        // Set user roles
        $user->setRoles($data['roles'] ?? ['ROLE_USER']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'User registered successfully'], JsonResponse::HTTP_CREATED);
    }
}