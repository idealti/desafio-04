<?php

session_start();

require "connection.php";
require "Repository/UserRepository.php";


if (isset($_COOKIE["auth_token"])) {
    $authToken = $_COOKIE["auth_token"];
    setcookie("auth_token", "", time() - 3600, "/");

    $userRepository = new UserRepository($conn);
    $userRepository->removeToken($authToken);
}

session_unset();

session_destroy();

header_remove();

header("Location: login.php");
exit;
?>