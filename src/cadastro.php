<?php
session_start();
include_once "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Document</title>
</head>

<body>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha_usuario = password_hash($_POST['senha_usuario'], PASSWORD_DEFAULT);

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo 'Usuário já cadastrado com esse email';
        } else {
            $insert = "INSERT INTO usuarios (nome, email, senha_usuario) 
                        VALUES('$nome', '$email', '$senha_usuario')";

            if ($conn->query($insert) === TRUE) {
                echo '<script>alert("Usuário cadastrado com sucesso!");</script>';
            } else {
                echo '<script>alert("Erro ao cadastrar usuário");</script>';
            }
        }
    }
    ?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="w3-container">
        <p>Nome</p>
        <input type="text" name="nome" placeholder="Digite seu nome" required ><br><br>

        <label>Email</label>
        <input type="email" name="email" placeholder="Digite seu email" required><br><br>

        <label>Senha</label>
        <input type="password" name="senha_usuario" placeholder="Digite sua senha" required><br><br>


        <div>
            <input type="submit" value="cadastrar" name="SendLogin">
            &nbsp;
            <a href="index.php"><input type="button" value="acessar"></a>
        </div>

    </form>

</body>

</html>