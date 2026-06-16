<?php
session_start();
require 'database.php';

$sql = 'SELECT categories.id, categories.naam, categories.omschrijving, categories.foto_url,
               COUNT(recipes.id) AS aantal
        FROM categories
        LEFT JOIN recipes ON recipes.category_id = categories.id AND recipes.deleted_at IS NULL
        GROUP BY categories.id, categories.naam, categories.omschrijving, categories.foto_url
        ORDER BY categories.naam';
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Categorieën - RecipeBox</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <h2 class="h2-hero">Categorieën</h2>
        <div class="recipes-grid">
            <?php foreach ($categories as $c): ?>
                <div class="recipe-card">
                    <?php if ($c['foto_url']): ?>
                        <img src="<?php echo htmlspecialchars($c['foto_url']); ?>" alt="<?php echo htmlspecialchars($c['naam']); ?>">
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($c['naam']); ?></h3>
                    <p><?php echo htmlspecialchars($c['omschrijving'] ?? ''); ?></p>
                    <span><?php echo (int) $c['aantal']; ?> recept(en)</span><br>
                    <a href="recipes_index.php?category_id=<?php echo $c['id']; ?>">Bekijk recepten</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>