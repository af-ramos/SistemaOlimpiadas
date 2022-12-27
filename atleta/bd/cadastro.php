<?php
session_start();

$id = $_POST["id"];
$nome = $_POST["nome"];
$idade = $_POST["idade"];
$altura = $_POST["altura"];
$peso = $_POST["peso"];
$modalidade = $_POST["modalidade"];
$pais = $_POST["pais"];
$sexo = $_POST["sexo"];

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "INSERT INTO atleta VALUES ($id, $idade, '$sexo', $altura, $peso, '$modalidade', '$pais', '$nome');";

try {
    mysqli_query($conexao, $comando);
    mysqli_close($conexao);

    $_SESSION['sucessoCadastro'] = "Cadastro realizado!";

    header("Location: ../atleta.php");
    die();
} catch (mysqli_sql_exception $e) {
    $_SESSION['erroCadastro'] = "Erro ao cadastrar!";

    mysqli_close($conexao);

    header("Location: ../atleta.php");
    die();
}
