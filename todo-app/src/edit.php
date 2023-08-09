<?php
require __DIR__ .'/vendor/autoload.php';
require __DIR__ .'/protect.php';

use \App\entity\task;
define('TITLE', 'Editar tarefa');

if((!isset($_GET['id'])) || !is_numeric($_GET['id'])){
    header('location: home.php?status=error');
    
}

$obTask = Task::getOne($_GET['id']);

if(!$obTask instanceof Task){
    header('location: home.php?status=error');
    exit;
}

if($obTask->user_id != $_SESSION['id']){
    header('location: home.php?status=notallowed');
    exit;
}

if(isset($_POST['title'],$_POST['description'],$_POST['completed'])){
    if(strlen($_POST['title']) == 0 ){
        $msg =  '<div class="alert alert-danger">Preencha o titulo!</div>';
    } else if(strlen($_POST['description']) == 0){
        $msg =  '<div class="alert alert-danger">Preencha a descrição!</div>';
    } else {

        $obTask->title = $_POST['title'];
        $obTask->description = $_POST['description'];
        $obTask->is_completed = $_POST['completed'];
        $obTask->update($_GET['id']);
    
        header('location: home.php?status=success');
        exit;
    }
    
    
}

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/task.php';
include __DIR__ .'/includes/footer.php';


?>