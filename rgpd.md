# 🔐 Sécurité & RGPD — Green Market API

---

# 🛡️ Sécurité

## 🔑 Authentification

L’API utilise un système de connexion avec **JWT**.

Après connexion, un token est envoyé au client et doit être utilisé pour accéder aux routes protégées.

Exemple :

```http
Authorization: Bearer <token>
```

---

## 🔒 Protection des routes

Certaines routes sont protégées :

- Produits → uniquement PRODUCER ou ADMIN
- Commandes → utilisateur connecté uniquement
- Suppression → propriétaire ou ADMIN

---

## 🔐 Mots de passe

Les mots de passe sont **hachés** avant d’être stockés en base de données.

Ils ne sont jamais enregistrés en clair.

---

## 🚫 Sécurité générale

- Protection contre les injections SQL (Doctrine ORM)
- API en JSON uniquement (pas de XSS)
- API stateless (pas de session serveur)

# 📜 RGPD

## 📊 Données collectées

L’application stocke uniquement :

- email
- prénom / nom
- mot de passe (haché)
- commandes

---

## 🎯 Utilisation des données

Les données servent uniquement à :

- créer un compte
- se connecter
- gérer les commandes

---

## ⏳ Conservation

- données conservées tant que le compte existe
- suppression possible sur demande

---

## 👤 Accès aux données

Seuls :

- l’utilisateur
- les administrateurs

peuvent accéder aux données.

---

## ❌ Partage

Aucune donnée n’est vendue ou partagée.

---

## 🗑️ Droits utilisateur

Chaque utilisateur peut :

- voir ses données

---
