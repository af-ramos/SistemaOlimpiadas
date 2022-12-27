<?php
session_start();

$modalidade = $_POST["modalidade"];
$emEquipe = $_POST["emEquipe"];
$tipoModalidade = $_POST["tipoModalidade"];
$data = $_POST["data"];
$horario = $_POST["horario"];
$olimpiada = $_POST["olimpiada"];
$local = $_POST["local"];

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "INSERT INTO prova VALUES ('$modalidade', '$emEquipe', '$tipoModalidade', '$data', '$horario', '$olimpiada', '$local');";

try {
    mysqli_query($conexao, $comando);
    mysqli_close($conexao);

    $_SESSION['sucessoCadastro'] = "Cadastro realizado!";

    header("Location: ../prova.php");
    die();
} catch (mysqli_sql_exception $e) {
    $_SESSION['erroCadastro'] = "Erro ao cadastrar!";

    mysqli_close($conexao);

    header("Location: ../prova.php");
    die();
}
