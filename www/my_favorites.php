<?php
session_start();
require 'database.php';

// Alleen ingelogde gebruikers
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Verwijderen uit favorieten
if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
    $remove_id = (int) $_GET['remove'];
    $stmt = $conn->prepare('DELETE FROM favorites WHERE user_id = :user_id AND recipe_id = :recipe_id');
    $stmt->execute(['user_id' => $_SESSION['user_id'], 'recipe_id' => $remove_id]);
    header('Location: my_favorites.php');
    exit;
}

// Favoriete recepten van de ingelogde gebruiker (JOIN via favorites)
$stmt = $conn->prepare('SELECT recipes.*, categories.naam AS categorie_naam
                        FROM favorites
                        JOIN recipes ON favorites.recipe_id = recipes.id
                        JOIN categories ON recipes.category_id = categories.id
                        WHERE favorites.user_id = :user_id AND recipes.deleted_at IS NULL
                        ORDER BY favorites.created_at DESC');
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Mijn favorieten - RecipeBox</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h2 class="h2-hero">Mijn favorieten</h2>

        <?php if (empty($recipes)) : ?>
            <p class="empty-msg">Je hebt nog geen recepten bewaard.</p>
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
                        <a href="recipe_detail.php?id=<?php echo $recipe['id']; ?>">Bekijk recept</a>
                        <a class="btn-delete" href="my_favorites.php?remove=<?php echo $recipe['id']; ?>">Verwijder</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
