<?php
require 'conexao.php';

$id = filter_input(INPUT_GET, 'id');

if ($id) {
    $sql = $pdo->prepare("DELETE FROM sistema.atividades WHERE id =:id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    header("Location: logar.php");
    exit;
}else{
    header("Location: adiciona.php");
    exit;
}
?>
