<?php

require "connection.php";
require "Repository/TaskRepository.php";

$produtoRepositorio = new TaskRepository($conn);
$produtoRepositorio->delete($_POST['id']);

header("Location: index.php");