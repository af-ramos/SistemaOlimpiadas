<?php

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "SELECT idAtleta, atleta.nome, idade, sexo, altura, peso, modalidade, pais.nome AS nomePais FROM atleta INNER JOIN pais ON atleta.pais_codigo = pais.codigo";
$resultado = mysqli_query($conexao, $comando);

echo "<tr>
        <th> ID </th>
        <th> Nome </th>
        <th> Idade </th>
        <th> Sexo </th>
        <th> Altura </th>
        <th> Peso </th>
        <th> Modalidade </th>
        <th> País </th>
        <th> Atualizar </th>
        <th> Remover </th>
      </tr>";

while ($tupla = mysqli_fetch_assoc($resultado)) {
    echo "<tr>
          <td class='alinhar'> " . $tupla['idAtleta'] . " </td> 
          <td class='alinhar'> " . $tupla['nome'] . " </td> 
          <td class='alinhar'> " . $tupla['idade'] . " </td>
          <td class='alinhar'> " . $tupla['sexo'] . " </td>
          <td class='alinhar'> " . $tupla['altura'] . " </td>
          <td class='alinhar'> " . $tupla['peso'] . " </td>
          <td class='alinhar'> " . $tupla['modalidade'] . " </td>
          <td class='alinhar'> " . $tupla['nomePais'] . " </td>
          <td> <a href='bd/atualizacao.php?idAt=" . $tupla['idAtleta'] . "'><img src='../img/refresh.png' width='30px' style='display: block; margin: auto;'></a>
          </td> <td> <a href='bd/remocao.php?idRe=" . $tupla['idAtleta'] . "'><img src='../img/remove.png' width='30px' style='display: block; margin: auto;'></a> </td>
          </tr>";
}

mysqli_close($conexao);
