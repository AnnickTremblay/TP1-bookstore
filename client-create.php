<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Client create</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <form action="client-store.php" method="POST">
            <h2>New client</h2>
            <label>Name
                <input type="text" name="name" required>
            </label>
            <label>Address
                <input type="text" name="address">
            </label>
            <label>Zip code
                <input type="text" name="zip_code">
            </label>
            <label>Phone
                <input type="tel" name="phone">
            </label>
            <label>Email
                <input type="email" name="email" required>
            </label>
            <input type="submit" class="btn" value="Save">
        </form>
    </main>
</body>
</html>