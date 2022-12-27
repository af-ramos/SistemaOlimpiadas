<?php
session_start();

$idEmpresa = $_POST["id"];
$nome = $_POST["nome"];

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "INSERT INTO patrocinador VALUES ('$nome', $idEmpresa)";

try {
    mysqli_query($conexao, $comando);
    mysqli_close($conexao);

    $_SESSION['sucessoCadastro'] = "Cadastro realizado!";

    header("Location: ../patrocinador.php");
    die();
} catch (mysqli_sql_exception $e) {
    $_SESSION['erroCadastro'] = "Erro ao cadastrar!";

    mysqli_close($conexao);

    header("Location: ../patrocinador.php");
    die();
}
