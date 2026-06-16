<?php
session_start();
require 'database.php';

// Alleen POST toestaan
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: register.php');
    exit;
}

$naam         = trim($_POST['naam'] ?? '');
$email        = trim($_POST['email'] ?? '');
$password     = $_POST['password'] ?? '';
$kookniveau   = $_POST['kookniveau'] ?? '';
$specialiteit = trim($_POST['specialiteit'] ?? '');
$bio          = trim($_POST['bio'] ?? '');

// Input validatie: verplichte velden
if ($naam == '' || $email == '' || $password == '' || $kookniveau == '') {
    header('Location: register.php?error=' . urlencode('Vul alle verplichte velden in.'));
    exit;
}

// Email al in gebruik? (prepared statement)
$stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
if ($stmt->fetch(PDO::FETCH_ASSOC)) {
    header('Location: register.php?error=' . urlencode('Dit e-mailadres is al geregistreerd.'));
    exit;
}

// Wachtwoord hashen voor opslag
$hash = password_hash($password, PASSWORD_DEFAULT);

// 1. User aanmaken
$stmt = $conn->prepare("INSERT INTO users (naam, email, wachtwoord, rol)
                        VALUES (:naam, :email, :wachtwoord, 'user')");
$stmt->execute([
    'naam'       => $naam,
    'email'      => $email,
    'wachtwoord' => $hash
]);

// 2. Het id van de zojuist aangemaakte user ophalen
$user_id = $conn->lastInsertId();

// 3. Bijbehorend cook_profile aanmaken (1-op-1 relatie)
$stmt = $conn->prepare("INSERT INTO cook_profiles (user_id, kookniveau, specialiteit, bio)
                        VALUES (:user_id, :kookniveau, :specialiteit, :bio)");
$stmt->execute([
    'user_id'      => $user_id,
    'kookniveau'   => $kookniveau,
    'specialiteit' => $specialiteit,
    'bio'          => $bio
]);

header('Location: login.php?registered=1');
exit;
