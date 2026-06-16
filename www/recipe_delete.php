<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int) $_GET['id'] : 0;

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

$stmt = $conn->prepare('UPDATE recipes SET deleted_at = NOW() WHERE id = :id');
$stmt->execute(['id' => $id]);

header('Location: recipes_index.php?deleted=1');
exit;
