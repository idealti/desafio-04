<?php include __DIR__ . '/../header.php' ?>

<div class="col-xs-12 col-sm-12 col-md-8 col-lg-4 col-xl-4">
    <h1 class="text-center"><?php echo $title; ?></h1>

    <form action="/do-edit-task?id=<?php echo $task->getId() ?>" method="post">
        <div class="mb-3">
            <label for="taskTitle" class="form-label">Título</label>
            <input type="text" class="form-control" name="taskTitle" id="taskTitle" value="<?php echo $task->getTitle(); ?>">
        </div>
        <div class="mb-3">
            <label for="taskDescription" class="form-label">Descrição</label>
            <textarea class="form-control" name="taskDescription" id="taskDescription" rows="3"><?php echo $task->getDescription(); ?></textarea>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-between">
                <a href="/tasks" role="button" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../footer.php' ?>