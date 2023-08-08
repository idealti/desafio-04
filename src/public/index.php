<?php
session_start();

// Verifica se o usuário está logado, caso contrário, redireciona para a página de login
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}
// Incluir o arquivo de conexão
require_once './db/connection.php';
require_once './functions/functions.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <!-- Inclua o arquivo CSS do Bootstrap aqui ou use um CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">

    <script src="https://kit.fontawesome.com/2a52b00cee.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        console.log("Easter egg: Você é um recrutador curioso! 😄");
    </script>
</head>

<body class="d-flex flex-column min-vh-100" style="background: url('../images/background-login.jpg') no-repeat center center fixed; background-size: cover;">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Gerenciador de Tarefas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 content">
        <!-- Botão para abrir a modal de criação de tarefa -->
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTaskModal">Nova tarefa</button>
            </div>
        </div>

        <!-- Modal de Criação de Tarefa -->
        <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTaskModalLabel">Adicionar uma nova tarefa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulário para adicionar tarefa -->
                        <form action="tasks/add_task.php" method="post">
                            <div class="mb-3">
                                <label for="task_title" class="form-label">Título</label>
                                <input type="text" class="form-control task_title" name="task_title" id="task_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="task_description" class="form-label">Descrição</label>
                                <textarea class="form-control" name="task_description" id="task_description" rows="3" required></textarea>
                            </div>
                            <input type="hidden" name="task_created_at" value="<?= date('Y-m-d H:i:s'); ?>">
                            <div class="mb-3">
                                <label for="task_status" class="form-label">Status</label>
                                <select class="form-select" name="task_status" id="task_status" required>
                                    <option value="pendente">Pendente</option>
                                    <option value="concluída">Concluída</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ordenação -->
        <div class="row mt-4">
            <div class="col-md-8 offset-md-2 mb-3">
                <form action="" method="get" class="d-flex">
                    <div class="input-group">
                        <label for="sort" class="input-group-text">Ordenar por:</label>
                        <select name="sort" id="sort" class="form-select">
                            <option value="date">Data de criação</option>
                            <option value="status">Status</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Ordenar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista de tarefas -->
        <div class="row mt-4 mb-5">
            <!-- Verifica se há uma mensagem de sucesso na URL -->
            <?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
                <div class="col-md-8 offset-md-2 alert alert-success alert-dismissible fade show" role="alert">
                    Tarefa atualizada com sucesso!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php
            // Escreva o código para listar as tarefas aqui
            $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'date';

            if ($sortOption === 'date') {
                $sql = "SELECT * FROM tasks ORDER BY created_at DESC";
            } elseif ($sortOption === 'status') {
                $sql = "SELECT * FROM tasks ORDER BY status DESC";
            }

            $result = $conn->query($sql);
            $tasks = $result->fetch_all(MYSQLI_ASSOC);
            ?>

            <div class="col-md-8 offset-md-2">
                <ul class="list-group">
                    <?php if (count($tasks) > 0) { ?>
                        <?php foreach ($tasks as $task) : ?>
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <span class="badge <?= getTaskBackgroundColor($task['status']) ?> span-status"><?= $task['status'] ?></span>
                                        <a href="#" class="mt-2 task-title text-decoration-none text-dark fw-bold" data-bs-toggle="modal" data-bs-target="#viewModal<?= $task['id']; ?>"><?= $task['task_title']; ?></a>
                                    </div>
                                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-clock me-1"></i>
                                            <?= date('d/m/Y H:i', strtotime($task['created_at'])); ?>
                                        </p>
                                        <div class="d-flex justify-content-md-end">
                                            <a href="#" class="btn btn-warning btn-sm me-2 text-white" data-bs-toggle="modal" data-bs-target="#editModal<?= $task['id']; ?>">Editar</a>

                                            <?php
                                            // Defina o texto e a ação do botão com base no status da tarefa
                                            $buttonText = ($task['status'] == 'concluida') ? 'Desmarcar' : 'Concluir';
                                            $action = ($task['status'] == 'concluida') ? 'desmarcar' : 'concluir';
                                            ?>

                                            <a class="btn btn-sm btn-concluir <?= ($task['status'] == 'concluida') ? 'btn-danger' : 'btn-success'; ?>" data-task-id="<?= $task['id'] ?>" data-action="<?= ($task['status'] == 'concluida') ? 'desmarcar' : 'concluir'; ?>">
                                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                <?= ($task['status'] == 'concluida') ? 'Desmarcar' : 'Concluir'; ?>
                                            </a>
                                            <a class="btn btn-danger btn-sm btn-excluir ms-2" data-task-id="<?= $task['id'] ?>" onclick="confirm('Tem certeza?')">Excluir</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal de Edição -->
                                <div class="modal fade" id="editModal<?= $task['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Editar Tarefa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulário para edição da tarefa -->
                                                <form action="tasks/update_task.php" method="post">
                                                    <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                                                    <div class="mb-3">
                                                        <label for="task_title" class="form-label">Título</label>
                                                        <input type="text" class="form-control" name="task_title" id="task_title" value="<?= $task['task_title']; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="task_description" class="form-label">Descrição</label>
                                                        <textarea class="form-control" name="task_description" id="task_description" rows="3" required><?= $task['task_description']; ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="task_status" class="form-label">Status</label>
                                                        <select class="form-select" name="task_status" id="task_status" required>
                                                            <option value="pendente" <?= ($task['status'] === 'pendente') ? 'selected' : ''; ?>>Pendente</option>
                                                            <option value="concluída" <?= ($task['status'] === 'concluída') ? 'selected' : ''; ?>>Concluída</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- Modal de Visualização -->
                            <div class="modal fade" id="viewModal<?= $task['id']; ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel"><?= $task['task_title']; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><?= $task['task_description']; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="d-block mt-2 text-center">
                                        Nenhuma tarefa encontrada.
                                    </span>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

    </div>

    <!-- Rodapé fixo na parte inferior -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2023 Todo App - Criado por Israel</p>
    </footer>

    <!-- Inclua o jQuery antes do seu código JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- app.js -->
    <script src="./js/app.js"></script>

    <!-- Inclua o arquivo JavaScript do Bootstrap aqui ou use um CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>