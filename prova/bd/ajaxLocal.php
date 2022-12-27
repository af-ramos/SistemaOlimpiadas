<?php

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$nomeOlimpiada = $_POST["nomeOlimpiada"];

$comandoOlimpiada = "SELECT * FROM olimpiada WHERE nome = '$nomeOlimpiada'";
$resultadoOlimpiada = mysqli_query($conexao, $comandoOlimpiada);
$tuplaOlimpiada = mysqli_fetch_assoc($resultadoOlimpiada);

$comandoLocal = "SELECT * FROM local WHERE pais_codigo = '" . $tuplaOlimpiada['pais_codigo'] . "';";
$resultadoLocal = mysqli_query($conexao, $comandoLocal);

while ($tuplaLocal = mysqli_fetch_assoc($resultadoLocal)) {
    echo "<option value='" . $tuplaLocal['codigo'] . "'>" . $tuplaLocal['nome'] . "</option>";
}
