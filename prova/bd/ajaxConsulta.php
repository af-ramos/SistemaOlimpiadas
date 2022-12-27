<?php

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$tipoConsulta = $_POST["tipoConsulta"];

if (isset($_POST["valorConsulta"])) {
    $valorConsulta = $_POST["valorConsulta"];

    if ($valorConsulta == "") {
        $comando = "SELECT modalidade, emEquipe, tipoModalidade, data, horario, olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, local.codigo AS localCodigo, local.nome AS localNome FROM prova 
                    INNER JOIN olimpiada ON prova.olimpiada_nome = olimpiada.nome INNER JOIN local ON prova.local_codigo = local.codigo;";
    } else if ($tipoConsulta == "Modalidade") {
        $comando = "SELECT modalidade, emEquipe, tipoModalidade, data, horario, olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, local.codigo AS localCodigo, local.nome AS localNome FROM prova 
                    INNER JOIN olimpiada ON prova.olimpiada_nome = olimpiada.nome INNER JOIN local ON prova.local_codigo = local.codigo WHERE modalidade LIKE '%$valorConsulta%';";
    } else if ($tipoConsulta == 'TipoModalidade') {
        $comando = "SELECT modalidade, emEquipe, tipoModalidade, data, horario, olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, local.codigo AS localCodigo, local.nome AS localNome FROM prova 
                    INNER JOIN olimpiada ON prova.olimpiada_nome = olimpiada.nome INNER JOIN local ON prova.local_codigo = local.codigo WHERE tipoModalidade LIKE '%$valorConsulta%';";
    } else if ($tipoConsulta == 'Olimpiada') {
        $comando = "SELECT modalidade, emEquipe, tipoModalidade, data, horario, olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, local.codigo AS localCodigo, local.nome AS localNome FROM prova 
                    INNER JOIN olimpiada ON prova.olimpiada_nome = olimpiada.nome INNER JOIN local ON prova.local_codigo = local.codigo WHERE olimpiada.nome LIKE '%$valorConsulta%';";
    } else {
        $comando = "SELECT modalidade, emEquipe, tipoModalidade, data, horario, olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, local.codigo AS localCodigo, local.nome AS localNome FROM prova 
                    INNER JOIN olimpiada ON prova.olimpiada_nome = olimpiada.nome INNER JOIN local ON prova.local_codigo = local.codigo WHERE local.nome LIKE '%$valorConsulta%';";
    }

    $resultado = mysqli_query($conexao, $comando);

    echo "<tr>
    <th> Modalidade </th>
    <th> Em Equipe? </th>
    <th> Tipo de Modalidade </th>
    <th> Data </th>
    <th> Horário </th>
    <th> Olímpiada </th>
    <th> Local </th>
    <th> Atualizar </th>
    <th> Remover </th>
  </tr>";

    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
        <td class='alinhar'> " . $tupla['modalidade'] . " </td> 
        <td class='alinhar'> " . ($tupla['emEquipe'] ? "Sim" : "Não") . " </td> 
        <td class='alinhar'> " . $tupla['tipoModalidade'] . " </td>
        <td class='alinhar'> " . $tupla['data'] . " </td>
        <td class='alinhar'> " . $tupla['horario'] . " </td>
        <td class='alinhar'> " . $tupla['olimpiadaNome'] . " - " . $tupla['olimpiadaAno'] . " </td>
        <td class='alinhar'> " . $tupla['localNome'] . " </td>
        <td> <a href='bd/atualizacao.php?idAt=" . $tupla['data'] . "/" . $tupla['horario'] . "/" . $tupla['olimpiadaNome'] . "/" . $tupla['localCodigo'] . "'><img src='../img/refresh.png' width='30px' style='display: block; margin: auto;'></a>
        </td> <td> <a href='bd/remocao.php?idRe=" . $tupla['data'] . "/" . $tupla['horario'] . "/" . $tupla['olimpiadaNome'] . "/" . $tupla['localCodigo'] . "'><img src='../img/remove.png' width='30px' style='display: block; margin: auto;'></a> </td>
        </tr>";
    }
}

mysqli_close($conexao);
