<?php 
  session_start();
  if ($_SESSION['status'] != 'logonisencao') {
    header("Location: ../index.php");
  }
  else{
		$cpf = $_SESSION['cpf'];
		$contagoogle = $_SESSION['email'];

		//Possibilita acesso ao isencaoregistrar.php
		$_SESSION['status'] = 'requerer';
	}
  //Cria função para inserir mascaras de exibição
  function format($mask,$string)
  {
    return  vsprintf($mask, str_split($string));
  }
  $cpfMask = "%s%s%s.%s%s%s.%s%s%s-%s%s";
  $cepMask = "%s%s.%s%s%s-%s%s%s";
  $foneMask = "(%s%s) %s %s%s%s%s-%s%s%s%s";

?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" id="bootstrap-css" href="../css/bootstrap.min.css">
<link  rel="stylesheet" href="../css/style.css">
<head>
	<title>ETMSL - Isenção</title> <!-- ############# -->
    <script type="text/javascript">
      function estado_num(sem){  
	    var display = document.getElementById(sem).style.display;
	    if(display == "none"){
	      document.getElementById(sem).style.display = 'block';
	      document.getElementById('num_res').value = "";
	    }
	    else{
	      document.getElementById(sem).style.display = 'none';
	      document.getElementById('num_res').value = "0";
	    }   
	}
	function estado_comp(sem){  
	    var display = document.getElementById(sem).style.display;
	    if(display == "none"){
	      document.getElementById(sem).style.display = 'block';
	      document.getElementById('complemento').value = "";
	    }
	    else{
	      document.getElementById(sem).style.display = 'none';
	      document.getElementById('complemento').value = "SEM COMPLEMENTO";
	    }   
	}	
</script>
<style>
.example {  
  overflow-y: scroll; /* Add the ability to scroll */
}

