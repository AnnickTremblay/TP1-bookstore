<?php
// Bloque l'accès direct si le formulaire n'a pas été envoyé
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header("location:author-index.php");
}

require_once("classes/CRUD.php");

$crud = new CRUD;
// $_POST contient aussi le champ hidden id, qui sert au WHERE
$update = $crud->update('author', $_POST);

if($update){
    // update() retourne true ou false, l'id vient de $_POST
    return header('location:author-show.php?id='.$_POST['id']);
}else{
    echo "Page 404!";
}