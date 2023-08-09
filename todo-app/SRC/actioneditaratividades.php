<?php

require 'conexao.php';
$id = filter_input(INPUT_POST, 'id');
$titulo = filter_input(INPUT_POST, 'titulo');
$descricao = filter_input(INPUT_POST, 'descricao');
$data = filter_input(INPUT_POST, 'data');
$finalizacao = filter_input(INPUT_POST, 'finalizacao');
$status = filter_input(INPUT_POST, 'status');


if ($id && $titulo && $descricao && $data && $finalizacao && $status) {
    $sql = $pdo->prepare("UPDATE sistema.atividades SET titulo =:titulo, descricao =:descricao, data =:data, finalizacao =:finalizacao, status =:status WHERE id =:id ");
    $sql->bindValue(':id', $id);
    $sql->bindValue(':titulo', $titulo);
    $sql->bindValue(':descricao', $descricao);
    $sql->bindValue(':data', $data);
    $sql->bindValue(':finalizacao', $finalizacao);
    $sql->bindValue(':status', $status);
    $sql->execute();

    if ($sql->rowCount()>0) {
        echo "Edição finalizada com sucesso!";
    }else{
        header("Location: adiciona.php");
    }
}else{
    header("Location: adiciona.php");
    exit;
}

?>

<h2><a href="./logar.php">Retorne ao painel de atividades!</h2>