/* Hide scrollbar for Chrome, Safari and Opera */
.example::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.example {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>
</head>

<body>

<form id="regForm" action="registrar.php" method="post">
  <div align="center"><img id="logo-img"  class="" src="../img/logo.png" /></div>
  
  <h2 class="lead">Solicitar isenção online</h2>
  <!-- One "tab" for each step in the form: -->

    <div class="tab"><h3 class="lead">ETAPA 1 DE 5 - LEITURA DO EDITAL:</h3>
        <div class="row">

			<div style=" height:500px; background-color:#eee" class="example">

				<div style="background-color:#e4e4e4">
        			<?php
        				include('../lib/edital.php'); 
        				echo $edital;
        			?>
        			<!--<div> Tem uma div no edital -->
        					<div style="background-color:#FFF;" >
	                    		<br>
	                    		<table class="table-edital">
	                        		<tr>
										<td style="width:20px; display:block;">
											<input type="checkbox" name="chkedital" class="obrigatorio" id="chkedital"  onchange="habilita()" onclick="checkthis()">
										</td>
										<td>
											<label " for="chkedital" style="color:#FF0000">Declaro ter lido e concordado com o edital.<br>
										</td>
									</tr>        
								</table>
	                		</div>
						</div>
					</div>

                
            </div><br>
        </div> 
    </div>

    <div class="tab"> <h3>ETAPA 2 DE 5 - DADOS PESSOAIS:</h3>
    
      <p style="color: red;"><strong>IMPORTANTE:</strong><br>Conforme previsto em edital, a data de nascimento é um dos critérios de desempate, sujeito a desclassificação em caso de não comprovação.</p>

    	<input type="hidden" name="cpf" id="cpf" value=<?php echo $cpf;?>>
    	<input type="hidden" name="email" id="email"value=<?php echo $contagoogle;?>>
      <p>NOME COMPLETO:<br>
      <input type="text" class="form-control obrigatorio" name="nome" placeholder="NOME COMPLETO" onkeyup="norma(this)"/></p>
      <p>CPF:<br>
      <input type="text" class="form-control obrigatorio" name="exibe_cpf" id="exibe_cpf" disabled="true"  maxlength="14" onkeyup="javascript: fMasc( this, mCPF );" value=<?php echo format($cpfMask,$cpf)?>> </p>
      <p>RG:<br>
      <input type="text" class="form-control obrigatorio" name="rg" id="rg" maxlength="14" onkeyup="javascript: fMasc( this, mNum);"> </p>
      <p>NIS:<br>
      <input type="text" class="form-control obrigatorio" name="nis" id="nis" maxlength="14" onkeyup="javascript: fMasc( this, mNum);"> </p>
      <p>DATA DE NASCIMENTO:<br>
      <input type="date" class="form-control obrigatorio" name="dt_nasc"></p>

      <p>ESTADO CIVIL:<br>
      <input type="text" class="form-control obrigatorio" name="estado_civil" placeholder="ESTADO CIVIL" onkeyup="norma(this)"/></p>
      <p>PROFISSÃO:<br>
      <input type="text" class="form-control obrigatorio" name="profissao" placeholder="PROFISSÃO" onkeyup="norma(this)"/></p>
      
    </div>


    <div class="tab"><h3>ETAPA 3 DE 5 - DADOS DE CONTATO:</h3>

        <p style="color: red;"><strong>IMPORTANTE:</strong><br>Os cursos serão inicialmente on-line e quando acabarem as  medidas de enfrentamento à pandemia as aulas serão 100% presenciais de 2ª a 6ª de 18h30 às 22h.</p>


        <p>E-MAIL:<br>
          <input type="email" class="form-control obrigatorio" name="exibe_email" id="exibe_email" ; disabled="true" onkeyup="minuscula(this)"value=<?php  echo $contagoogle?>></p> 
        <p>TELEFONE:<br>
          <input type="text" class="form-control obrigatorio" name="fone1" id="fone1" placeholder="(XX)XXXXX-XXXX OU (XX)XXXX-XXXX" maxlength="14" onkeyup="javascript: fMasc( this, mTel);"/></p>
        <p>CEP:<br>
          <input type="text" class="form-control obrigatorio" name="cep" id="cep" placeholder="Ex.: 35702-383" maxlength="9" onkeyup="javascript: fMasc( this, mCEP );" onblur="pesquisacep(this.value);"/></p>           
        <p>ENDEREÇO:<br>
          <input type="text" class="form-control obrigatorio" name="rua" id="rua" placeholder="Ex.: AV PREF ALBERTO MOURA" onkeyup="norma(this)"/></p>
        <p>NÚMERO:<br>
          <input type="text" style="display:block; "class="form-control" name="num_res" id="num_res" placeholder="Ex.: 1111" onkeyup="javascript: fMasc( this, mNum);"/></p>
        <p>COMPLEMENTO:<br>
          <input type="text" class="form-control" name="complemento" id="complemento" placeholder="Ex.: APTO 201" onkeyup="norma(this)"/></p>
        <p>BAIRRO/DISTRITO:<br>
          <input type="text" class="form-control obrigatorio" name="bairro" id="bairro" placeholder="Ex.: DISTRITO INDUSTRIAL" onkeyup="norma(this)"/></p>
        <p>MUNICÍPIO:<br>
          <input type="text" class="form-control obrigatorio" name="cidade" id="cidade" placeholder="Ex.: SETE LAGOAS" onkeyup="norma(this)"/> </p>             
        <p>UNIDADE FEDERATIVA:<br>
          <select name="uf" id="uf" class="form-control obrigatorio">
            <option value="AC">ACRE</option>
            <option value="AL">ALAGOAS</option>
            <option value="AP">AMAPÁ</option>
            <option value="AM">AMAZONAS</option>
            <option value="BA">BAHIA</option>
            <option value="CE">CEARÁ</option>
            <option value="DF">DISTRITO FEDERAL</option>
            <option value="ES">ESPÍRITO SANTO</option>
            <option value="GO">GOIÁS</option>
            <option value="MA">MARANHÃO</option>
            <option value="MT">MATO GROSSO</option>
            <option value="MS">MATO GROSSO DO SUL</option>
            <option value="MG" selected>MINAS GERAIS</option>
            <option value="PA">PARÁ</option>
            <option value="PB">PARAÍBA</option>
            <option value="PR">PARANÁ</option>
            <option value="PE">PERNAMBUCO</option>
            <option value="PI">PIAUÍ</option>
            <option value="RJ">RIO DE JANEIRO</option>
            <option value="RN">RIO GRANDE DO NORTE</option>
            <option value="RS">RIO GRANDE DO SUL</option>
            <option value="RO">RONDÔNIA</option>
            <option value="RR">RORAIMA</option>
            <option value="SC">SANTA CATARINA</option>
            <option value="SP">SÃO PAULO</option>
            <option value="SE">SERGIPE</option>
            <option value="TO">TOCANTINS</option>
            <option value="EX">ESTRANGEIRO</option>
        </select></p>
        
    </div>
    

    <div class="tab" align="center"><h3>ETAPA 4 DE 5 - OPÇÃO DE CURSO:</h3>

        <div class="radio-group">
            <div class='radio text-center col-md-6' data-value="ADMINISTRACAO">Administração</div>
            <!--<div class='radio text-center col-md-6' data-value="ANALISES CLINICAS">Análises Clínicas</div>-->
            <div class='radio text-center col-md-6' data-value="EDIFICACOES">Edificações</div>
            <div class='radio text-center col-md-6' data-value="ELETRONICA">Eletrônica</div>
            <div class='radio text-center col-md-6' data-value="ELETROTECNICA">Eletrotécnica</div>
            <div class='radio text-center col-md-6' data-value="ENFERMAGEM">Enfermagem</div>
            <!--<div class='radio text-center col-md-6' data-value="MECANICA">Mecânica</div>-->
            <div class='radio text-center col-md-6' data-value="MEIO AMBIENTE">Meio Ambiente</div>
            <div class='radio text-center col-md-6' data-value="METALURGIA">Metalurgia</div>
            <div class='radio text-center col-md-6' data-value="QUIMICA">Química</div>
            <div class="form-group">
            <input type="hidden" class="form-control obrigatorio" id="opcao_curso" name="opcao_curso" />
            </div>
        </div>
    </div>

    <div class="tab"><h3 class="lead">ETAPA 5 DE 5 - CONDIÇÕES DE PARTICIPAÇÃO:</h3>
      <p style="color: red;"><strong>IMPORTANTE:</strong><br>Conforme previsto em edital, a escolaridade é um dos critérios de desempate, sujeito a desclassificação em caso de não comprovação.</p>

    	<div class="row">
            <p class="lead">Escolaridade (formação no Ensino Básico):</p>        
        </div>
      <div class="radio-group" align="center">
            
            <div class='radio text-center col-md-6' data-value="1">Cursando 2ª série do Ensino Médio</div>
            <div class='radio text-center col-md-6' data-value="1">Cursando 2º período EJA presencial</div>
            
            <div class='radio text-center col-md-6' data-value="2">Cursando 3ª série do Ensino Médio</div>
            <div class='radio text-center col-md-6' data-value="2">Cursando 3º período EJA presenciai</div>
            <div class='radio text-center col-md-6' data-value="3">Ensino Médio concluído</div>
            <div class="form-group">
            <input type="hidden" class="form-control obrigatorio" id="escolar_completa" name="escolar_completa" />
            </div>
        </div>


        <div class="row">
            <p class="lead">Alguma condição ou necessidade especial?</p>        
        </div>

        <div class="row">
            <select name="especial" id="especial" onchange="cond_especial(this.value);" class="form-control" style="display:block;">
                <option value="NENHUMA" selected>NENHUMA</option>
                <option value="AUDITIVA">AUDITIVA</option>
                <!--<option value="LACTANTE">LACTANTE</option>-->
                <option value="MOBILIDADE">MOBILIDADE</option>
                <!--<option value="SABADISTA">SABADISTA</option>-->
                <option value="VISUAL">VISUAL</option>
                <option value="OUTRA">OUTRA</option>
            </select>
        </div><p></p><p></p>

        <div class="row atendimentoespecial" style="display:none;">
            <div>
                <p class="lead">Condições solicitadas:</p>
            </div>
            <div>
                <input type="text" class="form-control" name="info_adicional" value="" id="info_adicional" onkeyup="maiuscula(this)">
            </div>
        </div>


        <p></p>
        <p><span class="lead">Declaração</span> <span class="" style="color:#FF0000">*</span></p>
        
        <div class="table-termos">
            <table>
                <tr>
                    <td style="width:20px; display:block;">
                        <input type="checkbox" class="form-control obrigatorio" name="termo1" class="" id="termo1" value="ON" checked onclick="checkthis()">
                    </td>
                    <td>
                        <label for="termo1" style="color:#FF0000">Declaro, para os devidos fins, que os dados declarados por mim são verdadeiros e de minha inteira responsabilidade a comprovação dos mesmos no dia da chamada.
                    </td>    
                </tr>                       
            </table>
        </div>        
    </div>
    






  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Retornar</button>
      <button type="button" id="nextBtn" disabled="true"  onclick="nextPrev(1)">Enviar</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>



<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    
    <script>
        //habilita o botão avançar ao concordar com o edital
        function habilita(){
          if(document.getElementById('chkedital').checked==true){
            document.getElementById("nextBtn").removeAttribute('disabled');    
          }else{
            document.getElementById("nextBtn").disabled = "true";
          }
        } 
    </script>
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
