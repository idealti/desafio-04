<?php
// Arquivo delete_task.php

// Verifica se a requisição foi feita através do método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifica se o parâmetro "task_id" foi recebido na requisição
    if (isset($_POST["task_id"])) {
        // Obtenha o ID da tarefa do parâmetro "task_id"
        $taskId = $_POST["task_id"];

        // Recupera a conexão do arquivo connection.php
        require_once '../db/connection.php';

        // Exclui a tarefa do banco de dados
        $sql = "DELETE FROM tasks WHERE id = $taskId";

        if ($conn->query($sql) === FALSE) {
            // Exibe uma mensagem de erro em caso de falha na exclusão
            echo "Erro ao excluir a tarefa: " . $conn->error;
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
