<?php

namespace TodoApp\Controller;

use TodoApp\Helper\FlashMessageTrait;
use TodoApp\Infrastructure\DB\ConnectionCreator;

class DeleteTask implements RequestControllerInterface
{
    use FlashMessageTrait;

    public function handle(): void
    {
        $taskId = (int)filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $connection = (new ConnectionCreator())->createConnection();
        $statement = $connection->prepare('DELETE FROM task WHERE id = ?');
        $statement->bind_param('i', $taskId);

        $statement->execute();

        $this->showMessage('success', 'Tarefa excluída com sucesso!');
        header('Location: /tasks');
        exit();
    }
}