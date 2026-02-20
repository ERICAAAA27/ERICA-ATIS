<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if (!$email || strlen($password) < 8) {
        die("Invalid input.");
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->execute([$email, $hashedPassword]);

    echo "Registered successfully!";
}
?>