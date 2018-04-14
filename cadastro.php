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
      <a id="logo-container" href="login.html" class="brand-logo">Prefeitura Municipal de Lavras da Mangabeira</a>
    </div>
  </nav>
    <h1 id="titulo" class="center">Cadastro Fornecedores e Prestadores de Serviços</h1>
    <div class="cadastro row">
    <form name="cadastro" class="col s12" method="POST" action="#">
      <h5 id="cabeca">Login<i class="material-icons left">person</i></h5>
      <div class="row">
        <div class="input-field col s12">
          <input id="usuario1" name="usuario" type="text" class="validate" required>
          <label for="usuario1">Usuário <v>*</v></label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s7">
          <input id="senha" name="senha" type="password" class="validate" required>
          <label for="senha">Senha <v>*</v></label>
        </div>
        <div class="input-field col s5">
          <input id="confSenha" name="confSenha" type="password" class="validate" required>
          <label for="confSenha">Repetir Senha<v>*</v></label>
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
          <label for="baiiro">Bairro <v>*</v></label>
        </div>
        <div class="input-field col s5">
          <input id="telefone" name="telefone" type="number" class="validate" required>
          <label for="telefone">Telefone <v>*</v></label>
        </div>
        <div class="input-field col s7">
          <input id="cidade" name="cidade" type="text" class="validate" required>
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
      <div class="row">
        <div class="input-field col s12">
          <input id="nome" name="nome" type="text" class="validate">
          <label for="nome">Nome</label>
        </div>
        <div class="input-field col s6">
          <input id="cpf" name="cpf" type="number" class="validate">
          <label for="cpf">CPF</label>
        </div>
        <div class="input-field col s6">
          <input id="quantificacao" name="quantificacao" type="text" class="validate">
          <label for="quantificacao">Quantificação</label>
        </div>
        <div class="input-field col s6">
          <input id="telefoneSocios" name="telefoneSocios" type="number" class="validate">
          <label for="telefoneSocios">Telefone</label>
        </div>
        <div class="input-field col s6">
          <input id="celular" name="celular" type="number" class="validate">
          <label for="celular">Celular</label>
        </div>
        <div class="input-field col s12">
          <input id="email" name="email" type="text" class="validate">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="col s12"><i class="add material-icons" onclick="">add_circle</i></div>
      <button class="green right btn waves-effect waves-light" type="button" name="action" onclick="validar()">Cadastrar
        <i class="material-icons right">send</i>
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
