<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>LOGIN</title>
</head>
<body>

<form action="./logar.php" method="post">
        <fieldset>
        <legend><STRONG>LOGIN</STRONG></legend>
        <p>
        <input type="text" name="email" id="email" placeholder="Digite seu e-mail" require>
        </p>
        <p>
        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" require>
        </p>
        <p>
        <input type="submit" value="ENTRAR">
        </p>
        <p>
            <a href="./cadastro.php">Não tenho conta</a>
        </p>
        </fieldset>
 </form>
    
</body>
</html>