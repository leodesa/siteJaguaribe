<?php
	include("conexao.php");
	include('classes/CRUD.class.php');
	$CRUD = new CRUD;
	$CRUD->verificarNivel(2);
	if(isset($_GET['idF'])){
		$idF = $_GET['idF'];
		$userUpdate = $_COOKIE[md5('usuariofpslavras')];
		$senhaUpdate = $_COOKIE[md5('senhafpslavras')];
		$sql2 = mysqli_query($mysqli, "SELECT fornecedores.rasao, fornecedores.fantasia, fornecedores.cnpj, fornecedores.cgf, fornecedores.rua, fornecedores.numeroCasa,
		fornecedores.complemento, fornecedores.bairro, fornecedores.telefone, fornecedores.uf, fornecedores.cidade, fornecedores.nomeBanco, fornecedores.agencia, fornecedores.contaCorrente,
		fornecedores.id FROM fornecedores JOIN login WHERE fornecedores.id = $idF");
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
		echo "<input type='hidden' value='$idFornecedor' id='idF' />";
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
</head>
<body>
  <?php	include('include/menu.php'); ?>
<h1 id="titulo" class="center">Dados de Cadastro Fornecedores e Prestadores de Serviços</h1>
    <div class="container">
		
	  <div id="modal1" class="modal">
		<div class="modal-content" id="modal">
			<div id="campoAddAdm"></div>
		</div>
		<div class="modal-footer">
		  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
		  <button data-target="modal1" class="waves-effect waves-green btn-flat">Confirmar</button>
		</div>
	  </div>
	  
	  <div id="modal1" class="modal">
		<div class="modal-content" id="modal3">
			<div id="campoAddAdm2"></div>
		</div>
		<div class="modal-footer">
		  <button data-target="modal1" class="modal-close waves-effect waves-green btn-flat">Fechar</button>
		</div>
	  </div>
	  <?php
		$query3 = mysqli_query($mysqli, "SELECT * FROM recomendacoes WHERE recomendacoes.vinculo='$idFornecedor'");    
		$rows3 = $query3->num_rows;
		if($rows3>0){
			echo"<button data-target='modal1' class='modal-trigger waves-effect waves-red btn-flat left col s12 m6 l4' id='historico' onclick='historico();'>Histórico de recomendações<i class='material-icons right'>history</i></button><br><br><br>";
		}
		$query4 = mysqli_query($mysqli, "SELECT fornecedores.sit FROM fornecedores WHERE fornecedores.id='$idFornecedor'");
		while($res4 = mysqli_fetch_array($query4)){
			$situacao = $res4[0];
		}
		if($situacao==1){
			echo "<button data-target='modal1' class='modal-trigger waves-effect waves-green btn-flat right col s12 m6 l2' onclick='aprovarCad();' id='aprovarCad'>Aprovar<i class='material-icons right'>done</i></button>";
			echo"<button data-target='modal1' class='modal-trigger waves-effect waves-red btn-flat left col s12 m6 l2' id='reprovarCad' onclick='reprovarCad();'>Reprovar<i class='material-icons right'>close</i></button><br><br><br>";
		}else if($situacao==3){
			echo "<button data-target='modal1' class='modal-trigger waves-effect waves-green btn-flat right col s12 m6 l2' onclick='aprovarCad();' id='aprovarCad'>Aprovar<i class='material-icons right'>done</i></button>";
		}else if($situacao==2){
			echo"<button data-target='modal1' class='modal-trigger waves-effect waves-red btn-flat left col s12 m6 l2' id='reprovarCad' onclick='reprovarCad();'>Reprovar<i class='material-icons right'>close</i></button><br><br><br>";
		}
	  ?>
	  <br>
	  <br>
      <h5 id="cabeca">Pessoa Jurídica<i class="material-icons left">people</i></h5>
      <div class="row">
        <div class="input-field col s12">
          <input id="rasaoSocial" name="rasaoSocial" type="text" class="validate" value="<?php echo $rasao;?>" disabled required>
          <label for="rasaoSocial">Razão Social <v>*</v></label>
        </div>
        <div class="input-field col s12">
          <input id="fantasia" name="fantasia" type="text" value="<?php echo $fantasia;?>" disabled class="validate">
          <label for="fantasia">Nome de Fantasia</label>
        </div>
        <div class="input-field col s7">
          <input id="cnpj" name="cnpj" type="text" class="validate cnpj" value="<?php $str = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})([0-9]{2})/", "$1.$2.$3/$4-$5", $cnpj);echo $str;?>" disabled required>
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
          <input id="telefone" name="telefone" type="text" value="<?php echo $telefone;?>" disabled class="validate tel" required>
          <label for="telefone">Telefone <v>*</v></label>
        </div>
       <div class="input-field col s7">
			<select id="estados" name="uf" class='validate' disabled>
				<option value="" disabled selected>Selecione o Estado</option>
				<?php
					$qryLista2 = mysqli_query($mysqli, "SELECT estados.cod_estados FROM estados JOIN fornecedores WHERE fornecedores.id = '$idFornecedor' AND fornecedores.uf = estados.cod_estados");    
					while($ress2 = mysqli_fetch_array($qryLista2)){
						$cod_estado_sel = $ress2[0];
					}
					$qryLista = mysqli_query($mysqli, "SELECT estados.nome, cod_estados FROM estados");    
					while($ress = mysqli_fetch_array($qryLista)){
						if($ress[1]==$cod_estado_sel){
							echo "<option value='".$ress[1]."' selected>".$ress[0]."</option>";
						}else{
							echo "<option value='".$ress[1]."'>".$ress[0]."</option>";
						}
					}
				?>
			</select>
		</div>
        <div class="input-field col s5">
          <select id="cidades" name="cidade" class='selectsEC' disabled>
				<?php
					$qryLista3 = mysqli_query($mysqli, "SELECT cidades.cod_cidades FROM cidades JOIN fornecedores WHERE fornecedores.id = '$idFornecedor' AND fornecedores.cidade = cidades.cod_cidades");    
					while($ress3 = mysqli_fetch_array($qryLista3)){
						$cod_cidade_sel = $ress3[0];
					}
					$qryLista = mysqli_query($mysqli, "SELECT cidades.nome, cod_cidades FROM cidades WHERE estados_cod_estados='$cod_estado_sel'");    
					while($ress = mysqli_fetch_array($qryLista)){
						if($ress[1]==$cod_cidade_sel){
							echo "<option value='".$ress[1]."' selected>".$ress[0]."</option>";
						}else{
							echo "<option value='".$ress[1]."'>".$ress[0]."</option>";
						}
					}
				?>
			</select>
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
      <?php
	  $sql22 = mysqli_query($mysqli, "SELECT socios.nomeSocio, socios.cpfSocio, socios.quantificacaoSocio, socios.telefoneSocio, socios.celularSocio, socios.emailSocio FROM socios JOIN login JOIN fornecedores WHERE fornecedores.id = '$idF' AND login.vinculo='$idF' AND socios.vinculo = '$idF'");
		$row = $sql22->num_rows;
		$socios = 1;
	
	echo "<div class='row' id='campo'>";
	if($row>0){
	  ?>
      <h5 id="cabeca">Sócios, Diretores ou Representantes<i class="material-icons left">assignment_ind</i></h5>
	<?php
	while($valor2 = mysqli_fetch_array($sql22)){
		$nomeSocio = $valor2[0];
		$cpfSocio = $valor2[1];
		$quantificacaoSocio = $valor2[2];
		$telefoneSocio = $valor2[3];
		$celularSocio = $valor2[4];
		$emailSocio = $valor2[5];
		echo "<div id='socioCp".$socios."'><h6 id='cabeca' class='right'>Número ".$socios."<i class='material-icons right'>people</i></h6><div class='input-field col s12'><input id='nomeSocio".$socios."' name='nomeSocio".$socios."' type='text' value='$nomeSocio' class='validate' disabled><label for='nomeSocio".$socios."'>Nome</label></div><div class='input-field col s6'><input id='cpfSocio".$socios."' name='cpfSocio".$socios."' type='text' value='$cpfSocio' class='validate cpf' disabled><label for='cpfSocio".$socios."'>CPF</label></div><div class='input-field col s6'><input id='quantificacaoSocio".$socios."' value='$quantificacaoSocio' name='quantificacaoSocio".$socios."' type='text' class='validate' disabled><label for='quantificacaoSocio".$socios."'>Quantificação</label></div><div class='input-field col s6'><input id='telefoneSocios".$socios."' name='telefoneSocios".$socios."' value='$telefoneSocio' type='text' class='validate tel' disabled><label for='telefoneSocios".$socios."'>Telefone</label></div><div class='input-field col s6'><input id='celularSocio".$socios."' name='celularSocio".$socios."' type='text' value='$celularSocio' class='validate tel' disabled><label for='celularSocio".$socios."'>Celular</label></div><div class='input-field col s12'><input id='emailSocio' name='emailSocio".$socios."' type='text' value='$emailSocio' class='validate' disabled><label for='emailSocio".$socios."'>Email</label></div></div>";
		$socios++;
	}}
?>
      </div>
	  <div id="op">
	  </div>

		<?php
		$sql2 = mysqli_query($mysqli, "SELECT arquivos.nomeArquivo, fornecedores.rasao, fornecedores.cnpj, arquivos.tipoArquivo , arquivos.emissao , arquivos.validade
		FROM arquivos JOIN fornecedores WHERE arquivos.vinculo = '$idF' AND fornecedores.id = '$idF' ORDER BY arquivos.id DESC");
		$rows = $sql2->num_rows;
		echo "<h1 id='titulo' class='center'>Documentos enviados</h1>";
		if($rows>0){
			
			while($valor = mysqli_fetch_array($sql2)){
				echo "<ul class='collection col s12 m10 l8'>
    <li class='collection-item avatar'>
      <i class='small material-icons'>insert_drive_file</i>
	  <span class='title'><b>".$valor[0]."</b></span>
      <p>Tipo de arquivo: ".$CRUD->VerificarTipoArquivo($valor[3])."<br>";
        if(!empty($valor[4])){
		echo "Data de emissão: ".date('d/m/Y',strtotime($valor[4]))."<br>";
	  }if(!empty($valor[5])){
         echo "Data de validade: ".date('d/m/Y',strtotime($valor[5]))."<br>";
		 date_default_timezone_set('America/Fortaleza');
         if(strtotime($valor[5]) < strtotime(date('Y/m/d'))){
			echo"Situação: <i class='tiny material-icons'>access_time</i> Expirado<br>";
	  }}
      echo "</p><br>
	  <a class='waves-effect waves-light btn col s12 m6 l2' target='_blank' href='arquivos/".$valor[1]."-".$valor[2]."/".$valor[0]."'><i class='material-icons left'>visibility</i>Visualizar</a>
    </li>
  </ul>";
			}
		}else{
			echo "<ul class='collection col s12'>
				<br><h6 class='center'>Nenhum registro encontrado</h6><br>
			</ul>";
		}?>
  </div>
  
	<?php	include('include/rodape.php'); ?>

  <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/script.js"></script>
  </body>
</html>