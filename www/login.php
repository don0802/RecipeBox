<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: recipes_index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inloggen - RecipeBox</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="auth-card">
            <h2>Inloggen</h2>

            <?php if (isset($_GET['error'])) : ?>
                <p class="form-error">Ongeldige inloggegevens</p>
            <?php endif; ?>

            <?php if (isset($_GET['registered'])) : ?>
                <p class="form-success">Account aangemaakt! Je kunt nu inloggen.</p>
            <?php endif; ?>

            <form action="login_process.php" method="POST">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required><br>

                <label for="password">Wachtwoord</label>
                <input type="password" name="password" id="password" required>

                <button type="submit">Inloggen</button>
            </form>

            <p class="auth-switch">Nog geen account? <a href="register.php">Registreer hier</a></p>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
