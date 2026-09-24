<?php
require_once('classes/CRUD.php');

// Va chercher les clients et les livres pour remplir les listes déroulantes.
$crud = new CRUD;
$clients = $crud->select('client');
$books = $crud->select('book');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Sale create</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <form action="sale-store.php" method="POST">
            <h2>New sale</h2>
            <label>Client
                <select name="client_id">
                    <?php foreach($clients as $client) {
                    ?>
                        <option value="<?= $client['id'] ?>"><?= $client['name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </label>
            <label>Book
                <select name="book_id">
                    <?php foreach($books as $book) {
                    ?>
                        <option value="<?= $book['id'] ?>"><?= $book['title'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </label>
            <label>Quantity
                <input type="number" name="quantity" value="1" required>
            </label>
            <label>Unit price
                <input type="number" step="0.01" name="unit_price" required>
            </label>
            <label>Date
                <input type="date" name="sold_date" required>
            </label>
            <input type="submit" class="btn" value="Save">
        </form>
    </main>
</body>
</html>