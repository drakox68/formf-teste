<?php
$conexao = "localhost";
$usuario = "pma";
$password = "";
$bd = "otimotex";


// Check connection
$conexao = new mysqli($conexao, $usuario, $password, $bd);

if($conexao->connect_errno)
    echo "Falha na conexão: (".$conexao->connect_errno.")" .$conexao->connect_error;

echo "";
?>
