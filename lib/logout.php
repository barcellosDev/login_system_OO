<?php
if (!isset($_SESSION)) 
{
	session_start();
}
unset($_SESSION['login_id']);
header("Location: ../");
?>