<?php
// Vérifie qu'un id est passé dans l'URL
if(!isset($_GET['id']) or $_GET['id'] === null) {
    header('location:book-index.php');
    die();
}

$id = $_GET['id'];

require_once('classes/Book.php');

$bookObj = new Book;

// Récupère le livre avec le nom de son auteur
$book = $bookObj->selectIdWithAuthor($id);

if($book) {
    // extract() transforme les clés du tableau en variables ($id, $title, $isbn, $description, $price, $author_id, $author_name)
    extract($book);
}else{
    header('location:book-index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Book show</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <h1>Book show</h1>
        <div class="fiche">
            <p><strong>Title: </strong><?= $title; ?></p>
            <p><strong>Author: </strong><?= $author_name; ?></p>
            <p><strong>Isbn: </strong><?= $isbn; ?></p>
            <p><strong>Description: </strong><?= $description; ?></p>
            <p><strong>Price: </strong><?= $price; ?> $</p>
        </div>
        <div class="actions">
            <a href="book-edit.php?id=<?= $id; ?>" class="btn">Edit</a>
            <form action="book-delete.php" method="post">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="submit" value="Delete" class="btn red">
            </form>
            <a href="book-index.php" class="btn outline">Back</a>
        </div>
    </main>
</body>
</html>