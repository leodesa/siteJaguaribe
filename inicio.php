<?php
	include("conexao.php");
	include('classes/CRUD.class.php');
	$CRUD = new CRUD;
	$CRUD->verificarNivel(1);
	$userUpdate = $_COOKIE[md5('usuariofpslavras')];
	$senhaUpdate = $_COOKIE[md5('senhafpslavras')];
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
	var socios = 0;
	var max = 10
	var controle = 0;
	function adicionarCampos(){
		if(socios==0){$('#campo').append("<h5 id='cabeca'>Sócios, Diretores ou Representantes<i class='material-icons left'>assignment_ind</i></h5>");}
		if(socios!=max){
			socios++;
			if(socios>=2 && controle==0){
				$('#op').append("<div class='green right btn waves-effect waves-light center block' id='closeSo' onclick='removeCampo(\"socioCp\")'>Remover<i class='material-icons right closeSocios' id='closeSo'>close</i></div>");
				controle=1;
			}
			$('#campo').append("<div id='socioCp"+socios+"'><h6 id='cabeca' class='right'>Número "+socios+"<i class='material-icons right'>people</i></h6><div class='input-field col s12'><input id='nomeSocio"+socios+"' name='nomeSocio"+socios+"' type='text' class='validate'><label for='nomeSocio"+socios+"'>Nome</label></div><div class='input-field col s6'><input id='cpfSocio"+socios+"' name='cpfSocio"+socios+"' type='text' class='validate cpf'><label for='cpfSocio"+socios+"'>CPF</label></div><div class='input-field col s6'><input id='quantificacaoSocio"+socios+"' name='quantificacaoSocio"+socios+"' type='text' class='validate'><label for='quantificacaoSocio"+socios+"'>Quantificação</label></div><div class='input-field col s6'><input id='telefoneSocios"+socios+"' name='telefoneSocios"+socios+"' type='text' class='validate tel'><label for='telefoneSocios"+socios+"'>Telefone</label></div><div class='input-field col s6'><input id='celularSocio"+socios+"' name='celularSocio"+socios+"'type='text' class='validate tel'><label for='celularSocio"+socios+"'>Celular</label></div><div class='input-field col s12'><input id='emailSocio"+socios+"' name='emailSocio"+socios+"' type='text' class='validate'><label for='emailSocio"+socios+"'>Email</label></div></div>");
			$('#qtdeSocios').val(parseInt($('#qtdeSocios').val())+1);
			$('.cpf').trigger('contentChanged');
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
  <?php	include('include/menu.php'); 
		$sql2 = mysqli_query($mysqli, "SELECT fornecedores.rasao, fornecedores.fantasia, fornecedores.cnpj, fornecedores.telefone, fornecedores.cidade, fornecedores.uf, fornecedores.sit, fornecedores.id 
		FROM fornecedores WHERE fornecedores.id = '$idFornecedor'");
		$row = $sql2->num_rows;
		if($row>0){
			while($valor = mysqli_fetch_array($sql2)){
				//Aguardando análise
				if($valor[6]==1){
					$sit = "access_time";
					$sit2 = "Em análise";
					$sitNum = $valor[6];
				}else
				//Aprovado
				if($valor[6]==2){
					$sit = "done";
					$sit2 = "Aprovado na análise";
					$sitNum = $valor[6];
				}else{
					$sit = "close";
					$sit2 = "Reprovado na análise";
					$sitNum = $valor[6];
				}
			}
		}
		$sql3 = mysqli_query($mysqli, "SELECT arquivos.id FROM arquivos WHERE arquivos.vinculo='$idFornecedor'");
		$row2 = $sql3->num_rows;
		if($row2<=0){
			$msgT = "Insira arquivos para análise";
		}else{
			$sql4 = mysqli_query($mysqli, "SELECT recomendacoes.msg FROM recomendacoes WHERE recomendacoes.vinculo='$idFornecedor' ORDER BY recomendacoes.data DESC LIMIT 1");
			$row4 = $sql4->num_rows;
			if($row4<=0 OR $sitNum==2){
				$msgT = "Nenhuma recomendação";
			}else{
				while($valor4 = mysqli_fetch_array($sql4)){
					$msgT = $valor4[0];
				}
			}
		}
  ?>
<h1 id="titulo" class="center">Dados de Cadastro Fornecedores e Prestadores de Serviços</h1>
    <div class="cadastro row">
	<div id="modal1" class="modal">
		<div class="modal-content" id="modal">
			<div id="campoAddAdm"></div>
		</div>
		<div class="modal-footer">
		  <button data-target="modal1" class="modal-close waves-effect waves-red btn-flat">Fechar</button>
		</div>
	  </div>
	 <table>
        <thead>
          <tr>
              <th>Situação</th>
              <th>Recomendações</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td><?php echo "<i class='tiny material-icons'>".$sit."</i> $sit2";?></td>
            <td><?php echo $msgT;?></td>
          </tr>
        </tbody>
      </table>
	  <?php
		$sql43 = mysqli_query($mysqli, "SELECT recomendacoes.msg FROM recomendacoes WHERE recomendacoes.vinculo='$idFornecedor'");
		$row43 = $sql43->num_rows;
		if($row43>0){
	  ?>
	  <button data-target="modal1" class="modal-trigger waves-effect waves-red btn-flat right" id='historico' onclick="historico();">Histórico de recomendações<i class='material-icons right'>history</i></button><br><br><br>
	  <?php
		}
	  ?>
	  <br>
	  <br>
	  <br>
    <form name="cadastro" id="cadastro" class="col s12" method="POST" action="DAO.php">
      <h5 id="cabeca">Login<i class="material-icons left">person</i></h5>
	  <input type="hidden" id="idF" value="<?php echo $idFornecedor;?>" name="atualizar" />
      <div class="row">
        <div class="input-field col s12">
          <input id="usuarioCad" name="usuarioCad" type="text" class="validate" required disabled>
          <label for="usuarioCad">Usuário <v>*</v></label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s7">
          <input id="senha" type="password" name="senha" class="validate" required disabled>
          <label for="senha">Senha <v>*</v></label>
        </div>
        <div class="input-field col s5">
          <input id="senhaConf" name="senhaConf" type="password" class="validate" required disabled>
          <label for="senhaConf">Repetir Senha<v>*</v></label>
        </div>
      </div>
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
			<select id="estados" name="uf" class='validate' disabled required>
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
			<label for="estados">Estado <v>*</v></label>
		</div>
        <div class="input-field col s5">
          <select id="cidades" name="cidade" class='selectsEC' disabled required>
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
	  $sql = "SELECT socios.nomeSocio, socios.cpfSocio, socios.quantificacaoSocio, socios.telefoneSocio, socios.celularSocio, socios.emailSocio FROM socios JOIN login JOIN fornecedores WHERE login.usuario = '$userUpdate' AND login.senha = '$senhaUpdate' AND login.vinculo = fornecedores.id AND socios.vinculo = fornecedores.id" or die("Erro ao selecionar");
	$query = $mysqli->query($sql);
	$row = $query->num_rows;
	  $sql22 = mysqli_query($mysqli, "SELECT socios.nomeSocio, socios.cpfSocio, socios.quantificacaoSocio, socios.telefoneSocio, socios.celularSocio, socios.emailSocio FROM socios JOIN login JOIN fornecedores WHERE login.usuario = '$userUpdate' AND login.senha = '$senhaUpdate' AND login.vinculo = fornecedores.id AND socios.vinculo = fornecedores.id");
	$socios = 1;
	
	echo "<div class='row' id='campo'>";
	echo "<input type='hidden' value='$row' id='qtdeSocios' name='qtdeSocios' /><script>socios=$row;</script>";
	if($row>0){
	  ?>
      <h5 id="cabeca">Sócios, Diretores ou Representantes<i class="material-icons left">assignment_ind</i></h5>
	<?php
	$socios = 1;
	while($valor2 = mysqli_fetch_array($sql22)){
		$nomeSocio = $valor2[0];
		$cpfSocio = $valor2[1];
		$quantificacaoSocio = $valor2[2];
		$telefoneSocio = $valor2[3];
		$celularSocio = $valor2[4];
		$emailSocio = $valor2[5];
		echo "<div id='socioCp".$socios."'><h6 id='cabeca' class='right'>Número ".$socios."<i class='material-icons right'>people</i></h6><div class='input-field col s12'><input id='nomeSocio".$socios."' name='nomeSocio".$socios."' type='text' value='$nomeSocio' class='validate' disabled><label for='nomeSocio".$socios."'>Nome</label></div><div class='input-field col s6'><input id='cpfSocio".$socios."' name='cpfSocio".$socios."' type='text' value='$cpfSocio' class='validate cpf' disabled><label for='cpfSocio".$socios."'>CPF</label></div><div class='input-field col s6'><input id='quantificacaoSocio".$socios."' value='$quantificacaoSocio' name='quantificacaoSocio".$socios."' type='text' class='validate' disabled><label for='quantificacaoSocio".$socios."'>Quantificação</label></div><div class='input-field col s6'><input id='telefoneSocios".$socios."' name='telefoneSocios".$socios."' value='$telefoneSocio' type='text' class='validate tel' disabled><label for='telefoneSocios".$socios."'>Telefone</label></div><div class='input-field col s6'><input id='celularSocio".$socios."' name='celularSocio".$socios."' type='text' value='$celularSocio' class='validate tel' disabled><label for='celularSocio".$socios."'>Celular</label></div><div class='input-field col s12'><input name='emailSocio".$socios."' type='text' value='$emailSocio' id='emailSocio".$socios."' class='validate' disabled><label for='emailSocio".$socios."'>Email</label></div></div>";
		$socios++;
	}}
?>
      </div>
	  <div id="op">
	  </div><br><br><br><br><br><br><br><br>
      <button class="green right btn waves-effect waves-light block" type="button" name="action" id="editButton" onclick="editar()">Editar
        <i class="material-icons right">edit</i>
      </button>
    </form>
  </div>
  
	<?php	include('include/rodape.php'); ?>

  <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/jquery.maskedinput.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/script.js"></script>

  </body>
</html>