<?php
// Vérifie qu'un id est passé dans l'URL
if(!isset($_GET['id']) or $_GET['id'] === null) {
    header('location:book-index.php');
    die();
}

$id = $_GET['id'];

require_once('classes/CRUD.php');

$crud = new CRUD;

// Récupère les données actuelles du livre pour préremplir le formulaire
$book = $crud->selectId('book', $id);
// Va chercher tous les auteurs pour remplir la liste déroulante
$authors = $crud->select('author');

if($book) {
    // extract() transforme les clés du tableau en variables ($id, $title, $isbn, $description, $price, $author_id)
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
    <title>Book edit</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <form action="book-update.php" method="post">
            <h2>Book edit</h2>
            <!-- Champ caché : l'id sert au WHERE de la requête UPDATE -->
            <input type="hidden" name="id" value="<?= $id; ?>">
            <label>Title
                <input type="text" name="title" value="<?= $title; ?>" required>
            </label>
            <label>Isbn
                <input type="text" name="isbn" value="<?= $isbn; ?>" pattern="[0-9]{13}" maxlength="13" title="13 chiffres sans tirets" required>
            </label>
            <label>Description
                <textarea name="description"><?= $description; ?></textarea>
            </label>
            <label>Price
                <input type="number" step="0.01" name="price" value="<?= $price; ?>" required>
            </label>
            <label>Author
                <select name="author_id">
                    <?php foreach($authors as $author) {
                    ?>
                        <option value="<?= $author['id'] ?>"
                            <?php if($author['id'] == $author_id) { echo 'selected'; } ?>
                        ><?= $author['name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </label>
            <input type="submit" class="btn" value="Save">
        </form>
    </main>
</body>
</html>