<?php

namespace TodoApp\Controller;

use TodoApp\Helper\FlashMessageTrait;
use TodoApp\Helper\HtmlRendererTrait;
use TodoApp\Infrastructure\DB\ConnectionCreator;
use TodoApp\Model\Task;

class UpdateTaskForm implements RequestControllerInterface
{
    use HtmlRendererTrait;

    public function handle(): void
    {

        $this->render('Tasks/edit-task-form.php', [
            'title' => 'Editar tarefa',
            'task' => $this->getTask()
        ]);
    }

    public function getTask(): Task
    {
        $taskId = (int)filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $connection = (new ConnectionCreator())->createConnection();
        $statement = $connection->prepare('SELECT * FROM task WHERE id = ?');
        $statement->bind_param('i', $taskId);

        $statement->execute();

        $result = $statement->get_result()->fetch_assoc();

        $task = new Task(
            $result['id'],
            $result['title'],
            $result['description'],
            $result['created_at'],
            $result['status']
        );

        return $task;
    }
}