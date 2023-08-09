<?php
require __DIR__ .'/vendor/autoload.php';
require __DIR__ .'/protect.php';

use \App\entity\task;



if((!isset($_GET['id'])) || !is_numeric($_GET['id'])){
    header('location: home.php?status=error');
    exit;
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


if(isset($_POST['delete'])){

    $obTask->delete($_GET['id']);
    
    header('location: home.php?status=success');
    exit;
    
}

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/delete.php';
include __DIR__ .'/includes/footer.php';


?>