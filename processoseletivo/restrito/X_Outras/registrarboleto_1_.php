<?php
  session_start();
  if ($_SESSION['permissao_cpf'] != 'sim') {
    header("Location: index.php");
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
    
  //Conecta ao banco de dados
  require_once "conexao.php";
  mysql_select_db("etmsl2", $conexao);

  //Consulta registros sem boleto e com cpf
  $query = "SELECT * FROM processoseletivo  WHERE pagamento = 'PENDENTE' AND url = '' ORDER BY nome ASC ";
  $result = mysql_query( $query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
  
  //Verifica o numero de resultados e imprime 
  $num   = mysql_num_rows($result);
  echo "Foram encontrados " . $num . " resultados!<br>";

  //A partir daqui as operações serão executades para cada um dos resultados da consulta

  while ($row = mysql_fetch_array($result)) {
    //Busca os resultados e os colota nas variáveis
    $id             = $row[id];
    $nome           = $row[nome];
    $cpf            = $row[cpf];
    $cep            = $row[cep];
    $rua            = $row[rua];
    $bairro         = $row[bairro];
    $cidade         = $row[cidade];
    $uf             = $row[uf];
    $opcao_curso    = $row[opcao_curso];

    //Limpa possíveis caracteres invalidos (apesar de já tratatado no frontend)
    $nome             = normaliza_caracteres($nome);
    $rua              = normaliza_caracteres($rua);
    $bairro           = normaliza_caracteres($bairro);
    $cidade           = normaliza_caracteres($cidade);

    //Cria as variáveis com o tamanho maximo para gerar boleto
    $boleto_nome        = limitarTexto($nome,40);
    $boleto_rua         = limitarTexto($rua,36);
    $boleto_bairro      = limitarTexto($bairro,15);
    $boleto_cidade      = limitarTexto($cidade,15);
    $boleto_opcao_curso = $opcao_curso;

    //Limpa possíveis mascaras (apesar de já tratatado no frontend)
    $cpf         = limpaMask($cpf);
    $cep         = limpaMask($cep);

    //Determina qual mensagem será registrada nos campos pagamento e situação
    $situacao    = "AGUARDANDO CONFIRMAÇÃO DE PAGAMENTO";
    $pagamento   = "PENDENTE";


    //Informa qual registro está sendo tratado
    echo "<br><br>Iniciando a criação de boleto para<br>" ;
    echo $id;
    echo "|";
    echo $cpf;
    echo "|";
    echo $nome;
    echo "|";
    echo $rua;
    echo "|";
    echo $bairro;
    echo "|";
    echo $cidade;
    echo "|";
    echo $cep;
    echo "|";
    echo $opcao_curso;

    echo "<br>";

    echo $id;
    echo "|";
    echo $cpf;
    echo "|";
    echo $boleto_nome;
    echo "|";
    echo $boleto_rua;
    echo "|";
    echo $boleto_bairro;
    echo "|";
    echo $boleto_cidade;
    echo "|";
    echo $cep;
    echo "|";
    echo $boleto_opcao_curso.'<br><br>';

    //Inclui serviço da Caixa
    include('WebserviceCaixa.php');
          
    //Cria array com dados bancarios
    $emissor = array(
      'CNPJ' => '20491718000135',
      'CODIGO_BENEFICIARIO' => '074393',
      'IDENTIFICACAO' => 'FUNDACAO MUNICIPAL DE ENSINO PROFISSIONA',
      'ENDERECO1' => 'AV PREF ALBERTO MOURA, 1.111',
      'ENDERECO2' => 'SETE LAGOAS-MG',
      'UNIDADE' => '0154' // agência de relacionamento
    );
    
    //Inclusão de boleto
    $ws = new WebserviceCaixa($emissor);
    
    //Cria array com dados do boleto
    $novo_boleto = array(
      //Informações do boleto
      'NOSSO_NUMERO' => '00000000000000000',
      'NUMERO_DOCUMENTO' => $cpf,
      'DATA_EMISSAO' => date('Y-m-d'),
      'DATA_VENCIMENTO' => date('2020-07-27'),
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

    //É a segunda vez que aparece
    $ws = new WebserviceCaixa($emissor);

    $ws->Inclui($novo_boleto);

    //Guarda dados do boleto nas variáveis correspondentes
    $url = $ws->resposta['DADOS']['INCLUI_BOLETO']["URL"];  
    $nosso_numero = $ws->resposta['DADOS']['INCLUI_BOLETO']["NOSSO_NUMERO"];  
    $codigobarras = $ws->resposta['DADOS']['INCLUI_BOLETO']["CODIGO_BARRAS"];
    $linhadigitavel =  $ws->resposta['DADOS']['INCLUI_BOLETO']["LINHA_DIGITAVEL"];

    //Será que precisa?
    //echo 'teste2'.$ws->GetUrlBoleto();
    print_r($url."\n");
    print_r($nosso_numero."\n");
    print_r($codigobarras."\n");
    print_r($linhadigitavel);
    //print_r($ws->GetUrlBoleto()); 
          

    //Só depois de criar o boleto
    //Cria query de atualização 
    $sql = "UPDATE processoseletivo SET situacao = '$situacao', pagamento = '$pagamento' , codigobarras = '$codigobarras' , nosso_numero = '$nosso_numero' , linhadigitavel = '$linhadigitavel' , url = '$url'  WHERE id = '$id'";

    //Registra no banco de dados
    $registro = mysql_query($sql);

    //Encerra a conexão com o banco de dados
    mysql_close($conexao);

    /*/Verifica se gerou boleto
    if ($ws->GetCodigoRetorno() == "0") {
        echo "" . $ws->GetUrlBoleto() . "\n";
    } else {
        echo "" . $ws->GetMensagemRetorno() . "\n";
    }
    print_r($ws->GetExcecao());*/

    // libera o tratador de erros interno
    unset($ws);

    //Informa a conclusão do laço while
    echo "<br><br>Feito!<br><br>";

    echo '<button type="button" class="btn btn-info btn-block" id="voltar" onclick="window.location.href = '."'registrarboleto_semboleto_.php'".'">Próximo</button><br><br>';
    
    break;
  }

  echo '<button type="button" class="btn btn-info btn-block" id="voltar" onclick="window.location.href = '."'painel.php'".'">Voltar</button><br><br>';

?>