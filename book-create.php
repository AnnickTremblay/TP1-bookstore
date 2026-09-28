<?php
require_once('classes/CRUD.php');

// Va chercher tous les auteurs pour remplir la liste déroulante.
$crud = new CRUD;
$authors = $crud->select('author');

// Si un auteur est passé dans l'URL, il sera présélectionné dans la liste.
$selected = 0;
if(isset($_GET['author_id'])) {
    $selected = $_GET['author_id'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Book create</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <form action="book-store.php" method="POST">
            <h2>New book</h2>
            <label>Title
                <input type="text" name="title" required>
            </label>
            <label>Isbn
                <input type="text" name="isbn" pattern="[0-9]{13}" maxlength="13" title="13 chiffres sans tirets" required>
            </label>
            <label>Description
                <textarea name="description"></textarea>
            </label>
            <label>Price
                <input type="number" step="0.01" name="price" required>
            </label>
            <label>Author
                <select name="author_id">
                    <?php foreach($authors as $author) {
                    ?>
                        <option value="<?= $author['id'] ?>"
                            <?php if($author['id'] == $selected) { echo 'selected'; } ?>
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