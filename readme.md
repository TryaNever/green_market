# 🌿 Green Market API

Backend Symfony + Docker + Fixtures automatiques

---

# 🚀 Lancement du projet

Le projet est entièrement dockerisé.

### ▶️ Commande unique :

```bash
docker compose up -d --build
```

---

# 🌐 Accès aux services

| Service     | URL                                            |
| ----------- | ---------------------------------------------- |
| Backend API | [http://localhost:8000](http://localhost:8000) |
| Frontend    | [http://localhost:5173](http://localhost:5173) |
| phpMyAdmin  | [http://localhost:8080](http://localhost:8080) |
| mySql       | [http://localhost:3306](http://localhost:3306) |

---

# 🐳 Architecture Docker

Le projet contient :

- Symfony (API backend)
- Frontend (Vite / React)
- MySQL
- phpMyAdmin

---

# 🧪 Fixtures (Données automatiques)

## 📦 Commande exécutée automatiquement :

Les fixtures se lancent via Doctrine et génèrent des données de test.

---

## 👤 Users générés

### 🔹 20 utilisateurs créés automatiquement

- `user0@example.com` → `user19@example.com`
- Password : `password0` → `password19`

---

### 🔹 Rôles

| Index   | Role          |
| ------- | ------------- |
| 0 → 10  | ROLE_PRODUCER |
| 11 → 19 | ROLE_USER     |

---

### 🔹 Exemple User Producer

```json
{
  "firstName": "user 1",
  "lastName": "user 1",
  "email": "user1@example.com",
  "role": "ROLE_PRODUCER"
}
```

---

### 🔹 Exemple User Client

```json
{
  "firstName": "user 15",
  "lastName": "user 15",
  "email": "user15@example.com",
  "role": "ROLE_USER"
}
```

---

## 🛒 Products générés

### 🔹 20 produits créés automatiquement

Chaque produit contient :

- name
- unit price (10 → 100)
- stock (1 → 50)
- description
- image (LoremFlickr)
- seller (user aléatoire)

---

### 🔹 Exemple Product

```json
{
  "name": "product 1",
  "unitPrice": 45,
  "stock": 12,
  "description": "Description du produit 1",
  "picture": "https://loremflickr.com/320/240?lock=11",
  "seller": "user3@example.com"
}
```

---

# 🔐 Comptes de test

## 👤 Producer (création produits)

```text
email: user0@example.com
password: password0
role: ROLE_PRODUCER
```

---

## 👤 User (client)

```text
email: user15@example.com
password: password15
role: ROLE_USER
```

---

# 📦 API Overview

## 🔐 Auth

### POST /api/auth/register

Créer un utilisateur

### POST /api/auth/login

Connexion utilisateur

---

## 🛒 Products

### GET /api/products

Liste des produits (USER authentifié)

### GET /api/products/{id}

Détail produit (USER authentifié)

### POST /api/products

Créer un produit (PRODUCER / ADMIN)

### DELETE /api/products/{id}

Supprimer un produit (OWNER / ADMIN)

---

## 📦 Orders

### GET /api/orders

Liste des commandes (USER authentifié)

### GET /api/orders/{id}

Détail commande (USER authentifié)

### POST /api/orders

Créer une commande (USER authentifié)

---

# ⚙️ Stack technique

- Symfony 6+
- Doctrine ORM
- MySQL
- Docker
- JWT (auth)
- Serializer Symfony
- Fixtures Doctrine

---

# 🧪 Initialisation base de données

Les données sont générées automatiquement par docker via :

```bash
php bin/console doctrine:fixtures:load
```

---

# 🔥 Points importants

- API 100% JSON
- Auth via JWT
- Rôles : USER / PRODUCER / ADMIN
- Produits liés à un seller
- Orders liés à un user
- Données de test incluses

---

# 📌 Notes

Ce projet est prêt à être utilisé immédiatement après :

```bash
docker compose up -d --build
```

Aucune configuration supplémentaire nécessaire.
