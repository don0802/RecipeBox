<?php
session_start();

// Het receptenoverzicht is openbaar: bezoekers hoeven niet ingelogd te zijn.
require 'database.php';

$sql = 'SELECT recipes.*, categories.naam AS categorie_naam
        FROM recipes
        JOIN categories ON recipes.category_id = categories.id
        WHERE recipes.deleted_at IS NULL
        ORDER BY recipes.created_at DESC';

$stmt = $conn->prepare($sql);
$stmt->execute();
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>RecipeBox</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h2 class="h2-hero">Alle recepten</h2>
        <div class="recipes-grid">
            <?php foreach ($recipes as $recipe) : ?>
                <div class="recipe-card">
                    <?php if ($recipe['foto_url']) : ?>
                        <img src="<?php echo htmlspecialchars($recipe['foto_url']); ?>" alt="<?php echo htmlspecialchars($recipe['titel']); ?>">
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($recipe['titel']); ?></h3>
                    <p><?php echo htmlspecialchars($recipe['omschrijving']); ?></p>
                    <span>Bereidingstijd: <?php echo htmlspecialchars($recipe['bereidingstijd']); ?> min</span><br>
                    <span>Porties: <?php echo htmlspecialchars($recipe['porties']); ?></span><br>
                    <span>Categorie: <?php echo htmlspecialchars($recipe['categorie_naam']); ?></span><br>
                    <a href="recipe_detail.php?id=<?php echo $recipe['id']; ?>">Bekijk recept</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
