<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: recipe_create.php');
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
$user_id         = (int) $_SESSION['user_id'];

if ($titel == '' || $ingredienten == '' || $bereidingswijze == ''
    || !is_numeric($bereidingstijd) || !is_numeric($porties) || !is_numeric($category_id)) {
    header('Location: recipe_create.php?error=' . urlencode('Vul alle verplichte velden correct in.'));
    exit;
}

$bereidingstijd = (int) $bereidingstijd;
$porties        = (int) $porties;
$category_id    = (int) $category_id;
$foto_url       = $foto_url == '' ? null : $foto_url;

$stmt = $conn->prepare('INSERT INTO recipes
        (titel, omschrijving, bereidingstijd, porties, ingredienten, bereidingswijze, foto_url, category_id, user_id)
        VALUES (:titel, :omschrijving, :bereidingstijd, :porties, :ingredienten, :bereidingswijze, :foto_url, :category_id, :user_id)');
$stmt->execute([
    'titel'           => $titel,
    'omschrijving'    => $omschrijving,
    'bereidingstijd'  => $bereidingstijd,
    'porties'         => $porties,
    'ingredienten'    => $ingredienten,
    'bereidingswijze' => $bereidingswijze,
    'foto_url'        => $foto_url,
    'category_id'     => $category_id,
    'user_id'         => $user_id
]);

$nieuw_id = $conn->lastInsertId();

header('Location: recipe_detail.php?id=' . $nieuw_id);
exit;
