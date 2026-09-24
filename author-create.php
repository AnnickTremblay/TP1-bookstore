<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Author create</title>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <main class="container">
        <form action="author-store.php" method="POST">
            <h2>New author</h2>
            <label>Name
                <input type="text" name="name" required>
            </label>
            <label>Birthday
                <input type="date" name="birthday" required>
            </label>
            <input type="submit" class="btn" value="Save">
        </form>
    </main>
</body>
</html>