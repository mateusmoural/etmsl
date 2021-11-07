<?php 
	session_start();
	if ($_SESSION['status'] != 'inscrito') {
	header("Location: ../index.php");
	}
	else{
		$_SESSION['status'] = 'inscrito';
		$cpf = $_SESSION['cpf'];
    	$contagoogle = $_SESSION['email'];
}  

  //Conecta ao banco de dados
  require_once "../lib/conexao.php";
  mysql_select_db("etmsl2", $conexao);

  //Consulta registros sem boleto e com cpf
  $query = "SELECT * FROM processoseletivo  WHERE cpf = '$cpf'";
  $result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
  
  //Verifica o numero de resultados e imprime 
  $num   = mysql_num_rows($result);
  echo "";

  //A partir daqui as operações serão executades para cada um dos resultados da consulta
  $row = mysql_fetch_array($result);
	//Busca os resultados e os colota nas variáveis
	foreach($row as $r){
		$id               = $row[id];  
	    $v_nome           = $row[nome];
	    $v_opcao_curso    = $row[opcao_curso];
	    $v_dt_nasc        = $row[dt_nasc];
	    $v_rua            = $row[rua];
	    $v_num_res        = $row[num_res];
	    $v_complemento    = $row[complemento];
	    $v_bairro         = $row[bairro];
	    $v_cep            = $row[cep];
	    $v_cidade         = $row[cidade];
	    $v_fone1          = $row[fone1];
	    $v_nis            = $row[nis];
	}    
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" id="bootstrap-css" href="../css/bootstrap.min.css">
<link  rel="stylesheet" href="../css/style.css">
<head>
	<title>ETMSL - Atualizar Dados</title> <!-- ############# -->

	<script type="text/javascript">
		function h_nome(){
	        if(document.getElementById('c_nome').checked){
	            document.getElementById('nome').removeAttribute("disabled");
	        }
	        else {
	            document.getElementById('onoff').value=''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
	            document.getElementById('nome').setAttribute("disabled", "disabled");
	        }
	    }
	    function h_nis(){
	        if(document.getElementById('c_nis').checked){
	            document.getElementById('nis').removeAttribute("disabled");
	        }
	        else {
	            document.getElementById('onoff').value=''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
	            document.getElementById('nis').setAttribute("disabled", "disabled");
	        }
	    }
	    function h_dt_nasc(){
	        if(document.getElementById('c_dt_nasc').checked){
	            document.getElementById('dt_nasc').removeAttribute("disabled");
	        }
	        else {
	            document.getElementById('onoff').value=''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
	            document.getElementById('dt_nasc').setAttribute("disabled", "disabled");
	        }
	    }
	    function h_fone1(){
	        if(document.getElementById('c_fone1').checked){
	            document.getElementById('fone1').removeAttribute("disabled");
	        }
	        else {
	            document.getElementById('onoff').value=''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
	            document.getElementById('fone1').setAttribute("disabled", "disabled");
	        }
	    }
	    function h_cep(){
	        if(document.getElementById('c_cpf').checked){
	            document.getElementById('cpf').removeAttribute("disabled");
	        }
	        else {
	            document.getElementById('onoff').value=''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
	            document.getElementById('cpf').setAttribute("disabled", "disabled");
	        }
	    }
	    function h_rua(){
	        if(document.getElementById('c_rua').checked){
	            document.getElementById('rua').removeAttribute("disabled");
	        }
	        else {
	            document.getElementById('onoff').value=''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
	            document.getElementById('rua').setAttribute("disabled", "disabled");
	        }
	    }
	    function h_num_res(){
	        if(document.getElementById('c_num_res').checked){
	            document.getElementById('num_res').removeAttribute("disabled");
	        }
	        else {
	            document.getElementById('onoff').value=''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
	            document.getElementById('num_res').setAttribute("disabled", "disabled");
	        }
	    }
	    function h_complemento(){
	        if(document.getElementById('c_complemento').checked){
	            document.getElementById('complemento').removeAttribute("disabled");
	        }
	        else {
	            document.getElementById('onoff').value=''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
	            document.getElementById('complemento').setAttribute("disabled", "disabled");
	        }
	    }
	    function h_bairro(){
	        if(document.getElementById('c_bairro').checked){
	            document.getElementById('bairro').removeAttribute("disabled");
	        }
	        else {
	            document.getElementById('onoff').value=''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
	            document.getElementById('bairro').setAttribute("disabled", "disabled");
	        }
	    }
	    function h_cidade(){
	        if(document.getElementById('c_cidade').checked){
	            document.getElementById('cidade').removeAttribute("disabled");
	        }
	        else {
	            document.getElementById('onoff').value=''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
	            document.getElementById('cidade').setAttribute("disabled", "disabled");
	        }
	    }
	    function h_opcao_curso(){
	        if(document.getElementById('c_opcao_curso').checked){
	            document.getElementById('opcao_curso').removeAttribute("disabled");
	        }
	        else {
	            document.getElementById('onoff').value=''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
	            document.getElementById('opcao_curso').setAttribute("disabled", "disabled");
	        }
	    }


	</script>

	<style type="text/css">
		.flex-box {
			display: flex;
			align-items: center;
			justify-content: center;
		}
	</style>
 </head>

