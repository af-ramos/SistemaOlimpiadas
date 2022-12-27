<?php

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$dadosProva = $_POST["dadosProva"];
$pks = explode("/", $dadosProva);

$comandoProva = "SELECT * FROM prova WHERE data = '$pks[0]' AND horario = '$pks[1]' AND olimpiada_nome = '$pks[2]' AND local_codigo = '$pks[3]'";
$resultadoProva = mysqli_query($conexao, $comandoProva);
$tuplaProva = mysqli_fetch_assoc($resultadoProva);

$comandoAtleta = "SELECT atleta.idAtleta AS idAtletinha, atleta.nome AS nomeAtletinha FROM atleta WHERE modalidade = '" . $tuplaProva['modalidade'] . "' 
                  AND pais_codigo IN (
                    SELECT pais_codigo FROM participar
                    WHERE olimpiada_nome = '" . $tuplaProva['olimpiada_nome'] . "'
                  )";
$resultadoAtleta = mysqli_query($conexao, $comandoAtleta);

while ($tuplaAtleta = mysqli_fetch_assoc($resultadoAtleta)) {
    echo "<option value='" . $tuplaAtleta['idAtletinha'] . "'>" . $tuplaAtleta['nomeAtletinha'] . "</option>";
}
