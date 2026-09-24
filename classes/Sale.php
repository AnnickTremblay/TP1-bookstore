<?php
require_once('CRUD.php');

// Classe qui représente la table sale.
// Hérite de CRUD, hérite donc de select, selectId, insert, update et delete.
class Sale extends CRUD {
    // Propriétés de la vente
    public int $quantity;
    public string $sold_date;
    public float $unit_price;

    // Remplit les propriétés de l'objet dès qu'il est créé.
    public function __construct($quantity = 0, $sold_date = '', $unit_price = 0) {
        // Appelle le constructeur de CRUD pour ouvrir la connexion.
        parent::__construct();
        $this->quantity = $quantity;
        $this->sold_date = $sold_date;
        $this->unit_price = $unit_price;
    }

    // Retourne toutes les ventes avec le nom du client et le titre du livre.
    public function selectWithDetails():array {
        $sql = "SELECT sale.*, client.name AS client_name, book.title AS book_title
                FROM sale
                INNER JOIN client ON sale.client_id = client.id
                INNER JOIN book ON sale.book_id = book.id
                ORDER BY sale.sold_date DESC";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    // Calcule le total de la vente (quantité x prix unitaire).
    public function calculateTotal():float {
        return $this->quantity * $this->unit_price;
    }
}