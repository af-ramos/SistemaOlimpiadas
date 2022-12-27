<?php
session_start();

$idRe = $_GET['idRe'];
$pks = explode("/", $idRe);

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "DELETE FROM competir WHERE prova_data = '$pks[0]' AND prova_horario = '$pks[1]' AND olimpiada_nome = '$pks[2]' AND local_codigo = '$pks[3]' AND atleta_idAtleta = '$pks[4]'";

try {
    mysqli_query($conexao, $comando);

    $_SESSION['sucessoRemocao'] = "Remoção realizada!";

    header("Location: ../competir.php");
    die();
} catch (mysqli_sql_exception $erro) {
    mysqli_close($conexao);

    $_SESSION['erroRemocao'] = "Erro ao remover!";

    header("Location: ../competir.php");
    die();
}
