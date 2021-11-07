<?php
  

  
  //Conecta ao banco de dados
  require_once "conexao.php";
  mysql_select_db("etmsl2", $conexao);

  //Consulta registros sem boleto e com cpf
  $query = "SELECT * FROM processoseletivo  WHERE  pagamento = 'LIQUIDADO'";
  $result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
  
  //Verifica o numero de resultados e imprime 
  $num   = mysql_num_rows($result);
  echo "Foram encontrados " . $num . " resultados!<br>";

  //A partir daqui as operações serão executades para cada um dos resultados da consulta

  while ($row = mysql_fetch_array($result)) {
    //Busca os resultados e os colota nas variáveis
    $id             = $row[id];
    $nome           = $row[nome];
    $cpf            = $row[cpf];
    $cep            = $row[cep];
    $rua            = $row[rua];
    $bairro         = $row[bairro];
    $cidade         = $row[cidade];
    $uf             = $row[uf];
    $opcao_curso    = $row[opcao_curso];



    //Determina qual mensagem será registrada nos campos pagamento e situação
    
    $pagamento   = "PAGO";


   
    //Só depois de criar o boleto
    //Cria query de atualização 
    $sql = "UPDATE processoseletivo SET pagamento = '$pagamento' WHERE id = '$id'";

    //Registra no banco de dados
    $registro = mysql_query($sql);


    

    //Informa a conclusão do laço while
    echo "<br><br>Feito!<br><br>";

   // echo '<button type="button" class="btn btn-info btn-block" id="voltar" onclick="window.location.href = '."'registrarboleto_semboleto_.php'".'">Próximo</button><br><br>';
    
   // break;
  }

  echo '<button type="button" class="btn btn-info btn-block" id="voltar" onclick="window.location.href = '."'painel.php'".'">Voltar</button><br><br>';

?>