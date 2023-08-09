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

if (isset($_POST['task'])) {
    $taskName = $_POST['taskName'];
    $completionDate = new DateTime($_POST['completionDate']);
    $description = $_POST['description'];

    $task = new Task(null, $taskName, null, $completionDate, $description, $user->getId(), new DateTime());
    
    $taskRepository->store($task);

    header("Location: index.php");
}

$tasks = $taskRepository->indexAll($user->getId());

$modalTask = null;
if (isset($_POST['edit'])) {
    $taskId = $_POST['id'];
    $modalTask = $taskRepository->index($taskId);
}

$statusFilter = $_GET['status'] ?? null;
$creationDateFilter = $_GET['creationDate'] ?? null;

$tasks = $taskRepository->indexAll($user->getId());

if ($statusFilter !== null) {
    $tasks = $taskRepository->indexFilteredByStatus($user->getId(), $statusFilter);
}

if ($creationDateFilter !== null) {
    $tasks = $taskRepository->indexFilteredByCreationDate($user->getId(), $creationDateFilter);
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
                    <span class=" navbar-toggler-icon"></span>
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
            <div">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newTaskModal">Nova
                    Tarefa</button>
                <a href="index.php" class="btn btn-secondary ml-2">Limpar Filtros</a>
        </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <form class="form-inline d-flex align-items-center justify-content-between" method="get"
                        action="index.php">
                        <div class="form-group mr-2 w-75">
                            <label for="status" class="mr-2">Filtrar por Status:</label>
                            <select class="form-control" name="status" id="status">
                                <option value="not_completed">Pendente</option>
                                <option value="completed">Concluída</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary align-self-end">Filtrar</button>
                    </form>
                </div>
                <div class="col-md-6 mb-3">
                    <form class="form-inline d-flex align-items-center justify-content-between" method="get"
                        action="index.php">
                        <div class="form-group mr-2 w-75">
                            <label for="creationDate" class="mr-2">Filtrar por Data de Criação:</label>
                            <input type="date" class="form-control" name="creationDate" id="creationDate">
                        </div>
                        <button type="submit" class="btn btn-primary align-self-end">Filtrar</button>
                    </form>
                </div>
            </div>
        </div>
        <section class=" container mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Status</th>
                        <th scope="col">Data de criação</th>
                        <th scope="col">Data de entrega</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task):?>
                    <tr>
                        <th scope=" row">
                            <a class="text-decoration-none"
                                href="details.php?id=<?= $task->getId()?>"><?= $task->getTaskName()?></a>
                        </th>
                        <td><?= $task->getStatus() === 'not_completed' ? 'Pendente' : 'Concluída' ?></td>
                        <td><?= $task->getCreationDate()->format('d/m/Y') ?></td>
                        <td><?= $task->getCompletionDate()->format('d/m/Y') ?></td>
                        <td class="d-flex">
                            <form action="check-task.php" method="post">
                                <input type="hidden" name="id" value="<?= $task->getId() ?>">
                                <button <?= $task->getStatus() === 'not_completed' ? '' : 'disabled' ?> class="btn icon"
                                    data-bs-toggle="tooltip" title="Marcar como concluído">✅</button>
                            </form>
                            <form action=" delete-task.php" method="post">
                                <input type="hidden" name="id" value="<?= $task->getId() ?>">
                                <button type="submit" class="btn icon" data-bs-toggle="tooltip"
                                    title="Excluir">❌</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

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
                                <label for="description" required class="form-label">Descrição da
                                    tarefa</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>

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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
    let myModal = new bootstrap.Modal(document.getElementById('newTaskModal'));
    </script>
</body>

</html>