<?php

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "SELECT qtdPaises, olimpiada.nome AS olimpiadaNome, data_inicio, data_termino, p2.nome AS primeiroNome, p3.nome AS segundoNome, p4.nome AS terceiroNome, ano, p1.nome AS paisNome FROM olimpiada 
                       INNER JOIN pais AS p1 ON olimpiada.pais_codigo = p1.codigo LEFT JOIN pais AS p2 ON olimpiada.primeiro = p2.codigo 
                       LEFT JOIN pais AS p3 ON olimpiada.segundo = p3.codigo LEFT JOIN pais AS p4 ON olimpiada.terceiro = p4.codigo";
$resultado = mysqli_query($conexao, $comando);

echo "<tr>
        <th> Nome </th>
        <th> Data de Início </th>
        <th> Data de Término </th>
        <th> Ano </th>
        <th> Primeiro </th>
        <th> Segundo </th>
        <th> Terceiro </th>
        <th> País </th>
        <th> Quantidade de Países </th>
        <th> Atualizar </th>
        <th> Remover </th>
        <th> Gerar Pódio </th>
      </tr>";

while ($tupla = mysqli_fetch_assoc($resultado)) {
    echo "<tr>
          <td class='alinhar'> " . $tupla['olimpiadaNome'] . " </td> 
          <td class='alinhar'> " . $tupla['data_inicio'] . " </td> 
          <td class='alinhar'> " . $tupla['data_termino'] . " </td>
          <td class='alinhar'> " . $tupla['ano'] . " </td>
          <td class='alinhar'> " . $tupla['primeiroNome'] . " </td>
          <td class='alinhar'> " . $tupla['segundoNome'] . " </td>
          <td class='alinhar'> " . $tupla['terceiroNome'] . " </td>
          <td class='alinhar'> " . $tupla['paisNome'] . " </td>
          <td class='alinhar'> " . $tupla['qtdPaises'] . " </td>
          <td> <a href='bd/atualizacao.php?idAt=" . $tupla['olimpiadaNome'] . "'><img src='../img/refresh.png' width='30px' style='display: block; margin: auto;'></a> </td> 
          <td> <a href='bd/remocao.php?idRe=" . $tupla['olimpiadaNome'] . "'><img src='../img/remove.png' width='30px' style='display: block; margin: auto;'></a> </td>
          <td> <a href='gerarPodio.php?idPodio=" . $tupla['olimpiadaNome'] . "'><img src='../img/ranking.png' width='30px' style='display: block; margin: auto;'></a> </td>
          </tr>";
}

mysqli_close($conexao);
