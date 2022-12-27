<?php
session_start();

$idRe = $_GET['idRe'];
$pks = explode("%", $idRe);

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "DELETE FROM patrocinar WHERE patrocinador_idEmpresa = '$pks[0]' AND olimpiada_nome = '$pks[1]'";

try {
    mysqli_query($conexao, $comando);

    $_SESSION['sucessoRemocao'] = "Remoção realizada!";

    header("Location: ../patrocinar.php");
    die();
} catch (mysqli_sql_exception $erro) {
    mysqli_close($conexao);

    $_SESSION['erroRemocao'] = "Erro ao remover!";

    header("Location: ../patrocinar.php");
    die();
}
