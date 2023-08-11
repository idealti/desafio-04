<?php include __DIR__ . '/../header.php' ?>

<div class="col-xs-12 col-sm-12 col-md-8 col-lg-4 col-xl-4">
    <h1 class="text-center"><?php echo $title; ?></h1>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?php echo $_SESSION['messageType'] ?> d-flex gap-2 align-items-center" role="alert">
            <div>
                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
        </div>
    <?php } ?>

    <?php if (isset($errorLogin)) { ?>
        <div class="alert alert-danger d-flex gap-2 align-items-center" role="alert">
            <div>
                Email ou senha incorretos.
            </div>
        </div>
    <?php } ?>

    <form action="/do-login" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="row">
            <div class="col d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary">Login</button>
                <a class="float-end" href="/register">Cadastre-se</a>
            </div>
    </form>
</div>

<?php include __DIR__ . '/../footer.php' ?>