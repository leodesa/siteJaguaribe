<?php
  include('classes/CRUD.class.php');
  include("conexao.php");
  $CRUD = new CRUD;
  $CRUD->verificarNivel(1);
  
  if(isset($_POST['exclusao'])){
	  $caminho = $_POST['exclusao'];
	unlink($caminho);
	$nomeAr = $_POST['nomeArquivo'];
	$sqlll = "DELETE FROM arquivos WHERE nomeArquivo = '$nomeAr'";
	if($mysqli->query($sqlll)){
		echo("<script type='text/javascript'> alert('$nomeAr excluido com sucesso!'); location.href='visualizarDoc.php';</script>");

	}else{
		echo("<script type='text/javascript'> alert('Houve um erro! tente novamente'); location.href='visualizarDoc.php';</script>");
	}
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
		$sql2 = mysqli_query($mysqli, "SELECT arquivos.nomeArquivo, fornecedores.rasao, fornecedores.cnpj, arquivos.tipoArquivo , arquivos.emissao , arquivos.validade
		FROM arquivos JOIN fornecedores WHERE arquivos.vinculo = '$id' AND arquivos.vinculo = fornecedores.id");
			while($valor = mysqli_fetch_array($sql2)){
				echo "<ul class='collection'>
    <li class='collection-item avatar'>
      <i class='small material-icons'>insert_drive_file</i>
	  <span class='title'><b>".$valor[0]."</b></span>
      <p>Tipo de arquivo: ".$CRUD->VerificarTipoArquivo($valor[3])."<br>
         Data de emissão: ".date('d/m/Y',strtotime($valor[4]))."<br>
         Data de validade: ".date('d/m/Y',strtotime($valor[5]))."<br>
      </p><br>
	  <a class='waves-effect waves-light btn' target='_blank' href='arquivos/".$valor[1]."-".$valor[2]."/".$valor[0]."'><i class='material-icons left'>visibility</i>Visualizar</a>
	  <a class='waves-effect waves-light btn' onclick='if(confirm(\"Você realmente deseja excluir este arquivo?\")){excluirArquivo(\"arquivos/".$valor[1]."-".$valor[2]."/".$valor[0]."\",\"".$valor[0]."\");}'><i class='material-icons left'>delete</i>Deletar</a>
    </li>
  </ul>";
			}
		?>
	</div>
	<form method="POST" action="visualizarDoc.php" id="formArquivos">
		<input type="hidden" value="" name="nomeArquivo" id="nomeArquivo" />
		<input type="hidden" value="" name="exclusao" id="exclusao" />
	</form>
  <?php	include('include/rodape.php'); ?>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/script.js"></script>

  </body>
</html>
