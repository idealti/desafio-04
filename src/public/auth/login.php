<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /public');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('../images/background-login.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .login-container {
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-4 bg-light p-4 rounded">
                <h2 class="mb-4 text-center">Login</h2>
                <!-- Verifica se há uma mensagem de erro na URL -->
                <?php if (isset($_GET['error']) && $_GET['error'] == 1) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Usuário não encontrado, verifique o e-mail e a senha e tente novamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <form action="process_login.php" method="post" onsubmit="return validateForm();">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </form>
                <div class="mt-3 text-center">
                    <p>Ainda não tem uma conta? <a href="../register/register.php">Registre-se aqui</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            if (email === '' || password === '') {
                alert('Por favor, preencha todos os campos.');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>