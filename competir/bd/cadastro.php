<?php
session_start();

$dadosProva = $_POST["prova"];
$pksProva = explode("/", $dadosProva);
$idAtleta = $_POST["atleta"];

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "INSERT INTO competir VALUES ('$idAtleta', '$pksProva[0]', '$pksProva[1]', '$pksProva[3]', '$pksProva[2]');";

try {
    mysqli_query($conexao, $comando);
    mysqli_close($conexao);

    $_SESSION['sucessoCadastro'] = "Cadastro realizado!";

    header("Location: ../competir.php");
    die();
} catch (mysqli_sql_exception $e) {
    $_SESSION['erroCadastro'] = "Erro ao cadastrar!";

    mysqli_close($conexao);

    header("Location: ../competir.php");
    die();
}
