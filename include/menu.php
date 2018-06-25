<?php
	include('conexao.php');
	$usuarioCookie = $_COOKIE[md5('usuariofpslavras')];
	$senhaCookie = $_COOKIE[md5('senhafpslavras')];
	$sql22 = mysqli_query($mysqli, "SELECT login.nivel FROM login WHERE usuario = '$usuarioCookie' AND senha = '$senhaCookie'");
	while($valor = mysqli_fetch_array($sql22)){
		$nivel = $valor[0];
	}
	if($nivel == 1){
?>

<nav class="green lighten-1" role="navigation" style="position:fixed;top:0;left:0;z-index:99;">
		<ul id="dropdown1" class="dropdown-content">
		  <li><a href="menuUsuario.php">Inserir</a></li>
 	 	  <li><a href="visualizarDoc.php">Visualizar</a></li>
        </ul>
		  <div class="nav-wrapper container">
			  <img id="logo" src="img/logo.png" class="left">
			  <a id="logo-container" class="brand-logo">Lavras da Mangabeira</a>
			  <ul class="right hide-on-med-and-down">
				<li><a href="inicio.php">Inicio</a></li>
          	  	<li><a class="dropdown-trigger" href="#!" data-target="dropdown1" style="outline:none;">Documentos<i class="material-icons right">arrow_drop_down</i></a></li>
          		<li><a href="logout.php">Sair</a></li>
          	  </ul> 	
    	  </div>
  	  
<div class="navbar-fixed">
  
  <a href="#" data-target="slide-out" class="sidenav-trigger" style="position: fixed!important; top:1%!important;left:1%!important;"><i class="medium material-icons">menu</i></a>
  </div>
  </nav>
  <ul id="slide-out" class="sidenav">
    <li><div class="user-view">
        <img src="img/logo.png">
    </div></li>
    <li><a href="inicio.php">Inicio</a></li>
	<ul class="collapsible">
    <li>
      <div class="collapsible-header">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Documentos<i class="material-icons">arrow_drop_down</i></div>
      <div class="collapsible-body" onclick="location.href='menuUsuario.php'" style="cursor: pointer;"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inserir</span></div>
      <div class="collapsible-body" onclick="location.href='visualizarDoc.php'" style="cursor: pointer;"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Visualizar</span></div>
    </li>
  </ul>
    <li><a href="logout.php">Sair</a></li>
  </ul>
<?php
	}else if($nivel==2){
?>
	<nav class="green lighten-1" role="navigation" style="position:fixed;top:0;left:0;z-index:99;">
		  <div class="nav-wrapper container">
			  <img id="logo" src="img/logo.png" class="left">
			  <a id="logo-container" class="brand-logo">Lavras da Mangabeira</a>
			  <ul class="right hide-on-med-and-down">
				<li><a href="administrativo.php">Inicio</a></li>
				<li><a href="">Notificações 
				<?php
					$sql3 = mysqli_query($mysqli, "SELECT COUNT(sit) FROM fornecedores WHERE sit = '1'");
						while($valor3 = mysqli_fetch_array($sql3)){
							$notifications = $valor3[0];
						}
						if($notifications>0){
							echo "<span class='new badge'>$notifications</span>";
						}
				?>
				</a></li>
          		<li><a href="logout.php">Sair</a></li>
          	  </ul> 	
    	  </div>
  	  
<div class="navbar-fixed">
  <a href="#" data-target="slide-out" class="sidenav-trigger" style="position: fixed!important; top:1%!important;left:1%!important;"><i class="medium material-icons">menu</i></a>
  </div>
  </nav>
  <ul id="slide-out" class="sidenav">
    <li><div class="user-view">
        <img src="img/logo.png">
    </div></li>
    <li><a href="administrativo.php">Inicio</a></li>
	<li><a href="">Notificações <?php if($notifications>0){
							echo "<span class='new badge'>$notifications</span>";
						}?></a></li>
    <li><a href="logout.php">Sair</a></li>
  </ul>
<?php
	}
?>