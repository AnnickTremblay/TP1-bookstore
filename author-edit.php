<?php
require_once('includes/nav.php');

// Si le formulaire n'a pas été envoyé, l'accès direct à la page sera bloqué
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:author-index.php');
}

require_once('classes/CRUD.php');

$crud = new CRUD;
// Pas besoin de transformer $_POST, insert() attend exactement ce format
// Les name du formulaire deviennent les clés du tableau $_POST
$insert = $crud->insert('author', $_POST);

if($insert) {
    // $insert contient le nouvel id, il affiche la fiche créée
    header("location:author-show.php?id=$insert");
}else{
    header('location:author-index.php');
}
// Vérifie qu'un id est passé dans l'URL
if(!isset($_GET['id']) or $_GET['id']==null){
    header('location:author-index.php');
    die();
}

$id = $_GET['id'];

require_once('classes/CRUD.php');

$crud = new CRUD;
// Récupère les données actuelles de l'auteur pour préremplir le formulaire

$author = $crud->selectId('author', $id);

if($author){
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
    <title>Author Edit</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="container">
        <?php require_once('includes/nav.php'); ?>
        <div class="container">
            <form action="author-update.php" method="post">
                <h2>Author Edit</h2>
                <!-- Champ caché : l'id sert au WHERE de la requête UPDATE -->
                <input type="hidden" name="id" value="<?= $id; ?>">
                <label>Name
                    <input type="text" name="name" value="<?= $name; ?>">
                </label>
                <label>Birthday
                    <input type="date" name="birthday" value="<?= $birthday; ?>">
                </label>
                <input type="submit" class="btn" value="Save">
            </form>
        </div>
    </main>
</body>
</html>