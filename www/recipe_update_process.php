<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: recipes_index.php');
    exit;
}

$id = isset($_POST['id']) && is_numeric($_POST['id']) ? (int) $_POST['id'] : 0;

$stmt = $conn->prepare('SELECT user_id FROM recipes WHERE id = :id AND deleted_at IS NULL');
$stmt->execute(['id' => $id]);
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipe) {
    header('Location: recipes_index.php');
    exit;
}

$is_admin    = ($_SESSION['role'] ?? '') == 'admin';
$is_eigenaar = (int) $_SESSION['user_id'] === (int) $recipe['user_id'];
if (!$is_admin && !$is_eigenaar) {
    http_response_code(403);
    echo 'Geen toegang.';
    exit;
}

$titel           = trim($_POST['titel'] ?? '');
$omschrijving    = trim($_POST['omschrijving'] ?? '');
$bereidingstijd  = $_POST['bereidingstijd'] ?? '';
$porties         = $_POST['porties'] ?? '';
$ingredienten    = trim($_POST['ingredienten'] ?? '');
$bereidingswijze = trim($_POST['bereidingswijze'] ?? '');
$foto_url        = trim($_POST['foto_url'] ?? '');
$category_id     = $_POST['category_id'] ?? '';

if ($titel == '' || $ingredienten == '' || $bereidingswijze == ''
    || !is_numeric($bereidingstijd) || !is_numeric($porties) || !is_numeric($category_id)) {
    header('Location: recipe_update.php?id=' . $id . '&error=' . urlencode('Vul alle verplichte velden correct in.'));
    exit;
}

$bereidingstijd = (int) $bereidingstijd;
$porties        = (int) $porties;
$category_id    = (int) $category_id;
$foto_url       = $foto_url == '' ? null : $foto_url;

$stmt = $conn->prepare('UPDATE recipes SET
        titel = :titel, omschrijving = :omschrijving, bereidingstijd = :bereidingstijd, porties = :porties,
        ingredienten = :ingredienten, bereidingswijze = :bereidingswijze, foto_url = :foto_url, category_id = :category_id
        WHERE id = :id');
$stmt->execute([
    'titel'           => $titel,
    'omschrijving'    => $omschrijving,
    'bereidingstijd'  => $bereidingstijd,
    'porties'         => $porties,
    'ingredienten'    => $ingredienten,
    'bereidingswijze' => $bereidingswijze,
    'foto_url'        => $foto_url,
    'category_id'     => $category_id,
    'id'              => $id
]);

header('Location: recipe_detail.php?id=' . $id);
exit;
