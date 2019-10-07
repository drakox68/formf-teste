<?php
require_once('conecta.php');
require_once('visitante-banco.php');

$id = $_POST['id'];

if(removeVisitante($conexao, $id)) {
    header('Location: lista-visitante.php?removido=true');
    die();
} 