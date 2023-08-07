<?php
$host = 'db';
$user = 'todo_user';
$password = 'todo';
$database = 'todo_db'; 

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
