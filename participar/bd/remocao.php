<?php
session_start();

$idRe = $_GET['idRe'];
$pks = explode("%", $idRe);

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "DELETE FROM participar WHERE olimpiada_nome = '$pks[0]' AND pais_codigo = '$pks[1]'";

try {
    mysqli_query($conexao, $comando);

    $_SESSION['sucessoRemocao'] = "Remoção realizada!";

    header("Location: ../participar.php");
    die();
} catch (mysqli_sql_exception $erro) {
    mysqli_close($conexao);

    $_SESSION['erroRemocao'] = "Erro ao remover!";

    header("Location: ../participar.php");
    die();
}
