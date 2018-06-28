<?php
    //Conectando ao banco de dados
    include('conexao.php');
	if(isset($_POST['estados'])){
    $id = $_POST['estados'];
    //Consultando banco de dados
	$html = "";
	$qryLista = mysqli_query($mysqli, "SELECT nome, cod_cidades FROM cidades WHERE estados_cod_estados = '$id'");
	while($ress = mysqli_fetch_array($qryLista)){
		$html .= "<option value='".$ress[1]."'>".$ress[0]."</option>";
	}
	echo $html;	
	}
	if(isset($_POST['historico'])){
    $id = $_POST['historico'];
    //Consultando banco de dados
	$html = "<table><thead><tr><th>Data</th><th>Recomendações</th></tr></thead><tbody>";
	$qryLista = mysqli_query($mysqli, "SELECT recomendacoes.msg, recomendacoes.data FROM recomendacoes WHERE recomendacoes.vinculo = '$id' ORDER BY data DESC");
	while($ress = mysqli_fetch_array($qryLista)){
		$html .= "<tr><td>".date('d/m/Y H:i',strtotime($ress[1]))."</td><td>$ress[0]</td></tr>";
	}	
	$html.= "</tbody></table>";
	echo "<div id='campoAddAdm2'>".$html."</div>";	
	}
	
	
	if(isset($_POST['visto'])){
		$id = $_POST['visto'];
		$sql1 = "UPDATE fornecedores SET visto = '2' WHERE id = '$id'";
		if($mysqli->query($sql1)){
		}else{
			echo("<script type='text/javascript'> alert('Houve um erro! tente novamente'); location.href='inicio.php';</script>");
		}
	}
	
	if(isset($_POST['noti'])){
		$sql3 = mysqli_query($mysqli, "SELECT COUNT(visto) FROM fornecedores WHERE visto = '1'");
		while($valor3 = mysqli_fetch_array($sql3)){
			$notifications = $valor3[0];
		}
		if($notifications>0){
			echo "<span class='new badge' class='bbb'>$notifications</span>";
		}else{
			echo "";
		}
	}
	if(isset($_POST['notificacoes'])){
		$sql8 = mysqli_query($mysqli, "SELECT fornecedores.rasao, fornecedores.fantasia, fornecedores.entrada, DATEDIFF( NOW(), fornecedores.entrada), fornecedores.id, fornecedores.status FROM fornecedores WHERE visto = '1' ORDER BY DATEDIFF( NOW(), fornecedores.entrada) ASC LIMIT 20");
		//$query = $mysqli->query($sql8);
		$row = $sql8->num_rows;
		if($row==0){
			echo"<div id='campoAddAdm3'><div class='collection'><a class='collection-item notificacoes center'>Sem notificações no momento<span class='badge'></span></a></div></div>";
		}else{
			echo "<div id='campoAddAdm3'><div class='collection'>";
			date_default_timezone_set('America/Fortaleza');
			$dataAtual = date('Y-m-d H:i:s');
			while($valor8 = mysqli_fetch_array($sql8)){
				 $date_time  = new DateTime($valor8[2]);
				 $diff       = $date_time->diff( new DateTime($dataAtual));
				 //echo $diff->format('%y ano(s), %m mês(s), %d dia(s), %H hora(s), %i minuto(s) e %s segundo(s)');
				if($diff->format('%y')==0){
					if($diff->format('%m')==0){
						if($diff->format('%d')==0){
							if($diff->format('%H')==0){
								if($diff->format('%i')==0){
									$status = $diff->format('%s')." segundos";
								}else if($diff->format('%i')==1){
									$status = $diff->format('%i')." minuto";
								}else{
									$status = $diff->format('%i')." minutos";
								}
							}else if($diff->format('%H')==1){
								$status = $diff->format('%H')." hora";
							}else{
								$status = $diff->format('%H')." horas";
							}
						}else if($diff->format('%d')==1){
							$status = $valor8[3]." dia";
						}
						else{
							$status = $valor8[3]." dias";
						}
					}else if($diff->format('%m')==1){
						$status = $diff->format('%m')." mês";
					}else{
						$status = $diff->format('%m')." meses";
					}
				}else if($diff->format('%y')==1){
					$status = $diff->format('%y')." ano";
				}else{
					$status = $diff->format('%y')." anos";
				}
				if($valor8[5]==1){
					$mensagem = "realizou seu cadastro. Aguardando a análise dos dados";
				}else{
					$mensagem = "atualizou seus dados. Necessita de análise";
				}
				echo"<a onclick='VisualizatNotificacao(".$valor8[4].")' class='collection-item notificacoes'>
				<h6 class='notFan'>$valor8[1]</h6> $mensagem
				<span class='badge'>".$status."</span></a>";
			}	
			echo "</div></div>";
		}
	}
?>