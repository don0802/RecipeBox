<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $conn->prepare('SELECT * FROM recipes WHERE id = :id AND deleted_at IS NULL');
$stmt->execute(['id' => $id]);
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipe) {
    http_response_code(404);
    include 'header.php';
    echo '<main><p class="empty-msg">Recept niet gevonden.</p></main>';
    include 'footer.php';
    exit;
}

$is_admin    = ($_SESSION['role'] ?? '') == 'admin';
$is_eigenaar = (int) $_SESSION['user_id'] === (int) $recipe['user_id'];
if (!$is_admin && !$is_eigenaar) {
    http_response_code(403);
    include 'header.php';
    echo '<main><p class="empty-msg">Je hebt geen toegang tot dit recept.</p></main>';
    include 'footer.php';
    exit;
}

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
    <title>Recept wijzigen - RecipeBox</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="form-card">
            <h2>Recept wijzigen</h2>

            <?php if (isset($_GET['error'])) : ?>
                <p class="form-error"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <form action="recipe_update_process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $recipe['id']; ?>">

                <label for="titel">Titel</label>
                <input type="text" name="titel" id="titel" value="<?php echo htmlspecialchars($recipe['titel']); ?>" required>

                <label for="omschrijving">Omschrijving</label>
                <textarea name="omschrijving" id="omschrijving" rows="2"><?php echo htmlspecialchars($recipe['omschrijving']); ?></textarea>

                <label for="bereidingstijd">Bereidingstijd (minuten)</label>
                <input type="number" name="bereidingstijd" id="bereidingstijd" min="1" value="<?php echo htmlspecialchars($recipe['bereidingstijd']); ?>" required>

                <label for="porties">Aantal porties</label>
                <input type="number" name="porties" id="porties" min="1" value="<?php echo htmlspecialchars($recipe['porties']); ?>" required>

                <label for="ingredienten">Ingrediënten</label>
                <textarea name="ingredienten" id="ingredienten" rows="5" required><?php echo htmlspecialchars($recipe['ingredienten']); ?></textarea>

                <label for="bereidingswijze">Bereidingswijze</label>
                <textarea name="bereidingswijze" id="bereidingswijze" rows="6" required><?php echo htmlspecialchars($recipe['bereidingswijze']); ?></textarea>

                <label for="foto_url">Foto URL (optioneel)</label>
                <input type="url" name="foto_url" id="foto_url" value="<?php echo htmlspecialchars($recipe['foto_url'] ?? ''); ?>">

                <label for="category_id">Categorie</label>
                <select name="category_id" id="category_id" required>
                    <?php foreach ($categories as $c) : ?>
                        <option value="<?php echo $c['id']; ?>" <?php echo ((int) $recipe['category_id'] === (int) $c['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($c['naam']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">Wijzigingen opslaan</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
