<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$olimpiadaNome = $_GET["idPodio"];

$comando = "SELECT pais_codigo AS codigoPais FROM participar WHERE olimpiada_nome = '$olimpiadaNome'";
$resultado = mysqli_query($conexao, $comando);

if ($resultado->num_rows >= 3) {
    while ($tupla = mysqli_fetch_assoc($resultado)) {
        $paises["" . $tupla['codigoPais'] . ""] = array(0, 0, 0, 0, 0);
    }

    $comando = "SELECT medalha.tipoMedalha AS tipoMedalha, atleta.pais_codigo AS codigoPais FROM medalha INNER JOIN atleta ON atleta.idAtleta = medalha.atleta_idAtleta WHERE medalha.olimpiada_nome = '$olimpiadaNome'";
    $resultado = mysqli_query($conexao, $comando);

    while ($tupla = mysqli_fetch_assoc($resultado)) {
        if ($tupla['tipoMedalha'] == 'Ouro') {
            $paises["" . $tupla['codigoPais'] . ""][2] += 1;
        } else if ($tupla['tipoMedalha'] == 'Prata') {
            $paises["" . $tupla['codigoPais'] . ""][3] += 1;
        } else {
            $paises["" . $tupla['codigoPais'] . ""][4] += 1;
        }

        $paises["" . $tupla['codigoPais'] . ""][1] += 1;
    }

    $colunaTotal = array_column($paises, 1);
    $colunaOuro = array_column($paises, 2);
    $colunaPrata = array_column($paises, 3);
    $colunaBronze = array_column($paises, 4);

    $chaves = array_keys($paises);

    array_multisort($colunaTotal, SORT_DESC, $colunaOuro, SORT_DESC, $colunaPrata, SORT_DESC, $colunaBronze, SORT_DESC, $paises);

    $chaves = array_keys($paises);
    $primeiro = $chaves[0];
    $segundo = $chaves[1];
    $terceiro = $chaves[2];

    $comando = "UPDATE olimpiada SET primeiro = '$primeiro', segundo = '$segundo', terceiro = '$terceiro' WHERE nome = '$olimpiadaNome'";
    $resultado = mysqli_query($conexao, $comando);

    $_SESSION['sucessoPodio'] = 'Pódio gerado!';
} else {
    $_SESSION['erroPodio'] = 'Erro ao gerar o pódio!';
}

mysqli_close($conexao);

header("Location: olimpiada.php");
die();
