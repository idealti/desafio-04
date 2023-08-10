<?php 

require "connection.php";
require "Repository/UserRepository.php";
require "utils/token.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userRepository = new UserRepository($conn);
    $user = $userRepository->findByEmail($email);

    if ($user && password_verify($password, $user->getPassword())) {
        $token = generateToken();
        $userRepository->updateToken($user, $token);
        setcookie("auth_token", $token, time() + 3600, "/", "", true, true); 

        header("Location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">TO DO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class=" nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Registre-se</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-fluid p-3">
        <h2 class="text-center mb-4">Bem vindo(a) de volta</h2>
        <form method="post" action="login.php" class="container">
            <div class="mb-3">
                <label for="email" class="form-label">Endereço de email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="nome@example.com">
            </div>
            <div class="mb-3">
                <label for="password" class="col-sm-2 col-form-label">Senha</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <button name="login" type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>