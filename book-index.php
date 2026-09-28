<?php
require_once('classes/Book.php');

// Crée l'objet Book qui ouvre la connexion à la base de données.
$bookObj = new Book;
// Récupère tous les livres avec le nom de leur auteur.
$books = $bookObj->selectWithAuthor();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Books</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <div class="page-header">
            <h1>Books</h1>
            <a href="book-create.php" class="btn">New book</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Isbn</th>
                    <th>Price</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($books as $book) {
                ?>
                    <tr>
                        <td><?= $book['id'] ?></td>
                        <td><a href="book-show.php?id=<?= $book['id'] ?>"><?= $book['title'] ?></a></td>
                        <td><?= $book['isbn'] ?></td>
                        <td><?= $book['price'] ?> $</td>
                        <td><?= $book['author_name'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>