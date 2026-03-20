<?php

namespace App\Entity;

use App\Enum\UserRole;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read'])]  // ← ajoutez
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['product:read', 'user:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 254)]
    #[Groups(['user:read'])]
    private ?string $email = null;

    #[ORM\Column(length: 60)]
    private ?string $password = null;

    #[ORM\Column(length: 50, enumType: UserRole::class)]
    #[Groups(['user:read'])]
    private ?UserRole $roles = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): UserRole
    {
        return $this->roles;
    }

    public function setRoles(UserRole $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
