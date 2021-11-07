<!DOCTYPE html>
<html>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title>Logon - ETMSL</title>
    <meta charset="UTF-8" />
    <!-- Estilos da Index.php -->
    <link rel="stylesheet" id="bootstrap-css" href="../css/bootstrap.min.css">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link  rel="stylesheet" href="../css/style.css">
    <meta name="google-signin-client_id" content="89860467480-4aan3ih1q29c63o1d768ci35lm2kii7e.apps.googleusercontent.com">
    <script type="text/javascript">
      function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        var senha = profile.getId(); // Do not send to your backend! Use an ID token instead.
        var name = profile.getName();
        var email = profile.getEmail(); // This is null if the 'email' scope is not present.
        document.getElementById('contagoogle').value = email;
      }
    </script>
    <script>
      function limpa{
          window.location.reload();
        }
    </script>
    <script>
      function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
          console.log('User signed out.');
          window.location.reload();
        });
      }
    </script>


<head>
    
  <style type="text/css">

 .login-container{
    margin-top: 5%;
    margin-bottom: 5%;    
  }

.login-form-2{
    padding: 5%;
    background: #fff;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
  }
.login-form-2 h3{
    text-align: center;
}
.login-container form{
    padding: 10%;
}
.btnSubmit
{
    position: center;
    width: 60%;
    height:50px;
    padding: 10%;
    border: none;
    cursor: pointer;
}
.login-form-2 .btnSubmit{
  position: center;
    font-weight: 600;
    color: #555;
    background-color: #bbb;
}
.flex-box {
  display: flex;
  align-items: center;
  justify-content: center;
}

  </style>
</head>
<body>
  <body style="background-color: #bbb;">
    <div class="container login-container flex-box">
      <div class="row">

          <div class="login-form-2 col-12" style="min-width: 300px;">
              <h1>Logon para formulário de inscrição no processo seletivo</h1>
              <!-- Aqui temos o formulário
              *Action é vazia por que vamos fazer a validação e o redirecionamento nesta mesma página.
              -->
              <hr>
              <p>Para iniciar o processo de inscrição, é necessário efetuar login com sua própria <font color="red" size=5;><b>conta Google (Gmail)</b></font>, que será vinculada ao seu número de CPF.<br>Esse procedimento é essencial para acesso à plataforma da prova.</p>
              <p>Você pode criar uma conta Google clicando <a href="https://accounts.google.com/signup">aqui</a>.</p>
              <p>Brasileiros residentes no Brasil, de 16 a 25 anos, que possuam Título de Eleitor regular, podem solicitar a primeira via do CPF clicando <a href="http://receita.economia.gov.br/">aqui</a>.</p>

              
              
              
              <form method="post" action="inscricao.php">
                <p class="flex-box">Primeiro faça login na sua conta Google</p><p class="g-signin2 flex-box"  onchange="javascript: limpa();" data-onsuccess="onSignIn"></p>
                <p class="flex-box">Digite também seu numero de CPF</p>
                <p class="flex-box">
                    <input type="text" class="form-control" placeholder="CPF" value="" id="cpf" name="cpf" maxlength="14" style="width: 250px;" onkeydown="javascript: fMasc( this, mCPF );" onkeyup="javascript: ativabtn()"/>
                    <input type="hidden" name="contagoogle" id="contagoogle">
                </p>
                
              <p id="result" style="color: red;"></p>
                
                <p class="flex-box">
                  <a style="margin: 5px;" href="../index.php" class="btn btn-info btn-lg">Voltar</a>  <button  style="margin: 5px;" type="submit" id="botao" class="btn btn-success btn-lg" disabled="true">Iniciar inscrição</button>
                </p>               
            </form>
          </div>
      </div>
    </div>  


<footer>
  <script src="../js/jquery-1.11.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/functions.js"></script>
  <script>
    $("#cpf").keyup(function(){
      var busca = $("#cpf").val().replace(/[^\d]+/g,'');
      var n = busca.length
      var contagoogle = $("#contagoogle").val();
      
      $.post('logon.php', {cpf: busca, contagoogle: contagoogle, n: n},function(data){
        $("#result").html(data);
      });
      
    });

  
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


</script>

</footer>
</body>

</html>