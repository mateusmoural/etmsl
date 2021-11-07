<?php
  session_start();
  if ($_SESSION['status'] != 'solicitar') {
    header("Location: ../index.php");
  }
  else{
    //Possibilita acesso ao inscricaoconfirmacao.php
    $_SESSION['status'] = 'registrado';
  }

  //Cria funções
  //Limpa possíveis mascaras (apesar de já tratatado no frontend)
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

  //Delimita o texto de acordo com um limite de caracteres
  function limitarTexto($texto, $limite){
      $texto = (substr($texto, 0, $limite));
      return $texto;
  }

  //Cria variáveis com os dados informados
  $cpf              = $_POST["cpf"];
  $email            = $_POST["email"];
  $nome             = $_POST["nome"];
  $opcao_curso      = $_POST["opcao_curso"];
  $escolar_completa = $_POST["escolar_completa"];
  $dt_nasc          = $_POST["dt_nasc"];
  $rua              = $_POST["rua"];
  $num_res          = $_POST["num_res"];
  $complemento      = $_POST["complemento"];
  $bairro           = $_POST["bairro"];
  $cep              = $_POST["cep"];
  $cidade           = $_POST["cidade"];
  $uf               = $_POST["uf"];
  $fone1            = $_POST["fone1"];
  $especial         = $_POST["especial"];
  $info_adicional   = $_POST["info_adicional"];  
  $rg               = $_POST["rg"];

  //Limpa possíveis caracteres invalidos (apesar de já tratatado no frontend)
  $nome           = normaliza_caracteres($nome);
  $rua            = normaliza_caracteres($rua);
  $complemento    = normaliza_caracteres($complemento);
  $bairro         = normaliza_caracteres($bairro);
  $cidade         = normaliza_caracteres($cidade);
  $info_adicional = normaliza_caracteres($info_adicional);

  //Limita o numero de caracteres nos campos a serem usados pela Caixa
  $boleto_nome    = limitarTexto($nome,39);
  $boleto_rua     = limitarTexto($rua,36);
  $boleto_bairro  = limitarTexto($bairro,14);
  $boleto_cidade  = limitarTexto($cidade,14);

  //Limpa possíveis mascaras (apesar de já tratatado no frontend)
  $cpf         = limpaMask($cpf);
  $cep         = limpaMask($cep);
  $fone1       = limpaMask($fone1);  
  $rg          = limpaMask($rg);

  //Situação e pagamentos padrão no momento da inscrição
  $situacao    = "AGUARDANDO CONFIRMAÇÃO DE PAGAMENTO";
  $pagamento   = "PENDENTE";

  
  //Estabelece conexão com banco de dados
  require_once "../lib/conexao.php";
  mysql_select_db("etmsl2", $conexao);

  //Consulta cpf no banco de dados
  $testecpf = mysql_query("SELECT cpf FROM processoseletivo WHERE cpf = '$cpf'");

  //Verifica se cpf já está cadastrado (já verificado no logon mas por aqui serve pra tentativas de cadastros paralelos)
  if (mysql_num_rows($testecpf) <> 0){
    echo("CPF Cadastrado");
  }

  // Se não retornou nenhum registro cria boleto e registra inscrição
  else{

    include('../lib/WebserviceCaixa.php');
    
    //Cria array com dados a serem inseridos no boleto
    $emissor = array(
      'CNPJ' => '20491718000135',
      'CODIGO_BENEFICIARIO' => '074393',
      'IDENTIFICACAO' => 'FUNDACAO MUNICIPAL DE ENSINO PROFISSIONA',
      'ENDERECO1' => 'AV PREF ALBERTO MOURA, 1.111',
      'ENDERECO2' => 'SETE LAGOAS-MG',
      'UNIDADE' => '0154' // agência de relacionamento
    );
    
    //Chama função do Webservice
    //$ws = new WebserviceCaixa($emissor);

    //Cria array com dados do boleto
    $novo_boleto = array(
      //Informações do boleto
      'NOSSO_NUMERO' => '00000000000000000',
      'NUMERO_DOCUMENTO' => $cpf,
      'DATA_EMISSAO' => date('Y-m-d'),
      'DATA_VENCIMENTO' => date('2021-10-27'),
      'NUMERO_DIAS' =>  '0',
      'VALOR' => '40.00',
      'FLAG_ACEITE' => 'N',

      //Informações do pagador nos arrays PAGADOR e ENDERECO
      'PAGADOR' => array(
        'CPF' => $cpf,
        'NOME' => addslashes(preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($boleto_nome)))),
      'ENDERECO' => array(
        'LOGRADOURO' => 'RUA '.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($boleto_rua))),
        'BAIRRO' => preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($boleto_bairro))),
        'CIDADE' => preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($boleto_cidade))),
        'UF' => $uf,
        'CEP' => $cep
        )
      ),
      // Informações adicionais impressas no boleto e no sistema do beneficiário.
      // Pode-se informar até 4 vezes.
      'FICHA_COMPENSACAO' => array(
        'MENSAGENS' => array(
          'MENSAGEM1' => 'NÃO RECEBER APÓS O VENCIMENTO',
          'MENSAGEM2' =>  $opcao_curso
          )
        )
      );//Fim do array $novo_boleto

    //Chama função do Webservice (é a segunda vez não sei se precisa dessas duas chamadas de função)a primeira está comentada
    $ws = new WebserviceCaixa($emissor);

    //Chama outra função do Webservice
    $ws->Inclui($novo_boleto);

    //dados do boleto nas variáveis correspondentes
    $url = $ws->resposta['DADOS']['INCLUI_BOLETO']["URL"];  
    $nosso_numero = $ws->resposta['DADOS']['INCLUI_BOLETO']["NOSSO_NUMERO"];  
    $codigobarras = $ws->resposta['DADOS']['INCLUI_BOLETO']["CODIGO_BARRAS"];
    $linhadigitavel =  $ws->resposta['DADOS']['INCLUI_BOLETO']["LINHA_DIGITAVEL"];

    //echo 'teste2'.$ws->GetUrlBoleto(); não sei o que isso faz
    print_r($url."\n");
    print_r($nosso_numero."\n");
    print_r($codigobarras."\n");
    print_r($linhadigitavel);
    //print_r($ws->GetUrlBoleto());   

    //Verifica se gerou boleto
    if ($ws->GetCodigoRetorno() == "0") {
        echo "Boleto disponível em " . $ws->GetUrlBoleto() . "\n";
    } else {
        echo "Erro ao gerar boleto." . $ws->GetMensagemRetorno() . "\n";
    }
    print_r($ws->GetExcecao());

    // libera o tratador de erros interno
    unset($ws);


    //Só depois de criar os numeros
    //Conecta ao banco de dados
    require_once "../lib/conexao.php";
    mysql_select_db("etmsl2", $conexao);

    //Cria a query de registro 
    $sql = "INSERT into processoseletivo (cpf, email, nome, opcao_curso, escolar_completa, dt_nasc, rua, num_res, complemento, bairro, cep, cidade, uf, fone1, situacao, pagamento, especial, info_adicional, codigobarras, nosso_numero, linhadigitavel, url, rg) values ('$cpf', '$email', '$nome', '$opcao_curso', '$escolar_completa', '$dt_nasc', '$rua', '$num_res', '$complemento', '$bairro', '$cep', '$cidade', '$uf', '$fone1', '$situacao', '$pagamento', '$especial', '$info_adicional', '$codigobarras', '$nosso_numero', '$linhadigitavel', '$url', '$rg')";

    //Registra no banco de dados
    $registro = mysql_query($sql);

    //Verifica se registrou no banco de dados
    $selecao = mysql_query("SELECT cpf FROM processoseletivo WHERE nome = '$nome'");
    $row = mysql_fetch_array($selecao);
    if(count($row) == 0)
      {
        echo("Erro...");
      }

    //Encerra a conexão com o banco de dados
    mysql_close($conexao);
 

    //cria as variáveis de sessão
    $_SESSION['cpf'] = $cpf;
    $_SESSION['url'] = $url;
    /*/Acho que não preciso dessas
    $_SESSION['nosso_numero'] = $nosso_numero;
    $_SESSION['codigobarras'] = $codigobarras;
    $_SESSION['linhadigitavel'] = $linhadigitavel;*/

    //Abre a pagina de confirmação
    header("Location: confirmacao.php");

  }/*fim do else que gera boleto e registra o candidato*/

?>