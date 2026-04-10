<?php

namespace App\Controller;

use App\Enum\UserRole;
use Doctrine\ORM\EntityManagerInterface;
use Proxies\__CG__\App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api')]
final class AuthController extends AbstractController
{
    #[Route('/auth/register', name: 'green_market_register', methods: ['POST'])]
    public function register(Request $request, ValidatorInterface $validator, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em): JsonResponse
    {

        $data = json_decode($request->getContent(), true);

        if (!isset($data['email']) || !isset($data['password']) || !isset($data['name'])) {
            return $this->json([
                'success' => false,
                'message' => 'Les champs email, password et name sont requis',
                'data' => null,
                'errors' => null,
            ], 400);
        }
        $plainPassword = $data['password'];

        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($plainPassword);
        $user->setName($data['name']);
        $user->setRoles(UserRole::ROLE_USER);
        $user->setCreatedAt(new \DateTimeImmutable());

        $error = $validator->validate($user);
        if (count($error) > 0) {
            $errors = [];
            foreach ($error as $err) {
                $errors[] = $err->getMessage();
            }

            return $this->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'data' => null,
                'errors' => $errors,
            ], 400);
        }
        $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);

        $em->persist($user);
        $em->flush();

        return $this->json([
            'success' => true,
            'message' => 'Compte Créer avec succès',
            'data' => ["email" => "{$user->getEmail()}", "name" => "{$user->getName()}"],
            'errors' => null,
        ], 200);
    }

    #[Route('/auth/login', name: 'green_market_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        return $this->json([
            'success' => true,
            'message' => 'Connexion réussie',
            'data' => null,
            'errors' => null,
        ], 200);
    }
}
