<?php
// Si le formulaire n'a pas été envoyé, l'accès direct à la page sera bloqué.
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:sale-index.php');
}

require_once('classes/CRUD.php');

$crud = new CRUD;
// Pas besoin de transformer $_POST, insert() attend ce format.
// Les name du formulaire deviennent les clés du tableau $_POST.
$insert = $crud->insert('sale', $_POST);

if($insert) {
    // La vente est ajoutée, retour à la liste.
    header('location:sale-index.php');
}else{
    header('location:sale-create.php');
}