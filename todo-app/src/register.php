<?php

require "connection.php";
require "Model/User.php";
require "Repository/UserRepository.php";

if (isset($_POST['register'])){
    $user = new User(null, $_POST['name'], $_POST['lastName'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), null);
    $userRepository = new UserRepository($conn);
    $userRepository->store($user);

    header("Location: login.php");
}


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Register</title>
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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-fluid p-3">
        <h2 class="text-center mb-4">Crie agora sua conta</h2>
        <form method="post" action="register.php" class="container">
            <div class="mb-3">
                <label for="email" class="form-label">Endereço de email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="nome@example.com">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Insira seu nome">
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="lastName" name="lastName"
                    placeholder="Insira seu sobrenome">
            </div>
            <div class="mb-3">
                <label for="password" class="col-sm-2 col-form-label">Senha</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <button name="register" type="submit" class="btn btn-primary w-100">Crie sua conta</button>
        </form>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>