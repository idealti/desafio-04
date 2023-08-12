<?php
session_start();
include_once "connection.php";

$id_registro = $_GET['id'];

$up = "DELETE FROM todoUsuario WHERE id=$id_registro";

$result = $conn->query($up);

if ($result) {
    echo "<script>alert('Deletado com sucesso com sucesso!'); window.location.href='task.php';</script>";
} else {
    echo "Aviso: Não foi deletado!";
}