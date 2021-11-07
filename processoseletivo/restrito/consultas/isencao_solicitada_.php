<?php
ini_set('default_charset', 'UTF-8');
$banco = "etmsl02";
$usuario = "etmsl02";
$senha = "3199862002";
$hostname = "mysql.etmsl.com.br";

$pagamento =  $_POST['busca'];

$conn = mysql_connect($hostname,$usuario,$senha); mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");
if (!$conn) {echo "Não foi possível conectar ao banco MySQL.
"; exit;}
else {
		$query = "SELECT id, nome, opcao_curso, cidade, nis, cpf, pagamento, nosso_numero FROM processoseletivo  WHERE id <> '' AND pagamento LIKE '%$pagamento%' ORDER BY cidade DESC, nome ASC, nosso_numero,   nis";
		$result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
		$num   = mysql_num_rows($result);	
	}	

//<td>Curso Selecionado</td> <td>Pagamento</td>
	if($num >0){
		echo "Foram encontrados " . $num . " resultados!<br>";
		echo '
        <div class="container"><div class="row"><div class="col-12">
        <table class="table table-striped table-bordered table-condensed table-hover">
          <thead>
              <tr>
              	<td>N</td>
				<td>Município</td>
                <td>Nome</td>
                <td>NIS</td>
                <td>CPF</td>
                <td>Pagamento</td>
               
              </tr>
          </thead>

          <tbody>';
          $n = 1;

//<td>' .$row[esccargo]. '</td><td>' .$row[RG]. '</td>
	    while($row = mysql_fetch_array($result)){
			echo utf8_encode('
				<tr>
					<td>' .$n++. '</td>
					<td>' .$row[cidade]. '</td>
					<td>' .$row[nome]. '</td>
					<td>' .$row[nis]. '</td>
					<td>' .$row[cpf]. '</td>
					<td>' .$row[pagamento]. '</td>
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
