<?php
// Bloque l'accès direct si le formulaire n'a pas été envoyé
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:book-index.php');
}

require_once('classes/CRUD.php');

$crud = new CRUD;
// Les name du formulaire deviennent les clés du tableau $_POST
$insert = $crud->insert('book', $_POST);

if($insert) {
    // $insert contient le nouvel id, il affiche la fiche créée
    header("location:book-show.php?id=$insert");
}else{
    header('location:book-index.php');
}