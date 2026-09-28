<?php
require_once('classes/Sale.php');

// Crée l'objet Sale qui ouvre la connexion à la base de données.
$saleObj = new Sale;
// Récupère toutes les ventes avec le nom du client et le titre du livre.
$sales = $saleObj->selectWithDetails();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Sales</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <div class="page-header">
            <h1>Sales</h1>
            <a href="sale-create.php" class="btn">New sale</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Book</th>
                    <th>Quantity</th>
                    <th>Unit price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sales as $row) {
                    // Crée un objet Sale pour calculer le total de la ligne.
                    $item = new Sale($row['quantity'], $row['sold_date'], $row['unit_price']);
                ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['sold_date'] ?></td>
                        <td><?= $row['client_name'] ?></td>
                        <td><?= $row['book_title'] ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= $row['unit_price'] ?> $</td>
                        <td><?= $item->calculateTotal() ?> $</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>