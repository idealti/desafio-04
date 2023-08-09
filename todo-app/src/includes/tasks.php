<?php

$msg = '';

if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $msg = '<div class="alert alert-success">Ação executada com sucesso!</div>';
            break;

        case 'error':
            $msg = '<div class="alert alert-danger">Ação não executada!</div>';
            break;
        case 'notallowed':
            $msg = '<div class="alert alert-danger">Operação não permitida!</div>';
            break;
    }
}


$results = '';
foreach ($tasks as $task) {
    $results .= '<tr>
                            <td>' . $task->id . '</td>
                            <td>' . $task->title . '</td>
                            <td>' . $task->description . '</td>
                            <td>' . date('d/m/Y', strtotime($task->date)) . '</td>
                            <td>' . ($task->is_completed == 's' ? 'Completo' : 'Pendente') . '</td>
                            <td>
                                <a href="edit.php?id=' . $task->id . '">
                                    <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="delete.php?id=' . $task->id . '">
                                    <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                            </td>
                    </tr>';
}

?>

<main>
    <div class="mt-3">
        <?= $msg ?>
    </div>


    <div class="mt-3">
        Bem vindo, <?= $_SESSION['name'] ?>
        <hr>
    </div>
    <section>
        <a href="register_task.php">
            <button class="btn btn-success  mt-5">Nova Tarefa</button>
        </a>
    </section>

    <section>

        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Descricao</th>
                    <th><a href="?sort=date" class="text-decoration-none">Data</a></th>
                    <th><a href="?sort=is_completed" class="text-decoration-none">Status</a></th>
                    <th>Acoes</th>
                </tr>
            </thead>
            <tbody>
                <?= $results ?>
            </tbody>
        </table>

    </section>
</main>