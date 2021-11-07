<?php 
  //Inicia sessões 
  session_start();

  // Sai da sessão pelo botão sair
  if($_GET["sair"]){
    session_destroy();
    header("Location: ../index.php");
  }

  // Sai da sessão se não veio do endereço isencaoregistrar.php
  if ($_SESSION['status'] != 'isencaoregistrado') {
    header("Location: ../index.php");
  }
  else{
    $cpf = $_SESSION['cpf'];
    $estado_civil = $_SESSION['estado_civil'];
    $profissao = $_SESSION['profissao'];
    $_SESSION['status'] = 'isencaoregistrado';
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

  $id               = $registro['id'];
  $cpf              = $registro["cpf"];
  $email            = $registro["email"];
  $nome             = $registro["nome"];
  $opcao_curso      = $registro["opcao_curso"];
  $escolar_completa = $registro["escolar_completa"];
  $dt_nasc          = $registro["dt_nasc"];
  $rua              = $registro["rua"];
  $num_res          = $registro["num_res"];
  $complemento      = $registro["complemento"];
  $bairro           = $registro["bairro"];
  $cep              = $registro["cep"];
  $cidade           = $registro["cidade"];
  $uf               = $registro["uf"];
  $fone1            = $registro["fone1"];
  $especial         = $registro["especial"];
  $info_adicional   = $registro["info_adicional"];  
  $nis              = $registro["nis"];
  $rg               = $registro["rg"];

$nasc=date('d/m/Y',strtotime($dt_nasc));
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$hoje = strftime('%d de %B de %Y', strtotime('today'));


?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<link rel="stylesheet" id="bootstrap-css" href="../css/bootstrap.min.css">
<link  rel="stylesheet" href="../css/style.css">
<head>
  <title>Anexos - ETMSL</title>
  

</head>

<body>
<div class="container">
  <div class="jumbotron"style="background-color:#fff">
    <div align="center"><img id="logo-img"  class="" src="../img/logo.png" /></div>

    <h2 class="lead">Inscrição online</h2>

<h3><strong>ESCOLA T&Eacute;CNICA MUNICIPAL DE SETE LAGOAS</strong></h3>
<h3><strong>Processo Seletivo &ndash; </strong><strong>2</strong><strong>&ordm; Semestre de 2021</strong></h3>

<p><strong>Anexo II</strong></p>

<p>&nbsp;&Agrave;</p>

<p>Comiss&atilde;o de An&aacute;lise de Pedidos de Isen&ccedil;&atilde;o do Valor da Inscri&ccedil;&atilde;o.</p>

<p>Eu, <?php echo $nome?>, portador do RG n&ordm; <?php echo $rg?> e inscrito no CPF sob o n&ordm; <?php echo format($cpfMask,$cpf);?>, declaro, sob as penas da lei, para fins de pedido de isen&ccedil;&atilde;o do pagamento do valor da inscri&ccedil;&atilde;o do Processo Seletivo da Escola T&eacute;cnica Municipal de Sete Lagoas para o Curso T&eacute;cnico em <?php echo $opcao_curso?> Edital n&ordm; 001/2021, que n&atilde;o tenho v&iacute;nculo empregat&iacute;cio vigente registrado na CTPS.</p>
<p>Apresento os dados de todos os documentos solicitados e estou ciente que a falta de algum deles caracterizar&aacute; em indeferimento.</p>

<p><?php echo $cidade.', '.$hoje?>.</p>


<p>Autenticado&nbsp;por meio de CPF, login e senha Google.<br><?php echo format($cpfMask,$cpf);?> <?php echo $email?><br>Código de autenticação <?php echo rand(55123456789, 99993456789);?></p><br>

<h3><strong>ESCOLA T&Eacute;CNICA MUNICIPAL DE SETE LAGOAS</strong></h3>
<h3><strong>Processo Seletivo &ndash; </strong><strong>2</strong><strong>&ordm; Semestre de 2021</strong></h3>

<p><strong>Anexo III</strong></p>

<p><strong>DECLARA&Ccedil;&Atilde;O DE HIPOSSUFICI&Ecirc;NCIA FINANCEIRA</strong></p>

<p>Eu, <?php echo $nome?>, <strong>NIS N&deg; </strong><?php echo $nis?> brasileiro, <?php echo $estado_civil?>, <?php echo $profissao?>, nascido aos <?php echo $nasc?>, inscrito no CPF/MF sob o n&ordm; <?php echo format($cpfMask,$cpf);?>, portador da Carteira de Identidade, RG n&ordm; <?php echo $rg?>, residente e domiciliado na <?php echo $rua?> <?php echo $num_res?>, <?php echo $bairro?>, cidade de <?php echo $cidade?> - <?php echo $uf?>, CEP: <?php echo format($cepMask,$cep);?>, <strong>DECLARO </strong>para os devidos fins e sob as penas da lei que n&atilde;o possuo, atualmente, qualquer v&iacute;nculo empregat&iacute;cio com anota&ccedil;&atilde;o em minha Carteira de Trabalho, nem v&iacute;nculo estatut&aacute;rio ou assemelhado, ou mesmo contrato de presta&ccedil;&atilde;o de servi&ccedil;os com o Poder P&uacute;blico, seja nos &acirc;mbitos federal, estadual ou municipal, nem, aufiro, ainda, qualquer tipo de renda, &agrave; exce&ccedil;&atilde;o de seguro-desemprego e minha situa&ccedil;&atilde;o econ&ocirc;mica enquadra-se a de membro de fam&iacute;lia de baixa renda nos termos do Decreto Federal n&ordm; 6.135/2007, n&atilde;o me permitindo, assim, a pagar o valor de inscri&ccedil;&atilde;o para participar do <strong>Processo Seletivo, 2&ordm; Semestre de 2021, Edital n&ordm; 001/2021 da Escola T&eacute;cnica Municipal de Sete Lagoas/MG</strong>, sem preju&iacute;zo do sustento pr&oacute;prio ou de minha fam&iacute;lia.</p>

<p>Declaro ainda, estar ciente que estou sujeito &agrave;s san&ccedil;&otilde;es civis, administrativas e criminais aplic&aacute;veis por for&ccedil;a de Lei, em sendo comprovada a falsidade das afirma&ccedil;&otilde;es supra.</p>

<p><?php echo $cidade.', '.$hoje?>.</p>

<p>Autenticado&nbsp;por meio de CPF, login e senha Google.<br><?php echo format($cpfMask,$cpf);?> <?php echo $email?><br>Código de autenticação <?php echo rand(25123456789, 99993456789);?></p>



<hr>
      
<div id="actions" class="row">
    <div class="col-md-12">
    <a href="confirmacao.php" class="btn btn-default">Prosseguir</a>
    </div>
</div><!-- .row -->

</div>
</div>

</body>
</html>