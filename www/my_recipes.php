<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$stmt = $conn->prepare('SELECT recipes.*, categories.naam AS categorie_naam
                        FROM recipes
                        JOIN categories ON recipes.category_id = categories.id
                        WHERE recipes.user_id = :user_id AND recipes.deleted_at IS NULL
                        ORDER BY recipes.created_at DESC');
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Mijn recepten - RecipeBox</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h2 class="h2-hero">Mijn recepten</h2>

        <p style="text-align:center;">
            <a class="btn-edit" href="recipe_create.php">+ Nieuw recept toevoegen</a>
        </p>

        <?php if (empty($recipes)) : ?>
            <p class="empty-msg">Je hebt nog geen recepten geplaatst.</p>
        <?php else : ?>
            <div class="recipes-grid">
                <?php foreach ($recipes as $recipe) : ?>
                    <div class="recipe-card">
                        <?php if ($recipe['foto_url']) : ?>
                            <img src="<?php echo htmlspecialchars($recipe['foto_url']); ?>" alt="<?php echo htmlspecialchars($recipe['titel']); ?>">
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($recipe['titel']); ?></h3>
                        <p><?php echo htmlspecialchars($recipe['omschrijving']); ?></p>
                        <span>Categorie: <?php echo htmlspecialchars($recipe['categorie_naam']); ?></span><br>
                        <a href="recipe_detail.php?id=<?php echo $recipe['id']; ?>">Bekijk</a>
                        <a class="btn-edit" href="recipe_update.php?id=<?php echo $recipe['id']; ?>">Wijzig</a>
                        <a class="btn-delete confirm-delete" href="recipe_delete.php?id=<?php echo $recipe['id']; ?>">Verwijder</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
