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
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
</head>

<body>
	<div class="navbar-fixed">
		<ul id="dropdown1" class="dropdown-content">
		  <li><a href="#!">Inserir</a></li>
 	 	  <li><a href="#!">Editar</a></li>
        </ul>
	  <nav class="green lighten-1" role="navigation">
		  <div class="nav-wrapper container">
			  <img id="logo" src="img/logo.png" class="left">
			  <a id="logo-container" href="index.php" class="brand-logo">Sistema Lavras</a>
			  <ul class="right hide-on-med-and-down">
          	  	<li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Documentos<i class="material-icons right">arrow_drop_down</i></a></li>
          		<li><a href="#">Sair</a></li>
          	  </ul> 	
    	  </div>
  	  </nav>
  	</div>
    <h1 id="titulo" class="center">Inserção de Documentos</h1>

    <div id="documentos">
    <form action="#">
    <div class="file-field input-field">
      <div class="btn">
        <span>Contrato Social e Aditivos</span>
        <input type="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate">
        <label id="C2">Validade</label>
    </div>
    <br>
    <div class="file-field input-field">
      <div class="btn">
        <span>Cnpj</span>
        <input type="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate">
        <label id="C2">Validade</label>
    </div>
    <button class="green right btn waves-effect waves-light block" type="button" name="action">Salvar
        <i class="material-icons right">send</i>
    </button>
    <br>
  </form>
  </div>

  <footer class="page-footer green">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Links</h5>
          <ul>
            <li><a class="white-text" href="https://www.lavrasdamangabeira.ce.gov.br/">Site da Prefeitura</a></li>
            <br>
            <li><a class="white-text fabrica" href="#"><img class="fabrica" src="img/logoFabrica.png" href="#">Fabrica de Software</a></li>
            <li><a class="redes white-text" href="https://www.facebook.com/governolavras/"><img class="redes" src="img/facebook.png" href="#">Facebook</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="green-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/script.js"></script>

  </body>
</html>
