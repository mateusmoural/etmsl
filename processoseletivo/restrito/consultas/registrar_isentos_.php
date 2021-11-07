<?php
  session_start();
  if ($_SESSION['isento'] != 'sim') {
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

    $nome= $valor[0];
    $cpf = $valor[1];
    $situa= $valor[2];
    

    //Consulta registros sem boleto e com cpf
    $query = "SELECT * FROM processoseletivo  WHERE cpf = '$cpf'";
    $result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );

    while ($row = mysql_fetch_array($result)) {
      //Busca os resultados e os colota nas variáveis
      $id = $row[id];
    }

    if ($id<>''&&$situa=='ISENTO') {
      echo $nome.'<br>';
      echo "Feito!<br><br>";

      $sql = "UPDATE processoseletivo SET situacao = 'INSCRITO', pagamento = 'ISENTO' WHERE id = '$id'";
      //Registra no banco de dados
      $registro = mysql_query($sql);
    }

    if ($id<>''&&$situa=='INDEFERIDA') {
      echo $nome.'<br>';
      echo "Feito!<br><br>";

      $sql = "UPDATE processoseletivo SET situacao = 'ISENCAO INDEFERIDA' WHERE id = '$id'";
      //Registra no banco de dados
      $registro = mysql_query($sql);
    }


    

    $id = '';
  }

    //Informa a conclusão do laço while
    

    //echo '<button type="button" class="btn btn-info btn-block" id="voltar" onclick="window.location.href = '."'registrarboleto_semboleto_.php'".'">Próximo</button><br><br>';
    
    //break;
  //}

  echo '<button type="button" class="btn btn-info btn-block" id="voltar" onclick="window.location.href = '."'painel.php'".'">Voltar</button><br><br>';

?>