<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no,">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="Module/RecuperaContrasena/View/Img/favicon.ico">

    <title> <?= DF_TITULO; ?> <?= DF_MENSAJE; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="Services/Resources/bootstrap/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="Module/RecuperaContrasena/View/LoginView.css" rel="stylesheet">

    <!-- Librerias externas para mostrar u ocultar el password -->
    <link rel='stylesheet' href='Services/Resources/bootstrap-4.5.2-dist/css/bootstrap.min.css' type='text/css' media='all'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  </head>

  <body class="text-center" >
    <form class="form-signin" id="formRecupera" action="inicio" method="post" >
      <img class="mb-4" src="Module/RecuperaContrasena/View/Img/logoefa3.png" alt="" height="100">
      <h1 class="h3 mb-3 font-weight-normal" style="font-size: 18px; "><?=$MENSAJE ?></h1>
     
      <button class="btn btn-lg btn-success btn-block" type="submit">Continuar</button>
      <br>
      <p class="mt-5 mb-3 text-muted">&copy; copyright 2018</p>
    </form>
    
    <!-- Librerias externas para mostrar u ocultar el password -->
    <footer>
      <script src='Services/Resources/jquery-3.2.1/jquery-3.2.1.min.js' type='text/javascript'></script> 
      <script src='Services/Resources/bootstrap-4.5.2-dist/js/bootstrap.min.js' type='text/javascript'></script>
      <script src='Module/RecuperaContrasena/View/LocalView.js' type='text/javascript'></script>
      <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </footer>
  
  </body>
</html>