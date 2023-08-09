<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CADASTRO DE ATIVIDADES</title>
</head>
<body>
    <section id="demandas">
        <fieldset> CADADASTRO DE ATIVIDADES<br><br>
        <form action="actionatividades.php" method="post">
            <label for="">TITULO
                <input type="text" name="titulo" id="titulo">
            </label>
            <label for="">DESCRIÇÃO
                <input type="text" name="descricao" id="descricao">
            </label>
            <label for="">DATA DA CRIAÇÃO
                <input type="date" name="data" id="data">
            </label>
            <label for="">DATA DA FINALIZAÇÃO
                <input type="datetime-local" name="finalizacao" id="finalizacao">
            </label>
            <label for="">STATUS
                <input type="text" name="status" id="status">
            </label>
            <button>CADASTRAR</button>
        </form>
    </fieldset>
    </section>
</body>
</html>