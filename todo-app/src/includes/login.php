<?php

if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'error':
            $msg = '<div class="alert alert-danger">Login ou senha incorretos.</div>';
            break;
        case 'loggedout':
            $msg = '<div class="alert alert-danger">Operação não permitida, por favor faça o login.</div>';
            break;
    }
}

?>

<main>

    <div class='mt-3'>
        <?= $msg ?>
    </div>



    <form method='post'>


        <div class='container'>
            <div class='row'>
                <div class='col-12'>
                    <h2 class='mt-3'>LOGIN</h2>
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='form-group mb-3'>
                    <i class="fa-regular fa-envelope mr-3" style="color: #393c41;"></i>
                    <label>E-mail:</label>
                    <input type='text' class='form-control-sm' name='email'>
                </div>
                <div class='form-group'>
                    <i class="fa-solid fa-lock mr-3" style="color: #393c41;"></i>
                    <label>Senha:</label>
                    <input type='password' class='form-control-sm' name='password'>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3">
                    <button type='submit' class='btn btn-success'>ENTRAR</button>
                </div>
            </div>
        </div>
    </form>

</main>