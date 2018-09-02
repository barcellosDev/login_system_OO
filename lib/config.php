<?php
const br = "<br>";
date_default_timezone_set('America/Sao_Paulo');
session_start();

abstract class Cnx 
{
	public static $conn;

	public static function connect()
	{
		self::$conn = new PDO("mysql:host=localhost;dbname=poo_login_system", "root", "");

		if (self::$conn) 
		{
			return self::$conn;
		} else 
		{
			echo "<strong>Não conectado!</strong>";
		}
	}
}
?>