<body>

<div class="container">
	<div class="flex-box w-300 p-3" style=" background-color:#fff">
		<form action="./atualizar_.php" method="post">

		<b><h2 class="lead">Alterar dados</h2></b>

		<div class="row align-items-center">
			<div class="col col-2" >
				<input type="checkbox" name="c_nome" id="c_nome"   onchange="h_nome()" />
			</div>
			<div class="col col-10">
				<b>NOME COMPLETO:</b> <?php echo $v_nome?> 
			</div>
		</div>
		<div class="row">			 
			 <input type="text" class="form-control obrigatorio" name="nome" onkeyup="norma(this)" disabled id="nome">
		</div><br>

		<div class="row align-items-center">
			<div class="col col-2" >
				<input type="checkbox" name="c_dt_nasc" id="c_dt_nasc" onchange="h_dt_nasc()" />
			</div>
			<div class="col col-10">
				<b>DATA DE NASCIMENTO:</b>  <?php echo date('d/m/Y', strtotime($v_dt_nasc));?>
			</div>
		</div>
		<div class="row">			
			<input type="date" class="form-control obrigatorio" name="dt_nasc" id="dt_nasc"></p>
		</div><br>

		<div class="row align-items-center">
			<div class="col col-2" >
				<input type="checkbox" name="c_fone1" id="c_fone1" onchange="h_fone1()" />
			</div>
			<div class="col col-10">
				<b>TELEFONE:</b>  <?php echo $v_fone1?>
			</div>
		</div>
		<div class="row">
			<input type="text" class="form-control obrigatorio" name="fone1" id="fone1" maxlength="14" disabled onkeyup="javascript: fMasc( this, mTel);">
		</div><br>


		<div class="row align-items-center">
			<div class="col col-2" >
				<input type="checkbox" name="c_rua" id="c_rua" onchange="h_rua()" />
			</div>
			<div class="col col-10">
				<b>ENDEREÇO:</b>  <?php echo $v_rua?>
			</div>
		</div>
		<div class="row">
			<input type="text" class="form-control obrigatorio" name="rua" id="rua" disabled onkeyup="norma(this)"><br>
		</div><br>

		<div class="row align-items-center">
			<div class="col col-2" >
				<input type="checkbox" name="c_num_res" id="c_num_res" onchange="h_num_res()" />
			</div>
			<div class="col col-10">
				<b>NÚMERO:</b>  <?php echo $v_num_res?>
			</div>
		</div>
		<div class="row">
			<input type="text" style="display:block; "class="form-control" name="num_res" id="num_res" disabled onkeyup="javascript: fMasc( this, mNum);">
		</div><br>

		<div class="row align-items-center">
			<div class="col col-2" >
				<input type="checkbox" name="c_complemento" id="c_complemento" onchange="h_complemento()" />
			</div>
			<div class="col col-10">
				<b>COMPLEMENTO:</b>  <?php echo $v_complemento?>
			</div>
		</div>
		<div class="row">
			<input type="text" class="form-control" name="complemento" id="complemento" disabled onkeyup="norma(this)">
		</div><br>
		
		<div class="row align-items-center">
			<div class="col col-2" >
				<input type="checkbox" name="c_bairro" id="c_bairro" onchange="h_bairro()" />
			</div>
			<div class="col col-10">
				<b>BAIRRO/DISTRITO:</b>  <?php echo $v_bairro?>
			</div>
		</div>
		<div class="row">
			<input type="text" class="form-control obrigatorio" name="bairro" id="bairro" disabled onkeyup="norma(this)">
		</div><br>

		<div class="row align-items-center">
			<div class="col col-2" >
				<input type="checkbox" name="c_cidade" id="c_cidade" onchange="h_cidade()" />
			</div>
			<div class="col col-10">
				<b>MUNICÍPIO:</b>  <?php echo $v_cidade?>
			</div>
		</div>
		<div class="row">
			<input type="text" class="form-control obrigatorio" name="cidade" id="cidade" disabled onkeyup="norma(this)">
		</div><br>

		<div class="row align-items-center">
			<div class="col col-2" >
				<input type="checkbox" name="c_opcao_curso" id="c_opcao_curso" onchange="h_opcao_curso()" />
			</div>
			<div class="col col-10">
				<b>OPÇÃO DE CURSO:</b>  <?php echo $v_opcao_curso?>
			</div>
		</div>
		<div class="row">
			<select name="opcao_curso" id="opcao_curso" disabled class="form-control" style="display:block;">
				<option value='' selected>Não alterar</option>
				<option value="ADMINISTRACAO">Administração</option>
				<!--<option value="ANALISES CLINICAS">Análises Clínicas</option>-->
				<option value="EDIFICACOES">Edificações</option>
				<option value="ELETRONICA">Eletrônica</option>
				<option value="ELETROTECNICA">Eletrotécnica</option>
				<option value="ENFERMAGEM">Enfermagem</option>
				<!--<option value="MECANICA">Mecânica</option>>-->
				<option value="EDIFICACOES">Edificações</option>
				<option value="MEIO AMBIENTE">Meio Ambiente</option>
				<option value="METALURGIA">Metalurgia</option>
				<option value="QUIMICA">Química</option>
            </select>




		</div><br>
			

		<input type="hidden" name="id" id="id" value=<?php echo $id?>>

		<div><p id="result"></p></div>

		<div>
			<div class="row center-align">
				<div class="col-6 center-align"><button type="button" class="btn btn-info btn-block" id="voltar" onclick="window.location.href = 'candidato.php'">Voltar</button>
				</div>
				<div class="col-6 center-align">
					<input class="btn btn-danger" type="submit" name="update" value="Alterar">
				</div>
			</div>
			
			
		</div>

	</form></div>	
