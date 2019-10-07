<?php
function insereVisitante($conexao, $nome, $sobrenome, $empresa, $cpf, $sexo, $email, $telefone, $cidade, $estado) {
    $query = "INSERT INTO usuario (nome, sobrenome, empresa, cpf, sexo, email, telefone, cidade, estado )
     VALUES ('$nome', '$sobrenome', '$empresa','$cpf', '$sexo',  '$email', '$telefone', '$cidade', '$estado')";
   
   return mysqli_query($conexao, $query);
}

function listaVisitantes($conexao) {
    $listaDeVisitantes = array();
    $consulta = mysqli_query($conexao, 'SELECT * FROM usuario');

    while($visitantes = mysqli_fetch_assoc($consulta)): 
        array_push($listaDeVisitantes, $visitantes);
    endwhile;

    return $listaDeVisitantes;
}

function removeVisitante($conexao, $id){
    $query = "DELETE FROM usuario WHERE id =  $id";
    return mysqli_query($conexao, $query);
}
