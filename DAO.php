<?php
	include('classes/CRUD.class.php');
	if(isset($_POST['usuario'])){
		$usuario = md5($_POST['usuario']);
		$pass = md5($_POST['senha']);
		$CRUD = new CRUD;
		$CRUD->verificarLogin($usuario,$pass);
	}
	if(isset($_POST['usuarioCad'])){
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
?>