<?php

namespace TodoApp\Controller;

use TodoApp\Helper\HtmlRendererTrait;
use TodoApp\Infrastructure\DB\ConnectionCreator;
use TodoApp\Model\Task;

class ListTasks implements RequestControllerInterface
{
    use HtmlRendererTrait;

    public function handle(): void
    {
        $this->render('Tasks/tasks-list.php', [
            'title' => 'ToDo List',
            'tasks' => $this->getTasks()
        ]);
    }

    public function getTasks(): array
    {
        $orderBy = (isset($_GET['orderBy'])) ? "ORDER BY {$_GET['orderBy']}" : '';
        $order = ($_GET['order']) ?? '';

        $currentUserId = $_SESSION['user'];
        $taskList = [];
        $connection = (new ConnectionCreator())->createConnection();
        $result = $connection->query('SELECT * FROM task WHERE iduser = ' . $currentUserId . ' ' . $orderBy . ' ' . $order);

        while($row = $result->fetch_assoc()) {
            $taskList[] = new Task(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['created_at'],
                $row['status']
            );
        }

        return $taskList;
    }
}