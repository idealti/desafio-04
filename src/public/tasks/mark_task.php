<?php
// Arquivo mark_task.php

// Verifica se a requisição foi feita através do método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os parâmetros "task_id" e "action" foram recebidos na requisição
    if (isset($_POST["task_id"]) && isset($_POST["action"])) {
        // Obtenha o ID da tarefa e a ação do parâmetro
        $taskId = $_POST["task_id"];
        $action = $_POST["action"];

        // Recupera a conexão do arquivo connection.php
        require_once '../db/connection.php';

        // Verifica a ação e define o novo status da tarefa
        $newStatus = ($action === 'concluir') ? 'concluida' : 'pendente';

        // Atualiza o status da tarefa no banco de dados
        $sql = "UPDATE tasks SET status = '$newStatus' WHERE id = $taskId";

        if ($conn->query($sql) === TRUE) {
            // Envie uma resposta de sucesso para o JavaScript
            echo "Tarefa atualizada com sucesso!";
        } else {
            // Envie uma resposta de erro para o JavaScript
            echo "Erro ao atualizar tarefa: " . $conn->error;
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        // Caso os parâmetros não tenham sido recebidos, envie uma resposta de erro para o JavaScript
        echo "Erro: parâmetros inválidos na requisição.";
    }
}
?>