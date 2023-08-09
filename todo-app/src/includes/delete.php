<main>

    <h2 class="mt-3">Excluir TASK</h2>

    <form method="post">
        <div class="form-group">
            <p>Você deseja realmente excluir a tarefa <strong><?=$obTask->title?></strong>?</p>
        </div>

        <div class="form-group">
            <a href="home.php">
                <button type ="button" class="btn btn-success">Cancelar</button>
            </a>
            <button type="submit" name="delete" class="btn btn-danger mt-2 mb-2">Excluir</button>
        </div>

    </form>
</main>