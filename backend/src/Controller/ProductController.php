<?php
namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api')]
final class ProductController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private SerializerInterface $serializer
    ) {
    }

    #[Route('/products', name: 'app_product', methods: ['GET'])]
    public function index(): JsonResponse
    {
        try {
            $products = $this->em->getRepository(Product::class)->findAll();

            if (empty($products)) {
                return $this->json([
                    'success' => false,
                    'message' => 'Aucun produit trouvé',
                    'data' => null,
                    'errors' => null,
                ], 404);
            }

            $data = $this->serializer->normalize($products, null, ['groups' => 'product:read']);

            return $this->json([
                'success' => true,
                'message' => 'Produits récupérés avec succès',
                'data' => $data,
                'errors' => null,
            ], 200);

        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des produits',
                'data' => null,
                'errors' => [$e->getMessage()],
            ], 500);
        }
    }

    #[Route('/products/{id}', name: 'app_product_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        try {
            if ($id <= 0) {
                return $this->json([
                    'success' => false,
                    'message' => 'L\'identifiant du produit est invalide',
                    'data' => null,
                    'errors' => null,
                ], 400);
            }

            $product = $this->em->getRepository(Product::class)->find($id);

            if (!$product) {
                return $this->json([
                    'success' => false,
                    'message' => "Aucun produit trouvé avec l'id {$id}",
                    'data' => null,
                    'errors' => null,
                ], 404);
            }

            $data = $this->serializer->normalize($product, null, ['groups' => 'product:read']);

            return $this->json([
                'success' => true,
                'message' => 'Produit récupéré avec succès',
                'data' => $data,
                'errors' => null,
            ], 200);

        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération du produit',
                'data' => null,
                'errors' => [$e->getMessage()],
            ], 500);
        }
    }

    #[Route('/products', name: 'app_product_create', methods: ['POST'])]
    #[IsGranted(new Expression('is_granted("ROLE_ADMIN") or is_granted("ROLE_PRODUCER")'))]
    public function create(Request $request, ValidatorInterface $validator): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            $product = new Product();
            $product->setName($data['name'] ?? '');
            $product->setDescription($data['description'] ?? '');
            $product->setUnitPrice($data['unitPrice'] ?? 0);
            $product->setStock($data['stock'] ?? 0);
            $product->setSeller($this->getUser());
            $product->setCreatedAt(new \DateTime());
            $product->setPicture($data['picture'] ?? null);

            $errors = $validator->validate($product);
            if (count($errors) > 0) {
                $errorsData = [];
                foreach ($errors as $error) {
                    $errorsData[] = $error->getMessage();
                }
                return $this->json([
                    'success' => false,
                    'message' => 'Erreur de validation',
                    'data' => null,
                    'errors' => $errorsData,
                ], 400);
            }

            $this->em->persist($product);
            $this->em->flush();

            return $this->json([
                'success' => true,
                'message' => 'Produit créé avec succès',
                'data' => $this->serializer->normalize($product, null, ['groups' => 'product:read']),
                'errors' => null,
            ], 201);

        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la création du produit',
                'data' => null,
                'errors' => [$e->getMessage()],
            ], 500);
        }
    }

    #[Route('/products/{id}', name: 'app_product_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        try {
            if ($id <= 0) {
                return $this->json([
                    'success' => false,
                    'message' => 'L\'identifiant du produit est invalide',
                    'data' => null,
                    'errors' => null,
                ], 400);
            }

            $product = $this->em->getRepository(Product::class)->find($id);

            if (!$product) {
                return $this->json([
                    'success' => false,
                    'message' => "Aucun produit trouvé avec l'id {$id}",
                    'data' => null,
                    'errors' => null,
                ], 404);
            }

            if (
                !$this->isGranted('ROLE_ADMIN') &&
                (!$this->isGranted('ROLE_PRODUCER') || $product->getSeller() !== $this->getUser())
            ) {
                return $this->json([
                    'success' => false,
                    'message' => 'Accès refusé',
                    'data' => null,
                    'errors' => null,
                ], 403);
            }

            $this->em->remove($product);
            $this->em->flush();

            return $this->json([
                'success' => true,
                'message' => 'Produit supprimé avec succès',
                'data' => null,
                'errors' => null,
            ], 200);

        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression du produit',
                'data' => null,
                'errors' => [$e->getMessage()],
            ], 500);
        }
    }
}