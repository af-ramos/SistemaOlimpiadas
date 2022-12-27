<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$idAt = $_GET['idAt'];

if (isset($_POST['botaoEnviar'])) {
    $dataInicio = $_POST["dataInicio"];
    $dataTermino = $_POST["dataTermino"];
    $ano = $_POST["ano"];
    $pais = $_POST["pais"];

    $comando = "UPDATE olimpiada SET data_inicio = '$dataInicio', data_termino = '$dataTermino', ano = $ano, pais_codigo = '$pais' WHERE nome = '$idAt';";

    try {
        mysqli_query($conexao, $comando);

        $_SESSION["sucessoAtualizacao"] = "Atualização realizada!";

        header("Location: ../olimpiada.php");
        die();
    } catch (mysqli_sql_exception $erro) {
        $_SESSION["erroAtualizacao"] = "Erro ao atualizar!";

        mysqli_close($conexao);

        header("Location: ../olimpiada.php");
        die();
    }
}

$comandoDados = "SELECT * FROM olimpiada WHERE nome = '$idAt'";
$resultadoDados = mysqli_query($conexao, $comandoDados);

if ($resultadoDados->num_rows <= 0) {
    mysqli_close($conexao);

    header("Location: ../olimpiada.php");
    die();
}

$tuplaDados = mysqli_fetch_assoc($resultadoDados);

$comandoPais = "SELECT * FROM pais";
$resultadoPais = mysqli_query($conexao, $comandoPais);

mysqli_close($conexao);
?>

<!DOCTYPE html>

<head>
    <title> Atualização de Olímpiada </title>

    <link rel="icon" type="image/x-icon" href="../../img/olympic.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" style="margin-left: 10px" href="../index.php"><img src="../../img/olympic.png" width="50px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item btn">
                        <a class="nav-link active" href="../../olimpiada/olimpiada.php">Olímpiada</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../../pais/pais.php">País</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../../prova/prova.php">Prova</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../../patrocinador/patrocinador.php">Patrocinador</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../../medalha/medalha.php">Medalha</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../../local/local.php">Local</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../../atleta/atleta.php">Atleta</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../../competir/competir.php">Competir</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../../participar/participar.php">Participar</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../../patrocinar/patrocinar.php">Patrocinar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="m-3">
        <h3 class="display-5 mb-3 mt-2"> Atualização </h3>

        <form action="atualizacao.php?idAt=<?php echo $idAt ?>" method="POST">
            <div class="input-group mb-3">
                <span class="input-group-text">Nome</span>
                <input type="text" class="form-control" name="nome" required readonly value="<?php echo $tuplaDados['nome'] ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Data de Início</span>
                <input type="date" class="form-control" name="dataInicio" required value="<?php echo $tuplaDados['data_inicio'] ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Data de Termino</span>
                <input type="date" class="form-control" name="dataTermino" required value="<?php echo $tuplaDados['data_termino'] ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Ano</span>
                <input type="number" class="form-control" name="ano" required value="<?php echo $tuplaDados['ano'] ?>">
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text">País</label>
                <select class="form-select" name="pais">
                    <?php
                    while ($tuplaPaises = mysqli_fetch_assoc($resultadoPais)) {
                        echo "<option value='" . $tuplaPaises['codigo'] . "'> " . $tuplaPaises['nome'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <input type="submit" value="Atualizar" name="botaoEnviar" class="btn btn-success btn-lg btn-block">
            <input type="reset" value="Restaurar" class="btn btn-secondary btn-lg btn-block">
        </form>
    </div>
</body>

</html>