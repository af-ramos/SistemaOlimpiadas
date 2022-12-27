<?php

$conexao = mysqli_connect("localhost", "root", "", "olimpiada");

if (!$conexao)
    die("Falha na conexão: " . mysqli_connect_error());

$comando = "SELECT idEmpresa, nome FROM patrocinador";
$resultado = mysqli_query($conexao, $comando);

echo "<tr>
        <th> ID </th>
        <th> Nome </th>
        <th> Atualizar </th>
        <th> Remover </th>
      </tr>";

while ($tupla = mysqli_fetch_assoc($resultado)) {
    echo "<tr>
              <td class='alinhar'> " . $tupla['idEmpresa'] . " </td> 
              <td class='alinhar'> " . $tupla['nome'] . " </td> 
              <td> <a href='bd/atualizacao.php?idAt=" . $tupla['idEmpresa'] . "'><img src='../img/refresh.png' width='30px' style='display: block; margin: auto;'></a>
              </td> <td> <a href='bd/remocao.php?idRe=" . $tupla['idEmpresa'] . "'><img src='../img/remove.png' width='30px' style='display: block; margin: auto;'></a> </td>
              </tr>";
}

mysqli_close($conexao);
