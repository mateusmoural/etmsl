<?php
ini_set('default_charset', 'UTF-8');
  //Conecta ao banco de dados
  require_once "../../lib/conexao.php";
  mysql_select_db("etmsl2", $conexao);

$curso =  $_POST['busca'];



	//Conecta ao banco de dados
	require_once "../../lib/conexao.php";
	mysql_select_db("etmsl2", $conexao);

	$query = "SELECT opcao_curso, cpf, pontos, escolar_informada, dt_nasc, nome FROM processoseletivo WHERE classificacao='INSCRITO' AND opcao_curso LIKE '%$curso%' ORDER BY pontos DESC, escolar_informada DESC, dt_nasc ASC";
	$result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
	$num   = mysql_num_rows($result);	


//<td>Curso Selecionado</td> <td>Pagamento</td>
	if($num >0){
		echo "Foram encontrados " . $num . " resultados!<br>";
		echo '
		<div class="container"><div class="row"><div class="col-12">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<tr>
					<td>CURSO</td>					
					<td>ORDEM</td>
					<td>NOME</td>
					<td>ACERTOS</td>					
					<td>ESCOLARIDADE</td>
					<td>NASCIMENTO</td>					
					<td>CPF</td>
				</tr>
			</thead>

			<tbody>';
          $n = 1;

//<td>' .$row[esccargo]. '</td><td>' .$row[RG]. '</td>
	    while($row = mysql_fetch_array($result)){
			switch ($row[escolar_informada]) {
				case '3':
					$escolar="ENSINO MEDIO COMPLETO";
					break;
				case '2':
					$escolar="CURSANDO ENSINO MEDIO";
					break;
				case '1':
					$escolar="CURSANDO SEGUNDO ANO";
					break;
			
				default:
					$escolar="CURSANDO SEGUNDO ANO";
					break;
			}
			echo utf8_encode('
				<tr>									
					<td>' .$row[opcao_curso]. '</td>				
					
					<td>' .$n++. '</td>
					<td>' .$row[nome]. '</td>
					<td>' .$row[pontos]. '</td>
					<td>' .$escolar. '</td>
					<td>' .$row[dt_nasc]. '</td>					
					<td>' .$row[cpf]. '</td>
					
				</tr>'
			);			
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
