<?php

session_start();
include_once "connection.php";


$id = $_GET['id'];


$up = "UPDATE todoUsuario SET todo_status='2'  WHERE id=$id";

$result = $conn->query($up);

if ($result) {
    echo "<script>alert('atualizado com sucesso!'); window.location.href='task.php';</script>";
} else {
    echo "Aviso: Não foi atualizado!";
}


?>