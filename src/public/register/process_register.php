<?php
require_once '../db/connection.php'; // Include your database connection file here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: auth/login.php"); // Redirect to login page after successful registration
        exit();
    } else {
        echo "Erro ao registrar o usuário: " . $conn->error;
    }

    $conn->close();
}
