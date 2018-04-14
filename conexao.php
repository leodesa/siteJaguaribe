<?php
	$user = "root";
	$local = "localhost";
	$senha = "";
	$banco = "fpslavras";
	$mysqli = mysqli_connect($local, $user, $senha, $banco) or die("Error " . mysqli_error($mysqli));
?>