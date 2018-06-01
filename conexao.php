<?php
	$user = "root";
	$local = "localhost";
	$senha = "";
	$banco = "fpslavras";
	$mysqli = mysqli_connect($local, $user, $senha, $banco) or die("Error " . mysqli_error($mysqli));
	mysqli_query($mysqli,"SET NAMES 'utf8'");
	mysqli_query($mysqli,'SET character_set_connection=utf8');
	mysqli_query($mysqli,'SET character_set_client=utf8');
	mysqli_query($mysqli,'SET character_set_results=utf8');
?>