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
<script>
	var socios = 1;
	var max = 10
	function adicionarCampos(){
		if(socios!=max){
			socios++;
			if(socios==2){
				$('#op').append("<div class='green right btn waves-effect waves-light center block' id='closeSo' onclick='removeCampo(\"socioCp\")'>Remover<i class='material-icons right closeSocios' id='closeSo'>close</i></div>");
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
			$('#op').append("<div class='green left btn waves-effect waves-light center block' id='buttonMais' onclick='adicionarCampos()'>Adicionar<i class='add material-icons center'>add_circle</i></div> ");
		}
		socios--;
		$('#qtdeSocios').val(parseInt($('#qtdeSocios').val())-1);
		if(socios<2){
			$('#closeSo').remove();
		}
	}
</script>
</head>
<body>
  <nav class="green lighten-1" role="navigation">
    <div class="nav-wrapper container">
      <img id="logo" src="img/logo.png">
      <a id="logo-container" href="index.php" class="brand-logo">Prefeitura Municipal de Lavras da Mangabeira</a>
    </div>
  </nav>
    <h1 id="titulo" class="center">Cadastro Fornecedores e Prestadores de Serviços</h1>
    <div class="cadastro row">
    <form name="cadastro" id="cadastro" class="col s12" method="POST" action="DAO.php">
      <h5 id="cabeca">Login<i class="material-icons left">person</i></h5>
	  <input type="hidden" value="1" name="cadastroForm" />
      <div class="row">
        <div class="input-field col s12">
          <input id="usuarioCad" name="usuarioCad" type="text" class="validate" required>
          <label for="usuarioCad">Usuário <v>*</v></label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s7">
          <input id="senha" type="password" name="senha" class="validate" required>
          <label for="pass">Senha <v>*</v></label>
        </div>
        <div class="input-field col s5">
          <input id="senhaConf" name="senhaConf"type="password" class="validate" required>
          <label for="passwordConf">Repetir Senha<v>*</v></label>
        </div>
      </div>
      <h5 id="cabeca">Pessoa Juridíca<i class="material-icons left">people</i></h5>
      <div class="row">
        <div class="input-field col s12">
          <input id="rasaoSocial" name="rasaoSocial" type="text" class="validate" required>
          <label for="rasaoSocial">Rasão Social <v>*</v></label>
        </div>
        <div class="input-field col s12">
          <input id="fantasia" name="fantasia" type="text" class="validate">
          <label for="fantasia">Nome de Fantasia</label>
        </div>
        <div class="input-field col s7">
          <input id="cnpj" name="cnpj" type="number" class="validate" required>
          <label for="cnpj">CNPJ.n° <v>*</v></label>
        </div>
        <div class="input-field col s5">
          <input id="cgf" name="cgf" type="text" class="validate">
          <label for="cgf">C.G.F.</label>
        </div>
        <div class="input-field col s10">
          <input id="rua" name="rua" type="text" class="validate" required>
          <label for="rua">Rua <v>*</v></label>
        </div>
        <div class="input-field col s2">
          <input id="numeroCasa" name="numeroCasa" type="number" class="validate" required>
          <label for="numeroCasa">N° <v>*</v></label>
        </div>
        <div class="input-field col s12">
          <input id="complemento" name="complemento" type="text" class="validate">
          <label for="complemento">Complemento</label>
        </div>
        <div class="input-field col s7">
          <input id="bairro" name="bairro" type="text" class="validate" required>
          <label for="bairro">Bairro <v>*</v></label>
        </div>
        <div class="input-field col s5">
          <input id="telefone" name="telefone" type="number" class="validate" required>
          <label for="telefone">Telefone <v>*</v></label>
        </div>
        <div class="input-field col s7">
          <input id="cidade" name="cidade"type="text" class="validate" required>
          <label for="cidade">Cidade <v>*</v></label>
        </div>
        <div class="input-field col s5">
          <input id="uf" name="uf" type="text" class="validate" required>
          <label for="uf">UF <v>*</v></label>
        </div>
      </div>
      <h5 id="cabeca">Informações Bancárias<i class="material-icons left">attach_money
</i></h5>
      <div class="row">
        <div class="input-field col s12">
          <input id="nomeBanco" name="nomeBanco" type="text" class="validate">
          <label for="nomeBanco">Nome do Banco</label>
        </div>
        <div class="input-field col s12">
          <input id="agencia" name="agencia" type="number" class="validate">
          <label for="agencia">Agencia</label>
        </div>
        <div class="input-field col s12">
          <input id="contaCorrente" name="contaCorrente" type="text" class="validate">
          <label for="contaCorrente">Conta Corrente</label>
        </div>
      </div>
      <h5 id="cabeca">Sócios, Diretores ou Representantes<i class="material-icons left">assignment_ind</i></h5>
      <div class="row" id="campo">
	  <input type="hidden" value="1" id="qtdeSocios" name="qtdeSocios"/>
	  <h6 id="cabeca" class="right">Número 1<i class="material-icons right">people</i></h6>
        <div class="input-field col s12">
          <input id="nomeSocio1" name="nomeSocio1" type="text" class="validate">
          <label for="nomeSocio1">Nome</label>
        </div>
        <div class="input-field col s6">
          <input id="cpfSocio1" name="cpfSocio1" type="number" class="validate">
          <label for="cpfSocio1">CPF</label>
        </div>
        <div class="input-field col s6">
          <input id="quantificacaoSocio1" name="quantificacaoSocio1" type="text" class="validate">
          <label for="quantificacaoSocio1">Quantificação</label>
        </div>
        <div class="input-field col s6">
          <input id="telefoneSocios1" name="telefoneSocios1" type="number" class="validate">
          <label for="telefoneSocios1">Telefone</label>
        </div>
        <div class="input-field col s6">
          <input id="celularSocio1" name="celularSocio1" type="number" class="validate">
          <label for="celularSocio1">Celular</label>
        </div>
        <div class="input-field col s12">
          <input id="emailSocio1" name="emailSocio1" type="text" class="validate">
          <label for="emailSocio1">Email</label>
        </div>
      </div>
	  <div id="op">
		<div class="green left btn waves-effect waves-light center block" id="buttonMais" onclick="adicionarCampos()">Adicionar<i class="add material-icons center">add_circle</i></div> 
	  </div><br><br><br><br><br><br><br><br>
      <button class="green right btn waves-effect waves-light block" type="button" name="action" onclick="validar()">Cadastrar
        <i class="material-icons right">send</i>
      </button>
    </form>
  </div>
  <?php	include('include/rodape.php'); ?>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/script.js"></script>

  </body>
</html>
