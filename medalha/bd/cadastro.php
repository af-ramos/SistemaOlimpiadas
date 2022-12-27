<?php
session_start();

$dadosCompetir = $_POST["competicao"];
$pksCompetir = explode("/", $dadosCompetir);
$tipoMedalha = $_POST["medalha"];

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "INSERT INTO medalha VALUES ('$tipoMedalha', '$pksCompetir[4]', '$pksCompetir[0]', '$pksCompetir[1]', '$pksCompetir[3]', '$pksCompetir[2]');";

try {
    mysqli_query($conexao, $comando);
    mysqli_close($conexao);

    $_SESSION['sucessoCadastro'] = "Cadastro realizado!";

    header("Location: ../medalha.php");
    die();
} catch (mysqli_sql_exception $e) {
    $_SESSION['erroCadastro'] = "Erro ao cadastrar!";

    mysqli_close($conexao);

    header("Location: ../medalha.php");
    die();
}
