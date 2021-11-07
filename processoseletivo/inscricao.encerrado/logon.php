<?php

function validaCPF($doc_cpf) { 
    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $doc_cpf)) {
        return false;
    }
    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $doc_cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($doc_cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}


ini_set('default_charset', 'UTF-8');
require "../lib/conexao.php";
session_start();

$cpfok = 0;
$candidato =  	$_POST['cpf'];
$contagoogle =  $_POST['contagoogle'];
$n =  			$_POST['n'];


//Verifica se CPF é válido
if(validaCPF($candidato)==true){
	$cpfok = 1;
}
else{
	$cpfok = 0;
}


//Consulta CPF no BD
$query = "SELECT cpf FROM processoseletivo WHERE cpf = '$candidato'";
$result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
$num   = mysql_num_rows($result);

//Consulta email no BD
$ver = "SELECT email FROM processoseletivo WHERE email = '$contagoogle'";
$resulta = mysql_query( $ver ) or die(' Erro na query:' . $ver . ' ' . mysql_error() );
$linha   = mysql_num_rows($resulta);

//Verifica as quatro condições
//CPF válido, CPF não registrado no BD, contagoogle válida, email não registrado no BD
if($cpfok == 1 && $num == 0 && $contagoogle <>'' && $linha == 0 && $n == 11) {
	echo "Conta Google e CPF válidos!<br>";
	echo "Prossiga clicando no botão Iniciar inscrição.<br>";
	echo 'Conta logada: '.$contagoogle.'.<br> <a href="#" onclick="signOut();">Sair deste login.</a><br>';	
	echo "<script>$('#botao').prop('disabled', false);</script>";
	$_SESSION['cpf'] = $candidato;
	$_SESSION['email'] = $contagoogle;
	$_SESSION['status'] = 'logoninscricao';
}
else{
	//Verifica se tem email na variável contagoogle
	if($contagoogle<>''){
		//Verifica se a Consulta por email retornou algum valor
		if($linha > 0){
			echo "Opa! Já existe cadastro com esta conta Google.<br>";
			echo 'Conta logada: '.$contagoogle.'.<br> <a href="#" onclick="signOut();">Sair deste login.</a><br>';
		}
		else{
			echo "Certo! Conta Google validada.<br>";
			echo 'Conta logada: '.$contagoogle.'.<br> <a href="#" onclick="signOut();">Sair deste login.</a><br>';
		}
	}
	else{
		echo ('Faça login clicando no botão Google<br>');
	}

	//Verifica se foram digitados os 11 numeros do CPF
	if($n == 11){
		//Verifica se a Consulta por CPF retornou algum valor
		if($num >0){
		echo "Já existe inscrição para este CPF.<br>";
		}
		else{
			//Verifica se CPF é válido
			if($cpfok==1){
				echo "Certo! CPF válido.<br>";
			}
			else{
				echo "Opa! Número de CPF inválido.<br>";
			}
		}
	}
	else{
		echo "Opa! Número de CPF incompleto.<br>";
	}
	echo "<script>$('#botao').prop('disabled', true);</script>";
}

mysql_close();

?>
