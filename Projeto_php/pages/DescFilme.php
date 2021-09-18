<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/DescFilme.scss">
    <title>Descrição do Filme</title>
</head>

<body>
    <header id='header-principal'>
        <nav></nav>
        <form method="post" class="form-principal" action="index.php">
            <input type="submit" name="voltar" class="btn" value="Página Inicial">
        </form>
    </header>
    <?php
    include '../modules/api.php';
    $valor = @$_GET['id'];
    $retorno = API::filmeId($valor);
    ?>

</body>

</html>