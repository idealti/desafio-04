<?php
session_start();
ob_start();
include_once 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>

    <h1>Login</h1>
    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['SendLogin'])) {
        $email = $_POST['email'];
        $senha_usuario = password_hash($_POST['senha_usuario'], PASSWORD_DEFAULT);

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $result_usuario = $conn->query($sql);

        if ($result_usuario) {
            $row_usuario = mysqli_fetch_assoc($result_usuario);
            if (password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])) {
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                header("Location: task.php");

            } else
                $_SESSION['msg'] = "<p style='color: red'>Emails ou senha incorreta</p>";
        } else {
            $_SESSION['msg'] = "<p style='color: red'>Erro: Usuário não cadastrado</p>";
        }
    }
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <form method="POST" action="" >

        <label>Email</label>
        <input type="email" name="email" placeholder="Digite seu email" required><br><br>

        <label>Senha</label>
        <input type="password" name="senha_usuario" placeholder="Digite sua senha" required value="<?php if (isset($dados['senha_usuario'])) {
            echo $dados['senha_usuario'];
        } ?>"><br><br>

        <div>
            <a href="task.php"><input type="submit" value="acessar" name="SendLogin"></a>
            &nbsp;
            <a href="cadastro.php"><input type="button" value="cadastrar"></a>
        </div>


    </form>
</body>

</html>