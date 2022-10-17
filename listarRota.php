<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-rotas.css">
    <title>Listagem de rotas</title>
</head>
<body>
    <div class="listagemRotas">
    <a href="menu.php">voltar</a>
        <h2>Rotas cadastradas</h2>

        <?php
	    	$host="localhost";
		    $basedad = "viagens";
		    $usuario_base = "root";
		    $senhabd = "";
	    	try{
		    	$conn = new PDO("mysql:host=$host;dbname=$basedad",$usuario_base,$senhabd);
			    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			    $stmt = $conn->prepare("SELECT nome, km FROM `rotas` ORDER BY id_rotas");
			    $stmt->execute();

			    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    echo "<td> <strong>Rota:</strong> ".$rs->nome."</td><td> 
                    <strong>Distância em KM:</strong> ".$rs->km."</td><br><hr>";
                }
		    }catch(PDOException $e){
			    echo"Conexão não deu boa: ". $e->getMessage();
		    }
        ?>

    </div>
</body>
</html>
