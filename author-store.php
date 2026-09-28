<?php
// Si le formulaire n'a pas été envoyé, l'accès direct à la page sera bloqué.
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