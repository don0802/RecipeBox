<?php
session_start();
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: login.php');
    exit;
}

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email == '' || $password == '') {
    header('Location: login.php?error=1');
    exit;
}

$stmt = $conn->prepare("SELECT id, naam, email, wachtwoord, rol FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['wachtwoord'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['naam']    = $user['naam'];
    $_SESSION['email']   = $user['email'];
    $_SESSION['role']    = $user['rol'];

    header("Location: recipes_index.php");
    exit;
}

header('Location: login.php?error=1');
exit;
