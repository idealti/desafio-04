<?php
// Arquivo add_task.php

// Verifica se a requisição foi feita através do método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera a conexão do arquivo connection.php
    require_once '../db/connection.php';

    // Obtém os dados enviados pelo formulário
    $taskTitle = $_POST["task_title"];
    $taskDescription = $_POST["task_description"];
    $taskCreatedAt = $_POST["task_created_at"];
    $taskStatus = $_POST["task_status"];

    // Prepara os dados para inserção no banco de dados (evita SQL injection)
    $taskTitle = $conn->real_escape_string($taskTitle);
    $taskDescription = $conn->real_escape_string($taskDescription);
    $taskCreatedAt = $conn->real_escape_string($taskCreatedAt);
    $taskStatus = $conn->real_escape_string($taskStatus);

    // Insere a tarefa no banco de dados
    $sql = "INSERT INTO tasks (task_title, task_description, created_at, status) 
            VALUES ('$taskTitle', '$taskDescription', '$taskCreatedAt', '$taskStatus')";

    if ($conn->query($sql) === TRUE) {
        // Redireciona para a página inicial
        header('Location: /');
    } else {
        echo "Erro ao adicionar tarefa: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
