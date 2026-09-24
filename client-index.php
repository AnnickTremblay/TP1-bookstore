<?php
require_once('classes/Client.php');

// Crée l'objet Client qui ouvre la connexion à la base de données.
$client = new Client;
// Récupère tous les clients avec le nombre de ventes.
$clients = $client->selectWithSaleCount();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Clients</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <div class="page-header">
            <h1>Clients</h1>
            <a href="client-create.php" class="btn">New client</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Zip code</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Sales</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clients as $client) {
                ?>
                    <tr>
                        <td><?= $client['id'] ?></td>
                        <td><?= $client['name'] ?></td>
                        <td><?= $client['address'] ?></td>
                        <td><?= $client['zip_code'] ?></td>
                        <td><?= $client['phone'] ?></td>
                        <td><?= $client['email'] ?></td>
                        <td><?= $client['sale_count'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>