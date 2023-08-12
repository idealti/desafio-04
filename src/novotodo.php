<?php
session_start();
include_once "connection.php";


$tarefa = $_POST['tarefa'];
$todo_status = 1;
$data_criacao = date('Y-m-d H:i:s');
$id_usuario = $_SESSION['id'];

$insert = "INSERT INTO todoUsuario (tarefa, todo_status, id_usuario, data_criacao) 
VALUES('$tarefa', '$todo_status', '$id_usuario', '$data_criacao')";

if ($conn->query($insert) === TRUE) {

    echo '<script>alert("Tarefa cadastrada com sucesso!"); window.location.href="task.php"</script>';

} else {
    echo '<script>alert("Erro ao cadastrar");</script>';
}