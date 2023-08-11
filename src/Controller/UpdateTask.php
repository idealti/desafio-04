<?php

namespace TodoApp\Controller;

use TodoApp\Helper\FlashMessageTrait;
use TodoApp\Infrastructure\DB\ConnectionCreator;

class UpdateTask implements RequestControllerInterface
{
    use FlashMessageTrait;

    public function handle(): void
    {
        $taskId = (int)filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $taskTitle = filter_input(INPUT_POST, 'taskTitle', FILTER_UNSAFE_RAW);
        $taskDescription = filter_input(INPUT_POST, 'taskDescription', FILTER_UNSAFE_RAW);

        $connection = (new ConnectionCreator())->createConnection();
        $statement = $connection->prepare('UPDATE task SET title = ?, description = ? WHERE id = ?');
        $statement->bind_param('ssi', $taskTitle, $taskDescription, $taskId);

        $statement->execute();

        $this->showMessage('success', 'Tarefa atualizada com sucesso!');
        header('Location: /tasks');
        exit();
    }
}