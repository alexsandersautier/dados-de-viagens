<?php
	if(count($_POST)>0){
		$usuario=$_POST["txtUsuario"];
		$senha=$_POST["txtSenha"];
		$host="localhost";
		$basedad = "viagens";
		$usuario_base = "root";
		$senhabd = "";
		try{
			$conn = new PDO("mysql:host=$host;dbname=$basedad",$usuario_base,$senhabd);
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare("SELECT id FROM `login` WHERE usuario=:usuariobd and senha=:senhabd");
			$stmt->bindParam(':usuariobd', $usuario);
			$stmt->bindParam(':senhabd', $senha);
			$stmt->execute();
	
			$result = $stmt->fetchAll();
			$qntUsuario=count($result);
			if($qntUsuario==1){
				include("menu.php");
				//include("index.html");
			}
			else{
				echo"<h1 style='color:white'>Usuário ou senha inválido</h1>";
				include("index.html");
			}
		}catch(PDOException $e){
			echo"Conexão não deu boa: ". $e->getMessage();
		}
		$conn = null;
	}else{
		include("index.html");
	}
?>