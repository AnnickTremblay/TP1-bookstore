<?php
// Bloque l'accès direct si le formulaire n'a pas été envoyé
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:author-index.php');
}

require_once('classes/CRUD.php');

$id = $_POST['id'];
$crud = new CRUD;

$delete = $crud->delete('author', $id);

if($delete) {
    header('location:author-index.php');
}else{
    echo "error";
}