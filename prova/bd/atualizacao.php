<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$idAt = $_GET['idAt'];
$pks = explode("/", $idAt);

if (isset($_POST['botaoEnviar'])) {
    $modalidade = $_POST["modalidade"];
    $emEquipe = $_POST["emEquipe"];
    $tipoModalidade = $_POST["tipoModalidade"];

    $comando = "UPDATE prova SET modalidade = '$modalidade', emEquipe = '$emEquipe', tipoModalidade = '$tipoModalidade' 
                WHERE data = '$pks[0]' AND horario = '$pks[1]' AND olimpiada_nome = '$pks[2]' AND local_codigo = '$pks[3]';";

    try {
        mysqli_query($conexao, $comando);

        $_SESSION["sucessoAtualizacao"] = "Atualização realizada!";

        header("Location: ../prova.php");
        die();
    } catch (mysqli_sql_exception $erro) {
        $_SESSION["erroAtualizacao"] = "Erro ao atualizar!";

        mysqli_close($conexao);

        header("Location: ../prova.php");
        die();
    }
}

$comandoDados = "SELECT * FROM prova WHERE data = '$pks[0]' AND horario = '$pks[1]' AND olimpiada_nome = '$pks[2]' AND local_codigo = '$pks[3]'";
$resultadoDados = mysqli_query($conexao, $comandoDados);

if ($resultadoDados->num_rows <= 0) {
    mysqli_close($conexao);

    header("Location: ../prova.php");
    die();
}

$tuplaDados = mysqli_fetch_assoc($resultadoDados);

$comandoOlimpiada = "SELECT * FROM olimpiada WHERE nome = '$pks[2]'";
$resultadoOlimpiada = mysqli_query($conexao, $comandoOlimpiada);
$tuplaOlimpiada = mysqli_fetch_assoc($resultadoOlimpiada);

$comandoLocal = "SELECT * FROM local WHERE codigo = '$pks[3]'";
$resultadoLocal = mysqli_query($conexao, $comandoLocal);
$tuplaLocal = mysqli_fetch_assoc($resultadoLocal);

mysqli_close($conexao);
?>

<!DOCTYPE html>

<head>
    <title> Atualização de Prova </title>

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
                        <a class="nav-link" href="../../olimpiada/olimpiada.php">Olímpiada</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../../pais/pais.php">País</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link active" href="../../prova/prova.php">Prova</a>
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
                <span class="input-group-text">Modalidade</span>
                <input type="text" class="form-control" name="modalidade" required value="<?php echo $tuplaDados['modalidade'] ?>">
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text">Em equipe?</label>
                <select class="form-select" name="emEquipe" value="<?php echo $tuplaDados['emEquipe'] ?>">
                    <option value="1"> Sim </option>
                    <option value="0"> Não </option>
                </select>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Tipo de Modalidade</span>
                <input type="text" class="form-control" name="tipoModalidade" required value="<?php echo $tuplaDados['tipoModalidade'] ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Data</span>
                <input type="date" class="form-control" name="data" required value="<?php echo $tuplaDados['data'] ?>" readonly>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Horário</span>
                <input type="time" class="form-control" name="horario" required value="<?php echo $tuplaDados['horario'] ?>" readonly>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text">Olímpiada</label>
                <select class="form-select" name="olimpiada" id="selectOlimpiada">
                    <?php
                    echo "<option value='" . $tuplaOlimpiada['nome'] . "'> " . $tuplaOlimpiada['nome'] . " - " . $tuplaOlimpiada['ano'] . "</option>";
                    ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text">Local</label>
                <select class="form-select" name="local" id="selectOlimpiada">
                    <?php
                    echo "<option value='" . $tuplaLocal['codigo'] . "'> " . $tuplaLocal['nome'] . "</option>";
                    ?>
                </select>
            </div>

            <input type="submit" value="Atualizar" name="botaoEnviar" class="btn btn-success btn-lg btn-block">
            <input type="reset" value="Restaurar" class="btn btn-secondary btn-lg btn-block">
        </form>
    </div>
</body>

</html>