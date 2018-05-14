<?php
	include('classes/CRUD.class.php');
	include("conexao.php");
	$CRUD = new CRUD;
	$CRUD->verificarCookie();
  if (isset($_COOKIE[md5('usuariofpslavras')]) and isset($_COOKIE[md5('senhafpslavras')])){
	   $userUpdate = $_COOKIE[md5('usuariofpslavras')];
	   $senhaUpdate = $_COOKIE[md5('senhafpslavras')];
  }else{
    header("Location: index.php");
  }
	$sql2 = mysqli_query($mysqli, "SELECT fornecedores.rasao, fornecedores.fantasia, fornecedores.cnpj, fornecedores.cgf, fornecedores.rua, fornecedores.numeroCasa,
	fornecedores.complemento, fornecedores.bairro, fornecedores.telefone, fornecedores.uf, fornecedores.cidade, fornecedores.nomeBanco, fornecedores.agencia, fornecedores.contaCorrente,
	fornecedores.id FROM fornecedores JOIN login WHERE login.usuario = '$userUpdate' AND login.senha = '$senhaUpdate' AND login.vinculo = fornecedores.id");
	while($valor = mysqli_fetch_array($sql2)){
		$rasao = $valor[0];
		$fantasia = $valor[1];
		$cnpj = $valor[2];
		$cgf = $valor[3];
		$rua = $valor[4];
		$numeroCasa = $valor[5];
		$complemento = $valor[6];
		$bairro = $valor[7];
		$telefone = $valor[8];
		$uf = $valor[9];
		$cidade = $valor[10];
		$nomeBanco = $valor[11];
		$agencia = $valor[12];
		$contaCorrente = $valor[13];
		$idFornecedor = $valor[14];
	}
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
  <script>
	var socios = 1;
	var max = 10
	var controle = 0;
	function adicionarCampos(){
		if(socios!=max){
			socios++;
			if(socios>=2 && controle==0){
				$('#op').append("<div class='green right btn waves-effect waves-light center block' id='closeSo' onclick='removeCampo(\"socioCp\")'>Remover<i class='material-icons right closeSocios' id='closeSo'>close</i></div>");
				controle=1;
			}
			$('#campo').append("<div id='socioCp"+socios+"'><h6 id='cabeca' class='right'>Número "+socios+"<i class='material-icons right'>people</i></h6><div class='input-field col s12'><input id='nomeSocio"+socios+"' name='nomeSocio"+socios+"' type='text' class='validate'><label for='nomeSocio"+socios+"'>Nome</label></div><div class='input-field col s6'><input id='cpfSocio"+socios+"' name='cpfSocio"+socios+"' type='number' class='validate'><label for='cpfSocio"+socios+"'>CPF</label></div><div class='input-field col s6'><input id='quantificacaoSocio"+socios+"' name='quantificacaoSocio"+socios+"' type='text' class='validate'><label for='quantificacaoSocio"+socios+"'>Quantificação</label></div><div class='input-field col s6'><input id='telefoneSocios"+socios+"' name='telefoneSocios"+socios+"' type='number' class='validate'><label for='telefoneSocios"+socios+"'>Telefone</label></div><div class='input-field col s6'><input id='celularSocio"+socios+"' name='celularSocio"+socios+"'type='number' class='validate'><label for='celularSocio"+socios+"'>Celular</label></div><div class='input-field col s12'><input id='emailSocio' name='emailSocio"+socios+"' type='text' class='validate'><label for='emailSocio"+socios+"'>Email</label></div></div>");
			$('#qtdeSocios').val(parseInt($('#qtdeSocios').val())+1);
			if(socios==max){
				$('#buttonMais').remove();
			}
		}
	}
	function removeCampo(div) {
		$('#'+div+$('#qtdeSocios').val()).remove();
		if(socios<=max){
			$('#buttonMais').remove();
			$('#op').append("<div class='green left btn waves-effect waves-light center block' id='buttonMais' onclick='adicionarCampos()'>Adicionar<i class='add material-icons center'>add_circle</i></div>");
		}
		socios--;
		$('#qtdeSocios').val(parseInt($('#qtdeSocios').val())-1);
		if(socios<2){
			$('#closeSo').remove();
			controle = 0;
		}
	}
</script>
</head>
<body>
  <div class="navbar-fixed">
		<ul id="dropdown1" class="dropdown-content">
		  <li><a href="menuUsuario.php">Inserir</a></li>
 	 	  <li><a href="#!">Editar</a></li>
          <li><a href="#!">Apagar</a></li>
        </ul>
	  <nav class="green lighten-1" role="navigation">
		  <div class="nav-wrapper container">
			  <img id="logo" src="img/logo.png" class="left">
			  <a id="logo-container" href="index.php" class="brand-logo">Sistema Lavras</a>
			  <ul class="right hide-on-med-and-down">
          	  	<li><a class="dropdown-trigger" href="#!" data-target="dropdown1" style="outline:none;">Documentos<i class="material-icons right">arrow_drop_down</i></a></li>
          		<li><a href="logout.php">Sair</a></li>
          	  </ul> 	
    	  </div>
  	  </nav>
  	</div>
<h1 id="titulo" class="center">Dados de Cadastro Fornecedores e Prestadores de Serviços</h1>
    <div class="cadastro row">
    <form name="cadastro" id="cadastro" class="col s12" method="POST" action="DAO.php">
      <h5 id="cabeca">Login<i class="material-icons left">person</i></h5>
	  <input type="hidden" value="<?php echo $idFornecedor;?>" name="atualizar" />
      <div class="row">
        <div class="input-field col s12">
          <input id="usuarioCad" name="usuarioCad" type="text" class="validate" required disabled>
          <label for="usuarioCad">Usuário <v>*</v></label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s7">
          <input id="senha" type="password" name="senha" class="validate" required disabled>
          <label for="pass">Senha <v>*</v></label>
        </div>
        <div class="input-field col s5">
          <input id="senhaConf" name="senhaConf"type="password" class="validate" required disabled>
          <label for="passwordConf">Repetir Senha<v>*</v></label>
        </div>
      </div>
      <h5 id="cabeca">Pessoa Juridíca<i class="material-icons left">people</i></h5>
      <div class="row">
        <div class="input-field col s12">
          <input id="rasaoSocial" name="rasaoSocial" type="text" class="validate" value="<?php echo $rasao;?>" disabled required>
          <label for="rasaoSocial">Rasão Social <v>*</v></label>
        </div>
        <div class="input-field col s12">
          <input id="fantasia" name="fantasia" type="text" value="<?php echo $fantasia;?>" disabled class="validate">
          <label for="fantasia">Nome de Fantasia</label>
        </div>
        <div class="input-field col s7">
          <input id="cnpj" name="cnpj" type="number" class="validate" value="<?php echo $cnpj;?>" disabled required>
          <label for="cnpj">CNPJ.n° <v>*</v></label>
        </div>
        <div class="input-field col s5">
          <input id="cgf" name="cgf" type="text" value="<?php echo $cgf;?>" disabled class="validate">
          <label for="cgf">C.G.F.</label>
        </div>
        <div class="input-field col s10">
          <input id="rua" name="rua" type="text" class="validate" value="<?php echo $rua;?>" disabled required>
          <label for="rua">Rua <v>*</v></label>
        </div>
        <div class="input-field col s2">
          <input id="numeroCasa" name="numeroCasa" type="number" value="<?php echo $numeroCasa;?>" disabled class="validate" required>
          <label for="numeroCasa">N° <v>*</v></label>
        </div>
        <div class="input-field col s12">
          <input id="complemento" name="complemento" type="text" value="<?php echo $complemento;?>" disabled class="validate">
          <label for="complemento">Complemento</label>
        </div>
        <div class="input-field col s7">
          <input id="bairro" name="bairro" type="text" class="validate" value="<?php echo $bairro;?>" disabled required>
          <label for="bairro">Bairro <v>*</v></label>
        </div>
        <div class="input-field col s5">
          <input id="telefone" name="telefone" type="number" value="<?php echo $telefone;?>" disabled class="validate" required>
          <label for="telefone">Telefone <v>*</v></label>
        </div>
        <div class="input-field col s7">
          <input id="cidade" name="cidade"type="text" value="<?php echo $cidade;?>" disabled class="validate" required>
          <label for="cidade">Cidade <v>*</v></label>
        </div>
        <div class="input-field col s5">
          <input id="uf" name="uf" type="text" class="validate" value="<?php echo $uf;?>" disabled required>
          <label for="uf">UF <v>*</v></label>
        </div>
      </div>
      <h5 id="cabeca">Informações Bancárias<i class="material-icons left">attach_money
</i></h5>
      <div class="row">
        <div class="input-field col s12">
          <input id="nomeBanco" name="nomeBanco" type="text" value="<?php echo $nomeBanco;?>" disabled class="validate">
          <label for="nomeBanco">Nome do Banco</label>
        </div>
        <div class="input-field col s12">
          <input id="agencia" name="agencia" type="number" value="<?php echo $agencia;?>" disabled class="validate">
          <label for="agencia">Agencia</label>
        </div>
        <div class="input-field col s12">
          <input id="contaCorrente" name="contaCorrente" type="text" value="<?php echo $contaCorrente;?>" disabled class="validate">
          <label for="contaCorrente">Conta Corrente</label>
        </div>
      </div>
      <h5 id="cabeca">Sócios, Diretores ou Representantes<i class="material-icons left">assignment_ind</i></h5>
      <div class="row" id="campo">
		<?php
	$sql22 = mysqli_query($mysqli, "SELECT socios.nomeSocio, socios.cpfSocio, socios.quantificacaoSocio, socios.telefoneSocio, socios.celularSocio, socios.emailSocio FROM socios JOIN login JOIN fornecedores WHERE login.usuario = '$userUpdate' AND login.senha = '$senhaUpdate' AND login.vinculo = fornecedores.id AND socios.vinculo = fornecedores.id");
	$socios = 1;
	$sql = "SELECT socios.nomeSocio, socios.cpfSocio, socios.quantificacaoSocio, socios.telefoneSocio, socios.celularSocio, socios.emailSocio FROM socios JOIN login JOIN fornecedores WHERE login.usuario = '$userUpdate' AND login.senha = '$senhaUpdate' AND login.vinculo = fornecedores.id AND socios.vinculo = fornecedores.id" or die("Erro ao selecionar");
	$query = $mysqli->query($sql);
	$row = $query->num_rows;
	echo "<input type='hidden' value='$row' id='qtdeSocios' name='qtdeSocios' /><script>socios=$row;</script>";
	$socios = 1;
	while($valor2 = mysqli_fetch_array($sql22)){
		$nomeSocio = $valor2[0];
		$cpfSocio = $valor2[1];
		$quantificacaoSocio = $valor2[2];
		$telefoneSocio = $valor2[3];
		$celularSocio = $valor2[4];
		$emailSocio = $valor2[5];
		echo "<div id='socioCp".$socios."'><h6 id='cabeca' class='right'>Número ".$socios."<i class='material-icons right'>people</i></h6><div class='input-field col s12'><input id='nomeSocio".$socios."' name='nomeSocio".$socios."' type='text' value='$nomeSocio' class='validate' disabled><label for='nomeSocio".$socios."'>Nome</label></div><div class='input-field col s6'><input id='cpfSocio".$socios."' name='cpfSocio".$socios."' type='number' value='$cpfSocio' class='validate' disabled><label for='cpfSocio".$socios."'>CPF</label></div><div class='input-field col s6'><input id='quantificacaoSocio".$socios."' value='$quantificacaoSocio' name='quantificacaoSocio".$socios."' type='text' class='validate' disabled><label for='quantificacaoSocio".$socios."'>Quantificação</label></div><div class='input-field col s6'><input id='telefoneSocios".$socios."' name='telefoneSocios".$socios."' value='$telefoneSocio' type='number' class='validate' disabled><label for='telefoneSocios".$socios."'>Telefone</label></div><div class='input-field col s6'><input id='celularSocio".$socios."' name='celularSocio".$socios."' type='number' value='$celularSocio' class='validate' disabled><label for='celularSocio".$socios."'>Celular</label></div><div class='input-field col s12'><input id='emailSocio' name='emailSocio".$socios."' type='text' value='$emailSocio' class='validate' disabled><label for='emailSocio".$socios."'>Email</label></div></div>";
		$socios++;
	}
?>
      </div>
	  <div id="op">
	  </div><br><br><br><br><br><br><br><br>
      <button class="green right btn waves-effect waves-light block" type="button" name="action" id="editButton" onclick="editar()">Editar
        <i class="material-icons right">edit</i>
      </button>
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