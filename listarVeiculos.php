<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-rotas.css">
    <title>Listagem de veículos cadastrados</title>
</head>
<body>
    <div class="listagemRotas">
    <a href="menu.php">voltar</a>
        <h2>Veículos cadastrados</h2>

        <?php
	    	$host="localhost";
		    $basedad = "viagens";
		    $usuario_base = "root";
		    $senhabd = "";
	    	try{
		    	$conn = new PDO("mysql:host=$host;dbname=$basedad",$usuario_base,$senhabd);
			    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			    $stmt = $conn->prepare("SELECT modelo, tp_combustivel, auto_veiculo, preco FROM `veiculos` ORDER BY id_veiculo");
			    $stmt->execute();

			    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    echo "<td> <strong>Modelo:</strong> ".$rs->modelo."|</td><td>
                    <td> <strong>Combustível:</strong> ".$rs->tp_combustivel."|</td><td>
                    <td> <strong>Autonomia:</strong> ".$rs->auto_veiculo."<strong>km</strong>|</td><td>
                    <strong>Preço R$:</strong> ".$rs->preco."</td><br><hr>";
                }
		    }catch(PDOException $e){
			    echo"Conexão não deu boa: ". $e->getMessage();
		    }
        ?>

    </div>
</body>
</html>
