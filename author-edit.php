<?php
// Vérifie qu'un id est passé dans l'URL
if(!isset($_GET['id']) or $_GET['id'] === null) {
    header('location:author-index.php');
    die();
}

$id = $_GET['id'];

require_once('classes/CRUD.php');

$crud = new CRUD;
// Récupère les données actuelles de l'auteur pour préremplir le formulaire
$author = $crud->selectId('author', $id);

if($author) {
    // extract() transforme les clés du tableau en variables ($id, $name, $birthday)
    extract($author);
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
    <title>Author edit</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <form action="author-update.php" method="post">
            <h2>Author edit</h2>
            <!-- Champ caché : l'id sert au WHERE de la requête UPDATE -->
            <input type="hidden" name="id" value="<?= $id; ?>">
            <label>Name
                <input type="text" name="name" value="<?= $name; ?>" required>
            </label>
            <label>Birthday
                <input type="date" name="birthday" value="<?= $birthday; ?>" required>
            </label>
            <input type="submit" class="btn" value="Save">
        </form>
    </main>
</body>
</html>
