<?php
require_once("config.php");

class Inf extends Cnx 
{
	private $db_conn, $stmt, $row;

	public function __construct()
	{
		$this->db_conn = Cnx::connect();
	}

	public function Query()
	{
		$this->stmt = $this->db_conn->prepare("SELECT usuario, admin FROM tb_usuarios WHERE id =".$_SESSION['login_id']);
		$this->stmt->execute();
		if ($this->stmt->rowCount() > 0) 
		{
			foreach ($this->row = $this->stmt->fetchAll() as $_SESSION[]) 
			{
			}
		}
	}
}
$inf = new Inf;
$inf->Query();
?>