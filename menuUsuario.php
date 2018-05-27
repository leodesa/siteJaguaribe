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
    <h1 id="titulo" class="center">Inserção de Documentos</h1>

    <div id="documentos">
    <form action="DAO.php" id="formFile" name="formFile" method="POST" enctype="multipart/form-data">
	<?php
		$compU = $_COOKIE[md5('usuariofpslavras')];
		$compS = $_COOKIE[md5('senhafpslavras')];
		$sql2 = mysqli_query($mysqli, "SELECT fornecedores.id FROM login JOIN fornecedores WHERE login.usuario = '$compU' AND login.senha = '$compS' AND login.vinculo = fornecedores.id");
			while($valor = mysqli_fetch_array($sql2)){
				$id = $valor[0];
				echo "<input type='hidden' value='$id' name='idPasta' />";
			}
	?>
    <label id="C3">Contrato Social e Aditivos <v>*</v></label>
    <div class="file-field input-field">
      <div class="btn">
        <span>Selecione o Arquivo</span>
        <input type="file" name="arquivo1">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="emissao1">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="validade1">
        <label id="C2">Validade</label>
    </div>
    <br>
    <label id="C3">CNPJ <v>*</v></label>
    <div class="file-field input-field">
      <div class="btn">
        <span>Selecione o Arquivo</span>
        <input type="file" name="arquivo2">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="emissao2">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="validade2">
        <label id="C2">Validade</label>
    </div>
    <br>
    <label id="C3">Inscrição Municipal <v>*</v></label>
    <div class="file-field input-field">
      <div class="btn">
        <span>Selecione o Arquivo</span>
        <input type="file" name="arquivo3">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="emissao3">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="validade3">
        <label id="C2">Validade</label>
    </div>
    <br>
    <label id="C3">CGF</label>
    <div class="file-field input-field">
      <div class="btn">
        <span>Selecione o Arquivo</span>
        <input type="file" name="arquivo4">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="emissao4">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="validade4">
        <label id="C2">Validade</label>
    </div>
    <br>
    <label id="C3">RG e CPF <v>*</v></label>
    <div class="file-field input-field">
      <div class="btn">
        <span>Selecione o Arquivo</span>
        <input type="file" name="arquivo5">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="emissao5">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="validade5">
        <label id="C2">Validade</label>
    </div>
    <br>
    <label id="C3">Certidão Federal (Portaria nº1751 02/10/2014) <v>*</v></label>
    <div class="file-field input-field">
      <div class="btn">
        <span>Selecione o Arquivo</span>
        <input type="file" name="arquivo6">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="emissao6">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="validade6">
        <label id="C2">Validade</label>
    </div>
    <br>
    <label id="C3">Certidão Estadual <v>*</v></label>
    <div class="file-field input-field">
      <div class="btn">
        <span>Selecione o Arquivo</span>
        <input type="file" name="arquivo7">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="emissao7">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="validade7">
        <label id="C2">Validade</label>
    </div>
    <br>
    <label id="C3">Certidão Municipal <v>*</v></label>
    <div class="file-field input-field">
      <div class="btn">
        <span>Selecione o Arquivo</span>
        <input type="file" name="arquivo8">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="emissao8">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="validade8">
        <label id="C2">Validade</label>
    </div>
    <br>
    <label id="C3">Certidão de Regularidade com FGTS <v>*</v></label>
    <div class="file-field input-field">
      <div class="btn">
        <span>Selecione o Arquivo</span>
        <input type="file" name="arquivo9">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="emissao9">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="validade9">
        <label id="C2">Validade</label>
    </div>
    <br>
    <label id="C3">Certidão Falência <v>*</v></label>
    <div class="file-field input-field">
      <div class="btn">
        <span>Selecione o Arquivo</span>
        <input type="file" name="arquivo10">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="emissao10">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="validade10">
        <label id="C2">Validade</label>
    </div>
    <br>
    <label id="C3">Balanço Patrimonial (Conforme Lei 123 das empresas ME/EPP
optante do Simples Nacional, estão dispensadas)</label>
    <div class="file-field input-field">
      <div class="btn">
        <span>Selecione o Arquivo</span>
        <input type="file" name="arquivo11">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="emissao11">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="validade11">
        <label id="C2">Validade</label>
    </div>
        <br>
    <label id="C3">CREA (se for o caso Construção ou Prestador de Serviços de
Engenharia)</label>
    <div class="file-field input-field">
      <div class="btn">
        <span>Selecione o Arquivo</span>
        <input type="file" name="arquivo12">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="emissao12">
        <label id="C2">Emissão</label>
    </div>
    <div class="input-field">
        <input type="date" class="validate" name="validade12">
        <label id="C2">Validade</label>
    </div>
    <button class="green right btn waves-effect waves-light block" type="button" onclick="document.getElementById('formFile').submit();" name="action">Enviar
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
