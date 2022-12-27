<?php
session_start();

$nome = $_GET['idRe'];

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "DELETE FROM olimpiada WHERE nome = '$nome'";

try {
    mysqli_query($conexao, $comando);

    $_SESSION['sucessoRemocao'] = "Remoção realizada!";

    header("Location: ../olimpiada.php");
    die();
} catch (mysqli_sql_exception $erro) {
    mysqli_close($conexao);

    $_SESSION['erroRemocao'] = "Erro ao remover!";

    header("Location: ../olimpiada.php");
    die();
}
