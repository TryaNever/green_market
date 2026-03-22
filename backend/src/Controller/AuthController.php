<?php

namespace App\Controller;

use Proxies\__CG__\App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class AuthController extends AbstractController
{
    #[Route('/auth/register', name: 'green_market_register', methods: ['POST'])]
    public function register(Request $request, ValidatorInterface $validator): JsonResponse
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

        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setName($data['name']);
        $user->setRoles(['ROLE_USER']);

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
        return $this->json([
            'success' => true,
            'message' => 'Compte Créer avec succès',
            'data' => null,
            'errors' => null,
        ], 200);
    }
}
