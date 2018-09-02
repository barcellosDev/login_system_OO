<?php 
require_once ("lib/config.php");
include ("lib/redirect.php"); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<meta charset="utf-8">
	<title>Login system OO</title>
	<style type="text/css">
		.align-center
		{
			text-align: center;
		}
		body
		{
			background-color: #f7ffbf;
			background-image: url(lib/sea.png);
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: 100%;
			background-size: cover;
		}
		.font-oswald
		{
			font-family: 'Oswald', sans-serif;
		}
	</style>
</head>
<body>
	<div class="align-center">
		<h2 class="font-oswald">Login</h2>
		<img src="lib/user.png" width="150">
		<form method="post">
			<input type="text" name="usuario" placeholder="Usuario"><br>
			<input type="password" name="senha" placeholder="Senha"><br>
			<input type="email" name="email" placeholder="E-email"><br>
			<a href="cadastro.php">Não cadastrado?</a><br>
			<input type="submit" name="enviar">
		</form>
	</div>
</body>
</html>
<?php
class Login extends Cnx
{
	private $db_conn, $stmt, $row;

	public function __construct()
	{
		$this->db_conn = Cnx::connect();
	}
	/*
	private function selectAdmin()
	{
		$this->stmt = $this->db_conn->prepare("SELECT admin FROM tb_usuarios WHERE usuario =".$_POST['usuario']);
		$this->stmt->execute();
		if ($this->stmt->rowCount() !== 0) 
		{
			$this->row = $this->stmt->fetch(PDO::FETCH_ASSOC);
			return $this->row['admin'];
		}
	}
	*/
	public function Consulta()
	{
		if (isset($_POST['enviar'])) 
		{
			if (!empty($_POST['usuario']) and !empty($_POST['senha']) and filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
			{
				
				$this->stmt = $this->db_conn->prepare("SELECT * FROM tb_usuarios WHERE usuario = :usr and senha = :pass");

				$this->stmt->execute(array(
						':usr' => $_POST['usuario'],
						':pass' => sha1($_POST['senha'])
					));

				if ($this->stmt->rowCount() > 0) 
				{
						$this->row = $this->stmt->fetch(PDO::FETCH_ASSOC);
						$_SESSION['login_id'] = $this->row['id'];
						header("Location: conteudo/index.php");
				} else 
				{
						echo "<script>alert('Usuário não existe!')</script>";
				}
		
			} else 
			{
				echo "<script>alert('Verifique os campos!')</script>";
			}
		}
	}
}
$login = new Login;
$login->Consulta();
?>