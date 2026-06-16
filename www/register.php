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
    <title>Registreren - RecipeBox</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="auth-card">
            <h2>Account aanmaken</h2>

            <?php if (isset($_GET['error'])) : ?>
                <p class="form-error"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <form action="register_process.php" method="POST">
                <label for="naam">Naam</label>
                <input type="text" name="naam" id="naam" required><br>

                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required><br>

                <label for="password">Wachtwoord</label>
                <input type="password" name="password" id="password" required><br>

                <label for="kookniveau">Kookniveau</label>
                <select name="kookniveau" id="kookniveau" required>
                    <option value="beginner">Beginner</option>
                    <option value="gevorderd">Gevorderd</option>
                    <option value="expert">Expert</option>
                </select><br>

                <label for="specialiteit">Specialiteit</label>
                <input type="text" name="specialiteit" id="specialiteit" placeholder="bijv. Italiaans, Aziatisch, Gebak"><br>

                <label for="bio">Bio</label><br>
                <textarea name="bio" id="bio" rows="3" placeholder="Vertel iets over jezelf als kok"></textarea><br>

                <button type="submit">Maak account</button>
            </form>

            <p class="auth-switch">Heb je al een account? <a href="login.php">Log hier in</a></p>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
