<?php
require_once('CRUD.php');

// Classe qui représente la table client.
// Hérite de CRUD, hérite donc de select, selectId, insert, update et delete.
class Client extends CRUD {
    // Propriétés du client
    public string $name;
    public string $address;
    public string $zip_code;
    public string $phone;
    public string $email;

    // Remplit les propriétés de l'objet dès qu'il est créé.
    public function __construct($name = '', $address = '', $zip_code = '', $phone = '', $email = '') {
        // Appelle le constructeur de CRUD pour ouvrir la connexion
        parent::__construct();
        $this->name = $name;
        $this->address = $address;
        $this->zip_code = $zip_code;
        $this->phone = $phone;
        $this->email = $email;
    }

    // Retourne tous les clients avec le nombre de ventes qu'ils ont faites.
    public function selectWithSaleCount():array {
        // client.* -> toutes les colonnes de la table client
        $sql = "SELECT client.*, COUNT(sale.id) AS sale_count
            FROM client
            LEFT JOIN sale ON sale.client_id = client.id
            GROUP BY client.id
            ORDER BY client.name ASC";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }
}