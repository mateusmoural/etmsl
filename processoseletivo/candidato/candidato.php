<?php 
// Inicia sessões 
  session_start();
  if($_GET["sair"]){
    session_destroy();
    header("Location: ../index.php");
  }

  if ($_SESSION['status'] != 'inscrito') {
    header("Location: ../index.php");
  }
  else{
    $cpf = $_SESSION['cpf'];
    $contagoogle = $_SESSION['email'];
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
  require "../lib/conexao.php";

  //busca dados do inscrito
  $sql = "SELECT id, cpf, nome, opcao_curso, dt_nasc, email, fone1, rua, num_res, complemento, bairro, cep, cidade, uf, situacao, pagamento, classificacao, url, escolar_completa, link, link_matricula FROM processoseletivo WHERE cpf = '$cpf'";
  $result = mysql_query($sql);
  $registro = mysql_fetch_assoc($result);

  $id =               $registro['id'];
  $cpf =              $registro['cpf'];
  $nome =             $registro['nome'];
  $opcao_curso =      $registro['opcao_curso'];  
  $dt_nasc =          $registro['dt_nasc'];
  $email =            $registro['email'];
  $fone1 =            $registro['fone1'];
  $rua =              $registro['rua'];
  $num_res =          $registro['num_res'];
  $complemento =      $registro['complemento'];
  $bairro =           $registro['bairro'];
  $cep =              $registro['cep'];
  $cidade =           $registro['cidade'];
  $uf =               $registro['uf'];
  $situacao =         $registro['situacao'];  
  $pagamento =        $registro['pagamento'];
  $url =              $registro['url'];
  $escolar_completa = $registro['escolar_completa'];
  $classificacao =    $registro['classificacao'];
  $link =             $registro['link'];
  $link_matricula =   $registro['link_matricula'];

  switch ($escolar_completa) {
     case '0':
       $escolar_completa="CURSANDO 1ª ANO";
       break;
    case '1':
       $escolar_completa="CURSANDO 2ª ANO";
       break;
    case '2':
       $escolar_completa="Cursando 3ª ano";
       break;
    case '3':
       $escolar_completa="ENSINO MÉDIO CONCLUÍDO";
       break;
   }
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" id="bootstrap-css" href="../css/bootstrap.min.css">
<link  rel="stylesheet" href="../css/style.css">
<head>
  <title>Escola Técnica Municipal de Sete Lagoas</title>
</head>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" id="bootstrap-css" href="../css/bootstrap.min.css">
<link  rel="stylesheet" href="../css/style.css">
<head>

</head>
<body>
  
  <br>
  <div class="container">
    <div class="jumbotron"style="background-color:#fff">
      <div align="center"><img id="logo-img"  class="" src="../img/logo.png" /></div>

      <h2 class="lead">Inscrição online</h2>
      <h3 class="lead">PAGINA DO CANDIDATO:</h3><br>

      <div class="row">
        <div class="col-md-6">
          <p><strong>NOME COMPLETO </strong><br>
            <?php echo $nome ?></p>
        </div>
        <div class="col-md-6">
          <p><strong>CPF</strong><br>
            <?php echo format($cpfMask,$cpf) ?></p>
        </div>
      </div> <!-- .row -->
            <div class="row">
        <div class="col-md-6">
          <p><strong>DATA DE NASCIMENTO</strong><br>
            <?php echo date('d/m/Y', strtotime($dt_nasc));?></p>
        </div>
        <div class="col-md-6">
          <p><strong>E-MAIL </strong><br>
            <?php echo $email ?></p>
        </div>
      </div> <!-- .row -->
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


      <div class="row">
        <div class="col-md-6">
          <p><strong>CURSO SELECIONADO</strong><br>
            <?php echo $opcao_curso?></p>
        </div>
        <div class="col-md-6">
          <p><strong>ESCOLARIDADE</strong><br>            
            <?php echo $escolar_completa?></p>
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

      <!-- .row -->
      <div class="row">


        
           
        

      <?php  
       
       echo '


        
        
        
        
        ';       

        /* Comentario para Link de prova, classificação e matricula
        
        
        //link de prova
        <div class="col-md-6">        
          <p><strong>ACESSO À PROVA</strong><br> 
            <a href="'.$link.'">LINK DA PROVA</a>
          </p>
        </div>


        //Classificação
        <div class="col-md-6">
          <p><strong>CLASSIFICAÇÃO</strong><br> 
          '.$classificacao.'</p>
        </div>


        //Inicio da matricula
        echo '
        </div> <!-- .row -->
        <div class="row">
        ';
        
        if ($situacao == "APROVADO PRIMEIRA CHAMADA"){
        //if ($situacao == "APROVADO SEGUNDA CHAMADA"){
        //if ($situacao == "APROVADO TERCEIRA CHAMADA"){
        //if ($situacao == "APROVADO QUARTA CHAMADA"){

            echo '<div class="col-md-6">
              <p><strong>LINK PARA MATRICULA</strong><br> 
                <a href="'.$link_matricula.'">LINK</a>
              </p>
            </div>';
        }  
        //Fim da matricula

   */ 
  
  
        /*

        <!-- <div class="col-6">
          <p><a href="./atualizar.php" class="btn btn-warning ">Atualizar dados</a></p>
        </div>-->


        */  
        
      ?>

      </div>  <!--.row -->


      <p><br></p>
      
      <hr/>
      <div id="actions" class="row">        
        
      <?php 
        if ($pagamento == "PENDENTE") {
          echo '          
            <div class="col-6">
              <p><a class="btn btn-info " " href="'.$url.'">Imprimir Boleto</a></p>             
            </div>
          ';
        }
      ?>      
    </div>  <!--.row -->
    <div id="actions" class="row">
      <div class="col-6">
        <p><a href="candidato.php?sair=1" class="btn btn-danger ">Sair</a></p>
      </div>
    </div>  <!--.row -->
        
    </div>
  </div>
</body>
</html>