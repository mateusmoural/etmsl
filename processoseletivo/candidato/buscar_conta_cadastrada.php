<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <title>Sistema de buscas</title>
    <link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/3.3/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/3.3/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
    <script src="https://getbootstrap.com/docs/3.3/assets/js/ie-emulation-modes-warning.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="index.php">Voltar</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Veja a conta Google cadastrada com seu CPF</h3>
      </div>
      <div class="row">
        <div class="col-12">
          <form>           
                    
          <div>
            <input id="busca" type="text" class="form-control" placeholder="Digite seu CPF" maxlength="11" onkeydown="javascript:fMasc(this, mCPF);">
          </div>
            
          </form>
          <p id="result"></p>
        </div>
      </div>
      <footer class="footer">
        <p> 2021 ETMSL.</p>
      </footer>
    </div> <!-- /container -->
    <script>
      $("#busca").keyup(function(){
        var busca = $("#busca").val();
        var n = busca.length
        $.post('buscar_conta_cadastrada_.php', {busca: busca, n: n},function(data){
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
    cpf=cpf.replace(/(\d{11})/,"$1")
    return cpf
    }
      
    </script>
  </body>
</html>