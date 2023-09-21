<?php
    //configurações gerais
    header('Access-Control-Allow-Origin:*');
    // abrir conexao
    $conecta = mysqli_connect("localhost", "root", "", "andes");

    $consulta = " SELECT nomeproduto, precounitario, imagempequena FROM produtos";
    $produtos = mysqli_query($conecta, $consulta);

    $retorno = array();

    while($linha = mysqli_fetch_object($produtos)) {
       $retorno[] = $linha; 
    }
    
    echo json_encode($retorno);

    //fecha conexao
    mysqli_close($conecta);
?>