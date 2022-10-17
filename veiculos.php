<?php
    $modelo=$_POST["txtModelo"];
    $combus=$_POST["tipoCombustivel"];
    if($combus == 0){
        $combus = "null";    
    }else if($combus==1){
        $combus="gasolina";
    }else if($combus==2){
        $combus="diesel";
    }else{
        $combus="alcool";
    }
    $autonomia=intval($_POST["txtAutoVei"]);
    $preco=$_POST["txtPrecoCombus"];
    $host="localhost";
    $basedad = "viagens";
    $usuario_base = "root";
    $senhabd = "";
    print_r($rota.$km);
    try{
        $conn = new PDO("mysql:host=$host;dbname=$basedad",$usuario_base,$senhabd);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO `veiculos`(id_veiculo,modelo,tp_combustivel, auto_veiculo, preco) 
        VALUES(null,:modeloV,:combus,:autonomia,:preco)");
        $stmt->bindParam(':modeloV', $modelo);
        $stmt->bindParam(':combus', $combus);
        $stmt->bindParam(':autonomia', $autonomia);
        $stmt->bindParam(':preco', $preco);
        $stmt->execute();
        echo"<script>alert('Veículocadastro!')</script>";
        include("cadastrarVeiculo.html");
    }catch(PDOException $e){
        echo"Conexão não deu boa: ". $e->getMessage();
    }
    $conn = null;
?>