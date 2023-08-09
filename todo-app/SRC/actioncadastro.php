<?php

require 'conexao.php';

$name = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');

if ($name && $email && $senha) {
    $sql = $pdo->prepare("INSERT INTO sistema.cadastro (nome, email, senha) VALUES (:nome, :email, :senha)");
    $sql->bindValue(':nome', $name);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':senha', $senha);
    $sql->execute();

    

if ($sql->rowCount()>0) {
    echo "Usuário cadastrado com sucesso";
}else{
    header("Location: adiciona.php");
}

}else{
    header("Location: adiciona.php");
}

?>

<h2><a href="./login.php">Retorne ao login!</h2>