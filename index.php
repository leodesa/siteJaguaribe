<!DOCTYPE html>
<html lang="br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>LAVRAS</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="icon" href="img/logo.png">
</head>
<body>
  <nav class="green lighten-1" role="navigation">
    <div class="nav-wrapper container">
      <img id="logo" src="img/logo.png">
      <a id="logo-container" href="index.php" class="brand-logo">Prefeitura Municipal de Lavras da Mangabeira</a>
    </div>
  </nav>
    <h1 id="titulo" class="center">Fornecedores e Prestadores de Serviços</h1>
    <div class="login row">
    <form name="login" class="col s12" action="DAO.php" method="POST">
      <div class="row">
        <div class="input-field col s12">
          <input id="usuario" type="text" class="validate" name="usuario">
          <label for="usuario">Usuário</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate" name="senha">
          <label for="password">Senha</label>
        </div>
      </div>
      <button class="green right btn waves-effect waves-light" type="submit" name="action" onclick="return loginTemp()">Entrar
        <i class="material-icons right">send</i>
      </button>
      <h1 id="C1">Ainda não tem cadastro? <a id="C2" href="cadastro.php">Cadastre-se</a></h1>
    </form>
  </div>
  <?php	include('include/rodape.php'); ?>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/script.js"></script>

  </body>
</html>
