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

    <form action="/do-register-user" method="post">
        <div class="mb-3">
            <label for="name" class="form-label required">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label required">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label required">Senha</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

<?php include __DIR__ . '/../footer.php' ?>