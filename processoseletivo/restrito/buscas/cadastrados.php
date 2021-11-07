<?php 
  session_start();
  if ($_SESSION['nivel'] > 2) {
    header("Location: ../menu.php");
  }
 ?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <title>Sistema de Busca</title>
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
            <li role="presentation"><a href="#"></a></li>
            <li role="presentation"><a href="#"></a></li>
            <li role="presentation"><a href="../menu.php">Voltar</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Cadastrados inclusive não pagos</h3>
      </div>
      <div class="header clearfix">
        <h3 class="text-muted"></h3>
      </div>
      
      <label for="Curso">Curso&nbsp;</label>
              <select id="busca" name="busca" class="form-control">
              <option value="¨#">SELECIONE</option>
              <option value="ADMINISTRACAO">Administração</option>
              <!--<option value="ANALISES CLINICAS">Análises Clínicas</option>-->
              <option value="EDIFICACOES">Edificações</option>
              <option value="ELETRONICA">Eletrônica</option>
              <option value="ELETROTECNICA">Eletrotécnica</option>
              <option value="ENFERMAGEM">Enfermagem</option>
              <!--<option value="MECANICA">Mecânica</option>-->
              <option value="MEIO AMBIENTE">Meio Ambiente</option>
              <option value="METALURGIA">Metalurgia</option>
              <option value="QUIMICA">Química</option>
              <option value="A">TODOS</option>
            </select>

      <div class="row">
        <div class="col-12">
          
          <p id="result"></p>
        </div>
      </div>
      <footer class="footer">
        <p> 2021 ETMSL.</p>
      </footer>
    </div> <!-- /container -->
    <script>
      $("#busca").change(function(){
        var busca = $("#busca").val();
                $.post('../consultas/cadastrados_.php', {busca: busca},function(data){
          $("#result").html(data);
        });
      });
      
    </script>
  </body>
</html>