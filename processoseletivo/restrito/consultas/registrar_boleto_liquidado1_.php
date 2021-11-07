<?php
  session_start();
  if ($_SESSION['nivel'] > 0) {
    header("Location: ../menu.php");
  }

  //Conecta ao banco de dados
  require_once "../../lib/conexao.php";
  mysql_select_db("etmsl2", $conexao);


  $arquivo_tmp = $_FILES['extrato']['tmp_name'];
  
  $dados=file($arquivo_tmp);

  
  foreach ($dados as $linha) {
    $linha = trim($linha);
    $valor=explode(',', $linha);    

    $nosso_numero = $valor[0];
    $cpf = $valor[1];
    $nome= $valor[2];
    

    //Consulta registros sem boleto e com cpf
    $query = "SELECT * FROM processoseletivo  WHERE cpf = '$cpf'";
    $result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );

    while ($row = mysql_fetch_array($result)) {
      //Busca os resultados e os colota nas variáveis
      $id = $row[id];
    }

    if ($id<>'') {
      echo $nome.'<br>';
      echo $cpf.'<br>';
      echo $nosso_numero.'<br>';
      echo $id.'<br>';
      echo "<br>Feito!<br><br>";

      $sql = "UPDATE processoseletivo SET situacao = 'INSCRITO', pagamento = 'LIQUIDADO' WHERE id = '$id'";
      //Registra no banco de dados
      $registro = mysql_query($sql);
    }

    

    $id = '';
  }

    //Informa a conclusão do laço while
    

    //echo '<button type="button" class="btn btn-info btn-block" id="voltar" onclick="window.location.href = '."'registrarboleto_semboleto_.php'".'">Próximo</button><br><br>';
    
    //break;
  //}

  echo '<button type="button" class="btn btn-info btn-block" id="voltar" onclick="window.location.href = '."'../menu.php'".'">Voltar</button><br><br>';

?>