<?php
// Vérifie qu'un id est passé dans l'URL
if(!isset($_GET['id']) or $_GET['id'] === null) {
    header('location:author-index.php');
    die();
}

$id = $_GET['id'];

require_once('classes/Author.php');

$authorObj = new Author;

// Récupère l'enregistrement
$authorData = $authorObj->selectId('author', $id);
// Récupère les livres de cet auteur
$books = $authorObj->selectBooks($id);

if($authorData) {
    // extract() transforme les clés du tableau en variables ($id, $name, $birthday)
    extract($authorData);
}else{
    header('location:author-index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Author show</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <h1>Author show</h1>
        <div class="fiche">
            <p><strong>Name: </strong><?= $name; ?></p>
            <p><strong>Birthday: </strong><?= $birthday; ?></p>
        </div>

        <h2>Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Isbn</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($books as $book) {
                ?>
                    <tr>
                        <td><a href="book-show.php?id=<?= $book['id'] ?>"><?= $book['title'] ?></a></td>
                        <td><?= $book['isbn'] ?></td>
                        <td><?= $book['price'] ?> $</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="actions">
            <a href="author-edit.php?id=<?= $id; ?>" class="btn">Edit</a>
            <a href="book-create.php?author_id=<?= $id; ?>" class="btn">New book</a>
            <form action="author-delete.php" method="post">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="submit" value="Delete" class="btn red">
            </form>
            <a href="author-index.php" class="btn outline">Back</a>
        </div>
    </main>
</body>
</html>