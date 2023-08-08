<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('../images/background-login.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .register-container {
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <div class="container register-container">

        <div class="row justify-content-center">

            <div class="col-md-4 bg-light p-4 rounded">
                <h2 class="mb-4 text-center">Registro de Usuário</h2>
                <!-- Verifica se há uma mensagem de erro na URL -->
                <?php if (isset($_GET['error']) && $_GET['error'] == 1) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Erro ao registrar o usuário: O email já está em uso.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <form action="process_register.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                </form>
                <div class="mt-3 text-center">
                    Já tem uma conta? <a href="../auth/login.php">Voltar para o Login</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>