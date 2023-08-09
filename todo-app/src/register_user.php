<?php

require __DIR__ .'/vendor/autoload.php';

use \App\entity\user;

$msg = '';

if(isset($_POST['name']) || isset($_POST['email']) || isset($_POST['password']) || isset($_POST['password1'])){

    if(strlen($_POST['name']) == 0 ){
        $msg =  '<div class="alert alert-danger">Preencha seu nome!</div>';
    } else if(strlen($_POST['email']) == 0){
        $msg =  '<div class="alert alert-danger">Preencha sua e-mail!</div>';
    } else if(strlen($_POST['password']) == 0){
        $msg =  '<div class="alert alert-danger">Preencha sua senha!</div>';
    } else if(strlen($_POST['password1']) == 0){
        $msg =  '<div class="alert alert-danger">Repita a senha!</div>';
    } else if($_POST['password'] != $_POST['password1']){
        $msg =  '<div class="alert alert-danger">As senhas são diferentes!</div>';
    }else {
        
        $obUser = new User();
        $obUser->name = $_POST['name'];
        $obUser->email = $_POST['email'];
        $obUser->password = $_POST['password'];

        $obUser->create();

        if(!isset($_SESSION)){
            session_start();
        }

        $_SESSION['id'] = $obUser->id;
        $_SESSION['name'] = $obUser->name;
    
        header("Location: home.php");
        exit;
    }
    

    
}


include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/user.php';
include __DIR__ .'/includes/footer.php';

