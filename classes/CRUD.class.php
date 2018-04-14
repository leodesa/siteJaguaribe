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
	}
?>


