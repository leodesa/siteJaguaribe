<?php
	include('classes/CRUD.class.php');
	if(isset($_POST['usuario'])){
		$usuario = md5($_POST['usuario']);
		$pass = md5($_POST['senha']);
		$CRUD = new CRUD;
		$CRUD->verificarLogin($usuario,$pass);
	}
	if(isset($_POST['cadastroForm'])){
		include("conexao.php");
		$usuario = md5($_POST['usuarioCad']);
		$pass = md5($_POST['senha']);
		$sql = "SELECT * FROM login WHERE usuario = '$usuario' limit 1" or die("erro ao selecionar");
        $query = $mysqli->query($sql);
		$linhas = $query->num_rows;
		if ($linhas>0){
			echo"<script>alert('Nome de usuário já cadastrado!');</script>";
			header("Location:cadastro.php");
            die();
		}
		$rasao = $_POST['rasaoSocial'];
		$fantasia = $_POST['fantasia'];
		$cnpj = $_POST['cnpj'];
		$cgf = $_POST['cgf'];
		$rua = $_POST['rua'];
		$numeroCasa = $_POST['numeroCasa'];
		$complemento = $_POST['complemento'];
		$bairro = $_POST['bairro'];
		$telefone = $_POST['telefone'];
		$uf = $_POST['uf'];
		$cidade = $_POST['cidade'];
		$nomeBanco = $_POST['nomeBanco'];
		$agencia = $_POST['agencia'];
		$contaCorrente = $_POST['contaCorrente'];
		$qtdeSocios = (int)$_POST['qtdeSocios'];
		$socio = array("","","","","","","","","","");
		for($i = 1; $i <= $qtdeSocios; $i++){
			$nomeSocio = $_POST['nomeSocio'.$i];
			$cpfSocio = $_POST['cpfSocio'.$i];
			$quantificacaoSocio = $_POST['quantificacaoSocio'.$i];
			$telefoneSocios = $_POST['telefoneSocios'.$i];
			$celularSocio = $_POST['celularSocio'.$i];
			$emailSocio = $_POST['emailSocio'.$i];
			$dados = array('nome' =>"$nomeSocio", 'cpf'=>"$cpfSocio", 'quantificacaoSocio'=>"$quantificacaoSocio", 'telefoneSocios'=>"$telefoneSocios", 'celularSocio'=>"$celularSocio", 'emailSocio'=>"$emailSocio");
			for($k = 0; $k < $qtdeSocios; $k++){
				if($socio[$k]==""){
					$socio[$k] = (object)$dados;
					break;
				}
			}
		}
		$CRUD = new CRUD;
		$CRUD->cadastarFornecedor($usuario,$pass,$rasao,$fantasia,$cnpj,$cgf,$rua,$numeroCasa,$complemento,$bairro,$telefone,$uf,$cidade,$nomeBanco,$agencia,$contaCorrente,$socio,$qtdeSocios);
	}
	
	//Atualizar Cadastro
	if(isset($_POST['atualizar'])){
		include("conexao.php");
		if(!empty($_POST['usuarioCad'])){
			$userUp = md5($_POST['usuarioCad']);
			$senhaa = md5($_POST['senha']);
			$sql = "SELECT * FROM login WHERE usuario = '$userUp' limit 1" or die("erro ao selecionar");
			$query = $mysqli->query($sql);
			$linhas = $query->num_rows;
			if ($linhas>0){
				echo"<script>alert('Nome de usuário já cadastrado!');</script>";
				header("Location:inicio.php");
				die();
			}
		}else{
			$userUp = "";
			$senhaa = "";
		}
		$id = $_POST['atualizar'];
		$rasao = $_POST['rasaoSocial'];
		$fantasia = $_POST['fantasia'];
		$cnpj = $_POST['cnpj'];
		$cgf = $_POST['cgf'];
		$rua = $_POST['rua'];
		$numeroCasa = $_POST['numeroCasa'];
		$complemento = $_POST['complemento'];
		$bairro = $_POST['bairro'];
		$telefone = $_POST['telefone'];
		$uf = $_POST['uf'];
		$cidade = $_POST['cidade'];
		$nomeBanco = $_POST['nomeBanco'];
		$agencia = $_POST['agencia'];
		$contaCorrente = $_POST['contaCorrente'];
		$qtdeSocios = (int)$_POST['qtdeSocios'];
		$socio = array("","","","","","","","","","");
		for($i = 1; $i <= $qtdeSocios; $i++){
			$nomeSocio = $_POST['nomeSocio'.$i];
			$cpfSocio = $_POST['cpfSocio'.$i];
			$quantificacaoSocio = $_POST['quantificacaoSocio'.$i];
			$telefoneSocios = $_POST['telefoneSocios'.$i];
			$celularSocio = $_POST['celularSocio'.$i];
			$emailSocio = $_POST['emailSocio'.$i];
			$dados = array('nome' =>"$nomeSocio", 'cpf'=>"$cpfSocio", 'quantificacaoSocio'=>"$quantificacaoSocio", 'telefoneSocios'=>"$telefoneSocios", 'celularSocio'=>"$celularSocio", 'emailSocio'=>"$emailSocio");
			for($k = 0; $k < $qtdeSocios; $k++){
				if($socio[$k]==""){
					$socio[$k] = (object)$dados;
					break;
				}
			}
		}
		$CRUD = new CRUD;
		$CRUD->atualizarFornecedor($userUp,$senhaa,$rasao,$fantasia,$cnpj,$cgf,$rua,$numeroCasa,$complemento,$bairro,$telefone,$uf,$cidade,$nomeBanco,$agencia,$contaCorrente,$socio,$qtdeSocios,$id);
	}
	if(isset($_POST['idPasta'])){
		include("conexao.php");
		$idPasta = $_POST['idPasta'];
		$sql2 = mysqli_query($mysqli, "SELECT fornecedores.rasao, fornecedores.cnpj FROM fornecedores WHERE id = '$idPasta'");
			while($valor = mysqli_fetch_array($sql2)){
				$rasao = $valor[0];
				$cnpj = $valor[1];
			}
			$_UP['pasta'] = "arquivos/".$rasao."-".$cnpj."/";
		for ($i=1; $i<13; $i++){
			if(is_uploaded_file($_FILES['arquivo'.$i]['tmp_name'])){
				$arquivo = $_FILES['arquivo'.$i];
				$emissao = $_POST['emissao'.$i];
				$validade = $_POST['validade'.$i];
				// Tamanho máximo do arquivo (em Bytes)
				$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
				// Array com as extensões permitidas
				$_UP['extensoes'] = array('pdf', 'doc', 'docx','jpeg','jpg','png');
				// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
				$_UP['renomeia'] = false;
				// Array com os tipos de erros de upload do PHP
				$_UP['erros'][0] = 'Não houve erro';
				$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
				$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
				$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
				$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
				// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
				if ($_FILES['arquivo'.$i]['error'] != 0) {
					echo("<script type='text/javascript'> alert('Não foi possível fazer o upload, erro: " . $_UP['erros'][$_FILES['arquivo'.$i]['error']]."'); location.href='menuUsuario.php';</script>");
					die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo'.$i]['error']]);
					exit; // Para a execução do script
				}
				// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
				// Faz a verificação da extensão do arquivo
				$extensao = ltrim( substr(  $_FILES['arquivo'.$i]['name'], strrpos(  $_FILES['arquivo'.$i]['name'], '.' ) ), '.' );
				if (array_search($extensao, $_UP['extensoes']) === false) {
					echo("<script type='text/javascript'> alert('Por favor, envie arquivos com as seguintes extensões: pdf, doc, docx,jpg ou png'); location.href='menuUsuario.php';</script>");
					exit;
				}
				// Faz a verificação do tamanho do arquivo
				if ($_UP['tamanho'] < $_FILES['arquivo'.$i]['size']) {
					echo("<script type='text/javascript'> alert('O arquivo enviado é muito grande, envie arquivos de até 2Mb.'); location.href='menuUsuario.php';</script>");
					echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
					exit;
				}
				// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
				  // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
				  $nome_final = md5(time().$i).".".$extensao;
				  
				// Depois verifica se é possível mover o arquivo para a pasta escolhida
				if (move_uploaded_file($_FILES['arquivo'.$i]['tmp_name'], $_UP['pasta'] . $nome_final)) {
				  // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
				} else {
				  // Não foi possível fazer o upload, provavelmente a pasta está incorreta
				}
				
				$sql4 = "INSERT INTO arquivos VALUES(null, '$nome_final','$i','$emissao','$validade','$idPasta','1')";
				if($mysqli->query($sql4)){
					echo("<script type='text/javascript'> alert('Upload efetuado com sucesso!'); location.href='visualizarDoc.php';</script>");
				}else{
					echo("<script type='text/javascript'> alert('Houve um erro! tente novamente'); location.href='visualizarDoc.php';</script>");
				}
			}
		}
	}
?>