<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.scss">
    <title>Pagina Inicial</title>
</head>

<body>
    <header id='header-principal'>
        <nav></nav>
        <form method="post" class="form-principal" action="pesquisa.php">
            <input type="text" name="query" class="input_pesquisar" value="" placeholder="Pesquisar Filme por palava-chave">
            <input type="submit" name="pesquisar" class="btn" value="Pesquisar Filme">
        </form>
    </header>
    <?php
    include '../modules/api.php';

    if (@$_POST["Submit"]) {
        if ($_POST['pagina'] > 1) {
            $_POST['pagina']--;
        }
    } else {
        @$_POST['pagina']++;
    }

    @$result = API::listaFilmes($_POST['pagina']);
    $index = $_POST['pagina'];


    ?>
    <form method="post" class="navegacao">
        <input type="hidden" name="pagina" value="<?php echo isset($_POST['pagina']) ? $_POST['pagina'] : 1; ?>">
        <input type="submit" name="Submit" class="btn" value="Anterior">
        <input type="hidden"><?php
                                echo "<h2 class='index'>" . $index . "</h2>";
                                ?></input>
        <input type="submit" name="Su" class="btn" value="Próximo">
    </form>

</body>

</html>