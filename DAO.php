<?php
	include('classes/CRUD.class.php');
	if(isset($_POST['usuario'])){
		$usuario = md5($_POST['usuario']);
		$pass = md5($_POST['senha']);
		$CRUD = new CRUD;
		$CRUD->verificarLogin($usuario,$pass);
	}
	if(isset($_POST['usuarioCad'])){
		$usuario = md5($_POST['usuarioCad']);
		$pass = md5($_POST['senha']);
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
		$cidade = $_POST['cidade'];
		$qtdeSocios = $_POST['qtdeSocios'];
		for(int i = 1; i <= $qtdeSocios; i++){
			
		}
		$CRUD = new CRUD;
		$CRUD->verificarLogin($usuario,$pass);
	}
?>