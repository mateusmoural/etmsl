<?php 
  session_start();
  if ($_SESSION['nivel'] > 1) {
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
        <h3 class="text-muted">Pesquisa por pagamento</h3>
      </div>
      <div class="header clearfix">
        <h3 class="text-muted"></h3>
      </div>
      
      <label for="EscCargo">Escolha</label>
              <select id="busca" name="busca" class="form-control">
                <option value="ZZZ">SELECIONE</option>
                <option value="LIQ">BOLETOS PAGOS</option>
                <option value="PAGO">PAGOS</option>
                <option value="PEND">PAGAMENTOS PENDENTES</option>
                <option value="SOLICITADA">ISENÇÕES SOLICITADAS</option>
                <option value="ISENT">ISENÇÕES DEFERIDAS</option>
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
                $.post('../consultas/isencao_solicitada_.php', {busca: busca},function(data){
          $("#result").html(data);
        });
      });
      
    </script>
  </body>
</html>