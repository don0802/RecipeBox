<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') != 'admin') {
    http_response_code(403);
    include 'header.php';
    echo '<main><p class="empty-msg">Alleen beheerders hebben toegang tot deze pagina.</p></main>';
    include 'footer.php';
    exit;
}

if (isset($_GET['restore']) && is_numeric($_GET['restore'])) {
    $restore_id = (int) $_GET['restore'];
    $stmt = $conn->prepare('UPDATE recipes SET deleted_at = NULL WHERE id = :id');
    $stmt->execute(['id' => $restore_id]);
    header('Location: recipes_deleted.php?restored=1');
    exit;
}

$sql = 'SELECT recipes.*, categories.naam AS categorie_naam
        FROM recipes
        JOIN categories ON recipes.category_id = categories.id
        WHERE recipes.deleted_at IS NOT NULL
        ORDER BY recipes.deleted_at DESC';
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
    <title>Verwijderde recepten - RecipeBox</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h2 class="h2-hero">Verwijderde recepten</h2>

        <?php if (isset($_GET['restored'])) : ?>
            <p class="form-success">Recept hersteld.</p>
        <?php endif; ?>

        <?php if (empty($recipes)) : ?>
            <p class="empty-msg">Er zijn geen verwijderde recepten.</p>
        <?php else : ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Titel</th>
                        <th>Categorie</th>
                        <th>Verwijderd op</th>
                        <th>Actie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recipes as $recipe) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($recipe['titel']); ?></td>
                            <td><?php echo htmlspecialchars($recipe['categorie_naam']); ?></td>
                            <td><?php echo htmlspecialchars($recipe['deleted_at']); ?></td>
                            <td><a class="btn-edit" href="recipes_deleted.php?restore=<?php echo $recipe['id']; ?>">Herstel</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
