<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Não tenho conta</title>
</head>
<body>

<form action="./actioncadastro.php" method="post">
        <fieldset>
        <legend><STRONG>CADASTRO</STRONG></legend>
        <p>
        <input type="text" name="nome" id="nome" placeholder="Digite seu nome" required>
        </p>
        <p>
        <input type="text" name="email" id="email" placeholder="Digite seu e-mail" required>
        </p>
        <p>
        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
        </p>
        <p>
        <button>CADASTRAR</button>
        </p>
        <p>
            <a href="./login.php">Retorne a página principal</a>
        </p>
        </fieldset>
 </form>
    
</body>
</html>