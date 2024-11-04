<?php

namespace App\Controller;

use App\Entity\Groupeuser;
use App\Entity\UserGroupeuser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; 

class LoginController extends AbstractController
{


    private $userManager;

    public function __construct(EntityManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }


    #[Route('/reg', name: 'reg_app')]
    public function createUser(UserPasswordHasherInterface $passwordHasher): Response
    {
        // Create a new user instance
        $user = new User();

        // Set the user's properties
        $user->setUsername('islem');

        $user->setEmail('newusddderd1@example.com');

        $hashedPassword = $passwordHasher->hashPassword($user, '123456789');
        $user->setPassword($hashedPassword);
        $user->setEnabled(true);







        // Assign roles
        $user->setRoles(['ROLE_ADMIN']);

       

        $this->userManager->persist($user);
        $this->userManager->flush();



        return new Response('User created successfully!');
    }
}
