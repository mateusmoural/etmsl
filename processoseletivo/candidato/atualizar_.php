<?php 
session_start();
if ($_SESSION['status'] != 'inscrito') {
	header("Location: ../index.php");
}
else{
    $cpf = $_SESSION['cpf'];
    $contagoogle = $_SESSION['email'];
  }  

//Cria funções
	//Cria função para inserir mascaras de exibição
	function format($mask,$string)
	{
	return  vsprintf($mask, str_split($string));
	}
	$cpfMask = "%s%s%s.%s%s%s.%s%s%s-%s%s";
	$cepMask = "%s%s.%s%s%s-%s%s%s";
	$foneMask = "(%s%s) %s %s%s%s%s-%s%s%s%s";
  
  //Limpa possíveis mascaras
  function limpaMask($valor){
    $valor = trim($valor);
    $valor = str_replace(" ", "", $valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    $valor = str_replace("(", "", $valor);
    $valor = str_replace(")", "", $valor);
    //Mais uma forma de limpar (agora quero ver passar um caracter invalido)
    $valor = preg_replace('/[^0-9]/', '', $valor);

    return $valor;
  }

  //Retira caracteres invalidos e coloca tudo em caixa alta
  function normaliza_caracteres($str) {
    $str = strtolower($str);
    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    $str = preg_replace('/[^a-z0-9\s]/i', '', $str);
    $str = strtoupper($str);
    return $str;
  }

    //Busca os dados via POST e guarda nas variáveis
    $id_candidato   = $_POST['id'];     
    $nome           = $_POST['nome'];
    $opcao_curso    = $_POST['opcao_curso'];
    $dt_nasc        = $_POST['dt_nasc'];
    $rua            = $_POST['rua'];
    $num_res        = $_POST['num_res'];
    $complemento    = $_POST['complemento'];
    $bairro         = $_POST['bairro'];
    $cep            = $_POST['cep'];
    $cidade         = $_POST['cidade'];
    $fone1          = $_POST['fone1'];

      //Conecta ao banco de dados
	  require_once "../lib/conexao.php";
	  mysql_select_db("etmsl2", $conexao);

	  //Consulta registros sem boleto e com cpf
	  $query = "SELECT * FROM processoseletivo WHERE id = '$id_candidato'";
	  $result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
	  
	  //Verifica o numero de resultados e imprime 
	  $num   = mysql_num_rows($result);
	  echo "Registro encontrado!<br>";

	  //A partir daqui as operações serão executades para cada um dos resultados da consulta
	  if($num==1){
		  while($row = mysql_fetch_array($result)){
			//Busca os resultados e os colota nas variáveis

				$id                = $row[id];
			    $bd_cpf            = $row[cpf];   
			    $bd_nome           = $row[nome];
			    $bd_opcao_curso    = $row[opcao_curso];
			    $bd_dt_nasc        = $row[dt_nasc];
			    $bd_rua            = $row[rua];
			    $bd_num_res        = $row[num_res];
			    $bd_complemento    = $row[complemento];
			    $bd_bairro         = $row[bairro];
			    $bd_cep            = $row[cep];
			    $bd_cidade         = $row[cidade];
			    $bd_email          = $row[email];
			    $bd_fone1          = $row[fone1];
			    $bd_nis            = $row[nis];
			}
		}
		else{
			echo 'Erro no banco de dados';
		}
		
		//Se vazio recoloca o conteudo do BD
	    
	    if($nome == ''){
	    	$nome=$bd_nome;
	    }
	    if($opcao_curso == ''){
	    	$opcao_curso=$bd_opcao_curso;
	    }
	    if($dt_nasc  == ''){
	    	$dt_nasc=$bd_dt_nasc;
	    }
	    if($rua == ''){
	    	$rua=$bd_rua;
	    }
	    if($num_res == ''){
	    	$num_res=$bd_num_res;
	    }
	    if($complemento == ''){
	    	$complemento=$bd_complemento;
	    }
	    if($bairro == ''){
	    	$bairro=$bd_bairro;
	    }
	    if($cidade == ''){
	    	$cidade=$bd_cidade;
	    }
	    if($fone1 == ''){
	    	$fone1=$bd_fone1;
	    }


	    //Limpa possíveis caracteres invalidos (apesar de já tratatado no frontend)
	    $nome             = normaliza_caracteres($nome);
	    $rua              = normaliza_caracteres($rua);
	    $complemento      = normaliza_caracteres($complemento);
	    $bairro           = normaliza_caracteres($bairro);
	    $cidade           = normaliza_caracteres($cidade);
	    $especial         = normaliza_caracteres($especial);
	    $info_adicional   = normaliza_caracteres($info_adicional);
	    

	    //Limpa possíveis mascaras (apesar de já tratatado no frontend)
	    $cpf         = limpaMask($cpf);
	    $cep         = limpaMask($cep);
	    $fone1       = limpaMask($fone1);
	    $nis         = limpaMask($nis);
	
		//Consulta cpf no banco de dados
		$atualiza = mysql_query(" UPDATE processoseletivo SET nome='$nome', opcao_curso='$opcao_curso', dt_nasc='$dt_nasc',rua='$rua',num_res='$num_res',complemento='$complemento',bairro='$bairro',cidade='$cidade',fone1='$fone1' WHERE id='$id' ");
		

		//Registra no banco de dados
	    $guarda_alteracoes = mysql_query($atualiza);

		$_SESSION['status'] = 'inscrito';

	    echo "Concluído!<br><br>";
	    echo '<button type="button" class="btn btn-info btn-block" id="voltar" onclick="window.location.href = '."'./candidato.php'".'">Voltar</button>';

?>
