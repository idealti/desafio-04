<?php
session_start();
include_once "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>editar tarefa</title>
</head>

<body>

    <h1>Editar Tarefa</h1>

    <?php

    $id = $_GET['id'];
    $sql = "SELECT * FROM todoUsuario WHERE id = '$id'";

    $result = $conn->query($sql);
    $linhas = mysqli_fetch_assoc($result);
    $tarefa = $linhas['tarefa'];


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //print_r($_POST);
        
        $todo_name = $_POST['todo_name'];
        $id_registro = $_POST['id_registro'];
        $up = "UPDATE todoUsuario SET tarefa='$todo_name' WHERE id=$id_registro";
        
        $result = $conn->query($up);
        
        if ($result) {
            echo "<script>alert('atualizado com sucesso!'); window.location.href='editar.php?id=$id_registro';</script>";
        } else {
            echo "Aviso: Não foi atualizado!";
        }
    }

    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div style="margin-botton: 20px;">
            <input type="text" name="todo_name" value="<?= $tarefa; ?>">
            <input type="hidden" name="id_registro" value="<?=$id ?>">
            
            <button>Editar Tarefa</button><a href="task.php">Voltar</a>

        </div>

    </form>








</body>

</html>