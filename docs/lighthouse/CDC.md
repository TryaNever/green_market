# Cahier des charges – Projet Green Market

## 1. Contexte du projet

**Green Market** est un site vitrine e-commerce présentant des produits écologiques et durables.  
L'objectif principal est de proposer une expérience utilisateur claire et agréable tout en respectant les bonnes pratiques en termes d'accessibilité, SEO et performance.

---

## 2. Objectifs

- Présenter les produits de manière claire et attractive.
- Sensibiliser les utilisateurs à une consommation plus durable.
- Offrir une navigation simple et fluide.
- Assurer une compatibilité multi-support (responsive design).
- Optimiser la performance et le SEO.

---

## 3. Périmètre du projet

### Pages principales

1. **Accueil (Home)**

   - Présentation du site et de la philosophie Green Market.
   - Mise en avant des produits phares.
   - Section "Catégories de produits".

2. **Page Produits**

   - Liste complète des produits.
   - Possibilité de filtrer ou rechercher les produits.

3. **Détail Produit**
   - Fiche détaillée du produit (image, titre, description, prix).
   - Affichage de produits similaires.

---

## 4. Fonctionnalités attendues

- **Navigation**
  - Menu principal desktop et mobile (burger menu).
  - Liens internes vers Home, Produits et détails produit.
- **Recherche**
  - Barre de recherche fonctionnelle (NavSearch).
- **Accessibilité**
  - Navigation clavier.
  - Contrastes optimisés.
  - Textes alternatifs pour les images.
  - Utilisation des rôles ARIA pour les menus et messages dynamiques.
- **SEO**
  - Structure HTML sémantique.
  - Titres hiérarchisés (h1, h2, h3…).
  - Optimisation des balises meta (description, titre).
  - URLs propres et lisibles.
- **Performance**
  - Lazy loading pour les images.
  - Optimisation du poids des images.
  - Minification CSS/JS.
  - Score Lighthouse ≥ 80.

---

## 5. Design

- **Sitemap** : plan global du site avec navigation.
- **Wireframes** : maquettes fonctionnelles des pages.
- **Moodboard** : inspiration graphique (couleurs, typographies).
- **Style guide**
  - Couleurs : dégradés roses et verts naturels.
  - Typographies : police principale lisible, titres hiérarchisés.
- **Components UI**
  - Cartes produits (ProductCard).
  - Boutons, liens et formulaires standardisés.

---

## 6. Contraintes techniques

- Framework : **React + Vite**
- CSS : **Tailwind CSS**
- API : [Fake Store API](https://fakestoreapi.com/)
- Déploiement : **Vercel**
- Responsive design mobile-first
- Support navigateurs modernes

---

## 7. Performances et qualité

- Chargement rapide.
- Réduction des requêtes HTTP inutiles.
- Optimisation des images et ressources.
- Mise en cache intelligente.
- Validation Lighthouse pour : FCP, LCP, CLS, TBT.

---

## 8. Livrables

- Code source hébergé sur **GitHub**.
- Déploiement fonctionnel sur **Vercel**.
- **README.md** expliquant le projet.
- **Rapport technique** (explications choix techniques, performance, SEO, accessibilité).
- Maquettes et style guide Figma.

---

## 9. Validation et tests

- Vérification manuelle :
  - Navigation clavier.
  - Compatibilité mobile/desktop.
  - Accessibilité via ARIA et contrastes.
- Vérification des scores Lighthouse.
- Respect des critères ECF :
  - Fonctionnalité
  - Qualité technique
  - Accessibilité et SEO
  - Performance

---

## 10. Conclusion

Ce cahier des charges sert de guide pour le développement et la présentation du projet **Green Market**, garantissant :

- Cohérence avec les besoins utilisateurs
- Respect des standards web (accessibilité, SEO, performance)
- Qualité et lisibilité du code et du design
