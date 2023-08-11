<?php

namespace TodoApp\Infrastructure\DB;

use mysqli;

class ConnectionCreator
{
    private string $host = 'db';
    private string $user = 'todo_user';
    private string $password = 'password';
    private string $database = 'todo_db';

    public function createConnection(): mysqli
    {
        return new mysqli($this->host, $this->user, $this->password, $this->database);
    }
}