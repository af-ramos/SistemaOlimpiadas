<?php
session_start();

$nome = $_POST["nome"];
$dataInicio = $_POST["dataInicio"];
$dataTermino = $_POST["dataTermino"];
$ano = $_POST["ano"];
$pais = $_POST["pais"];

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "INSERT INTO olimpiada VALUES ('$nome', '$dataInicio', '$dataTermino', NULL, NULL, NULL, $ano, '$pais', 0);";

try {
    mysqli_query($conexao, $comando);
    mysqli_close($conexao);

    $_SESSION['sucessoCadastro'] = "Cadastro realizado!";

    header("Location: ../olimpiada.php");
    die();
} catch (mysqli_sql_exception $e) {
    $_SESSION['erroCadastro'] = "Erro ao cadastrar!";

    mysqli_close($conexao);

    header("Location: ../olimpiada.php");
    die();
}