</div>


<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
    
   
<!-- Adicionando Javascript -->
<script type="text/javascript" >
    
function fMasc(objeto,mascara) {
	obj=objeto
	masc=mascara
	setTimeout("fMascEx()",1)
}

function fMascEx() {
	obj.value=masc(obj.value)
}

function mCPF(cpf){
	cpf=cpf.replace(/\D/g,"")
	cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
	cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
	cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
	return cpf
}

function mCEP(cep){
	cep=cep.replace(/\D/g,"")
	cep=cep.replace(/^(\d{5})(\d)/,"$1-$2")
	return cep
}

function mTel(tel) {
	tel=tel.replace(/\D/g,"")
	tel=tel.replace(/^(\d)/,"($1")
	tel=tel.replace(/(.{3})(\d)/,"$1)$2")
	if(tel.length == 9) {
		tel=tel.replace(/(.{1})$/,"-$1")
	} else if (tel.length == 10) {
		tel=tel.replace(/(.{2})$/,"-$1")
	} else if (tel.length == 11) {
		tel=tel.replace(/(.{3})$/,"-$1")
	} else if (tel.length == 12) {
		tel=tel.replace(/(.{4})$/,"-$1")
	} else if (tel.length > 12) {
		tel=tel.replace(/(.{4})$/,"-$1")
	}
	return tel;
}

function mNum(num){
	num=num.replace(/\D/g,"")
	return num
}
function mData(v){
	v=v.replace(/\D/g,"");
	v=v.replace(/(\d{2})(\d)/,"$1/$2");
	v=v.replace(/(\d{2})(\d)/,"$1/$2");
	return v;
}

function maiuscula(z){
    v = z.value.toUpperCase().replace(/[a-zA-Z]\s\D/g,"");
    z.value = v;
}

function norma(z){
    v = z.value.toUpperCase().normalize('NFD').replace(/([\u0300-\u036f]|[^0-9a-zA-Z\s])/g, '');
    z.value = v;
}

function minuscula(z){
    v = z.value.toLowerCase();
    z.value = v;
}

function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('rua').value=("");
        document.getElementById('bairro').value=("");
        document.getElementById('cidade').value=("");
}
function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        var l,b,c;
        l=(conteudo.logradouro);
        b=(conteudo.bairro);
        c=(conteudo.localidade);

        document.getElementById('rua').value=l.toUpperCase().normalize('NFD').replace(/([\u0300-\u036f]|[^0-9a-zA-Z\s])/g, '');
        document.getElementById('bairro').value=b.toUpperCase().normalize('NFD').replace(/([\u0300-\u036f]|[^0-9a-zA-Z\s])/g, '');
        document.getElementById('cidade').value=c.toUpperCase().normalize('NFD').replace(/([\u0300-\u036f]|[^0-9a-zA-Z\s])/g, '');
        document.getElementById('uf').value=(conteudo.uf);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            document.getElementById('cep').value = cep.substring(0,5)
            +"-"
            +cep.substring(5);

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('rua').value="...";
            document.getElementById('bairro').value="...";
            document.getElementById('cidade').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};
    
</script>


<script src="../js/functions.js"></script>
</body>
</html>
