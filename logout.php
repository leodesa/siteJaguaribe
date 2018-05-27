<?php
	setcookie(md5('usuariofpslavras'));
	setcookie(md5('senhafpslavras'));
	header('Location: index.php');
?>