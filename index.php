<?php
require_once('classes/CRUD.php');

// Récupère les données pour afficher un sommaire du système.
$crud = new CRUD;
$authors = $crud->select('author');
$books = $crud->select('book');
$clients = $crud->select('client');
$sales = $crud->select('sale');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Bookstore</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <h1>Bookstore Management System</h1>
        <p>Manage authors, books, clients and sales.</p>

        <div class="stats">
            <div class="stat-card">
                <span class="stat-number"><?= count($authors) ?></span>
                <span class="stat-label">Authors</span>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?= count($books) ?></span>
                <span class="stat-label">Books</span>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?= count($clients) ?></span>
                <span class="stat-label">Clients</span>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?= count($sales) ?></span>
                <span class="stat-label">Sales</span>
            </div>
        </div>
    </main>
    <footer>
        <p>TP1 — Système de gestion de librairie · Programmation Web avancée (582-31B-MA)</p>
        <p>Annick Tremblay — Session Automne 2026</p>
    </footer>
</body>
</html>