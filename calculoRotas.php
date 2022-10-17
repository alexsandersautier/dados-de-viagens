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
        <h2>Calcular rotas</h2>
        <?php
	    	$host="localhost";
		    $basedad = "viagens";
		    $usuario_base = "root";
		    $senhabd = "";
	    	try{
		    	$conn = new PDO("mysql:host=$host;dbname=$basedad",$usuario_base,$senhabd);
			    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		    }catch(PDOException $e){
                echo"Conexão não deu boa: ". $e->getMessage();
		    }
       ?>
    <form action="calculoRotas.php" method="POST">
       <select name="car" id="">
        <?php
			    $stmt = $conn->prepare("SELECT * FROM veiculos");
			    $stmt->execute();        
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo"<option value='{$rs['modelo']}'>{$rs['modelo']}</option>";
        }
        ?>
       </select> 
       <select name="route" id="">
        <?php
			    $stmts = $conn->prepare("SELECT * FROM rotas");
			    $stmts->execute();        
        while ($rss = $stmts->fetch(PDO::FETCH_ASSOC)){
            echo"<option value='{$rss['nome']}'>{$rss['nome']}</option>";
        }
        ?>
       </select>

           <input class="botao" type="submit" value="Calcular" name="btnCal">
    </form> 
        <?php
            $car=$_POST['car'];
            $route=$_POST['route'];
            $stmt=$conn->prepare("select km from rotas where nome=:name");
            $stmt->bindParam(':name', $route);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_COLUMN);


            $stmts=$conn->prepare("select auto_veiculo from veiculos where modelo=:model");
            $stmts->bindParam(':model', $car);
            $stmts->execute();
            $results = $stmts->fetch(PDO::FETCH_COLUMN);


            $stmtss=$conn->prepare("select preco from veiculos where modelo=:model");
            $stmtss->bindParam(':model', $car);
            $stmtss->execute();
            $resultss = $stmtss->fetch(PDO::FETCH_COLUMN);
            
            echo"<br>";
            echo"Modelo: $car";
            echo"<br>";
            echo"Rota: $route";
            echo"<br>";
            print_r("Total em LT: ".number_format($calc=$result/$results,2,',','.'));
            echo"<br>";
            print_r("Total em R$: ".number_format($calc=($result/$results)*$resultss,2,',','.'));
            
        ?>
    </div>
</body>
</html>