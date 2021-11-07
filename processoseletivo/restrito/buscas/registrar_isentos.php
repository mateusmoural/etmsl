<?php 
  session_start();
  if ($_SESSION['nivel'] > 0) {
    header("Location: ../menu.php");
  }
  else{
    $_SESSION['isento'] = 'sim';
  }
?>
<!DOCTYPE html>
<html>
  <link href="../../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/jquery.min.js"></script>
  <title>Registra isentos - ETMSL</title>
    <meta charset="UTF-8" />
    <!-- Estilos da Index.php -->
    <link rel="stylesheet" id="bootstrap-css" href="../../css/bootstrap.min.css">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link  rel="stylesheet" href="../../css/style.css">
    <meta name="google-signin-client_id" content="89860467480-4aan3ih1q29c63o1d768ci35lm2kii7e.apps.googleusercontent.com">

<head>
    
  <style type="text/css">

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
      <div class="row" style="padding: 50px">

          <div class="login-form-2 col-12" style="min-width: 300px; background-color: #fff; padding: 50px;">
              <h1>Registra isentos</h1>
              <p>Nome,CPF,Situação</p>
              <!-- Aqui temos o formulário
              *Action é vazia por que vamos fazer a validação e o redirecionamento nesta mesma página.
              -->
              <hr>
              <p id="result"></p>
              
              
              <form method="post" action="../consultas/registrar_isentos_.php" enctype="multipart/form-data">
                <div class="flex-box">
                    <input type="file" class="form-control" placeholder="arquivo txt" id="extrato" name="extrato"/><br><br><br>
                </div>
                <div class="flex-box">
                  <br><br><br><br><br><br>
                  <a style="margin: 5px;" href="../menu.php" class="btn btn-info btn-lg">Voltar</a>  <button  style="margin: 5px;" type="submit" id="botao" class="btn btn-success btn-lg">Registrar</button>
                </p></div>                
            </form>
          </div>
      </div>
    </div>  


<footer>
  <script src="../../js/jquery-1.11.1.min.js"></script>
  <script src="../../js/popper.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/functions.js"></script>
</script>

</footer>
</body>

</html>
