<!DOCTYPE html>

<?php
    session_start(); # Deve ser a primeira linha do arquivo


?>
<html>
  
 <head>
    <meta charset="utf-8">
    <title>Verificar inscrições</title>
    


    <link rel="stylesheet" href="./bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap/4.1.3/css/style.css">

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="./bootstrap/4.1.3/js/jquery-3.3.1.slim.min.js"></script>
    <script src="./bootstrap/4.1.3/js/popper.min.js"></script>
    <script src="./bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="./bootstrap/4.1.3/js/funcoes.js"></script>
  <script type="text/javascript" src="./bootstrap/4.1.3/js/jquery.mask.min.js"/></script>



  <script type="text/javascript">
     function is_cpf (c) {
      if((c = c.replace(/[^\d]/g,"")).length != 11)
          return false

      if (c == "00000000000")
          return false;

      var r;
      var s = 0;

        for (i=1; i<=9; i++)
          s = s + parseInt(c[i-1]) * (11 - i);

          r = (s * 10) % 11;

          if ((r == 10) || (r == 11))
          r = 0;

          if (r != parseInt(c[9]))
            return false;

          s = 0;

        for (i = 1; i <= 10; i++)
          s = s + parseInt(c[i-1]) * (12 - i);

        r = (s * 10) % 11;

          if ((r == 10) || (r == 11))
          r = 0;

          if (r != parseInt(c[10]))
          return false;

      return true;
    }


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

    cpfCheck = function (el) {
        document.getElementById('cpfResponse').innerHTML = is_cpf(el.value)? '<span style="color:green">válido</span>' : '<span style="color:red">inválido</span>';
        if(el.value=='') document.getElementById('cpfResponse').innerHTML = '';
    }


      function FormatarCampo(objCampo, strMascara)
          {
              var intDigito = event.keyCode;

              // Expressão regular para validação de caractere dígitado.
              // São aceitos apenas números entre "0-9", são feitos dois testes pois existem "dois teclados numéricos" e seus caracteres ASCII são diferentes.
              var objER = /^(4[8-9]|5[0-7]|9[6-9]|10[0-5])$/;

              if(objER.test(intDigito))
                  {
                      var intTamanho   = objCampo.value.length;
                      var strCaractere = strMascara.charAt(0);
                      var strMascara   = strMascara.substring(intTamanho)

                      if (strMascara.charAt(0) != strCaractere)
                          objCampo.value += strMascara.charAt(0);
                  }
          }
      //-->
  </script>

  <!-- Essa função da maneira como está implementada deve ser chamada no evento onKeyPress do textbox-->




<script type="text/javascript">
 function SomenteNumero(e){
 var tecla=(window.event)?event.keyCode:e.which;
 if((tecla>47 && tecla<58)) return true;
 else{
 if (tecla==8 || tecla==0) return true;
 else  return false;
 }
}
</script>


<style type="text/css">
  table thead td{
    width: 100%;
    background: #333;
    color:#FFF;
    height: 40px;
    text-align:center;
}

table tbody td{
    width: 100%;
    height: 40px;
    text-align:center;
}
</style>




  <body>
    <h1>Controle de inscrições</h1>

    <div row>
      <div class="form-group col-md-3 col-sm-6>
        <label for="nome">Nome</label>
        <input type="text" size="53" class="form-control" id="nome" onChange="javascript:this.value=this.value.toUpperCase()" placeholder="Nome Completo">
      </div>
      <div class="form-group col-md-3 col-sm-6">
          <label for="CPF">CPF</label>
          <input type="text" name="CPF" maxlength="14" onkeyup="cpfCheck(this)" onkeydown="javascript: fMasc( this, mCPF );" class="form-control" id="CPF" placeholder="000.000.000-00"><span id="cpfResponse"></span>
      </div>
      <div class="form-group col-md-4 col-sm-6">
        <label for="EscCargo">Turma</label>
        <select id="EscCargo" name="EscCargo" class="form-control">
          <option value="Todas">Todas</option>
          <option value="Administracao">Administração</option>
          <option value="Analises_Clinicas">Análises Clínicas</option>
          <option value="Edificacoes">Edificações</option>
          <option value="Eletronica">Eletrônica</option>
          <option value="Eletrotecnica">Eletrotécnica</option>
          <option value="Enfermagem">Enfermagem</option>
          <option value="Mecanica">Mecânica</option>
          <option value="Meio_Ambiente">Meio Ambiente</option>
          <option value="Metalurgia">Metalurgia</option>
          <option value="Quimica">Química</option>
        </select>
      </div>

      <div class="form-group col-md-4 col-sm-6">
        <label for="ordem">Ordenar por</label>
        <select id="ordem" name="EscCargo" class="form-control">
          <option value="noone">Padrão</option>
          <option value="CPF">CPF</option>
          <option value="nome">Nome</option>
          <option value="EscCargo">Curso</option>
        </select>
      </div>
    </div>
    

</form>

<div id="resultado">
  <?php
    include('conexao.php');
    $sql=$mysql->mysql_query("SELECT nome,CPF,esccargo,URL,Email,Fone1,Fone2,Cidade FROM dados");
    $sql->execute();
    echo "
        <table>
          <thead>
              <tr>
                  <td>Nome</td>
                  <td>CPF</td>
                  <td>Curso Selecionado</td>
                  <td>URL boleto</td>
                  <td>Email</td>
                  <td>Telefone Fixo</td>
                  <td>Telefone Celular</td>
                  <td>Cidade</td>
              </tr>
          </thead>

          <tbody>";
          $sql->bind_result($nome,$CPF,$esccargo,$URL,$Email,$Fone1, $Fone2,$Cidade);
        
        while($sql->fetch()){
          echo "
            <tr>
              <td>$nome</td>
              <td>$CPF</td>
              <td>$esccargo</td>
              <td>$URL</td>
              <td>$Email</td>
              <td>$Fone1</td>
              <td>$Fone2</td>
              <td>$Cidade</td>
            </tr>";
        }
        echo "
          </tbody>
          </table>
          ";
      ?>

  

    </div>  


    

    

    

   

  </body>

</html>
