<?php
	class CRUD{
		public function VerificarTipoArquivo($tipo){
			$tipoArquivo = array("Contrato Social e Aditivos", "CNPJ", "Inscrição Municipal", "CGF", "RG e CPF", "Certidão Federal (Portaria nº1751 02/10/2014)","Certidão Estadual", "Certidão Municipal", "Certidão de Regularidade com FGTS","Certidão Falência","Balanço Patrimonial (Conforme Lei 123 das empresas ME/EPP optante do Simples Nacional, estão dispensadas)", "CREA (se for o caso Construção ou Prestador de Serviços de Engenharia)");
			$tipoInt = (int) $tipo;
			return $tipoArquivo[$tipoInt-1];
		}
		public function verificarLogin($usuario, $pass){
			include("conexao.php");
			$sql = "SELECT * FROM login WHERE usuario='$usuario' AND senha='$pass'" or die("Erro ao selecionar");
			$query = $mysqli->query($sql);
			$row = $query->num_rows;
			if ($row>0){
				setcookie(md5('usuariofpslavras'),$usuario);
				setcookie(md5('senhafpslavras'),$pass);
				$sql2 = mysqli_query($mysqli, "SELECT login.nivel FROM login WHERE usuario = '$usuario' AND senha = '$pass'");
				while($valor = mysqli_fetch_array($sql2)){
					$nivel = $valor[0];
				}
				if($nivel==1){
					header('Location: inicio.php');
				}else if($nivel==2){
					header('Location: administrativo.php');
				}
			}else{
				echo ("<script>
					window.alert('Dados Incorretos!')
					window.location.href='index.php';
				</script>");
			}
		}
		public function verificarNivel($nivelU){
			include("conexao.php");
			if (isset($_COOKIE[md5('usuariofpslavras')]) and isset($_COOKIE[md5('senhafpslavras')])){
				$usuarioCookie = $_COOKIE[md5('usuariofpslavras')];
				$senhaCookie = $_COOKIE[md5('senhafpslavras')];
			if($nivelU==1){
					$sql = "SELECT * FROM login WHERE usuario='$usuarioCookie' AND senha='$senhaCookie' AND nivel= '1'" or die("Erro ao selecionar");
					$query = $mysqli->query($sql);
					$row = $query->num_rows;
					if ($row>0){
					}else{
						echo "<script type='text/javascript'> alert('Acesso negado!'); location.href='logout.php';</script>";
					}
			}
			if($nivelU==2){
					$sql = "SELECT * FROM login WHERE usuario='$usuarioCookie' AND senha='$senhaCookie' AND nivel= '2'" or die("Erro ao selecionar");
					$query = $mysqli->query($sql);
					$row = $query->num_rows;
					if ($row>0){
					}else{
						echo "<script type='text/javascript'> alert('Acesso negado!'); location.href='logout.php';</script>";
					}
				}
			}else{
						echo("<script type='text/javascript'> alert('Acesso negado!'); location.href='logout.php';</script>");
					}
		}
		public function cadastarFornecedor($usuario,$pass,$rasao,$fantasia,$cnpj,$cgf,$rua,$numeroCasa,$complemento,$bairro,$telefone,$uf,$cidade,$nomeBanco,$agencia,$contaCorrente,$socio,$qtdeSocios){
			
			include("conexao.php");
			$sql1 = "INSERT INTO fornecedores VALUES(null, '$rasao','$fantasia','$cnpj','$cgf','$rua','$numeroCasa','$complemento','$bairro','$telefone','$uf','$cidade','$nomeBanco','$agencia','$contaCorrente','1')";
			if($mysqli->query($sql1)){
			}else{
				echo("<script type='text/javascript'> alert('Houve um erro! tente novamente'); location.href='cadastro.php';</script>");
			}
			$sql2 = mysqli_query($mysqli, "SELECT * FROM fornecedores ORDER BY id DESC LIMIT 1");
			while($valor = mysqli_fetch_array($sql2)){
				$id = $valor[0];
			}
			$sql3 = "INSERT INTO login VALUES(null, '$usuario','$pass','1','$id')";
			if($mysqli->query($sql3)){
			}else{
				echo("<script type='text/javascript'> alert('Houve um erro! tente novamente'); location.href='cadastro.php';</script>");
			}
				mkdir("/xampp/htdocs/siteJaguaribe/arquivos/".$rasao."-".$cnpj."/");
				$pasta = $rasao."-".$cnpj;
			$sql5 = "INSERT INTO pasta VALUES(null, '$pasta','$id')";
			if($mysqli->query($sql5)){
			}else{
				echo("<script type='text/javascript'> alert('Houve um erro! tente novamente'); location.href='cadastro.php';</script>");
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
						echo("<script type='text/javascript'> alert('Cadastrado com sucesso! Faça login'); location.href='index.php';</script>");
					}else{
						echo("<script type='text/javascript'> alert('Houve um erro! tente novamente'); location.href='cadastro.php';</script>");
					}
				}
			}
		}
		
		
		//Atualizar Fornecedor
		
		public function atualizarFornecedor($userUp,$senhaa,$rasao,$fantasia,$cnpj,$cgf,$rua,$numeroCasa,$complemento,$bairro,$telefone,$uf,$cidade,$nomeBanco,$agencia,$contaCorrente,$socio,$qtdeSocios,$idFornecedor){
			
			include("conexao.php");
			$sql1 = "UPDATE fornecedores SET rasao = '$rasao', fantasia = '$fantasia', cnpj = '$cnpj', cgf = '$cgf', rua = '$rua', numeroCasa = '$numeroCasa', complemento = '$complemento', bairro = '$bairro', telefone = '$telefone', uf = '$uf', cidade = '$cidade', nomeBanco = '$nomeBanco', agencia = '$agencia', contaCorrente = '$contaCorrente' WHERE id = '$idFornecedor'";
			if($mysqli->query($sql1)){
			}else{
				echo("<script type='text/javascript'> alert('Houve um erro! tente novamente'); location.href='inicio.php';</script>");
			}
			$sql3 = "DELETE FROM socios WHERE vinculo='$idFornecedor'";
			if($mysqli->query($sql3)){
			}else{
				echo("<script type='text/javascript'> alert('Houve um erro! tente novamente'); location.href='inicio.php';</script>");
			}
			if($userUp!=""){
				$sql2 = "UPDATE login SET usuario = '$userUp' WHERE vinculo = '$idFornecedor'";
				if($mysqli->query($sql2)){
					setcookie(md5('usuariofpslavras'),$userUp);
				}else{
					echo("<script type='text/javascript'> alert('Houve um erro! tente novamente'); location.href='inicio.php';</script>");
				}
			}
			if($senhaa!=""){
				$sql5 = "UPDATE login SET senha = '$senhaa' WHERE vinculo = '$idFornecedor'";
				if($mysqli->query($sql5)){
					setcookie(md5('senhafpslavras'),$senhaa);
				}else{
					echo("<script type='text/javascript'> alert('Houve um erro! tente novamente'); location.href='inicio.php';</script>");
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
							echo("<script type='text/javascript'> alert('Atualizado com sucesso!'); location.href='inicio.php';</script>");
						}else{
							echo("<script type='text/javascript'> alert('Houve um erro! tente novamente'); location.href='inicio.php';</script>");
						}
					}
			}
			echo("<script type='text/javascript'> alert('Atualizado com sucesso!'); location.href='inicio.php';</script>");
		}
	}
?>


