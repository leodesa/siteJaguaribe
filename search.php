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
?>