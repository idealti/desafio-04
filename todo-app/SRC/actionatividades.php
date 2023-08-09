<?php

require 'conexao.php';

$titulo = filter_input(INPUT_POST, 'titulo');
$descricao = filter_input(INPUT_POST, 'descricao');
$data = filter_input(INPUT_POST, 'data');
$finalizacao = filter_input(INPUT_POST, 'finalizacao');
$status = filter_input(INPUT_POST, 'status');


if ($titulo && $descricao && $data && $finalizacao && $status) {
    $sql = $pdo->prepare("INSERT INTO sistema.atividades (titulo, descricao, data, finalizacao, status) VALUES (:titulo, :descricao, :data, :finalizacao, :status)");
    $sql->bindValue(':titulo', $titulo);
    $sql->bindValue(':descricao', $descricao);
    $sql->bindValue(':data', $data);
    $sql->bindValue(':finalizacao', $finalizacao);
    $sql->bindValue(':status', $status);
    $sql->execute();

    if ($sql->rowCount()>0) {
        echo "Atividade cadastrada com sucesso!";
    }else{
        header("Location: adiciona.php");
    }
}else{
    header("Location: adiciona.php");
    exit;
}

?>

<h2><a href="./logar.php">Retorne ao login!</h2>