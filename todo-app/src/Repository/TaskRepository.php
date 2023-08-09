<?php

require "Model/Task.php";

class TaskRepository
{
    private mysqli $mysqli;

    /**
     * @param mysqli $mysqli
     */
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function store(Task $task)
    {
        $sql = "INSERT INTO tasks(task_name, completion_date, description, user_id, creation_date) VALUES (?,?,?,?, NOW())";

        $taskName = $task->getTaskName();
        $completionDate = $task->getCompletionDate()->format('Y-m-d H:i:s');
        $description = $task->getDescription();
        $userId = $task->getUserId();

        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("sssi", $taskName, $completionDate, $description, $userId);

        $statement->execute();
    }

    public function index(int $id): Task
    {
        $sql = "SELECT * FROM tasks WHERE id = ?";

        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows === 1) {
            $task = $result->fetch_assoc();
            return new Task(
                $task['id'],
                $task['task_name'],
                $task['status'],
                new DateTime($task['completion_date']),
                $task['description'],
                $task['user_id'],
                new DateTime($task['creation_date'])
            );
        }

        return null;
    }

    public function indexAll(int $userId): array
    {
        $sql = "SELECT * FROM tasks WHERE user_id = ?";
    
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("i", $userId);
        $statement->execute();
        $result = $statement->get_result();
    
        $tasks = [];
    
        foreach ($result as $value) {
            $tasks[] = new Task(
                $value['id'],
                $value['task_name'],
                $value['status'],
                new DateTime($value['completion_date']),
                $value['description'],
                $value['user_id'],
                new DateTime($value['creation_date'])
            );
        }
    
        return $tasks;
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM tasks WHERE id = ?";
        
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("i", $id);

        $statement->execute();
    }

    public function update(Task $task)
    {
        $sql = "UPDATE tasks 
                SET task_name = ?, completion_date = ?, description = ?
                WHERE id = ?";
        
        $taskName = $task->getTaskName();
        $completionDate = $task->getCompletionDate()->format('Y-m-d');
        $description = $task->getDescription();
        $taskId = $task->getId();
        
        $statement = $this->mysqli->prepare($sql);
        
        $statement->bind_param("sssi", $taskName, $completionDate, $description, $taskId);
        
        $statement->execute();
    }
    

    public function checkTask(int $id)
    {
        $sql = "UPDATE tasks SET status = ? WHERE id = ?";

        $statement = $this->mysqli->prepare($sql);

        $status = 'completed';

        $statement->bind_param("si", $status, $id);

        $statement->execute();
    }

    public function indexFiltered(int $userId, ?string $status, ?string $creationDate): array
    {
        $sql = "SELECT * FROM tasks WHERE user_id = ?";
    
        $params = array($userId);
        $paramTypes = 'i'; 
    
        if ($status !== null) {
            $sql .= " AND status = ?";
            $params[] = $status;
            $paramTypes .= 's'; 
        }
    
        if ($creationDate !== null) {
            $sql .= " AND DATE(creation_date) = ?";
            $params[] = $creationDate;
            $paramTypes .= 's';
        }
    
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param($paramTypes, ...$params);
        $statement->execute();
        $result = $statement->get_result();
    
        $tasks = [];
    
        foreach ($result as $value) {
            $tasks[] = new Task(
                $value['id'],
                $value['task_name'],
                $value['status'],
                new DateTime($value['completion_date']),
                $value['description'],
                $value['user_id'],
                new DateTime($value['creation_date'])
            );
        }
    
        return $tasks;
    }

    public function indexFilteredByStatus(int $userId, ?string $status): array
    {
        $sql = "SELECT * FROM tasks WHERE user_id = ?";
        $params = array($userId);

        if ($status !== null) {
            $sql .= " AND status = ?";
            $params[] = $status;
        }

        $statement = $this->mysqli->prepare($sql);

        if ($status !== null) {
            $types = str_repeat('s', count($params));
            $statement->bind_param($types, ...$params);
        } else {
            $statement->bind_param('i', $userId);
        }

        $statement->execute();
        $result = $statement->get_result();

        $tasks = [];

        foreach ($result as $value) {
            $tasks[] = new Task(
                $value['id'],
                $value['task_name'],
                $value['status'],
                new DateTime($value['completion_date']),
                $value['description'],
                $value['user_id'],
                new DateTime($value['creation_date'])
            );
        }

        return $tasks;
    }

    public function indexFilteredByCreationDate(int $userId, ?string $creationDate): array
    {
        $sql = "SELECT * FROM tasks WHERE user_id = ?";

        if ($creationDate !== null) {
            $sql .= " AND DATE(creation_date) = ?";
        }

        $statement = $this->mysqli->prepare($sql);

        if ($creationDate !== null) {
            $statement->bind_param("is", $userId, $creationDate);
        } else {
            $statement->bind_param("i", $userId);
        }

        $statement->execute();
        $result = $statement->get_result();

        $tasks = [];

        foreach ($result as $value) {
            $tasks[] = new Task(
                $value['id'],
                $value['task_name'],
                $value['status'],
                new DateTime($value['completion_date']),
                $value['description'],
                $value['user_id'],
                new DateTime($value['creation_date'])
            );
        }

        return $tasks;
    }
}