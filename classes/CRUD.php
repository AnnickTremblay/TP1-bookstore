<?php
// Classe générique qui gère les opérations de la base de données.
// Elle hérite de PDO, ainsi elle garde toutes ses méthodes.
class CRUD extends PDO {

    // Le constructeur ouvre la connexion aussitôt que l'objet CRUD est créé.
    public function __construct() {
        // Appelle la méthode de la classe parent.
        parent::__construct('mysql:host=localhost; dbname=bookstore; port=3306; charset=utf8', 'root', 'Admin');
    }

    // Retourne TOUS les enregistrements d'une table
    // $field et $order servent a trier le resultat
    public function select(string $table, $field = "id", $order = "ASC"):array {
        $sql = "SELECT * FROM $table ORDER BY $field $order";
        $stmt = $this->query($sql);
        // Retourne un tableau 2D (toutes les lignes)
        return $stmt->fetchAll();
    }

    // Retourne UN SEUL enregistrement à partir de sa clé primaire.
    public function selectId(string $table, int|string $value, $field = 'id'):bool|array {
        // Avec $table = 'author' et $field = 'id', la requête devient :
        // SELECT * FROM author WHERE id = :id
        $sql = "SELECT * FROM $table WHERE $field = :$field";
        // Requête préparée = protection injection SQL.
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();

        $count = $stmt->rowCount();
        // Vérification qu'il y a bien 1 seule ligne.
        if($count === 1) {
            // Retourne un tableau 1D (une seule ligne)
            return $stmt->fetch();
        }else{
            return false;
        }
    }

    // Ajoute un enregistrement. $data = tableau associatif
    // Les clés se doivent d'avoir le même nom que les colonnes.
    public function insert(string $table, array $data):bool|int {
        // Liste des colonnes : name, birthday
        $fieldName = implode(', ', array_keys($data));
        // Liste des paramètres : :name, :birthday
        $fieldBindValue = ":".implode(', :', array_keys($data));
        // INSERT INTO author(name, birthday) VALUES (:name, :birthday)
        $sql = "INSERT INTO $table ($fieldName) VALUES ($fieldBindValue)";
        $stmt = $this->prepare($sql);

        foreach($data as $key=>$value) {
            $stmt->bindValue(":$key", $value);
        }
        if($stmt->execute()) {
            // Retourne le nouvel id de l'enregistrement
            return $this->lastInsertId();
        }else{
            return false;
        }
    }

    // Modifie un enregistrement existant.
    // L'id doit se trouver dans $data car il alimente le WHERE.
    public function update(string $table, array $data, $field = 'id'):bool {
        // Construit la partie SET : <colonne> = :<colonne>, ...
        $fieldName = null;
        foreach($data as $key=>$value) {
            $fieldName .= "$key = :$key, ";
        }
        // Enlève la virgule et l'espace à la fin.
        $fieldName = rtrim($fieldName, ', ');

        // UPDATE <table> SET <colonne> = :<colonne>, ... WHERE id = :id
        $sql = "UPDATE $table SET $fieldName WHERE $field = :$field;";
        $stmt = $this->prepare($sql);

        foreach($data as $key=>$value) {
            // Relie chaque valeur à son paramètre
            $stmt->bindValue(":$key", $value);
        }
        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }

    // Supprime un enregistrement selon sa clé primaire.
    public function delete(string $table, int|string $value, $field = 'id'):bool {
        // La table est effacée si pas de WHERE
        $sql = "DELETE FROM $table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);

        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }
}