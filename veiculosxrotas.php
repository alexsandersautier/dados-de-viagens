<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-rotas.css">
    <title>Veículos X Rotas</title>
</head>
<body>
    <a href="menu.php" style="color:white">voltar</a>
    <div class="listagemRotas">
        <h2>Veículos X Rotas</h2>
        <?php
	    	$host="localhost";
		    $basedad = "viagens";
		    $usuario_base = "root";
		    $senhabd = "";
	    	try{
		    	$conn = new PDO("mysql:host=$host;dbname=$basedad",$usuario_base,$senhabd);
			    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			    $stmt = $conn->prepare("SELECT * FROM veiculos, rotas ");
			    $stmt->execute();

			    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    echo "<li><strong>Veículo:</strong> ".$rs->modelo."
                    <strong>Rota:</strong> ".$rs->nome."
                    <strong>autonomia:</strong> ".$rs->auto_veiculo."
                    <strong>Distancia em km:</strong> ".$rs->km."
                    <strong>Total Litros:</strong> ".number_format($rs->km/$rs->auto_veiculo,2,',','.')."
                    <strong>Total em R$:</strong>".number_format($rs->km/$rs->auto_veiculo*$rs->preco,2,',','.')."</li><hr>";
                }
		    }catch(PDOException $e){
			    echo"Conexão não deu boa: ". $e->getMessage();
		    }
        ?>

    </div>
</body>
</html>
