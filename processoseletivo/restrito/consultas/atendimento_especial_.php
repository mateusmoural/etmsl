<?php

session_start();
if ($_SESSION['nivel'] > 2) {
  header("Location: ../menu.php");
}


ini_set('default_charset', 'UTF-8');


$curso =  $_POST['busca'];

//Conecta ao banco de dados
require_once "../../lib/conexao.php";
mysql_select_db("etmsl2", $conexao);

$query = "SELECT * FROM processoseletivo  WHERE  `situacao` = 'INSCRITO' AND especial <> 'NENHUMA' AND opcao_curso LIKE '%$curso%' ORDER BY opcao_curso, nome ASC ";
$result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );

//Verifica o numero de resultados e imprime 
$num   = mysql_num_rows($result);
echo "Foram encontrados " . $num . " resultados!<br>";


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
				<td>CPF</td>
                <td>Curso</td>
                <td>Telefone</td>
				<td>Email</td>
                <td>Atendimento</td>
                <td>Informações</td>
               
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
					<td>' .$row[cpf]. '</td>
					<td>' .$row[opcao_curso]. '</td>
					<td>' .$row[fone1]. '</td>
					<td>' .$row[email]. '</td>
					<td>' .$row[especial]. '</td>
					<td>' .$row[info_adicional]. '</td>
					
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
