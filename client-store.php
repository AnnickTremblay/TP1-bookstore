<?php
// Si le formulaire n'a pas été envoyé, l'accès direct à la page sera bloqué.
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:client-index.php');
}

require_once('classes/CRUD.php');

$crud = new CRUD;
// Pas besoin de transformer $_POST, insert() attend exactement ce format
// Les name du formulaire deviennent les clés du tableau $_POST
$insert = $crud->insert('client', $_POST);

if($insert) {
    // Le client est ajouté, retour à la liste.
    header('location:client-index.php');
}else{
    header('location:client-create.php');
}