<?php
	class CRUD{
		public function verificarLogin($usuario, $pass){
			include("conexao.php");
			$sql = "SELECT * FROM login WHERE usuario='$usuario' AND senha='$pass'" or die("Erro ao selecionar");
			$query = $mysqli->query($sql);
			$row = $query->num_rows;
			if ($row>0){
				setcookie(md5('usuariofpslavras'),$usuario);
				setcookie(md5('senhafpslavras'),$pass);
				echo"Logado";
				header("Location: inicio.php");
			}else{
				echo"Erro";
				header("Location: index.php");
				die();
			}
		}
		public function verificarCookie(){
			include("conexao.php");
			if (isset($_COOKIE[md5('usuariofpslavras')]) and isset($_COOKIE[md5('senhafpslavras')])){
				$usuarioCookie = $_COOKIE[md5('usuariofpslavras')];
				$senhaCookie = $_COOKIE[md5('senhafpslavras')];
				$sql = "SELECT * FROM login WHERE usuario='$usuarioCookie' AND senha='$senhaCookie'" or die("Erro ao selecionar");
				$query = $mysqli->query($sql);
				$row = $query->num_rows;
				if ($row>0){
					echo"Logado";
				}else{
					echo"Erro";
					die();
				}
			}
		}
		public function cadastarFornecedor($usuario,$pass,$rasao,$fantasia,$cnpj,$cgf,$rua,$numeroCasa,$complemento,$bairro,$telefone,$uf,$cidade,$nomeBanco,$agencia,$contaCorrente,$socio,$qtdeSocios){
			
			include("conexao.php");
			$sql1 = "INSERT INTO fornecedores VALUES(null, '$rasao','$fantasia','$cnpj','$cgf','$rua','$numeroCasa','$complemento','$bairro','$telefone','$uf','$cidade','$nomeBanco','$agencia','$contaCorrente')";
			if($mysqli->query($sql1)){
				echo "Salvo";
				header('Location: cadastro.php');
			}else{
				echo "Houve um erro! tente novamente";
				echo $mysqli->error;
			}
			$sql2 = mysqli_query($mysqli, "SELECT * FROM fornecedores ORDER BY id DESC LIMIT 1");
			while($valor = mysqli_fetch_array($sql2)){
				$id = $valor[0];
			}
			$sql3 = "INSERT INTO login VALUES(null, '$usuario','$pass','1','$id')";
			if($mysqli->query($sql3)){
				echo "Salvo";
				header('Location: cadastro.php');
			}else{
				echo "Houve um erro! tente novamente";
				echo $mysqli->error;
			}
			for($j = 0; $j < $qtdeSocios; $j++){
				if($socio[$j]!=""){
					$nomeSocio = $socio[$j]->nome;
					$cpfSocio = $socio[$j]->cpf;
					$quantiSocio = $socio[$j]->quantificacaoSocio;
					$telSocio = $socio[$j]->telefoneSocios;
					$celSocio = $socio[$j]->celularSocio;
					$mailSocio = $socio[$j]->emailSocio;
					$sql4 = "INSERT INTO socios VALUES(null, '$nomeSocio','$cpfSocio','$quantiSocio','$telSocio','$celSocio','$mailSocio','$id')";
					if($mysqli->query($sql4)){
						echo "Salvo";
						header('Location: cadastro.php');
					}else{
						echo "Houve um erro! tente novamente";
						echo $mysqli->error;
					}
				}
			}
		}
	}
?>


