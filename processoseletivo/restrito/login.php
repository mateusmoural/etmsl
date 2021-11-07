<?php
ini_set('default_charset', 'UTF-8');
require "../lib/conexao.php";
session_start();

$contagoogle =  $_POST['contagoogle'];
session_destroy();

$query = "SELECT * FROM `usuarios` WHERE `email` = '$contagoogle'";
$result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
$num   = mysql_num_rows($result);

while($row = mysql_fetch_array($result)){
	//Busca os resultados e os coloca nas variáveis
	$id			= $row[id];
	$email		= $row[email];   
	$nivel		= $row[nivel];
	$status		= $row[status];
}

//Verifica as condições
//email não registrado no BD
if($num==1) {
	session_start();
	$_SESSION['id'] = $id;
	$_SESSION['email'] = $email;
	$_SESSION['nivel'] = $nivel;
	
	$_SESSION['permissao'] = 'sim';
	header("Location: menu.php");
	echo $contagoogle;
	echo $email;
}

else{
	echo $contagoogle;
	echo $email;
	header("Location: index.php");
}

mysql_close();

?>