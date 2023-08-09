<main>


    <div class="mt-3">
        <?= $msg ?>
    </div>

    <h2 class="mt-3"><?= TITLE ?></h2>
    <hr>

    <form method="post">
        <div class="form-group">
            <label>Título</label>
            <input type="text" class="form-control" name="title" value="<?= $obTask->title ?>">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea class="form-control" name="description" rows="4"><?= $obTask->description ?></textarea>
        </div>

        <div class="form-group">
            <label>Status</label>

            <div>
                <div class="form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="completed" value="n" checked>Pendente
                    </label>
                </div>

                <div class="form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="completed" value="s" <?= $obTask->is_completed == 's' ? 'checked' : '' ?>>Concluido
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success mt-2 mb-2">Enviar</button>
        </div>

    </form>
</main>