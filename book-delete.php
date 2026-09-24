<?php
// Bloque l'accès direct si le formulaire n'a pas été envoyé
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:book-index.php');
}

require_once('classes/CRUD.php');

$id = $_POST['id'];
$crud = new CRUD;

$delete = $crud->delete('book', $id);

if($delete) {
    header('location:book-index.php');
}else{
    echo "error";
}