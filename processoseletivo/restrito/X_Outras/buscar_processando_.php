<?php
ini_set('default_charset', 'UTF-8');
$banco = "etmsl02";
$usuario = "etmsl02";
$senha = "3199862002";
$hostname = "mysql.etmsl.com.br";

$candidato =  $_POST['busca'];


$conn = mysql_connect($hostname,$usuario,$senha); mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");
if (!$conn) {
	echo "Não foi possível conectar ao banco MySQL."; exit;
}
else {
	$query = "SELECT * FROM processoseletivo WHERE nome LIKE '%$candidato%'";
	$result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
	$num   = mysql_num_rows($result);
}
	if($num >0){
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
                  <td>Informar</td>
              </tr>
          </thead>

          <tbody>';


	    while($row = mysql_fetch_array($result)){

			if($row[pagamento]<>"PENDENTE"){
				echo utf8_encode('
				<tr>
					<td>' .$row[nome]. '</td>
					<td>' .$row[opcao_curso]. '</td>
					<td>' .$row[cpf].'</td>
					<td>' .$row[email]. '</td>
					<td>' .$row[fone1]. '</td>
					<td>' .$row[pagamento]. '</td>
				</tr>');
			}
			else{
				echo utf8_encode('
				<tr>
					<td>' .$row[nome]. '</td>
					<td>' .$row[opcao_curso]. '</td>
					<td>' .$row[cpf].'</td>
					<td>' .$row[email]. '</td>
					<td>' .$row[fone1]. '</td>
					<td><a class="btn btn-primary" " href="'.$row[url].'">Boleto</a> </td>
					<!-- Botão que alterna processando  ou pendente-->
					<td>
					<form id=”pago” method="post" action="informar_processando_.php">
   						<input type="hidden" name="id_candidato" value="'.$row[id].'">
   						<input class="btn btn-danger" type="submit" name="pagamento" value="Alterar">
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
	  echo "Não inscrito!";
	}


mysql_close();
?>
