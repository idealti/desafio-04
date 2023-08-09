<?php
require 'conexao.php';

$info = [];
$id = filter_input(INPUT_GET, 'id');

if ($id) {
    $sql = $pdo->prepare("SELECT * FROM sistema.atividades WHERE id =:id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    if ($sql->rowCount()>0) {
        $info = $sql->fetch(PDO::FETCH_ASSOC);
    }else{
        header("Location: adiciona.php");
        exit; 
    }
}else{
         header("Location: adiciona.php");
         exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>EDITAR ATIVIDADES</title>
</head>
<body>
    <section id="demandas">
        <fieldset>EDITAR ATIVIDADES
        <form action="actioneditaratividades.php" method="post">
            <input type="hidden" name="id" value="<?=$info['id']; ?>">
            <label for="">TITULO
                <input type="text" name="titulo" id="titulo" value="<?=$info['titulo']; ?>">
            </label>
            <label for="">DESCRIÇÃO
                <input type="text" name="descricao" id="descricao" value="<?=$info['descricao']; ?>">
            </label>
            <label for="">DATA DA CRIAÇÃO
                <input type="date" name="data" id="data" value="<?=$info['data']; ?>">
            </label>
            <label for="">DATA DA FINALIZAÇÃO
                <input type="datetime-local" name="finalizacao" id="finalizacao" value="<?=$info['finalizacao']; ?>">
            </label>
            <label for="">STATUS
                <input type="text" name="status" id="status" value="<?=$info['status']; ?>">
            </label>
            <button>SALVAR EDIÇÃO</button>
        </form>
    </fieldset>
    </section>
</body>
</html>