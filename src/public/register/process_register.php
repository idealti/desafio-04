<?php
require_once '../db/connection.php'; // Inclua o arquivo de conexão com o banco de dados aqui

$errorMsg = ""; // Inicialize a mensagem de erro vazia

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash da senha

    // Verificar se já existe um usuário com o mesmo email
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $emailResult = $conn->query($checkEmailQuery);

    if ($emailResult->num_rows > 0) {
        header("Location: register.php?error=1"); // Redirecionar para a página de registro com uma mensagem de erro
        exit();
    } else {
        // Inserir o novo usuário se o email não estiver em uso
        $insertQuery = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        if ($conn->query($insertQuery) === TRUE) {
            header("Location: ../auth/login.php"); // Redirecionar para a página de login após o registro bem-sucedido
            exit();
        } else {
            $errorMsg = "Erro ao registrar o usuário: " . $conn->error;
        }
    }

    $conn->close();
}
?>
