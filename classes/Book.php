<?php
require_once('CRUD.php');

// Classe qui représente la table book.
// Elle hérite de CRUD, elle hérite donc de select, selectId, insert, update et delete.
// L'héritage —> Book récupère les cinq méthodes
class Book extends CRUD {
    // Propriétés du livre
    public string $title;
    public string $isbn;
    public float $price;

    // Remplit les propriétés de l'objet dès qu'il est créé.
    public function __construct($title = '', $isbn = '', $price = 0) {
        // Appelle le constructeur de CRUD pour ouvrir la connexion
        parent::__construct();
        $this->title = $title;
        $this->isbn = $isbn;
        $this->price = $price;
    }

    // Retourne tous les livres avec le nom de l'auteur (table author).
    public function selectWithAuthor():array {
        // book.* -> toutes les colonnes de la table book
        $sql = "SELECT book.*, author.name AS author_name
                FROM book
                INNER JOIN author ON book.author_id = author.id
                ORDER BY book.title ASC";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    // Retourne un livre avec le nom de son auteur.
    public function selectIdWithAuthor(int $id):bool|array {
        $sql = "SELECT book.*, author.name AS author_name
                FROM book
                INNER JOIN author ON book.author_id = author.id
                WHERE book.id = :id";
        // Requête préparée = protection injection SQL
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}