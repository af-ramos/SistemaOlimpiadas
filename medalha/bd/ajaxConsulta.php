<?php

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$tipoConsulta = $_POST["tipoConsulta"];

if (isset($_POST["valorConsulta"])) {
    $valorConsulta = $_POST["valorConsulta"];

    if ($valorConsulta == "") {
        $comando = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, prova.modalidade AS provaModalidade, prova.tipoModalidade AS provaTipoModalidade, 
                    local.nome AS localNome, local.codigo AS localCodigo, prova.data AS provaData, prova.horario AS provaHorario, atleta.nome AS atletaNome, atleta.idAtleta AS idAtletinha, medalha.tipoMedalha AS medalhaTipo 
                    FROM medalha INNER JOIN competir ON competir.olimpiada_nome = medalha.olimpiada_nome AND medalha.local_codigo = competir.local_codigo AND 
                    medalha.prova_horario = competir.prova_horario AND medalha.prova_data = competir.prova_data AND medalha.atleta_idAtleta = competir.atleta_idAtleta
                    INNER JOIN olimpiada ON olimpiada.nome = competir.olimpiada_nome 
                    INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN local ON prova.local_codigo = local.codigo 
                    INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta;";
    } else if ($tipoConsulta == "Olimpiada") {
        $comando = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, prova.modalidade AS provaModalidade, prova.tipoModalidade AS provaTipoModalidade, 
                    local.nome AS localNome, local.codigo AS localCodigo, prova.data AS provaData, prova.horario AS provaHorario, atleta.nome AS atletaNome, atleta.idAtleta AS idAtletinha, medalha.tipoMedalha AS medalhaTipo 
                    FROM medalha INNER JOIN competir ON competir.olimpiada_nome = medalha.olimpiada_nome AND medalha.local_codigo = competir.local_codigo AND 
                    medalha.prova_horario = competir.prova_horario AND medalha.prova_data = competir.prova_data AND medalha.atleta_idAtleta = competir.atleta_idAtleta
                    INNER JOIN olimpiada ON olimpiada.nome = competir.olimpiada_nome 
                    INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN local ON prova.local_codigo = local.codigo 
                    INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta
                    WHERE olimpiada.nome LIKE '%$valorConsulta%';";
    } else if ($tipoConsulta == 'Atleta') {
        $comando = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, prova.modalidade AS provaModalidade, prova.tipoModalidade AS provaTipoModalidade, 
                    local.nome AS localNome, local.codigo AS localCodigo, prova.data AS provaData, prova.horario AS provaHorario, atleta.nome AS atletaNome, atleta.idAtleta AS idAtletinha, medalha.tipoMedalha AS medalhaTipo 
                    FROM medalha INNER JOIN competir ON competir.olimpiada_nome = medalha.olimpiada_nome AND medalha.local_codigo = competir.local_codigo AND 
                    medalha.prova_horario = competir.prova_horario AND medalha.prova_data = competir.prova_data AND medalha.atleta_idAtleta = competir.atleta_idAtleta
                    INNER JOIN olimpiada ON olimpiada.nome = competir.olimpiada_nome 
                    INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN local ON prova.local_codigo = local.codigo 
                    INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta 
                    WHERE atleta.nome LIKE '%$valorConsulta%';";
    } else if ($tipoConsulta == 'Local') {
        $comando = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, prova.modalidade AS provaModalidade, prova.tipoModalidade AS provaTipoModalidade, 
                    local.nome AS localNome, local.codigo AS localCodigo, prova.data AS provaData, prova.horario AS provaHorario, atleta.nome AS atletaNome, atleta.idAtleta AS idAtletinha, medalha.tipoMedalha AS medalhaTipo 
                    FROM medalha INNER JOIN competir ON competir.olimpiada_nome = medalha.olimpiada_nome AND medalha.local_codigo = competir.local_codigo AND 
                    medalha.prova_horario = competir.prova_horario AND medalha.prova_data = competir.prova_data AND medalha.atleta_idAtleta = competir.atleta_idAtleta
                    INNER JOIN olimpiada ON olimpiada.nome = competir.olimpiada_nome 
                    INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN local ON prova.local_codigo = local.codigo 
                    INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta
                    WHERE local.nome LIKE '%$valorConsulta%';";
    } else if ($tipoConsulta == 'Ano') {
        $comando = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, prova.modalidade AS provaModalidade, prova.tipoModalidade AS provaTipoModalidade, 
                    local.nome AS localNome, local.codigo AS localCodigo, prova.data AS provaData, prova.horario AS provaHorario, atleta.nome AS atletaNome, atleta.idAtleta AS idAtletinha, medalha.tipoMedalha AS medalhaTipo 
                    FROM medalha INNER JOIN competir ON competir.olimpiada_nome = medalha.olimpiada_nome AND medalha.local_codigo = competir.local_codigo AND 
                    medalha.prova_horario = competir.prova_horario AND medalha.prova_data = competir.prova_data AND medalha.atleta_idAtleta = competir.atleta_idAtleta
                    INNER JOIN olimpiada ON olimpiada.nome = competir.olimpiada_nome 
                    INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN local ON prova.local_codigo = local.codigo 
                    INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta
                    WHERE olimpiada.ano = '$valorConsulta';";
    } else {
        $comando = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, prova.modalidade AS provaModalidade, prova.tipoModalidade AS provaTipoModalidade, 
                    local.nome AS localNome, local.codigo AS localCodigo, prova.data AS provaData, prova.horario AS provaHorario, atleta.nome AS atletaNome, atleta.idAtleta AS idAtletinha, medalha.tipoMedalha AS medalhaTipo 
                    FROM medalha INNER JOIN competir ON competir.olimpiada_nome = medalha.olimpiada_nome AND medalha.local_codigo = competir.local_codigo AND 
                    medalha.prova_horario = competir.prova_horario AND medalha.prova_data = competir.prova_data AND medalha.atleta_idAtleta = competir.atleta_idAtleta
                    INNER JOIN olimpiada ON olimpiada.nome = competir.olimpiada_nome 
                    INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN local ON prova.local_codigo = local.codigo 
                    INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta
                    WHERE tipoMedalha LIKE '%$valorConsulta%';";
    }

    $resultado = mysqli_query($conexao, $comando);

    echo "<tr>
        <th> Olímpiada </th>
        <th> Modalidade </th>
        <th> Tipo de Modalidade </th>
        <th> Local </th>
        <th> Data </th>
        <th> Horário </th>
        <th> Atleta </th>
        <th> Medalha </th>
        <th> Atualizar </th>
        <th> Remover </th>
      </tr>";

    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
          <td class='alinhar'> " . $tupla['olimpiadaNome'] . " - " . $tupla['olimpiadaAno'] . " </td> 
          <td class='alinhar'> " . $tupla['provaModalidade'] . " </td> 
          <td class='alinhar'> " . $tupla['provaTipoModalidade'] . " </td>
          <td class='alinhar'> " . $tupla['localNome'] . " </td>
          <td class='alinhar'> " . $tupla['provaData'] . " </td>
          <td class='alinhar'> " . $tupla['provaHorario'] . "</td>
          <td class='alinhar'> " . $tupla['atletaNome'] . "</td>
          <td class='alinhar'> " . $tupla['medalhaTipo'] . " </td>
          <td> <a href='bd/atualizacao.php?idAt=" . $tupla['provaData'] . "/" . $tupla['provaHorario'] . "/" . $tupla['olimpiadaNome'] . "/" . $tupla['localCodigo'] . "/" . $tupla['idAtletinha'] . "'><img src='../img/refresh.png' width='30px' style='display: block; margin: auto;'></a>
          </td> <td> <a href='bd/remocao.php?idRe=" . $tupla['provaData'] . "/" . $tupla['provaHorario'] . "/" . $tupla['olimpiadaNome'] . "/" . $tupla['localCodigo'] . "/" . $tupla['idAtletinha'] . "'><img src='../img/remove.png' width='30px' style='display: block; margin: auto;'></a> </td>
          </tr>";
    }
}

mysqli_close($conexao);
