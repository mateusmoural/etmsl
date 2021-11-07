<?php
  session_start();
  if ($_SESSION['pontuado'] != 'sim') {
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
    $pontos = $valor[2];
    

    

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
      echo $pontos.'<br>';


      $sql = "UPDATE processoseletivo SET pontos = $pontos WHERE id = '$id'";
      //Registra no banco de dados
      $registro = mysql_query($sql);

      echo "<br>Feito!<br><br>";
    }
    else {
      echo '#####################################################################################<br>';
      echo $nome.'<br>';
      echo $cpf.'<br>';
      echo '#####################################################################################';
      echo "<br>FALHA!<br><br>";
    }    

    $id = '';
  }

  echo '<button type="button" class="btn btn-info btn-block" id="voltar" onclick="window.location.href = '."'painel.php'".'">Voltar</button><br><br>';

?>








