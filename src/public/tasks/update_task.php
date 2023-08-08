<?php

// Verifica se a requisição foi feita através do método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o parâmetro "task_id" foi recebido na requisição
    if (isset($_POST["task_id"])) {
        // Obtenha o ID da tarefa do parâmetro "task_id"
        $taskId = $_POST["task_id"];

        // Obtenha os novos dados da tarefa do formulário
        $newTaskTitle = $_POST["task_title"];
        $newTaskDescription = $_POST["task_description"];
        $newTaskStatus = $_POST["task_status"];

        // Recupera a conexão do arquivo connection.php
        require_once '../db/connection.php';

        // Atualiza os dados da tarefa no banco de dados
        $sql = "UPDATE tasks SET task_title = '$newTaskTitle', task_description = '$newTaskDescription', status = '$newTaskStatus' WHERE id = $taskId";

        if ($conn->query($sql) === TRUE) {
            // Redireciona de volta para a página inicial após a atualização
            header("Location: ../index.php?success=1");
            exit();
        } else {
            // Exibe uma mensagem de erro em caso de falha na atualização
            echo "Erro ao atualizar a tarefa: " . $conn->error;
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        // Caso o parâmetro "task_id" não tenha sido recebido, exibe uma mensagem de erro
        echo "Erro: parâmetro 'task_id' não fornecido na requisição.";
    }
} else {
    // Caso a requisição não tenha sido feita através do método POST, exibe uma mensagem de erro
    echo "Erro: método de requisição inválido.";
}
