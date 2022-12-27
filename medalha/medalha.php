<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comandoCompetir = "SELECT prova.data, prova.horario, prova.modalidade, prova.tipoModalidade, olimpiada.nome AS nomeOlimpiada, ano, local.nome AS localNome, local.codigo AS localCodigo, atleta.nome AS nomeAtleta, atleta.idAtleta AS idAtletinha
                    FROM competir INNER JOIN olimpiada ON competir.olimpiada_nome = olimpiada.nome 
                    INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN atleta ON atleta.idAtleta = competir.atleta_idAtleta 
                    INNER JOIN local ON competir.local_codigo = local.codigo";
$resultadoCompetir = mysqli_query($conexao, $comandoCompetir);

mysqli_close($conexao);
?>

<!DOCTYPE html>

<head>
    <title> Cadastro e Consulta de Medalhas </title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <link rel="icon" type="image/x-icon" href="../img/olympic.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <style>
        th {
            text-align: center;
            vertical-align: middle,
        }

        td.alinhar {
            text-align: center;
            vertical-align: middle,
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#botaoMedalha").click(function() {
                $.ajax({
                    type: 'POST',
                    url: 'bd/ajaxConsulta.php',
                    data: {
                        tipoConsulta: "Medalha",
                        valorConsulta: document.getElementById("textoConsulta").value
                    },
                    success: function(data) {
                        document.getElementById("tabelaConteudo").innerHTML = data;
                    }
                });
            });

            $("#botaoOlimpiada").click(function() {
                $.ajax({
                    type: 'POST',
                    url: 'bd/ajaxConsulta.php',
                    data: {
                        tipoConsulta: "Olimpiada",
                        valorConsulta: document.getElementById("textoConsulta").value
                    },
                    success: function(data) {
                        document.getElementById("tabelaConteudo").innerHTML = data;
                    }
                });
            });

            $("#botaoAtleta").click(function() {
                $.ajax({
                    type: 'POST',
                    url: 'bd/ajaxConsulta.php',
                    data: {
                        tipoConsulta: "Atleta",
                        valorConsulta: document.getElementById("textoConsulta").value
                    },
                    success: function(data) {
                        document.getElementById("tabelaConteudo").innerHTML = data;
                    }
                });
            });

            $("#botaoLocal").click(function() {
                $.ajax({
                    type: 'POST',
                    url: 'bd/ajaxConsulta.php',
                    data: {
                        tipoConsulta: "Local",
                        valorConsulta: document.getElementById("textoConsulta").value
                    },
                    success: function(data) {
                        document.getElementById("tabelaConteudo").innerHTML = data;
                    }
                });
            });

            $("#botaoAno").click(function() {
                $.ajax({
                    type: 'POST',
                    url: 'bd/ajaxConsulta.php',
                    data: {
                        tipoConsulta: "Ano",
                        valorConsulta: document.getElementById("textoConsulta").value
                    },
                    success: function(data) {
                        document.getElementById("tabelaConteudo").innerHTML = data;
                    }
                });
            });
        });
    </script>
</head>

<body style="width: 100%">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" style="margin-left: 10px" href="../index.php"><img src="../img/olympic.png" width="50px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item btn">
                        <a class="nav-link" href="../olimpiada/olimpiada.php">Olímpiada</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../pais/pais.php">País</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../prova/prova.php">Prova</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../patrocinador/patrocinador.php">Patrocinador</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link active" href="../medalha/medalha.php">Medalha</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../local/local.php">Local</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../atleta/atleta.php">Atleta</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../competir/competir.php">Competir</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../participar/participar.php">Participar</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../patrocinar/patrocinar.php">Patrocinar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="m-3">
        <h3 class="display-5 mb-3 mt-2"> Cadastro </h3>

        <form action="bd/cadastro.php" method="POST">
            <div class="input-group mb-3">
                <label class="input-group-text">Competição</label>
                <select class="form-select" name="competicao" id="selectCompeticao">
                    <?php
                    while ($tuplaCompetir = mysqli_fetch_assoc($resultadoCompetir)) {
                        echo "<option value='" . $tuplaCompetir['data'] . "/" . $tuplaCompetir['horario'] . "/" . $tuplaCompetir['nomeOlimpiada'] . "/" . $tuplaCompetir['localCodigo'] . "/" . $tuplaCompetir['idAtletinha'] . "'> 
                        " . $tuplaCompetir['nomeOlimpiada'] . " - " . $tuplaCompetir['ano'] . " | " . $tuplaCompetir['nomeAtleta'] .  " | " . $tuplaCompetir['modalidade'] . " | " . $tuplaCompetir['tipoModalidade'] .
                            " | " . $tuplaCompetir['localNome'] . " | " . $tuplaCompetir['data'] . " | " . $tuplaCompetir['horario'] . "</option>";
                    }
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

            <?php
            if (isset($_SESSION["sucessoCadastro"])) {
                echo "<div class='alert alert-success'> " . $_SESSION["sucessoCadastro"] . "</div>";
                unset($_SESSION["sucessoCadastro"]);
            }
            ?>

            <?php
            if (isset($_SESSION["erroCadastro"])) {
                echo "<div class='alert alert-danger'> " . $_SESSION["erroCadastro"] . "</div>";
                unset($_SESSION["erroCadastro"]);
            }
            ?>

            <input type="submit" value="Cadastrar" class="btn btn-success btn-lg btn-block"> &nbsp;
            <input type="reset" value="Limpar" class="btn btn-danger btn-lg btn-block">
        </form>

        <hr class="mt-4">
        <h3 class="display-5 mb-3"> Consulta </h3>

        <div class="input-group mb-3">
            <input type="text" class="form-control" id="textoConsulta" placeholder="Consulta...">
            <button class="btn btn-dark" type="button" id="botaoMedalha">por medalha</button>
            <button class="btn btn-dark" type="button" id="botaoOlimpiada">por olímpiada</button>
            <button class="btn btn-dark" type="button" id="botaoAtleta">por atleta</button>
            <button class="btn btn-dark" type="button" id="botaoLocal">por local</button>
            <button class="btn btn-dark" type="button" id="botaoAno">por ano</button>
        </div>

        <table class="table table-striped" id="tabelaConteudo">
            <?php include 'bd/consulta.php' ?>
        </table>

        <?php
        if (isset($_SESSION["sucessoAtualizacao"])) {
            echo "<div class='alert alert-success'> " . $_SESSION["sucessoAtualizacao"] . "</div>";
            unset($_SESSION["sucessoAtualizacao"]);
        }

        if (isset($_SESSION["erroAtualizacao"])) {
            echo "<div class='alert alert-danger'> " . $_SESSION["erroAtualizacao"] . "</div>";
            unset($_SESSION["erroAtualizacao"]);
        }

        if (isset($_SESSION["sucessoRemocao"])) {
            echo "<div class='alert alert-success'> " . $_SESSION["sucessoRemocao"] . "</div>";
            unset($_SESSION["sucessoRemocao"]);
        }

        if (isset($_SESSION["erroRemocao"])) {
            echo "<div class='alert alert-danger'> " . $_SESSION["erroRemocao"] . "</div>";
            unset($_SESSION["erroRemocao"]);
        }
        ?>
    </div>
</body>

</html>