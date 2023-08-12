<?php
session_start();
include_once "connection.php";

?>

<?php
$todos = [];
if (file_exists('todo.json')) {
    $json = file_get_contents('todo.json');
    $todos = json_decode($json, true);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Tarefas</title>
</head>

<body>

    <?php

    echo "Olá, " . $_SESSION['nome'];

    ?>


    <form method="post" action="novotodo.php">
        <div style="margin-botton: 20px;">
            <table id="customers">
                <th>
                    <input type="text" name="tarefa" placeholder="Digite sua tarefa">
                    <button class="button" >Nova Tarefa</button>
                </th>
                    
            </table>
            
        </div>

    </form>


    <?php
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM todoUsuario WHERE id_usuario = '$id'";

    $result = $conn->query($sql);
    if ($result) {
        ?>

        <table id="customers"></br>
            <tr>
             
                <th>tarefa</th>
                <th>status</th>
                <th>Data criação</th>
                <th>Ações</th>
            </tr>

            <?php while ($linhas = mysqli_fetch_assoc($result)) { ?>
                <tr>
                   
                    <td>
                        <?php echo $linhas['tarefa']; ?>
                    </td>
                    <td><input type="checkbox" onclick="qualquernome('<?php echo $linhas['id']; ?>') "
                            name="<?php echo $linhas['id']; ?>" value="1" <?php echo ($linhas['todo_status'] == 2) ? "checked" : "" ?>>Feito</td>
                    <td>
                        <?php echo $linhas['data_criacao']; ?>
                    </td>
                    <td><a href="editar.php?id=<?php echo $linhas['id']; ?>" class="button" >Editar </a> 
                    <a href="delet.php?id=<?php echo $linhas['id']; ?>" class="button" > Delete</a></td>
                </tr>
            <?php } ?>
                
        </table>
    <?php

    } else {
        echo 'Sem tarefas';
    }

    ?>
    <button class="button" ><a href="sair.php" class="button">Sair</a></button>

    <script>
        function qualquernome(id) {
            window.location.href = "updatestatus.php?id=" + id;
        }
    </script>
</body>

</html>