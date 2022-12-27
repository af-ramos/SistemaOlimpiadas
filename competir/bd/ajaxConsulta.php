<?php

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$tipoConsulta = $_POST["tipoConsulta"];

if (isset($_POST["valorConsulta"])) {
    $valorConsulta = $_POST["valorConsulta"];

    if ($valorConsulta == "") {
        $comando = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, local.nome AS localNome, local.codigo AS localCodigo, prova.data AS dataProva, prova.horario AS horarioProva, prova.modalidade AS modalidadeProva, prova.tipoModalidade AS tipoModalidadeProva, atleta.nome AS nomeAtleta, atleta.idAtleta AS IDAtleta 
                    FROM competir INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta 
                    INNER JOIN olimpiada ON prova.olimpiada_nome = olimpiada.nome
                    INNER JOIN local ON prova.local_codigo = local.codigo";
    } else if ($tipoConsulta == "Modalidade") {
        $comando = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, local.nome AS localNome, local.codigo AS localCodigo, prova.data AS dataProva, prova.horario AS horarioProva, prova.modalidade AS modalidadeProva, prova.tipoModalidade AS tipoModalidadeProva, atleta.nome AS nomeAtleta, atleta.idAtleta AS IDAtleta 
                    FROM competir INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta 
                    INNER JOIN olimpiada ON prova.olimpiada_nome = olimpiada.nome
                    INNER JOIN local ON prova.local_codigo = local.codigo
                    WHERE prova.modalidade LIKE '%$valorConsulta%'";
    } else if ($tipoConsulta == 'TipoModalidade') {
        $comando = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, local.nome AS localNome, local.codigo AS localCodigo, prova.data AS dataProva, prova.horario AS horarioProva, prova.modalidade AS modalidadeProva, prova.tipoModalidade AS tipoModalidadeProva, atleta.nome AS nomeAtleta, atleta.idAtleta AS IDAtleta 
                    FROM competir INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta 
                    INNER JOIN olimpiada ON prova.olimpiada_nome = olimpiada.nome
                    INNER JOIN local ON prova.local_codigo = local.codigo
                    WHERE prova.tipoModalidade LIKE '%$valorConsulta%'";
    } else if ($tipoConsulta == 'Olimpiada') {
        $comando = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, local.nome AS localNome, local.codigo AS localCodigo, prova.data AS dataProva, prova.horario AS horarioProva, prova.modalidade AS modalidadeProva, prova.tipoModalidade AS tipoModalidadeProva, atleta.nome AS nomeAtleta, atleta.idAtleta AS IDAtleta 
                    FROM competir INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta 
                    INNER JOIN olimpiada ON prova.olimpiada_nome = olimpiada.nome
                    INNER JOIN local ON prova.local_codigo = local.codigo
                    WHERE olimpiada.nome LIKE '%$valorConsulta%'";
    } else if ($tipoConsulta == 'Local') {
        $comando = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, local.nome AS localNome, local.codigo AS localCodigo, prova.data AS dataProva, prova.horario AS horarioProva, prova.modalidade AS modalidadeProva, prova.tipoModalidade AS tipoModalidadeProva, atleta.nome AS nomeAtleta, atleta.idAtleta AS IDAtleta 
                    FROM competir INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta 
                    INNER JOIN olimpiada ON prova.olimpiada_nome = olimpiada.nome
                    INNER JOIN local ON prova.local_codigo = local.codigo
                    WHERE local.nome LIKE '%$valorConsulta%'";
    } else {
        $comando = "SELECT olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno, local.nome AS localNome, local.codigo AS localCodigo, prova.data AS dataProva, prova.horario AS horarioProva, prova.modalidade AS modalidadeProva, prova.tipoModalidade AS tipoModalidadeProva, atleta.nome AS nomeAtleta, atleta.idAtleta AS IDAtleta 
                    FROM competir INNER JOIN prova ON competir.prova_data = prova.data AND competir.prova_horario = prova.horario AND competir.local_codigo = prova.local_codigo AND competir.olimpiada_nome = prova.olimpiada_nome 
                    INNER JOIN atleta ON competir.atleta_idAtleta = atleta.idAtleta 
                    INNER JOIN olimpiada ON prova.olimpiada_nome = olimpiada.nome
                    INNER JOIN local ON prova.local_codigo = local.codigo
                    WHERE atleta.nome LIKE '%$valorConsulta%'";
    }

    $resultado = mysqli_query($conexao, $comando);

    echo "<tr>
        <th> Olímpiada </th>
        <th> Local </th>
        <th> Data </th>
        <th> Horário </th>
        <th> Modalidade </th>
        <th> Tipo de Modalidade </th>
        <th> Atleta </th>
        <th> Remover </th>
      </tr>";

    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
          <td class='alinhar'> " . $tupla['olimpiadaNome'] . " - " . $tupla['olimpiadaAno'] . " </td> 
          <td class='alinhar'> " . $tupla['localNome'] . " </td> 
          <td class='alinhar'> " . $tupla['dataProva'] . " </td>
          <td class='alinhar'> " . $tupla['horarioProva'] . " </td>
          <td class='alinhar'> " . $tupla['modalidadeProva'] . " </td>
          <td class='alinhar'> " . $tupla['tipoModalidadeProva'] . " </td>
          <td class='alinhar'> " . $tupla['nomeAtleta'] . " </td>
          <td> <a href='bd/remocao.php?idRe=" . $tupla['dataProva'] . "/" . $tupla['horarioProva'] . "/" . $tupla['olimpiadaNome'] . "/" . $tupla['localCodigo']  . "/" . $tupla['IDAtleta'] . "'><img src='../img/remove.png' width='30px' style='display: block; margin: auto;'></a> </td>
          </tr>";
    }
}

mysqli_close($conexao);
