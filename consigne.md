# 📦 RÉCAP PROJET ECF2 — VERSION SIMPLE

## 🎯 Objectif

Créer une API back-end avec :

- utilisateurs
- produits
- commandes
- sécurité (JWT + rôles)

---

# 🧱 1 — BASE DE DONNÉES (VERSION SIMPLE)

## Tables à créer

### 👤 users

- id
- name
- email (unique)
- password (hashé)
- role (admin | producer | client)
- created_at

### 📦 products

- id
- name
- description
- price (> 0)
- stock (≥ 0)
- picture
- user_id (producteur)
- created_at

### 🧾 orders

- id
- user_id (client)
- total_price (calculé serveur)
- status
- created_at

### 🧩 order_items

- id
- order_id
- product_id
- quantity (> 0)
- unit_price

---

## Relations (à retenir simple)

- 1 user → plusieurs produits
- 1 user → plusieurs commandes
- 1 commande → plusieurs lignes (order_items)

---

# 🔌 2 — API REST

## Auth

- POST `/api/auth/register`
- POST `/api/auth/login`

## Users

- GET `/api/users`
- GET `/api/users/:id`

## Products

- GET `/api/products`
- GET `/api/products/:id`
- POST `/api/products` (producer seulement)

## Orders

- GET `/api/orders`
- GET `/api/orders/:id`
- POST `/api/orders`

---

# ⚙️ 3 — RÈGLES IMPORTANTES

## Utilisateur

- email unique
- password hashé
- role = client par défaut

## Produit

- seulement producer peut créer
- price > 0
- stock ≥ 0

## Commande

- au moins 1 produit
- quantity > 0
- total_price calculé côté serveur ❗

---

# 🔐 4 — SÉCURITÉ

À faire :

- bcrypt → hash password
- JWT → login
- middleware auth
- middleware rôle

---

# ✅ 5 — VALIDATION

Toujours vérifier :

- email valide
- champs obligatoires
- prix correct
- quantité correcte

---

# 📘 6 — DOCUMENTATION

README avec :

- comment lancer le projet
- routes API
- sécurité

---

# 📂 7 — LIVRABLES

- code API
- base de données (SQL)
- données test
- README
- doc API
