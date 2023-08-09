<?php

require "connection.php";
require "Repository/UserRepository.php";

if (!isset($_COOKIE["auth_token"])) {
    header("Location: login.php");
    exit;
}

$authToken = $_COOKIE["auth_token"];
$userRepository = new UserRepository($conn);
$user = $userRepository->findByToken($authToken);

if (!$user) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <title>TO DO</title>
</head>

<body>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>