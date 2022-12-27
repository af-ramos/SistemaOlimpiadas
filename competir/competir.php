<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comandoProva = "SELECT prova.olimpiada_nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, prova.local_codigo AS localCodigo, local.nome AS localNome, prova.data, prova.horario, modalidade, tipoModalidade FROM prova 
                 INNER JOIN olimpiada ON prova.olimpiada_nome = olimpiada.nome INNER JOIN local ON prova.local_codigo = local.codigo";
$resultadoProva = mysqli_query($conexao, $comandoProva);

mysqli_close($conexao);
?>

<!DOCTYPE html>

<head>
    <title> Cadastro e Consulta de Competições </title>
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
            var dadosProva = $("#selectOlimpiada").val();

            $.ajax({
                url: 'bd/ajaxAtleta.php',
                type: 'POST',
                data: {
                    dadosProva: dadosProva
                },
                success: function(data) {
                    $("#selectAtleta").html(data);
                }
            });

            $("#botaoModalidade").click(function() {
                $.ajax({
                    type: 'POST',
                    url: 'bd/ajaxConsulta.php',
                    data: {
                        tipoConsulta: "Modalidade",
                        valorConsulta: document.getElementById("textoConsulta").value
                    },
                    success: function(data) {
                        document.getElementById("tabelaConteudo").innerHTML = data;
                    }
                });
            });

            $("#botaoTipoModalidade").click(function() {
                $.ajax({
                    type: 'POST',
                    url: 'bd/ajaxConsulta.php',
                    data: {
                        tipoConsulta: "TipoModalidade",
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

            $("#selectOlimpiada").on("change", function() {
                var dadosProva = $("#selectOlimpiada").val();

                $.ajax({
                    url: 'bd/ajaxAtleta.php',
                    type: 'POST',
                    data: {
                        dadosProva: dadosProva
                    },
                    success: function(data) {
                        $("#selectAtleta").html(data);
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
                        <a class="nav-link" href="../medalha/medalha.php">Medalha</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../local/local.php">Local</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" href="../atleta/atleta.php">Atleta</a>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link active" href="../competir/competir.php">Competir</a>
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
                <label class="input-group-text">Prova</label>
                <select class="form-select" name="prova" id="selectOlimpiada">
                    <?php
                    while ($tuplaProva = mysqli_fetch_assoc($resultadoProva)) {
                        echo "<option value='" . $tuplaProva['data'] . "/" . $tuplaProva['horario'] . "/" . $tuplaProva['olimpiadaNome'] . "/" . $tuplaProva['localCodigo'] . "'> 
                        " . $tuplaProva['olimpiadaNome'] . " - " . $tuplaProva['olimpiadaAno'] . " | " . $tuplaProva['modalidade'] . " | " . $tuplaProva['tipoModalidade'] .
                            " | " . $tuplaProva['localNome'] . " | " . $tuplaProva['data'] . " | " . $tuplaProva['horario'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text">Atleta</label>
                <select class="form-select" name="atleta" id="selectAtleta"> </select>
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
            <button class="btn btn-dark" type="button" id="botaoModalidade">por modalidade</button>
            <button class="btn btn-dark" type="button" id="botaoTipoModalidade">por tipo de modalidade</button>
            <button class="btn btn-dark" type="button" id="botaoOlimpiada">por olímpiada</button>
            <button class="btn btn-dark" type="button" id="botaoLocal">por local</button>
            <button class="btn btn-dark" type="button" id="botaoAtleta">por atleta</button>
        </div>

        <table class="table table-striped" id="tabelaConteudo">
            <?php include 'bd/consulta.php' ?>
        </table>

        <?php
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