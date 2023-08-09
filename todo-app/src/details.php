<?php

require "connection.php";
require "Repository/UserRepository.php";
require "Repository/TaskRepository.php";

if (!isset($_COOKIE["auth_token"])) {
    header("Location: login.php");
    exit;
}

$authToken = $_COOKIE["auth_token"];
$userRepository = new UserRepository($conn);
$user = $userRepository->findByToken($authToken);

$errorMessage = null;

if (!$user) {
    header("Location: login.php");
    exit;
}

$taskRepository = new TaskRepository($conn);

$task = $taskRepository->index($_GET['id']);

if (isset($_POST['updateTask'])) {
    $task->setTaskName($_POST['taskName']);
    $task->setCompletionDate($_POST['completionDate']);
    $task->setDescription($_POST['description']);

    $taskRepository->update($task);

    header("Location: details.php?id=" . $task->getId());
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>TO DO</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">TO DO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container d-flex justify-content-between p-4">
            <h2>Suas tarefas</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newTaskModal"
                <?= $task->getStatus() === 'not_completed' ? '' : 'disabled' ?>>Editar Tarefa</button>
        </div>

        <section class="container">
            <p>Título: <?=  $task->getTaskName()?></p>
            <p>Status: <?= $task->getStatus() === 'not_completed' ? 'Pendente' : 'Concluída' ?></p>
            <p>Data de entrega: <?=$task->getCompletionDate()->format('d/m/Y')?></p>
            <p>Descrição: <?=  $task->getDescription()?></p>

        </section>

        <div class="modal fade" id="newTaskModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edite a tarefa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="p-4" action="details.php?id=<?= $task->getId()?>">
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Título da tarefa</label>
                                <input type="text" required class="form-control" id="taskName" name="taskName"
                                    placeholder="Adicione o título aqui" value="<?=  $task->getTaskName()?>">
                            </div>
                            <div class="mb-3">
                                <label for="completionDate" class="form-label">Data de conclusão</label>
                                <input type="date" required class="form-control" id="completionDate"
                                    name="completionDate" value="<?=$task->getCompletionDate()->format('Y-m-d')?>">
                            </div>
                            <div class="mb-3">
                                <label for="description" required class="form-label">Descrição da tarefa</label>
                                <textarea class="form-control" id="description" name="description"
                                    rows="3"><?=$task->getDescription()?></textarea>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button name="updateTask" type="submit" class="btn btn-primary w-75">Salvar</button>
                            </div>
                        </form>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary w-75"
                                data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="newTaskModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nova Tarefa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="index.php" class="p-4">
                                <div class="mb-3">
                                    <label for="taskName" class="form-label">Título da tarefa</label>
                                    <input type="text" required class="form-control" id="taskName" name="taskName"
                                        placeholder="Adicione o título aqui">
                                </div>
                                <div class="mb-3">
                                    <label for="completionDate" class="form-label">Data de conclusão</label>
                                    <input type="date" required class="form-control" id="completionDate"
                                        name="completionDate">
                                </div>
                                <div class="mb-3">
                                    <label for="description" required class="form-label">Descrição da tarefa</label>
                                    <textarea class="form-control" id="description" name="description"
                                        rows="3"></textarea>

                                </div>
                                <div class="d-flex justify-content-center">
                                    <button name="task" type="submit" class="btn btn-primary w-75">Salvar</button>
                                </div>
                            </form>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary w-75"
                                    data-bs-dismiss="modal">Cancelar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editTaskModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edite Tarefa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="index.php" class="p-4">
                                <div class="mb-3">
                                    <label for="taskName" class="form-label">Título da tarefa</label>
                                    <input type="text" required class="form-control" id="taskName" name="taskName"
                                        placeholder="Adicione o título aqui">
                                </div>
                                <div class="mb-3">
                                    <label for="completionDate" class="form-label">Data de conclusão</label>
                                    <input type="date" required class="form-control" id="completionDate"
                                        name="completionDate">
                                </div>
                                <div class="mb-3">
                                    <label for="description" required class="form-label">Descrição da tarefa</label>
                                    <textarea class="form-control" id="description" name="description"
                                        rows="3"></textarea>

                                </div>
                                <div class="d-flex justify-content-center">
                                    <button name="task" type="submit" class="btn btn-primary w-75">Salvar</button>
                                </div>
                            </form>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary w-75"
                                    data-bs-dismiss="modal">Cancelar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
    let myModal = new bootstrap.Modal(document.getElementById('newTaskModal'));
    </script>
</body>

</html>