<?php
session_start();
require 'database.php';

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $conn->prepare('SELECT recipes.*, categories.naam AS categorie_naam, users.naam AS kok_naam
                        FROM recipes
                        JOIN categories ON recipes.category_id = categories.id
                        JOIN users ON recipes.user_id = users.id
                        WHERE recipes.id = :id AND recipes.deleted_at IS NULL');
$stmt->execute(['id' => $id]);
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipe) {
    http_response_code(404);
    include 'header.php';
    echo '<main><p class="empty-msg">Recept niet gevonden.</p></main>';
    include 'footer.php';
    exit;
}

$ingelogd = isset($_SESSION['user_id']);
$is_admin = ($_SESSION['role'] ?? '') == 'admin';
$is_eigenaar = $ingelogd && (int) $_SESSION['user_id'] === (int) $recipe['user_id'];

// Staat dit recept al in de favorieten van de ingelogde gebruiker?
$al_favoriet = false;
if ($ingelogd) {
    $stmt = $conn->prepare('SELECT id FROM favorites WHERE user_id = :user_id AND recipe_id = :recipe_id');
    $stmt->execute(['user_id' => $_SESSION['user_id'], 'recipe_id' => $recipe['id']]);
    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        $al_favoriet = true;
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo htmlspecialchars($recipe['titel']); ?> - RecipeBox</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <article class="recipe-detail">
            <?php if ($recipe['foto_url']) : ?>
                <img class="detail-foto" src="<?php echo htmlspecialchars($recipe['foto_url']); ?>" alt="<?php echo htmlspecialchars($recipe['titel']); ?>">
            <?php endif; ?>

            <h2><?php echo htmlspecialchars($recipe['titel']); ?></h2>
            <p class="detail-meta">
                Categorie: <?php echo htmlspecialchars($recipe['categorie_naam']); ?> &middot;
                Bereidingstijd: <?php echo htmlspecialchars($recipe['bereidingstijd']); ?> min &middot;
                Porties: <?php echo htmlspecialchars($recipe['porties']); ?> &middot;
                Door: <?php echo htmlspecialchars($recipe['kok_naam']); ?>
            </p>

            <p class="detail-omschrijving"><?php echo htmlspecialchars($recipe['omschrijving']); ?></p>

            <h3>Ingrediënten</h3>
            <p class="detail-tekst"><?php echo nl2br(htmlspecialchars($recipe['ingredienten'])); ?></p>

            <h3>Bereidingswijze</h3>
            <p class="detail-tekst"><?php echo nl2br(htmlspecialchars($recipe['bereidingswijze'])); ?></p>

            <?php if ($ingelogd) : ?>
                <button id="favoriet-knop"
                        class="fav-btn"
                        data-recipe-id="<?php echo $recipe['id']; ?>"
                        <?php echo $al_favoriet ? 'disabled' : ''; ?>>
                    <?php echo $al_favoriet ? 'Opgeslagen ✓' : 'Bewaar recept'; ?>
                </button>
                <p id="favoriet-melding" class="fav-melding"></p>
            <?php else : ?>
                <p><a href="login.php">Log in</a> om dit recept te bewaren.</p>
            <?php endif; ?>

            <?php if ($is_eigenaar || $is_admin) : ?>
                <div class="detail-acties">
                    <a class="btn-edit" href="recipe_update.php?id=<?php echo $recipe['id']; ?>">Wijzigen</a>
                    <a class="btn-delete confirm-delete" href="recipe_delete.php?id=<?php echo $recipe['id']; ?>">Verwijderen</a>
                </div>
            <?php endif; ?>
        </article>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
