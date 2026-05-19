<?php
namespace App\Controller;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Enum\OrderStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route("/api")]
final class OrderController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private SerializerInterface $serializer
    ) {
    }
    #[Route('/orders', name: 'app_order', methods: ['GET'])]
    public function index(): JsonResponse
    {
        try {
            $orders = $this->em->getRepository(Order::class)->findAllWithItem();

            if (empty($orders)) {
                return $this->json([
                    'message' => 'Aucune commande trouvé',
                ], 404);
            }

            $data = $this->serializer->normalize($orders, null, ['groups' => 'order:read']);

            return $this->json([
                'message' => 'Produits récupérés avec succès',
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            return $this->json([
                'message' => 'Une erreur est survenue lors de la récupération des produits',
                'errors' => [$e->getMessage()],
            ], 500);
        }
    }


    #[Route('/orders/{id}', name: 'app_order_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        try {
            if ($id <= 0) {
                return $this->json([
                    'message' => 'L\'identifiant du produit est invalide',
                ], 400);
            }

            $orders = $this->em->getRepository(Order::class)->findWithItems($id);

            if (!$orders) {
                return $this->json([
                    'message' => "Aucune commandes trouvé avec l'id {$id}",
                ], 404);
            }

            if (
                !$this->isGranted('ROLE_ADMIN') &&
                (!$this->isGranted('ROLE_USER') || $orders->getUser() !== $this->getUser())
            ) {
                return $this->json([
                    'message' => 'Accès refusé',
                ], 403);
            }


            $data = $this->serializer->normalize($orders, null, ['groups' => 'order:read']);

            return $this->json([
                'message' => 'Produit récupéré avec succès',
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            return $this->json([
                'message' => 'Une erreur est survenue lors de la récupération du produit',
                'errors' => [$e->getMessage()],
            ], 500);
        }


    }

    #[Route('/orders', name: 'app_order_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        try {

            $data = json_decode($request->getContent(), true);

            // error to patch

            // if (!$data || $data['items']) {
            //     return $this->json([
            //         'message' => 'Mauvaise donnée récu',
            //     ], 400);
            // }

            // Verif exist user

            $user = $this->getUser();

            if (!$user) {
                return $this->json([
                    'message' => 'Utilisateur introuvable',
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

                if (
                    !$data ||
                    !isset($data['items']) ||
                    empty($data['items'])
                ) {
                    return $this->json([
                        'message' => 'Mauvaise donnée reçue',
                    ], 400);
                }

                $product = $this->em->getRepository(Product::class)->find($value['productId']);

                // verif value order item

                if (!$product) {
                    return $this->json([
                        'message' => 'produit inexistant',
                    ], 404);
                }

                $qty = (int) $value['quantity'];

                if ($qty <= 0) {
                    return $this->json([
                        'message' => 'La quantité ne peut pas être négative ou nulle',
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

            $this->em->persist($order);
            $this->em->flush();
            return $this->json([
                'id' => $order->getId(),
                'user_id' => $order->getUser()->getId(),
                'date' => $order->getCreatedAt()->format('Y-m-d'),
                'products' => array_map(fn($item) => [
                    'product_id' => $item->getProduct()->getId(),
                    'quantity' => $item->getQuantity(),
                ], $order->getOrderItems()->toArray()),
                'total' => (float) $order->getTotalPrice()
            ], 201);
        } catch (\Throwable $e) {
            return $this->json([
                'message' => "Error pendant l'enregistremant de la commande",
            ], 500);
        }


    }

}