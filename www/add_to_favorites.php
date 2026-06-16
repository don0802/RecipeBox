<?php
session_start();
require 'database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Je moet ingelogd zijn.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$recipe_id = isset($data['recipe_id']) && is_numeric($data['recipe_id']) ? (int) $data['recipe_id'] : 0;
$user_id   = (int) $_SESSION['user_id'];

if ($recipe_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Ongeldig recept.']);
    exit;
}

$stmt = $conn->prepare('SELECT id FROM recipes WHERE id = :id AND deleted_at IS NULL');
$stmt->execute(['id' => $recipe_id]);
if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
    echo json_encode(['success' => false, 'message' => 'Recept bestaat niet.']);
    exit;
}

$stmt = $conn->prepare('SELECT id FROM favorites WHERE user_id = :user_id AND recipe_id = :recipe_id');
$stmt->execute(['user_id' => $user_id, 'recipe_id' => $recipe_id]);
if ($stmt->fetch(PDO::FETCH_ASSOC)) {
    echo json_encode(['success' => false, 'message' => 'Dit recept staat al in je favorieten.']);
    exit;
}

$stmt = $conn->prepare('INSERT INTO favorites (user_id, recipe_id) VALUES (:user_id, :recipe_id)');
$stmt->execute(['user_id' => $user_id, 'recipe_id' => $recipe_id]);

echo json_encode(['success' => true, 'message' => 'Toegevoegd aan favorieten']);
