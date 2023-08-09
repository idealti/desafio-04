<main>

    <div class="mt-3">
        <?= $msg ?>
    </div>



    <h2 class="mt-3">Cadastro
        <hr>
    </h2>

    <form method="post">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>E-mail</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label>Repita a senha</label>
            <input type="password" class="form-control" name="password1">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success mt-2 mb-2">Enviar</button>
        </div>
    </form>
</main>