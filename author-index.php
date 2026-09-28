<?php
require_once('classes/Author.php');

// Crée l'objet Author qui ouvre la connexion à la base de données.
$authorObj = new Author;
// Récupère tous les auteurs avec le nombre de livres qu'ils ont écrits.
$authors = $authorObj->selectWithBookCount();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Authors</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <div class="page-header">
            <h1>Authors</h1>
            <a href="author-create.php" class="btn">New author</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Birthday</th>
                    <th>Books</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($authors as $author) {
                ?>
                    <tr>
                        <td><?= $author['id'] ?></td>
                        <td><a href="author-show.php?id=<?= $author['id'] ?>"><?= $author['name'] ?></a></td>
                        <td><?= $author['birthday'] ?></td>
                        <td><?= $author['book_count'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>