<?php
    //Conectando ao banco de dados
    include('conexao.php');
    $id = $_POST['estados'];
    //Consultando banco de dados
	$html = "";
	$qryLista = mysqli_query($mysqli, "SELECT nome, cod_cidades FROM cidades WHERE estados_cod_estados = '$id'");
	while($ress = mysqli_fetch_array($qryLista)){
		$html .= "<option value='".$ress[1]."'>".$ress[0]."</option>";
	}
	echo $html;	
?>