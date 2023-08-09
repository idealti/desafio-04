<?php
require 'conexao.php';

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
}else{
    header("Login.php");
}

$lista = [];
$sql = $pdo->query("SELECT * FROM sistema.atividades");

if($sql->rowCount()>0){
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC); 
}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Todo-App</title>
</head>
<body>

    <header class="menu">
    <h2><a href="./cadastraratividades.php">CADASTRAR ATIVIDADES</h2>
    <h2><a href="./login.php">SAIR</a></h2>
    </header>

    <section id="atividades">
        <fieldset>GERECIAMENTO DE ATIVIDADES<br><br>
        <table border="1" width="100%">
            <tr>
                <td>ID</td>
                <td>TITULO</td>
                <td>DESCRIÇÃO</td>
                <td>DATA DE CRIAÇÃO</td>
                <td>DATA DE FINALIZAÇÃO</td>
                <td>STATUS</td>
                <td>OPÇÕES</td>
            </tr>

            <?php foreach ($lista as $atualizado): ?>

<tr>
    <td><?php echo $atualizado['id'] ?></td>
    <td><?php echo $atualizado['titulo'] ?></td>
    <td><?php echo $atualizado['descricao'] ?></td>
    <td><?php echo $atualizado['data'] ?></td>
    <td><?php echo $atualizado['finalizacao'] ?></td>
    <td><?php echo $atualizado['status'] ?></td>
    <td>
        <a href="editaratividades.php?id=<?=$atualizado['id'];?>">[Editar]</a>
        <a href="excluiratividade.php?id=<?=$atualizado['id'];?>" onclick="return confirm('Tem certeza que deseja excluir?')">[Excluir]</a>
    </td>
</tr>

<?php endforeach; ?>
        </table>
        </fieldset>

        </section>

    
</body>
</html>
