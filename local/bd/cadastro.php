<?php
session_start();

$codigo = $_POST["codigo"];
$nome = $_POST["nome"];
$endereco = $_POST["endereco"];
$capacidade = $_POST["capacidade"];
$pais = $_POST["pais"];

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "INSERT INTO local VALUES ($capacidade, '$endereco', '$nome', '$pais', $codigo)";

try {
    mysqli_query($conexao, $comando);
    mysqli_close($conexao);

    $_SESSION['sucessoCadastro'] = "Cadastro realizado!";

    header("Location: ../local.php");
    die();
} catch (mysqli_sql_exception $e) {
    $_SESSION['erroCadastro'] = "Erro ao cadastrar!";

    mysqli_close($conexao);

    header("Location: ../local.php");
    die();
}
