<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';

use \App\entity\user;


$msg = '';
if (isset($_POST['email']) || isset($_POST['password'])) {

    if (strlen($_POST['email']) == 0) {
        $msg =  '<div class="alert alert-danger">Preencha seu e-mail!</div>';
    } else if (strlen($_POST['password']) == 0) {
        $msg =  '<div class="alert alert-danger">Preencha sua senha!</div>';
    } else {

        $user = User::login($_POST['email'], $_POST['password']);
        if (!$user instanceof User) {
            header('location: index.php?status=error');
            exit;
        }


        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['id'] = $user->id;
        $_SESSION['name'] = $user->name;

        header("Location: home.php");
    }
}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/login.php';
include __DIR__ . '/includes/footer.php';
