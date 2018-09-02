<?php 
require_once("lib/config.php");
include ("lib/redirect.php"); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<meta charset="utf-8">
	<title>Cadastrar</title>
	<style type="text/css">
		.align-center
		{
			text-align: center;
		}
		.font-oswald
		{
			font-family: 'Oswald', sans-serif;
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
	</style>
</head>
<body>
	<div class="align-center">
		<h2 class="font-oswald">Cadastro</h2>
		<img src="lib/user.png" width="150">
		<form method="post">
			<input type="text" name="usuario" placeholder="Usuario"><br>
			<input type="password" name="senha" placeholder="Senha"><br>
			<input type="email" name="email" placeholder="E-email"><br>
			<input type="checkbox" name="admin" value="1">Admin<br>
			<a href="index.php">Já cadastrado?</a><br>
			<input type="submit" name="enviar">
		</form>
	</div>
	<?php
		class Cadastro extends Cnx 
		{
			private $db_conn, $stmt;

			public function __construct()
			{
				$this->db_conn = Cnx::connect();
				$this->db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}

			private function verificaUsuario($post)
			{
				$this->stmt = $this->db_conn->prepare("SELECT usuario FROM tb_usuarios WHERE usuario = '$post'");
				$this->stmt->execute();
				if ($this->stmt->rowCount() == 1) 
				{
					echo "<script>alert('Usuário já existe!')</script>";
					exit();
				}
			}

			public function Registra()
			{
				if (isset($_POST['enviar'])) 
				{
					if (!empty($_POST['usuario']) and !empty($_POST['senha']) and !empty($_POST['email'])) 
					{
						$this->verificaUsuario($_POST['usuario']);

						if (isset($_POST['admin'])) 
						{

							$this->stmt = $this->db_conn->prepare("INSERT INTO tb_usuarios (usuario, senha, email, admin) VALUES (:usr, :pass, :email, :admin)");

							$this->stmt->execute(array(
								':usr' => $_POST['usuario'],
								':pass' => sha1($_POST['senha']),
								':email' => $_POST['email'],
								':admin' => $_POST['admin']
							));

							switch ($this->stmt) 
							{
								case TRUE:
									echo "<script>alert('Registrado com sucesso!')</script>";
									echo ("<script>location.href = 'index.php'</script>");
									break;
								
								default:
									echo "<script>alert('Não registrado :( ')</script>";
									break;
							}

						} else
						{
							$this->stmt = $this->db_conn->prepare("INSERT INTO tb_usuarios (usuario, senha, email, admin) VALUES (:usr, :pass, :email, :admin)");

							$this->stmt->execute(array(
								':usr' => $_POST['usuario'],
								':pass' => $_POST['senha'],
								':email' => $_POST['email'],
								':admin' => 0
							));

							switch ($this->stmt) 
							{
								case TRUE:
									echo "<script>alert('Registrado com sucesso! (Usuário padrão)')</script>";
									echo ("<script>location.href = 'index.php'</script>");
									break;
								
								default:
									echo "<script>alert('Não registrado :( ')</script>";
									break;
							}
						}
					} else 
					{
						echo "<script>alert('Preencha os campos!')</script>";
					}
				}
			}
		}
		$obj_cadastro = new Cadastro;
		$obj_cadastro->Registra();
	?>
</body>
</html>