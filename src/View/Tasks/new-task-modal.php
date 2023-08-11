<div class="modal" tabindex="-1" id="newTask">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nova tarefa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/do-register-task" method="post">
                    <div class="mb-3">
                        <label for="taskTitle" class="form-label">Título</label>
                        <input type="text" class="form-control" name="taskTitle" id="taskTitle" placeholder="Ser aprovado na entrevista">
                    </div>
                    <div class="mb-3">
                        <label for="taskDescription" class="form-label">Descrição</label>
                        <textarea class="form-control" name="taskDescription" id="taskDescription" rows="3"></textarea>
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