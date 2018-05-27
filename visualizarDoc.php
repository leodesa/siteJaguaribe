<?php
  include('classes/CRUD.class.php');
  include("conexao.php");
  $CRUD = new CRUD;
  $CRUD->verificarCookie();
?>
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
	<?php include('include/menu.php'); ?>
    <h1 id="titulo" class="center">Documentos enviados</h1>

    <div id="documentos">
		<?php
		$compU = $_COOKIE[md5('usuariofpslavras')];
		$compS = $_COOKIE[md5('senhafpslavras')];
		$sql2 = mysqli_query($mysqli, "SELECT fornecedores.id FROM login JOIN fornecedores WHERE login.usuario = '$compU' AND login.senha = '$compS' AND login.vinculo = fornecedores.id");
			while($valor = mysqli_fetch_array($sql2)){
				$id = $valor[0];
			}
		echo "<table class='highlight'>
        <thead>
          <tr>
              <th>Nome do arquivo</th>
              <th>Tipo</th>
              <th>Op</th>
          </tr>
        </thead>

        <tbody>"; 
		$sql2 = mysqli_query($mysqli, "SELECT arquivos.nomeArquivo, fornecedores.rasao, fornecedores.cnpj, arquivos.tipoArquivo 
		FROM arquivos JOIN fornecedores WHERE arquivos.vinculo = '$id' AND arquivos.vinculo = fornecedores.id");
			while($valor = mysqli_fetch_array($sql2)){
				echo "<tr><td>".$valor[0]."</td><td>".$CRUD->tipoArquivo[$valor[3]]."</td><td><a href='arquivos/".$valor[1]."-".$valor[2]."/".$valor[0]."' target='_blank'>Visualizar</a></td></tr>";
			}
		echo "</tbody>
      </table>";
		?>
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
