<?php
ini_set('default_charset', 'UTF-8');
  //Conecta ao banco de dados
  require_once "../../lib/conexao.php";
  mysql_select_db("etmsl2", $conexao);

$curso =  $_POST['busca'];

//$conn = mysql_connect($hostname,$usuario,$senha); mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");
if (!$conexao) {echo "Não foi possível conectar ao banco MySQL.
"; exit;}
else {
			$query = "SELECT id, nome, opcao_curso FROM processoseletivo  WHERE 1 AND opcao_curso LIKE '%$curso%' ORDER BY nome, opcao_curso ASC ";
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
                <td>Nome</td>
                <td>Curso</td>
               
              </tr>
          </thead>

          <tbody>';
          $n = 1;

//<td>' .$row[esccargo]. '</td><td>' .$row[RG]. '</td>
	    while($row = mysql_fetch_array($result)){
			echo utf8_encode('
				<tr>
					<td>' .$n++. '</td>
					<td>' .$row[nome]. '</td>
					<td>' .$row[opcao_curso]. '</td>
					
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
