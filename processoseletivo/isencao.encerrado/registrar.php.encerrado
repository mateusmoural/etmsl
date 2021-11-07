<?php
  session_start();
  if ($_SESSION['status'] != 'requerer') {
    header("Location: ../index.php");
  }
  else{
    //Possibilita acesso ao isencaoconfirmacao.php
    $_SESSION['status'] = 'isencaoregistrado';

    $profissao = $_POST["profissao"];
    $estado_civil = $_POST["estado_civil"];    
    $_SESSION['profissao'] = $profissao;
    $_SESSION['estado_civil'] = $estado_civil;
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
  $nis              = $_POST["nis"];
  $rg               = $_POST["rg"];

  //Limpa possíveis caracteres invalidos (apesar de já tratatado no frontend)
  $nome           = normaliza_caracteres($nome);
  $rua            = normaliza_caracteres($rua);
  $complemento    = normaliza_caracteres($complemento);
  $bairro         = normaliza_caracteres($bairro);
  $cidade         = normaliza_caracteres($cidade);
  $info_adicional = normaliza_caracteres($info_adicional);

  //Limpa possíveis mascaras (apesar de já tratatado no frontend)
  $cpf          = limpaMask($cpf);
  $cep          = limpaMask($cep);
  $fone1        = limpaMask($fone1);
  $nis          = limpaMask($nis);
  $rg           = limpaMask($rg);

  //Situação e pagamentos padrão no momento da inscrição
  $situacao    = "AGUARDANDO CONFIRMAÇÃO DE ISENÇÃO";
  $pagamento   = "ISENÇÃO SOLICITADA";
  
  //Estabelece conexão com banco de dados
  require_once "../lib/conexao.php";
  mysql_select_db("etmsl2", $conexao);

  //Consulta cpf no banco de dados
  $testecpf = mysql_query("SELECT cpf FROM processoseletivo WHERE cpf = '$cpf'");


  //Verifica se cpf já está cadastrado  (já verificado no logon mas por aqui serve pra tentativas de cadastros paralelos)
  if (mysql_num_rows($testecpf) <> 0){
    echo("CPF Cadastrado");
  }

  // Se não retornou nenhum registro, registra solicitação de isenção
  else{
        
    require_once "../lib/conexao.php";
    mysql_select_db("etmsl2", $conexao);

    $sql = "INSERT into processoseletivo (cpf, email, nome, opcao_curso, escolar_completa, dt_nasc, rua, num_res, complemento, bairro, cep, cidade, uf, fone1, situacao, pagamento, especial, info_adicional, nis, rg) values ('$cpf', '$email', '$nome', '$opcao_curso', '$escolar_completa', '$dt_nasc', '$rua', '$num_res', '$complemento', '$bairro', '$cep', '$cidade', '$uf', '$fone1', '$situacao', '$pagamento', '$especial', '$info_adicional', '$nis', '$rg')";

    $registro = mysql_query($sql);

    mysql_close($conexao);

    $_SESSION['cpf'] = $cpf;

    header("Location: anexos.php");
    
  }/*fim do else que gera boleto e registra o candidato*/

?>