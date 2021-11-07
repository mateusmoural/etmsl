<?php
ini_set('default_charset', 'UTF-8');

$candidato =  $_POST['busca'];
$n =  			$_POST['n'];


require_once "../lib/conexao.php";


	$query = "SELECT email FROM processoseletivo WHERE cpf = '$candidato'";
	$result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
	$num   = mysql_num_rows($result);

	
	
	if($num > 0){
		echo "Encontrei!<br><br>";
		echo '
        <div class="container"><div class="row"><div class="col-12">
        <table class="table table-striped table-bordered table-condensed table-hover">
          <thead>
              <tr>
                  <td>Conta Google</td>
              </tr>
          </thead>

          <tbody>';


	    while($row = mysql_fetch_array($result)){

			echo ('
				<tr>
					<td>' .$row[email]. '</td>
				</tr>');

	    }

	    echo "
          </tbody>
          </table>
          </div></div></div>";


	}
	elseif($n != 11){
		echo "Opa! Número de CPF incompleto.";
	}
	else{
		echo "Nenhum resultado!";
	}


mysql_close();
?>
