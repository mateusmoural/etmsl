<?php

$banco = "etmsl02";
$usuario = "etmsl02";
$senha = "3199862002";
$hostname = "mysql.etmsl.com.br";

$candidato =  $_POST['id_candidato'];

$conn = mysql_connect($hostname,$usuario,$senha); mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");
if (!$conn) {echo "Não foi possível conectar ao banco MySQL."; exit;}


(isset($_POST["pagamento"])) {

    $query = "SELECT * FROM processoseletivo WHERE id = '$candidato'";
	$result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
	while($row = mysql_fetch_array($result)){

		if($row[pagamento]=="PENDENTE"){
			$update = "UPDATE processoseletivo SET RG ='PROCESSANDO PAGAMENTO' WHERE id='".$candidato."'";
			$altera = mysql_query($update);
		}
		elseif($row[pagamento]=="PROCESSANDO PAGAMENTO"){
			$update = "UPDATE processoseletivo SET RG ='PENDENTE' WHERE id='".$candidato."'";
			$altera = mysql_query($update);
		}
	}

    if($altera) {
       echo "Sucesso!";
    }
    else {
       echo "Falha!";
       echo $candidato;
    }
}

?>


