<?php

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$tipoConsulta = $_POST["tipoConsulta"];

if (isset($_POST["valorConsulta"])) {
    $valorConsulta = $_POST["valorConsulta"];

    if ($valorConsulta == "") {
        $comando = "SELECT local.codigo, local.nome, local.capacidade, local.endereco, pais.nome AS nomePais FROM local INNER JOIN pais ON local.pais_codigo = pais.codigo";
    } else if ($tipoConsulta == "Nome") {
        $comando = "SELECT local.codigo, local.nome, local.capacidade, local.endereco, pais.nome AS nomePais FROM local INNER JOIN pais ON local.pais_codigo = pais.codigo WHERE local.nome LIKE '%$valorConsulta%'";
    } else if ($tipoConsulta == 'Codigo') {
        $comando = "SELECT local.codigo, local.nome, local.capacidade, local.endereco, pais.nome AS nomePais FROM local INNER JOIN pais ON local.pais_codigo = pais.codigo WHERE local.codigo = '$valorConsulta'";
    } else if ($tipoConsulta == 'Endereco') {
        $comando = "SELECT local.codigo, local.nome, local.capacidade, local.endereco, pais.nome AS nomePais FROM local INNER JOIN pais ON local.pais_codigo = pais.codigo WHERE local.endereco LIKE '%$valorConsulta%'";
    } else if ($tipoConsulta == 'Capacidade') {
        $comando = "SELECT local.codigo, local.nome, local.capacidade, local.endereco, pais.nome AS nomePais FROM local INNER JOIN pais ON local.pais_codigo = pais.codigo WHERE local.capacidade = '$valorConsulta'";
    } else {
        $comando = "SELECT local.codigo, local.nome, local.capacidade, local.endereco, pais.nome AS nomePais FROM local INNER JOIN pais ON local.pais_codigo = pais.codigo WHERE pais.nome LIKE '%$valorConsulta%'";
    }

    $resultado = mysqli_query($conexao, $comando);

    echo "<tr>
        <th> Código </th>
        <th> Nome </th>
        <th> Endereço </th>
        <th> Capacidade </th>
        <th> País </th>
        <th> Atualizar </th>
        <th> Remover </th>
      </tr>";

    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
              <td class='alinhar'> " . $tupla['codigo'] . " </td> 
              <td class='alinhar'> " . $tupla['nome'] . " </td> 
              <td class='alinhar'> " . $tupla['endereco'] . " </td>
              <td class='alinhar'> " . $tupla['capacidade'] . " </td>
              <td class='alinhar'> " . $tupla['nomePais'] . " </td>
              <td> <a href='bd/atualizacao.php?idAt=" . $tupla['codigo'] . "'><img src='../img/refresh.png' width='30px' style='display: block; margin: auto;'></a>
              </td> <td> <a href='bd/remocao.php?idRe=" . $tupla['codigo'] . "'><img src='../img/remove.png' width='30px' style='display: block; margin: auto;'></a> </td>
              </tr>";
    }
}

mysqli_close($conexao);
