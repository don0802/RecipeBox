<?php
session_start();
require 'database.php';

// Alleen ingelogde gebruikers mogen recepten toevoegen
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Categorieën voor de dropdown
$stmt = $conn->prepare('SELECT id, naam FROM categories ORDER BY naam');
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Recept toevoegen - RecipeBox</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="form-card">
            <h2>Recept toevoegen</h2>

            <?php if (isset($_GET['error'])) : ?>
                <p class="form-error"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <form action="recipe_create_process.php" method="POST">
                <label for="titel">Titel</label>
                <input type="text" name="titel" id="titel" required>

                <label for="omschrijving">Omschrijving</label>
                <textarea name="omschrijving" id="omschrijving" rows="2"></textarea>

                <label for="bereidingstijd">Bereidingstijd (minuten)</label>
                <input type="number" name="bereidingstijd" id="bereidingstijd" min="1" required>

                <label for="porties">Aantal porties</label>
                <input type="number" name="porties" id="porties" min="1" required>

                <label for="ingredienten">Ingrediënten</label>
                <textarea name="ingredienten" id="ingredienten" rows="5" required></textarea>

                <label for="bereidingswijze">Bereidingswijze</label>
                <textarea name="bereidingswijze" id="bereidingswijze" rows="6" required></textarea>

                <label for="foto_url">Foto URL (optioneel)</label>
                <input type="url" name="foto_url" id="foto_url" placeholder="https://...">

                <label for="category_id">Categorie</label>
                <select name="category_id" id="category_id" required>
                    <?php foreach ($categories as $c) : ?>
                        <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['naam']); ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">Recept opslaan</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
