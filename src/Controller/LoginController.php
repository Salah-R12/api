<?php
namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class LoginController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $requestData = json_decode($request->getContent(), true);
        $user = $userRepository->findOneByEmail($requestData['email']);
        if (!$user || !$passwordHasher->isPasswordValid($user, $requestData['password'])) {
            return $this->json(['message' => 'Email or password is incorrect'], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'email' => $requestData['email'],
            'message' => 'Login successful',
        ]);
    }

    #[Route('/api/check-email', name: 'check_email', methods: ['GET'])]
    public function checkEmail(Request $request, UserRepository $userRepository): Response
    {
        $email = $request->query->get('email');
        if (!$email) {
            throw new HttpException(400, 'Email parameter is missing.');
        }

        $user = $userRepository->findOneBy(['email' => $email]);
        $exists = $user ? true : false;

        return $this->json([
            'email' => $email,
            'exists' => $exists,
        ]);
    }
}
