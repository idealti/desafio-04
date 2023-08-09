<?php
$host = 'db';
$user = 'todo_user';
$password = 'todo';
$database = 'todo_db';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sqlCreateDatabase) === FALSE) {
    die('Criation failed: ' . $conn->connect_error);
}

$conn->select_db($database);

$sqlCreateUsersTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    token VARCHAR(255)
)";

if ($conn->query($sqlCreateUsersTable) === FALSE) {
    die('Criation failed: ' . $conn->connect_error);
}

$sqlCreateTasksTable = "CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255) NOT NULL,
    status TINYINT DEFAULT 0,
    completion_date DATE,
    description TEXT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
if ($conn->query($sqlCreateTasksTable) === FALSE) {
    die('Criation failed: ' . $conn->connect_error);
} 