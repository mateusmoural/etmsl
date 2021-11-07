<?php
  session_start();
  if ($_SESSION['permissao'] != 'sim') {
    header("Location: index.php");
  }
  else{  	
	$nivel = $_SESSION['nivel'];
	$status = $_SESSION['status'];
	switch ($nivel) {
	  	case '0':
	  		$_SESSION['permissao'] = 'sim';
	  		$_SESSION['permissao_cpf'] = 'sim';
	  		$_SESSION['permissao_root'] = 'sim';
	  		break;
	  	case '1':
	  		$_SESSION['permissao'] = 'sim';
	  		$_SESSION['permissao_cpf'] = 'sim';
	  		break;
	  	case '2':
	  		$_SESSION['permissao'] = 'sim';
	  		break;	
	  	default:
	  		# code...
	  		break;
	}
  }

 ?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" id="bootstrap-css" href="../css/bootstrap.min.css">
<link  rel="stylesheet" href="../css/style.css">

<head>
    
	<style type="text/css">

	body {
	  -webkit-font-smoothing: antialiased;
	  font: normal 10px Roboto,arial,sans-serif;

	}

	.container {
    padding: 3%;
    align-content: center;
    position: center;
    top: 50%;
    -ms-transform: translateY(-50%);      
	}

  
	.formlogin {
	    background-color: #FFF;
	    padding-top: 10px;
	    padding-bottom: 20px;
	    padding-left: 20px;
	    padding-right: 20px;
	    border-radius: 15px;
	    border-color:#d2d2d2;
	    border-width: 5px;
	    box-shadow:0 1px 0 #cfcfcf;
      align-content: center;

	}
  
	h4 { 
	 border:0 solid #EDEDED; 
	 border-bottom-width:1px;
	 padding-bottom:10px;
	 text-align: center;
	}

	.form-control {
	    border-radius: 10px;

	}

	.wrapper {
	    text-align: center;
	}

	</style>
	
	
</head>
<body>

<div align="center"  class="container vertical-center" style="justify-content: center; display: flex;flex-direction: row; align-items: center;">

    <div class="box" style="background-color: white; padding: 50px">

    	<h1><font size="10">Painel de controle</font></h1>



    	<div class="row admin root coordenador">

			<?php if ($nivel < 1) { ?>
				
				<button onclick="window.location.href = './buscas/registrar_boleto_liquidado.php'" type="button" class="btn btn-secondary btn-lg btn-block"> Registrar boletos liquidado</button>

				<button onclick="window.location.href = './buscas/registrar_isentos.php'" type="button" class="btn btn-secondary btn-lg btn-block">Registrar isenções</button>

				<button onclick="window.location.href = './consultas/registrar_boleto_isencoes_indeferidas_.php'" type="button" class="btn btn-secondary btn-lg btn-block"> Criar boletos para isenções indeferidas</button>				

				<button onclick="window.location.href = './consultas/gerar_boleto_sem_boleto_.php'" type="button" class="btn btn-secondary btn-lg btn-block"> Criar boletos não gerados na inscrição</button>

				<button onclick="window.location.href = './buscas/registrar_nota.php'" type="button" class="btn btn-secondary btn-lg btn-block"> Registrar notas</button>

			<?php } ?>

			<?php if ($nivel < 2) { ?>

				<button onclick="window.location.href = './buscas/isencao_solicitada.php'" type="button" class="btn btn-secondary btn-lg btn-block">Pesquisa por pagamento</button>

				<button onclick="window.location.href = './buscas/atendimento_especial.php'" type="button" class="btn btn-secondary btn-lg btn-block">Busca por atendimento especial</button>

				<button onclick="window.location.href = './buscas/classificar.php'" type="button" class="btn btn-secondary btn-lg btn-block"> Classificações</button>

			<?php } ?>

			<?php if ($nivel < 3) { ?>

				<button onclick="window.location.href = './buscas/cadastrados.php'" type="button" class="btn btn-secondary btn-lg btn-block">Cadastrados (inclusive não confirmados)</button>

				<button onclick="window.location.href = './buscas/para_atualizar.php'" type="button" class="btn btn-secondary btn-lg btn-block">Atualizar dados</button>

			<?php } ?>

			<?php if ($nivel < 4) { ?>

				<button id="por_cpf" onclick="window.location.href = './buscas/por_cpf.php'" type="button" class="btn btn-secondary btn-lg btn-block">Busca por CPF</button>

				<button id="por_nome" onclick="window.location.href = './buscas/por_nome.php'" type="button" class="btn btn-secondary btn-lg btn-block">Busca por Nome</button>

			<?php } ?>

			<button id="por_deferidas" onclick="window.location.href = './buscas/confirmadas.php'" type="button" class="btn btn-secondary btn-lg btn-block">Inscrições Confirmadas</button>

    	</div>
		<a style="margin: 5px; align='center'" href="./index.php" class="btn btn-info btn-lg">SAIR</a>
	</div>
</div>

<footer>
  <script src="../js/jquery-1.11.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/functions.js"></script>


</footer>
</body>

</html>
