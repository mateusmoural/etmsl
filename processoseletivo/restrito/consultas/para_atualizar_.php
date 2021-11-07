<?php

	session_start();

	session_start();
	if ($_SESSION['nivel'] > 2) {
		header("Location: ../menu.php");
	}

	else{
		$_SESSION['status'] = 'alterar';
		$_SESSION['permissao_cpf'] = 'sim';
	}

	ini_set('default_charset', 'UTF-8');

	$candidato =  $_POST['busca'];

	//Estabelece conexão com banco de dados
	require_once "../../lib/conexao.php";
	$query = "SELECT * FROM processoseletivo WHERE nome LIKE '%$candidato%' ORDER BY nome ASC";
	$result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
	$num   = mysql_num_rows($result);	

	if($num > 0){
		echo "Foram encontrados " . $num . " resultados!<br>";
		echo '
        <div class="container"><div class="row"><div class="col-12">
        <table class="table table-striped table-bordered table-condensed table-hover">
          <thead>
              <tr>
                  <td>Nome</td>
                  <td>Curso Selecionado</td>
                  <td>CPF</td>
                  <td>Email</td>
                  <td>Fone</td>
                  <td>Boleto</td>
                  <td>Alterar</td>
              </tr>
          </thead>
          <tbody>';


	    while($row = mysql_fetch_array($result)){

			if($row[pagamento]<>"PENDENTE"){
				echo ('
				<tr>
					<td>' .$row[nome]. '</td>
					<td>' .$row[opcao_curso]. '</td>
					<td>' .$row[cpf].'</td>
					<td>' .$row[email]. '</td>
					<td>' .$row[fone1]. '</td>
					<td>' .$row[pagamento]. '</td>
					<td>
					<form id=”pago” method="post" action="update.php">
   						<input type="hidden" name="id_candidato" value="'.$row[id].'">
   						<input class="btn btn-danger" type="submit" name="update" value="Alterar">
					</form>
					</td>

				</tr>');
			}
			else{
				echo ('
				<tr>
					<td>' .$row[nome]. '</td>
					<td>' .$row[opcao_curso]. '</td>
					<td>' .$row[cpf].'</td>
					<td>' .$row[email]. '</td>
					<td>' .$row[fone1]. '</td>
					<td><a class="btn btn-primary" " href="'.$row[url].'">Boleto</a> </td>
					<td>
					<form id=”pago” method="post" action="../buscas/update.php">
   						<input type="hidden" name="id_candidato" value="'.$row[id].'">
   						<input class="btn btn-danger" type="submit" name="update" value="Alterar">
					</form>
					</td>
				</tr>');
			}
	    }

	    echo "
          </tbody>
          </table>
          </div></div></div>";


	}else{
	  echo "Nenhum resultado!";
	}


mysql_close();
?>
