<?php

namespace App\Controller;

use App\Enum\UserRole;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
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
        // recupe data post
        $data = json_decode($request->getContent(), true);

        // verif no data missing
        if (!isset($data['email']) || !isset($data['password']) || !isset($data['firstName']) || !isset($data['lastName'])) {
            return $this->json([
                'message' => 'Les champs email, password, firstName et LastName sont requis',
            ], 400);
        }
        $plainPassword = $data['password'];
        $role = $data['role'] ?? UserRole::ROLE_USER;


        //def role user
        try {
            $roleEnum = UserRole::from($role);
        } catch (\ValueError $e) {
            $roleEnum = UserRole::ROLE_USER;
        }

        $user = new User();


        $user->setEmail($data['email']);
        $user->setPassword($plainPassword);
        $user->setLastName($data["lastName"]);
        $user->setfirstName($data["firstName"]);
        $user->setRoles($roleEnum);

        $user->setCreatedAt(new \DateTimeImmutable());

        //verif valide data
        $error = $validator->validate($user);
        if (count($error) > 0) {
            $errors = [];
            foreach ($error as $err) {
                $errors[] = $err->getMessage();
            }

            return $this->json([
                'message' => 'Erreur de validation',
                'errors' => $errors,
            ], 400);
        }
        $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);

        $em->persist($user);
        $em->flush();

        return $this->json([
            'message' => 'Compte Créer avec succès',
            'data' => $em->getRepository(User::class)->find($user->getId())
        ], 200);
    }

    #[Route('/auth/login', name: 'green_market_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        return $this->json([
            'message' => 'Connexion réussie',
            'data' => null,
        ], 200);
    }
}
