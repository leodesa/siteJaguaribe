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
	 <form action="administrativo.php" method="POST">
	<div class="row">
		<div class="col s4">
			<select id="situacao" name='sit'>
				<option disabled selected>Situação</option>
				<option value="1">Em análise</option>
				<option value="2">Aprovado</option>
				<option value="3">Reprovado</option>
			</select>
		</div>
		<div class="col s4">
			<select id="estados" name="estados">
				<option value="" disabled selected>Selecione um estado</option>
				<?php
					$qryLista = mysqli_query($mysqli, "SELECT estados.nome, cod_estados FROM estados");    
					while($ress = mysqli_fetch_array($qryLista)){
						echo "<option value='".$ress[1]."'>".$ress[0]."</option>";
					}
				?>
			</select>
		</div>
		<div class="col s4">
			<select id="cidades" name="cidades">
				<option value="" disabled selected>Selecione uma cidade</option>
			</select>
		</div>
		<div class="col s8 nav-wrapper">
			<div class="input-field">
			  <input id="search" type="search" name='busca' placeholder="Pesquisar fornecedores">
			  <label class="label-icon" for="search"><i class="material-icons">search</i></label>
			  <i class="material-icons">close</i>
			</div>	   
		</div>
		<div class="input-field col s4">
			<button class="btn waves-effect waves-light" type="submit" name="action">Filtrar
				<i class="material-icons right">filter_list</i>
			  </button>
		</div>
	</div>
	</form>
		<?php
		if(isset($_POST['busca'])){
			$cont = 1;
			$busca = $_POST['busca'];
			$sql = "SELECT fornecedores.rasao, fornecedores.fantasia, fornecedores.cnpj, fornecedores.telefone, fornecedores.cidade, fornecedores.uf, fornecedores.sit, fornecedores.id 
			FROM fornecedores";
			if(!empty($_POST['estados']) and isset($_POST['estados'])){
				$uf = $_POST['estados'];
				if($cont==1){
					$sql .= " WHERE fornecedores.uf = '$uf'";
					$cont = 2;
				}else{
					$sql .= "AND fornecedores.uf = '$uf'";
				}
			}
			if(!empty($_POST['cidades']) and isset($_POST['cidades'])){
				$cidades = $_POST['cidades'];
				if($cont==1){
					$sql .= " WHERE fornecedores.cidade = '$cidades'";
					$cont = 2;
				}else{
					$sql .= "AND fornecedores.cidade = '$cidades'";
				}
			}
			if(isset($_POST['sit']) and !empty($_POST['sit'])){
				$sit = $_POST['sit'];
				if($cont==1){
					$sql .= " WHERE fornecedores.sit = '$sit'";
					$cont = 2;
				}else{
					$sql .= " AND fornecedores.sit = '$sit'";
				}
				$sql .= "";
			}
			if(!empty($_POST['busca']) and isset($_POST['busca'])){
				if($cont==1){
					$sql .= " WHERE (fornecedores.rasao like '%$busca%' OR fornecedores.fantasia like '%$busca%')";
					$cont = 2;
				}else{
					$sql .= "AND (fornecedores.rasao like '%$busca%' OR fornecedores.fantasia like '%$busca%')";
				}
			}
			$sql .= " LIMIT 10";
			///if(isset($_POST['estados']) and !empty($_POST['estados'])){$sit = $_POST['situacao'];}
			$sql2 = mysqli_query($mysqli, $sql);
			$row = $sql2->num_rows;
		echo "<ul class='collapsible'>";
		if($row>0){
			while($valor = mysqli_fetch_array($sql2)){
				//Aguardando análise
				if($valor[6]==1){
					$sit3 = "access_time";
					$sit2 = "Em análise";
				}else
				//Aprovado
				if($valor[6]==2){
					$sit3 = "done";
					$sit2 = "Aprovado na análise";
				}else{
					$sit3 = "close";
					$sit2 = "Reprovado na análise";
				}
				$sqlEstado = mysqli_query($mysqli, "SELECT estados.nome FROM estados WHERE estados.cod_estados = '$valor[5]'");
				while($valor2 = mysqli_fetch_array($sqlEstado)){
					$uff = $valor2[0];
				}
				$sqlCidade = mysqli_query($mysqli, "SELECT cidades.nome FROM cidades WHERE cidades.cod_cidades = '$valor[4]'");
				while($valor3 = mysqli_fetch_array($sqlCidade)){
					$cidadee = $valor3[0];
				}
				echo "<li>
						  <div class='collapsible-header' style='outline:none;'><i class='material-icons'>folder_open</i>$valor[0]</div>
						  <div class='collapsible-body'><span>
							<b>CNPJ:</b> $valor[2]<br>
							<b>Telefone:</b> $valor[3]<br>
							<b>Cidade:</b> $cidadee<br>
							<b>UF:</b> $uff<br>
							<b>Situação:</b> <i class='tiny material-icons'>".$sit3."</i> $sit2<br><br><br>
							<a class='waves-effect waves-light btn' target='_blank' href='visualizarAdm.php?idF=$valor[7]'><i class='material-icons left'>visibility</i>Visualizar</a>
						  </span></div>
						</li>";
			}
			
		}
		else{
			echo "<br><h6 class='center'>Nenhum registro encontrado</h6><br>";
		}
		echo "</ul>";
		}
		else{
		$sql2 = mysqli_query($mysqli, "SELECT fornecedores.rasao, fornecedores.fantasia, fornecedores.cnpj, fornecedores.telefone, fornecedores.cidade, fornecedores.uf, fornecedores.sit, fornecedores.id 
		FROM fornecedores LIMIT 10");
		$row = $sql2->num_rows;
		echo "<ul class='collapsible'>";
		if($row>0){
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
				$sqlEstado = mysqli_query($mysqli, "SELECT estados.nome FROM estados WHERE estados.cod_estados = '$valor[5]'");
				while($valor2 = mysqli_fetch_array($sqlEstado)){
					$uff = $valor2[0];
				}
				$sqlCidade = mysqli_query($mysqli, "SELECT cidades.nome FROM cidades WHERE cidades.cod_cidades = '$valor[4]'");
				while($valor3 = mysqli_fetch_array($sqlCidade)){
					$cidadee = $valor3[0];
				}
				$str = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})([0-9]{2})/", "$1.$2.$3/$4-$5", $valor[2]);
				echo "<li>
						  <div class='collapsible-header' style='outline:none;'><i class='material-icons'>folder_open</i>$valor[0]</div>
						  <div class='collapsible-body'><span>
							<b>CNPJ:</b> $str<br>
							<b>Telefone:</b> $valor[3]<br>
							<b>Cidade:</b> $cidadee<br>
							<b>UF:</b> $uff<br>
							<b>Situação:</b> <i class='tiny material-icons'>".$sit."</i> $sit2<br><br><br>
							<a class='waves-effect waves-light btn' target='_blank' href='visualizarAdm.php?idF=$valor[7]'><i class='material-icons left'>visibility</i>Visualizar</a>
						  </span></div>
						</li>";
			}
		}else{echo"<br><h6 class='center'>Nenhum registro encontrado</h6><br>";}
			echo "</ul>";
		}
		?>
	</div>
  
	<?php	include('include/rodape.php'); ?>

  <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/script.js"></script>
  </body>
</html>