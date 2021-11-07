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
    <title>Sistema de busca por nome</title>
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
            <li role="presentation"><a href="por_cpf.php">Buscar por CPF</a></li>
            <li role="presentation"><a href="confirmadas.php">Consultar inscrições confirmadas</a></li>
            <li role="presentation"><a href="../menu.php">Voltar</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Sistema de busca e alteração</h3>
      </div>
      <div class="row">
        <div class="col-12">
          <form action="buscar_e_alterar_dados.php" method="post">           
                    
          <div>
            <input id="busca" type="text" class="form-control" placeholder="Buscar Candidato">
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
                $.post('../consultas/para_atualizar_.php', {busca: busca},function(data){
          $("#result").html(data);
        });
      });
      
    </script>
  </body>
</html>