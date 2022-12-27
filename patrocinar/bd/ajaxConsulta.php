<?php

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$tipoConsulta = $_POST["tipoConsulta"];

if (isset($_POST["valorConsulta"])) {
    $valorConsulta = $_POST["valorConsulta"];

    if ($valorConsulta == "") {
        $comando = "SELECT patrocinar.patrocinador_idEmpresa AS PIDEmpresa, patrocinador.nome AS patrocinadorNome, olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno FROM patrocinar 
                    INNER JOIN patrocinador ON patrocinar.patrocinador_idEmpresa = patrocinador.idEmpresa 
                    INNER JOIN olimpiada ON patrocinar.olimpiada_nome = olimpiada.nome;";
    } else if ($tipoConsulta == "Patrocinador") {
        $comando = "SELECT patrocinar.patrocinador_idEmpresa AS PIDEmpresa, patrocinador.nome AS patrocinadorNome, olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno FROM patrocinar 
                    INNER JOIN patrocinador ON patrocinar.patrocinador_idEmpresa = patrocinador.idEmpresa 
                    INNER JOIN olimpiada ON patrocinar.olimpiada_nome = olimpiada.nome WHERE patrocinador.nome LIKE '%$valorConsulta%';";
    } else {
        $comando = "SELECT patrocinar.patrocinador_idEmpresa AS PIDEmpresa, patrocinador.nome AS patrocinadorNome, olimpiada.nome AS olimpiadaNome, olimpiada.ano AS olimpiadaAno FROM patrocinar 
                    INNER JOIN patrocinador ON patrocinar.patrocinador_idEmpresa = patrocinador.idEmpresa 
                    INNER JOIN olimpiada ON patrocinar.olimpiada_nome = olimpiada.nome WHERE olimpiada.nome LIKE '%$valorConsulta%';";
    }

    $resultado = mysqli_query($conexao, $comando);

    echo "<tr>
        <th> Patrocinador </th>
        <th> Olímpiada </th>
        <th> Remover </th>
      </tr>";

    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
              <td class='alinhar'> " . $tupla['patrocinadorNome'] . " </td> 
              <td class='alinhar'> " . $tupla['olimpiadaNome'] . " - " . $tupla['olimpiadaAno'] . " </td> 
              <td> <a href='bd/remocao.php?idRe=" . $tupla['PIDEmpresa'] . "%" . $tupla['olimpiadaNome'] . "'><img src='../img/remove.png' width='30px' style='display: block; margin: auto;'></a> </td>
              </tr>";
    }
}

mysqli_close($conexao);
