<?php
if(count($_POST)>0){
    $cidadeOrigem=$_POST["txtCidOri"];
    $cidadeDestino=$_POST["txtCidDest"];
    $rota=$cidadeOrigem.$cidadeDestino;
    $km=floatval($_POST["txtKm"]);
    $host="localhost";
    $basedad = "viagens";
    $usuario_base = "root";
    $senhabd = "";
    print_r($rota.$km);
    try{
        $conn = new PDO("mysql:host=$host;dbname=$basedad",$usuario_base,$senhabd);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO `rotas`(id_rotas,nome,km) VALUES(null,:nome,:quilometro)");
        $stmt->bindParam(':nome', $rota);
        $stmt->bindParam(':quilometro', $km);
        $stmt->execute();
        echo"<script>alert('Rota cadastrada!')</script>";
        include("cadastrarRota.html");
    }catch(PDOException $e){
        echo"Conexão não deu boa: ". $e->getMessage();
    }
    $conn = null;
}else{
    include("index.html");
}
?>