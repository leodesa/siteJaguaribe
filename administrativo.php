<?php
	include('classes/CRUD.class.php');
	include("conexao.php");
	$CRUD = new CRUD;
	$CRUD->verificarNivel(2);
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
</head>
<body>
  <?php	include('include/menu.php'); ?>
<h1 id="titulo" class="center">Últimos Cadastros de Fornecedores e Prestadores de Serviços</h1>
     <div id="documentos">
		<?php
		$sql2 = mysqli_query($mysqli, "SELECT fornecedores.rasao, fornecedores.fantasia, fornecedores.cnpj, fornecedores.telefone, fornecedores.cidade, fornecedores.uf, fornecedores.sit, fornecedores.id 
		FROM fornecedores LIMIT 10");
			while($valor = mysqli_fetch_array($sql2)){
				//Aguardando análise
				if($valor[6]==1){
					$sit = "access_time";
					$sit2 = "Em análise";
				}else
				//Aprovado
				if($valor[6]==2){
					$sit = "done";
					$sit2 = "Aprovado na análise";
				}else{
					$sit = "close";
					$sit2 = "Reprovado na análise";
				}
				echo "<ul class='collapsible' data-collapsible='accordion'>
					  <li>
						<div class='collapsible-header' style='outline:none!important;'>
						  <i class='material-icons'>folder_open</i>
						  $valor[0]</div>
						<div class='collapsible-body'><p>
						<b>Fantasia:</b> $valor[1]<br>
						<b>CNPJ:</b> $valor[2]<br>
						<b>Telefone:</b> $valor[3]<br>
						<b>Cidade:</b> $valor[4]<br>
						<b>UF:</b> $valor[5]<br>
						<b>Situação:</b> <i class='tiny material-icons'>".$sit."</i> $sit2<br><br><br>
						<a class='waves-effect waves-light btn' onclick='visualizarFicha($valor[7])'><i class='material-icons left'>visibility</i>Visualizar</a>
						</p></div>
					  </li>
					</ul>";
			}
		?>
	</div>
  
	<?php	include('include/rodape.php'); ?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/script.js"></script>

  </body>
</html>