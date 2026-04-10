<?php
namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
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
        $products = $this->em->getRepository(Product::class)->findAll();

        $data = $this->serializer->normalize($products, null, ['groups' => 'product:read']);

        return $this->json([
            'success' => true,
            'message' => 'Produits récupérés avec succès',
            'data' => $data,
            'errors' => null,
        ], 200);
    }

    #[Route('/products/{id}', name: 'app_product_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $product = $this->em->getRepository(Product::class)->find($id);

        $data = $this->serializer->normalize($product, null, ['groups' => 'product:read']);

        return $this->json([
            'success' => true,
            'message' => 'Produit récupéré avec succès',
            'data' => $data,
            'errors' => null,
        ], 200);
    }

}