<?php
/*
if (!isset($_SESSION)) 
{
	session_start();
}*/
if (array_key_exists('login_id', $_SESSION)) 
{
	header("Location: conteudo/index.php");
}
?>