<?php

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$tipoConsulta = $_POST["tipoConsulta"];

if (isset($_POST["valorConsulta"])) {
    $valorConsulta = $_POST["valorConsulta"];

    if ($valorConsulta == "") {
        $comando = "SELECT * FROM pais";
    }
    if ($tipoConsulta == "Nome") {
        $comando = "SELECT * FROM pais WHERE nome LIKE '%" . $valorConsulta . "%'";
    } else {
        $comando = "SELECT * FROM pais WHERE codigo LIKE '%" . $valorConsulta . "%'";
    }

    $resultado = mysqli_query($conexao, $comando);

    echo "<tr>
            <th> Código </th>
            <th> Nome </th>
            <th> Número de Atletas </th>
            <th> Atualizar </th>
            <th> Remover </th>
          </tr>";

    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
          <td class='alinhar'> " . $tupla['codigo'] . " </td> <td class='alinhar'> " . $tupla['nome'] . " </td> <td class='alinhar'> " . $tupla['numeroAtletas'] . " </td>
          <td> <a href='bd/atualizacao.php?codigoAt=" . $tupla['codigo'] . "'><img src='../img/refresh.png' width='30px' style='display: block; margin: auto;'></a>
          </td> <td> <a href='bd/remocao.php?codigoRe=" . $tupla['codigo'] . "'><img src='../img/remove.png' width='30px' style='display: block; margin: auto;'></a> </td>
          </tr>";
    }
}

mysqli_close($conexao);
