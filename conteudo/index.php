<?php
require_once("../lib/config.php");
include("../lib/protect.php");
include("../lib/retriv_inf.php");
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<meta charset="utf-8">
	<title>Conteudo</title>
	<style type="text/css">
		.align-center
		{
			text-align: center;
		}
		.font-oswald
		{
			font-family: 'Oswald', sans-serif;
		}
		.conteudo
		{
			border-style: ridge;
			border-color: black;
			border-radius: 4px;
			border-width: 1px;

			background-color: white;
		}
		body
		{
			background-image: url(../lib/nature.jpg);
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: 100%;
			background-size: cover;
		}
	</style>
</head>
<body>
	<div class="align-center">
		<h1 class="font-oswald">Bem-vindo <?php echo ucfirst($_SESSION[0]['usuario']);?></h1>

	</div>
	<a href="../lib/logout.php">Logout</a>
</body>
</html>