<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\User;
use App\Enum\UserRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $users = [];
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setFirstName('user ' . $i);
            $user->setLastName('user ' . $i);
            $user->setEmail('user' . $i . '@example.com');
            $hashedPassword = $this->passwordHasher->hashPassword($user, 'password' . $i);

            $user->setPassword($hashedPassword);
            $user->setRoles($i > 10 ? UserRole::ROLE_USER : UserRole::ROLE_PRODUCER);
            $user->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($user);
            $users[] = $user;
        }
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName('product ' . $i);
            $product->setUnitPrice(mt_rand(10, 100));
            $product->setStock(mt_rand(1, 50));
            $product->setDescription('Description du produit ' . $i);
            $product->setSeller($users[array_rand($users)]);
            $product->setCreatedAt(new \DateTime());
            $product->setPicture('https://loremflickr.com/320/240?lock=1' . $i);
            $manager->persist($product);
        }

        $manager->flush();
    }
}