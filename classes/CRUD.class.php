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
				}else{
					header('Location: index.php');
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
				mkdir(__DIR__."/rasao", 0700, true);
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
		
		
		//Atualizar Fornecedor
		
		public function atualizarFornecedor($userUp,$senhaa,$rasao,$fantasia,$cnpj,$cgf,$rua,$numeroCasa,$complemento,$bairro,$telefone,$uf,$cidade,$nomeBanco,$agencia,$contaCorrente,$socio,$qtdeSocios,$idFornecedor){
			
			include("conexao.php");
			$sql1 = "UPDATE fornecedores SET rasao = '$rasao', fantasia = '$fantasia', cnpj = '$cnpj', cgf = '$cgf', rua = '$rua', numeroCasa = '$numeroCasa', complemento = '$complemento', bairro = '$bairro', telefone = '$telefone', uf = '$uf', cidade = '$cidade', nomeBanco = '$nomeBanco', agencia = '$agencia', contaCorrente = '$contaCorrente' WHERE id = '$idFornecedor'";
			if($mysqli->query($sql1)){
				echo "Atualizado";
			}else{
				echo "Houve um erro! tente novamente";
				echo $mysqli->error;
			}
			$sql3 = "DELETE FROM socios WHERE vinculo='$idFornecedor'";
			if($mysqli->query($sql3)){
				echo "Deletado";
			}else{
				echo "Houve um erro! tente novamente";
				echo $mysqli->error;
			}
			if($userUp!=""){
				$sql2 = "UPDATE login SET usuario = '$userUp' WHERE vinculo = '$idFornecedor'";
				if($mysqli->query($sql2)){
					echo "Usuario Alterado";
					setcookie(md5('usuariofpslavras'),$userUp);
				}else{
					echo "Houve um erro! tente novamente";
					echo $mysqli->error;
				}
			}
			if($senhaa!=""){
				$sql5 = "UPDATE login SET senha = '$senhaa' WHERE vinculo = '$idFornecedor'";
				if($mysqli->query($sql5)){
					echo "Senha Alterada";
					setcookie(md5('senhafpslavras'),$senhaa);
				}else{
					echo "Houve um erro! tente novamente";
					echo $mysqli->error;
				}
			}
			for($j = 0; $j < $qtdeSocios; $j++){
					$nomeSocio = $socio[$j]->nome;
					$cpfSocio = $socio[$j]->cpf;
					$quantiSocio = $socio[$j]->quantificacaoSocio;
					$telSocio = $socio[$j]->telefoneSocios;
					$celSocio = $socio[$j]->celularSocio;
					$mailSocio = $socio[$j]->emailSocio;
					if(($nomeSocio!="") and ($cpfSocio!="") and ($quantiSocio!="") and ($telSocio!="") and ($celSocio!="") and ($mailSocio!="")){
						$sql4 = "INSERT INTO socios VALUES(null, '$nomeSocio','$cpfSocio','$quantiSocio','$telSocio','$celSocio','$mailSocio','$idFornecedor')";
						if($mysqli->query($sql4)){
						}else{
							echo "Houve um erro! tente novamente";
							echo $mysqli->error;
						}
					}
			}
			header('Location: inicio.php');
		}
	}
?>


