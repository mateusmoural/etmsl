<?php 
  //Inicia sessões 
  session_start();

  // Sai da sessão pelo botão sair
  if($_GET["sair"]){
    session_destroy();
    header("Location: ../index.php");
  }

  // Sai da sessão se não veio do endereço inscricaoregistrar.php
  if ($_SESSION['status'] != 'registrado') {
    header("Location: ../index.html");
  }
  else{
    $cpf = $_SESSION['cpf'];
  }

  //Cria função para inserir mascaras de exibição
  function format($mask,$string)
  {
    return  vsprintf($mask, str_split($string));
  }
  $cpfMask = "%s%s%s.%s%s%s.%s%s%s-%s%s";
  $cepMask = "%s%s.%s%s%s-%s%s%s";
  $foneMask = "(%s%s) %s %s%s%s%s-%s%s%s%s";

  //Conecta ao banco de dados
  require_once "../lib/conexao.php";

  //busca dados do inscrito
  $sql = "SELECT * FROM processoseletivo WHERE cpf = '$cpf'";
  $result = mysql_query($sql);
  $registro = mysql_fetch_assoc($result);

  $id =               $registro['id'];
  $cpf =              $registro['cpf'];
  $email =            $registro['email'];
  $nome =             $registro['nome'];
  $opcao_curso =      $registro['opcao_curso'];
  $escolar_completa = $registro['escolar_completa'];
  $dt_nasc =          $registro['dt_nasc'];
  $rua =              $registro['rua'];
  $num_res =          $registro['num_res'];
  $complemento =      $registro['complemento'];
  $bairro =           $registro['bairro'];
  $cep =              $registro['cep'];
  $cidade =           $registro['cidade'];
  $uf =               $registro['uf'];
  $fone1 =            $registro['fone1'];
  $situacao =         $registro['situacao'];
  $pagamento =        $registro['pagamento'];
  $especial =         $registro['especial'];
  $info_adicional =   $registro['info_adicional'];
  $url =              $registro['url']; 
  $nosso_numero =     $registro['nosso_numero'];
  $codigobarras =     $registro['codigobarras'];
  $linhadigitavel =   $registro['linhadigitavel'];

  //Cria variáveis de sessão para impressão do boleto
  $_SESSION['url'] = $url;
  $_SESSION['nosso_numero'] = $nosso_numero;
  $_SESSION['codigobarras'] = $codigobarras;
  $_SESSION['linhadigitavel'] = $linhadigitavel;


  switch ($escolar_completa) {
     case '0':
       $escolar="Cursando 1ª ano";
       break;
    case '1':
       $escolar="Cursando 2ª ano";
       break;
    case '2':
       $escolar="Cursando 3ª ano";
       break;
    case '3':
       $escolar="Ensino Médio concluído";
       break;
   }

?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" id="bootstrap-css" href="../css/bootstrap.min.css">
<link  rel="stylesheet" href="../css/style.css">
<head>
  <title>Confirmação - ETMSL</title>

</head>

<body>
  
  <br>
  <div class="container">
    <div class="jumbotron"style="background-color:#fff">
      <div align="center"><img id="logo-img"  class="" src="../img/logo.png" /></div>

      <h2 class="lead">Inscrição online</h2>
      <h3 class="lead">SOLICITAÇÃO DE INSCRIÇÃO REGISTRADA</h3><br>

      <div class="row">
        <div class="col-md-6">
          <p><strong>NOME COMPLETO</strong><br>
            <?php echo $nome;?></p>
        </div>
        <div class="col-md-6">
          <p><strong>CPF</strong><br>
            <?php echo format($cpfMask,$cpf);?></p>
        </div>
      </div> <!-- .row -->
      <div class="row">
        <div class="col-md-6">
          <p><strong>DATA DE NASCIMENTO</strong><br>
            <?php echo $dt_nasc?></p>
        </div>
        <div class="col-md-6">
          <p><strong>E-MAIL</strong><br>
            <?php echo $email?></p>
        </div>
      </div> <!-- .row -->
      <hr> 

      <div class="row">
        <div class="col-md-6">
          <p><strong>CURSO SELECIONADO</strong><br>
            <?php echo $opcao_curso?></p>
        </div>
        <div class="col-md-6">
          <p><strong>ESCOLARIDADE</strong><br>            
            <?php echo $escolar?></p>
        </div>
      </div> <!-- .row -->

      <div class="row">
        <div class="col-md-6">
          <p><strong>SITUAÇÃO DA INSCRIÇÃO</strong><br>
            <?php echo $situacao?></p>
        </div>
        <div class="col-md-6">
          <p><strong>PAGAMENTO DO BOLETO</strong><br>
            <?php echo $pagamento?></p>
        </div>
      </div> <!-- .row -->
      
        <?php 
          if ($especial <> "NENHUMA") {
            echo '
            <div class="row">
              <div class="col-md-6">
                <p><strong>ATENDIMENTO ESPECIAL</strong><br>
                  '.  $especial .'</p>
              </div>
              <div class="col-md-6">
                <p><strong>INFORMAÇÃO ADICIONAL</strong><br>
                  '. $info_adicional . '</p>
              </div>
              </div> <!-- .row -->';
            }
        ?>
      

      <hr>

      <div class="row">
        
        <div class="col-md-6">
          <p><strong>TELEFONE</strong><br>
            <?php echo format($foneMask,$fone1);?></p>
        </div>
        <div class="col-md-6">
          <p><strong>CEP</strong><br>
            <?php echo format($cepMask,$cep);?></p>
        </div>
      </div> <!-- .row -->

      <div class="row">
        <div class="col-md-6">
          <p><strong>ENDEREÇO</strong><br>
            <?php echo $rua?></p>
        </div>
        <div class="col-md-6">
          <p><strong>NÚMERO</strong><br>
            <?php echo $num_res?></p>
        </div>
      </div> <!-- .row -->
      <div class="row">
        <div class="col-md-6">
          <p><strong>COMPLEMENTO</strong><br>
            <?php echo $complemento?></p>
        </div>
        <div class="col-md-6">
          <p><strong>BAIRRO/DISTRITO</strong><br>
            <?php echo $bairro?></p>
        </div>
      </div> <!-- .row -->

      <div class="row">
        <div class="col-md-6">
          <p><strong>MUNICÍPIO</strong><br>
            <?php echo $cidade?></p>
        </div>
        <div class="col-md-6">
          <p><strong>UNIDADE FEDERATIVA:</strong><br>
            <?php echo $uf?></p>
        </div>
      </div> <!-- .row -->

      <hr>

      <p>#<br>
        #
      </p>

      <hr />
      <?php 
        if ($pagamento == "PENDENTE") {
          echo '
          <div id="actions" class="row">
             <div class="col-md-12">
              <a class="btn btn-default" " href="'.$url.'">Imprimir Boleto</a>
             </div>
             
          </div>';
        }
        else{
          echo '
          <div class="row">
            <div class="col-md-6">
              
            </div>            
          </div> <!-- row -->';
        }
      ?>
      <div id="actions" class="row">
         <div class="col-md-12">
          <a href="confirmacao.php?sair=1" class="btn btn-default">Sair</a>
         </div>
      </div>   
    </div>
  </div>
</body>
</html>