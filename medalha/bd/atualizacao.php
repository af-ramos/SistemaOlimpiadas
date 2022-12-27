<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$idAt = $_GET['idAt'];
$pks = explode("/", $idAt);

if (isset($_POST['botaoEnviar'])) {
    $medalha = $_POST["medalha"];

    $comando = "UPDATE medalha SET tipoMedalha = '$medalha'
                WHERE atleta_idAtleta = '$pks[4]' AND prova_data = '$pks[0]' AND prova_horario = '$pks[1]' AND local_codigo = '$pks[3]' AND olimpiada_nome = '$pks[2]';";

    try {
        mysqli_query($conexao, $comando);

        $_SESSION["sucessoAtualizacao"] = "Atualização realizada!";

        header("Location: ../medalha.php");
        die();
    } catch (mysqli_sql_exception $erro) {
        $_SESSION["erroAtualizacao"] = "Erro ao atualizar!";

        mysqli_close($conexao);

        header("Location: ../medalha.php");
        die();
    }
}

$comandoDados = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, prova.modalidade AS provaModalidade, prova.tipoModalidade AS provaTipoModalidade, 
                local.nome AS localNome, local.codigo AS localCodigo, prova.data AS provaData, prova.horario AS provaHorario, atleta.nome AS atletaNome, atleta.idAtleta AS idAtletinha, medalha.tipoMedalha AS medalhaTipo 
                FROM medalha INNER JOIN competir ON competir.olimpiada_nome = medalha.olimpiada_nome AND medalha.local_codigo = competir.local_codigo AND 
                medalha.prova_horario = competir.prova_horario AND medalha.prova_data = competir.prova_data AND medalha.atleta_idAtleta = competir.atleta_idAtleta
                INNER JOIN olimpiada ON olimpiada.nome = competir.olimpiada_nome 
                INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                INNER JOIN local ON prova.local_codigo = local.codigo 
                INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta
                WHERE medalha.atleta_idAtleta = '$pks[4]' AND medalha.prova_data = '$pks[0]' AND medalha.prova_horario = '$pks[1]'
                AND medalha.local_codigo = '$pks[3]' AND medalha.olimpiada_nome = '$pks[2]'";
$resultadoDados = mysqli_query($conexao, $comandoDados);

if ($resultadoDados->num_rows <= 0) {
    mysqli_close($conexao);

    header("Location: ../medalha.php");
    die();
}

$tuplaDados = mysqli_fetch_assoc($resultadoDados);

mysqli_close($conexao);
?>

<!DOCTYPE html>

<head>
    <title> Atualização de Medalha </title>

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
                        <a class="nav-link" href="../../prova/prova.php">Prova</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../../patrocinador/patrocinador.php">Patrocinador</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link active" href="../../medalha/medalha.php">Medalha</a>
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
                <label class="input-group-text">Competição</label>
                <select class="form-select" name="competicao" id="selectCompeticao">
                    <?php
                    echo "<option value='" . $tuplaDados['provaData'] . "/" . $tuplaDados['provaHorario'] . "/" . $tuplaDados['olimpiadaNome'] . "/" . $tuplaDados['localCodigo'] . "/" . $tuplaDados['idAtletinha'] . "'> 
                        " . $tuplaDados['olimpiadaNome'] . " - " . $tuplaDados['olimpiadaAno'] . " | " . $tuplaDados['atletaNome'] .  " | " . $tuplaDados['provaModalidade'] . " | " . $tuplaDados['provaTipoModalidade'] .
                        " | " . $tuplaDados['localNome'] . " | " . $tuplaDados['provaData'] . " | " . $tuplaDados['provaHorario'] . "</option>";
                    ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text">Tipo de Medalha</label>
                <select class="form-select" name="medalha">
                    <option value="Ouro"> Ouro </option>
                    <option value="Prata"> Prata </option>
                    <option value="Bronze"> Bronze </option>
                </select>
            </div>

            <input type="submit" value="Atualizar" name="botaoEnviar" class="btn btn-success btn-lg btn-block">
            <input type="reset" value="Restaurar" class="btn btn-secondary btn-lg btn-block">
        </form>
    </div>
</body>

</html>