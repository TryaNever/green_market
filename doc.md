# Green Market API

## 🔐 Auth

### POST /api/auth/register

Body:

```json
{
  "firstname": "Alice",
  "lastname": "Martin",
  "email": "alice@example.com",
  "password": "Password123!",
  "role": "client"
}
```

Response:

```json
{
  "id": 1,
  "firstname": "Alice",
  "lastname": "Martin",
  "email": "alice@example.com",
  "role": "client"
}
```

---

### POST /api/auth/login

Body:

```json
{
  "email": "alice@example.com",
  "password": "Password123!"
}
```

Response:

```json
{
  "token": "jwt_token_here",
  "user": {
    "id": 1,
    "firstname": "Alice",
    "lastname": "Martin",
    "email": "alice@example.com",
    "role": "client"
  }
}
```

---

## 👤 Users

### GET /api/users

Response:

```json
[
  {
    "id": 1,
    "firstname": "Alice",
    "lastname": "Martin",
    "email": "alice@example.com",
    "role": "client"
  }
]
```

---

### GET /api/users/{id}

Response:

```json
{
  "id": 1,
  "firstname": "Alice",
  "lastname": "Martin",
  "email": "alice@example.com",
  "role": "client"
}
```

---

## 🛒 Products

### GET /api/products

Response:

```json
[
  {
    "id": 1,
    "title": "Tomates bio",
    "price": 3.5,
    "description": "Tomates bio produites localement",
    "category": "vegetables",
    "image": "https://example.com/images/tomates.jpg",
    "rating": {
      "rate": 4.5,
      "count": 12
    }
  }
]
```

---

### GET /api/products/{id}

Response:

```json
{
  "id": 1,
  "title": "Tomates bio",
  "price": 3.5,
  "description": "Tomates bio produites localement",
  "category": "vegetables",
  "image": "https://example.com/images/tomates.jpg",
  "rating": {
    "rate": 4.5,
    "count": 12
  }
}
```

---

### POST /api/products

Body:

```json
{
  "title": "Tomates bio",
  "price": 3.5,
  "description": "Tomates bio produites localement",
  "category": "vegetables",
  "image": "https://example.com/images/tomates.jpg"
}
```

Response:

```json
{
  "id": 2,
  "title": "Tomates bio",
  "price": 3.5,
  "description": "Tomates bio produites localement",
  "category": "vegetables",
  "image": "https://example.com/images/tomates.jpg",
  "rating": {
    "rate": 0,
    "count": 0
  }
}
```

---

### DELETE /api/products/{id}

Response:

```json
{
  "message": "Produit supprimé avec succès"
}
```

---

## 📦 Orders

### GET /api/orders

Response:

```json
[
  {
    "id": 1,
    "userId": 1,
    "date": "2026-04-20",
    "products": [
      {
        "productId": 1,
        "quantity": 2
      }
    ],
    "total": 7.0
  }
]
```

---

### GET /api/orders/{id}

Response:

```json
{
  "id": 1,
  "userId": 1,
  "date": "2026-04-20",
  "products": [
    {
      "productId": 1,
      "quantity": 2
    }
  ],
  "total": 7.0
}
```

---

### POST /api/orders

Body:

```json
{
  "products": [
    {
      "productId": 1,
      "quantity": 2
    }
  ]
}
```

Response:

```json
{
  "id": 2,
  "userId": 1,
  "date": "2026-04-20",
  "products": [
    {
      "productId": 1,
      "quantity": 2
    }
  ],
  "total": 7.0
}
```

---

## ❌ Errors

```json
{
  "error": "Message d'erreur"
}
```

---

## 🔐 Auth

Header:

```
Authorization: Bearer <token>
```
