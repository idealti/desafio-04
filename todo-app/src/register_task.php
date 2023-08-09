<?php

require __DIR__ .'/vendor/autoload.php';
require __DIR__ .'/protect.php';
use \App\entity\task;

define('TITLE', 'Cadastrar tarefa');


if(isset($_POST['title'],$_POST['description'],$_POST['completed'])){
    if(strlen($_POST['title']) == 0 ){
        $msg =  '<div class="alert alert-danger">Preencha o titulo!</div>';
    } else if(strlen($_POST['description']) == 0){
        $msg =  '<div class="alert alert-danger">Preencha a descrição!</div>';
    } else {
        $obTask = new Task;
        $obTask->title = $_POST['title'];
        $obTask->description = $_POST['description'];
        $obTask->is_completed = $_POST['completed'];
        $obTask->user_id = $_SESSION['id'];
        $obTask->create();
        
        header('location: home.php?status=success');
        exit;
    }

    
    
}

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/task.php';
include __DIR__ .'/includes/footer.php';
