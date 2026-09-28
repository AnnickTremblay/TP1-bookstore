# Bookstore

TP1 — Programmation Web avancée (582-31B-MA)  
Annick Tremblay — Collège de Maisonneuve

Système de gestion de librairie en PHP orienté objet avec MySQL.

## Les tables

- `author` — les auteurs
- `book` — les livres, avec une clé étrangère vers `author`
- `client` — les clients
- `sale` — les ventes, qui relient un client et un livre

## Les classes

`CRUD` hérite de PDO et contient les méthodes `select`, `selectId`, `insert`, `update` et `delete`. Elle reste générique, donc aucune requête propre à une table dedans.

`Author`, `Book`, `Client` et `Sale` héritent de `CRUD` et ajoutent leurs propres requêtes (les jointures, le calcul du total d'une vente).

## Les pages

Chaque table a ses pages : `index` pour la liste, `create` et `store` pour ajouter, `edit` et `update` pour modifier, `delete` pour supprimer.
