<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\User;
use App\Enum\OrderStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

#[Route("/api")]
final class OrderController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private SerializerInterface $serializer
    ) {
    }
    #[Route('/order', name: 'app_order', methods: ['GET'])]
    public function index(): JsonResponse
    {
        try {
            $orders = $this->em->getRepository(Order::class)->findAllWithItem();

            if (empty($orders)) {
                return $this->json([
                    'success' => false,
                    'message' => 'Aucune commande trouvé',
                    'data' => null,
                    'errors' => null,
                ], 404);
            }

            $data = $this->serializer->normalize($orders, null, ['groups' => 'order:read']);

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


    #[Route('/order/{id}', name: 'app_order_show', methods: ['GET'])]
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

            $orders = $this->em->getRepository(Order::class)->findWithItems($id);

            if (!$orders) {
                return $this->json([
                    'success' => false,
                    'message' => "Aucune commandes trouvé avec l'id {$id}",
                    'data' => null,
                    'errors' => null,
                ], 404);
            }

            if (
                !$this->isGranted('ROLE_ADMIN') &&
                (!$this->isGranted('ROLE_USER') || $orders->getUser() !== $this->getUser())
            ) {
                return $this->json([
                    'success' => false,
                    'message' => 'Accès refusé',
                    'data' => null,
                    'errors' => null,
                ], 403);
            }


            $data = $this->serializer->normalize($orders, null, ['groups' => 'order:read']);

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

    #[Route('/order', name: 'app_order_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['userId'], $data['items'])) {
            return $this->json([
                'success' => false,
                'message' => 'Invalid payload',
            ], 400);
        }

        // Verif exist user

        $user = $this->em->getRepository(User::class)->find($data['userId']);

        if (!$user) {
            return $this->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        // init order

        $order = new Order();
        $order->setUser($user);
        $order->setStatus(OrderStatus::Preparation);
        $order->setCreatedAt(new \DateTimeImmutable());

        $totalPrice = 0.0;

        // order item

        foreach ($data['items'] as $value) {

            if (!isset($value['productId'], $value['quantity'])) {
                return $this->json([
                    'success' => false,
                    'message' => 'Invalid item format',
                ], 400);
            }

            $product = $this->em->getRepository(Product::class)->find($value['productId']);

            // verif value order item

            if (!$product) {
                return $this->json([
                    'success' => false,
                    'message' => 'Product not found',
                ], 404);
            }

            $qty = (int) $value['quantity'];

            if ($qty <= 0) {
                return $this->json([
                    'success' => false,
                    'message' => 'Invalid quantity',
                ], 400);
            }

            $orderItem = new OrderItem();
            $orderItem->setProduct($product);
            $orderItem->setQuantity($qty);
            $orderItem->setPriceUnit((string) $product->getUnitPrice());

            $totalItem = $product->getUnitPrice() * $qty;
            $orderItem->setTotalPrice((string) $totalItem);

            $order->addOrderItem($orderItem);

            $totalPrice += $totalItem;
        }

        $order->setTotalPrice((string) $totalPrice);

        try {
            $this->em->persist($order);
            $this->em->flush();
        } catch (\Throwable $e) {
            return $this->json([
                'success' => false,
                'message' => 'Error while saving order',
            ], 500);
        }

        return $this->json([
            'success' => true,
            'message' => 'Order created',
            'data' => $product = $this->em->getRepository(Order::class)->find($order->getId()),
        ], 201);
    }

}