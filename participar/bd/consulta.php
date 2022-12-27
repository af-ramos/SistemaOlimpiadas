<?php

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "SELECT olimpiada.nome AS olimpiadaNome, pais.nome AS paisNome, pais.codigo AS paisCodigo, olimpiada.ano AS olimpiadaAno FROM participar 
    INNER JOIN olimpiada ON participar.olimpiada_nome = olimpiada.nome 
    INNER JOIN pais ON pais.codigo = participar.pais_codigo";
$resultado = mysqli_query($conexao, $comando);

echo "<tr>
        <th> Olímpiada </th>
        <th> País </th>
        <th> Remover </th>
      </tr>";

while ($tupla = mysqli_fetch_assoc($resultado)) {
    echo "<tr>
              <td class='alinhar'> " . $tupla['olimpiadaNome'] . " - " . $tupla['olimpiadaAno'] . " </td> 
              <td class='alinhar'> " . $tupla['paisNome'] . " </td> 
              <td> <a href='bd/remocao.php?idRe=" . $tupla['olimpiadaNome'] . "%" . $tupla['paisCodigo'] . "'><img src='../img/remove.png' width='30px' style='display: block; margin: auto;'></a> </td>
              </tr>";
}

mysqli_close($conexao);
