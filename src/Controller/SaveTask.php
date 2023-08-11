<?php

namespace TodoApp\Controller;

use TodoApp\Helper\FlashMessageTrait;
use TodoApp\Infrastructure\DB\ConnectionCreator;

class SaveTask implements RequestControllerInterface
{
    use FlashMessageTrait;

    public function handle(): void
    {
        $currentUserId = (int)$_SESSION['user'];
        $connection = (new ConnectionCreator())->createConnection();

        $taskTitle = filter_input(INPUT_POST, 'taskTitle', FILTER_UNSAFE_RAW);
        $taskDescription = filter_input(INPUT_POST, 'taskDescription', FILTER_UNSAFE_RAW);

        $statement = $connection->prepare(
            'INSERT INTO task (iduser, title, description, created_at, status) VALUES (?, ?, ?, NOW(), 1)'
        );

        $statement->bind_param(
            'iss',
            $currentUserId,
            $taskTitle,
            $taskDescription
        );

        $statement->execute();

        $this->showMessage('success', 'Tarefa criada com sucesso!');
        http_response_code(201);
        header('Location: /tasks');
        exit();
    }
}