<div class="modal" tabindex="-1" id="editTask">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar tarefa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>