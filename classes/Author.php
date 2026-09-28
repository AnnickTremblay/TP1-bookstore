<?php
require_once('CRUD.php');

// Classe qui représente la table author.
// Hérite de CRUD, hérite donc de select, selectId, insert, update et delete.
class Author extends CRUD {
    // Propriétés de l'auteur
    public string $name;
    public string $birthday;

    // Remplit les propriétés de l'objet dès qu'il est créé.
    public function __construct($name = '', $birthday = '') {
        // Appelle le constructeur de CRUD pour ouvrir la connexion
        parent::__construct();
        $this->name = $name;
        $this->birthday = $birthday;
    }

    // Retourne tous les auteurs avec le nombre de livres qu'ils ont écrits.
    public function selectWithBookCount():array {
        // author.* -> toutes les colonnes de la table author
        $sql = "SELECT author.*, COUNT(book.id) AS book_count
            FROM author
            LEFT JOIN book ON book.author_id = author.id
            GROUP BY author.id
            ORDER BY author.name ASC";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    // Retourne tous les livres écrits par un auteur.
    public function selectBooks(int $authorId):array {
        $sql = "SELECT * FROM book WHERE author_id = :author_id ORDER BY title ASC";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':author_id', $authorId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}