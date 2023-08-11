<?php include __DIR__ . '/../header.php' ?>

<?php include __DIR__ . '/new-task-modal.php' ?>

<div class="col-8">
    <h1 class="text-center"><?php echo $title; ?></h1>

    <div class="row align-items-center">
        <div class="col">
            <button type="button" class="btn btn-outline-primary my-3" data-bs-toggle="modal" data-bs-target="#newTask">Criar nova tarefa</button>
        </div>

        <div class="col text-end">
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Ordenar por
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="/tasks?orderBy=created_at&order=asc">
                            Data
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up" viewBox="0 0 16 16">
                                <path d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/tasks?orderBy=created_at&order=desc">
                            Data
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                                <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                            </svg>
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="/tasks?orderBy=status&order=asc">Status</a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?php echo $_SESSION['messageType'] ?> alert-dismissible d-flex gap-2 align-items-center" role="alert">
            <div>
                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
        </div>
    <?php } ?>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        <a class="link-opacity-75" href="/tasks?orderBy=id&order=asc">#</a>
                    </th>
                    <th scope="col">Título</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Status</th>
                    <th scope="col">Criada em</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tasks as $task) { ?>
                    <tr>
                        <th scope="row">
                            <?php echo $task->getId(); ?>
                        </th>

                        <td>
                            <?php echo $task->getTitle(); ?>
                        </td>

                        <td>
                            <div class="row">
                                <div class="col-10 text-truncate">
                                    <?php echo $task->getDescription(); ?>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="badge text-bg-<?php echo ($task->getStatus() === 'Concluído') ? 'success' : 'warning' ?>">
                                <?php echo $task->getStatus(); ?>
                            </span>
                        </td>

                        <td>
                            <?php echo $task->getCreatedAt(); ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                </svg>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/edit-task?id=<?php echo $task->getId() ?>">Editar</a></li>
                                <li><a class="dropdown-item link-success" href="/do-complete-task?id=<?php echo $task->getId() ?>">Concluir tarefa</a></li>
                                <li><a class="dropdown-item link-danger" href="/do-delete-task?id=<?php echo $task->getId() ?>">Excluir tarefa</a></li>
                            </ul>
                        </td>
                    </tr>

                    <?php include __DIR__ . '/edit-task-modal.php' ?>

                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../footer.php' ?>;