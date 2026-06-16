<?php
session_start();
require 'database.php';

$category_id = isset($_GET['category_id']) && is_numeric($_GET['category_id']) ? (int) $_GET['category_id'] : null;
$tijd        = $_GET['tijd'] ?? '';
$search      = trim($_GET['search'] ?? '');

$sql = 'SELECT recipes.*, categories.naam AS categorie_naam
        FROM recipes
        JOIN categories ON recipes.category_id = categories.id
        WHERE recipes.deleted_at IS NULL';
$params = [];

if ($category_id !== null) {
    $sql .= ' AND recipes.category_id = :category_id';
    $params['category_id'] = $category_id;
}

if ($tijd === 'snel') {
    $sql .= ' AND recipes.bereidingstijd <= 30';
} elseif ($tijd === 'normaal') {
    $sql .= ' AND recipes.bereidingstijd BETWEEN 31 AND 60';
} elseif ($tijd === 'uitgebreid') {
    $sql .= ' AND recipes.bereidingstijd > 60';
}

if ($search !== '') {
    $sql .= ' AND recipes.titel LIKE :search';
    $params['search'] = '%' . $search . '%';
}

$sql .= ' ORDER BY recipes.created_at DESC';

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare('SELECT id, naam FROM categories ORDER BY naam');
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$actieve_categorie = null;
if ($category_id !== null) {
    foreach ($categories as $c) {
        if ((int) $c['id'] === $category_id) {
            $actieve_categorie = $c['naam'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Recepten - RecipeBox</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h2 class="h2-hero">
            <?php echo $actieve_categorie ? 'Recepten: ' . htmlspecialchars($actieve_categorie) : 'Alle recepten'; ?>
        </h2>

        <form class="filter-bar" method="GET" action="recipes_index.php">
            <input type="text" name="search" placeholder="Zoek op titel..." value="<?php echo htmlspecialchars($search); ?>">

            <select name="category_id">
                <option value="">Alle categorieën</option>
                <?php foreach ($categories as $c) : ?>
                    <option value="<?php echo $c['id']; ?>" <?php echo ($category_id === (int) $c['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($c['naam']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="tijd">
                <option value="">Alle bereidingstijden</option>
                <option value="snel"       <?php echo $tijd === 'snel' ? 'selected' : ''; ?>>Snel (≤ 30 min)</option>
                <option value="normaal"    <?php echo $tijd === 'normaal' ? 'selected' : ''; ?>>Normaal (31-60 min)</option>
                <option value="uitgebreid" <?php echo $tijd === 'uitgebreid' ? 'selected' : ''; ?>>Uitgebreid (60+ min)</option>
            </select>

            <button type="submit">Filter</button>
            <a class="filter-reset" href="recipes_index.php">Reset</a>
        </form>

        <?php if (empty($recipes)) : ?>
            <p class="empty-msg">Geen recepten gevonden.</p>
        <?php else : ?>
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
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
