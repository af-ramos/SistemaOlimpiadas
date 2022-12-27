<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$idAt = $_GET['idAt'];

if (isset($_POST['botaoEnviar'])) {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $altura = $_POST["altura"];
    $peso = $_POST["peso"];
    $modalidade = $_POST["modalidade"];
    $pais = $_POST["pais"];
    $sexo = $_POST["sexo"];

    $comando = "UPDATE atleta SET nome = '$nome', idade = '$idade', altura = '$altura', peso = '$peso', modalidade = '$modalidade', pais_codigo = '$pais', sexo = '$sexo' WHERE idAtleta = '$idAt';";

    try {
        mysqli_query($conexao, $comando);

        $_SESSION["sucessoAtualizacao"] = "Atualização realizada!";

        header("Location: ../atleta.php");
        die();
    } catch (mysqli_sql_exception $erro) {
        $_SESSION["erroAtualizacao"] = "Erro ao atualizar!";

        mysqli_close($conexao);

        header("Location: ../atleta.php");
        die();
    }
}

$comandoDados = "SELECT * FROM atleta WHERE idAtleta = '$idAt'";
$resultadoDados = mysqli_query($conexao, $comandoDados);

if ($resultadoDados->num_rows <= 0) {
    mysqli_close($conexao);

    header("Location: ../atleta.php");
    die();
}

$tuplaDados = mysqli_fetch_assoc($resultadoDados);

$comandoPais = "SELECT * FROM pais";
$resultadoPais = mysqli_query($conexao, $comandoPais);

mysqli_close($conexao);
?>

<!DOCTYPE html>

<head>
    <title> Atualização de Atleta </title>

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
                        <a class="nav-link" href="../../medalha/medalha.php">Medalha</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../../local/local.php">Local</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link active" href="../../atleta/atleta.php">Atleta</a>
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
                <span class="input-group-text">ID</span>
                <input type="number" readonly class="form-control" name="id" required value="<?php echo $tuplaDados['idAtleta'] ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Nome</span>
                <input type="text" class="form-control" name="nome" required value="<?php echo $tuplaDados['nome'] ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Idade</span>
                <input type="number" class="form-control" name="idade" required value="<?php echo $tuplaDados['idade'] ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Altura</span>
                <input type="text" class="form-control" name="altura" required value="<?php echo $tuplaDados['altura'] ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Peso</span>
                <input type="text" class="form-control" name="peso" required value="<?php echo $tuplaDados['peso'] ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Modalidade</span>
                <input type="text" class="form-control" name="modalidade" required value="<?php echo $tuplaDados['modalidade'] ?>">
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text">País</label>
                <select class="form-select" name="pais">
                    <?php
                    while ($tuplaPais = mysqli_fetch_assoc($resultadoPais)) {
                        echo "<option value='" . $tuplaPais['codigo'] . "'> " . $tuplaPais['nome'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text">Sexo</label>
                <select class="form-select" name="sexo">
                    <option value="H">Homem</option>
                    <option value="M">Mulher</option>
                    <option value="O">Outro</option>
                </select>
            </div>

            <input type="submit" value="Atualizar" name="botaoEnviar" class="btn btn-success btn-lg btn-block">
            <input type="reset" value="Restaurar" class="btn btn-secondary btn-lg btn-block">
        </form>
    </div>
</body>

</html>