<?php 

require_once('cabecalho.php');
require_once('conecta.php'); 
require_once('visitante-banco.php'); 


$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$empresa = $_POST['empresa'];
$cpf = $_POST['cpf'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];


?>    

<?php if(insereVisitante($conexao, $nome, $sobrenome, $empresa, $cpf, $sexo, $email, $telefone, $cidade, $estado, )) : ?>
    <p class="alert alert-success">
        O cadastro <?= $nome; ?>, <?= $sobrenome ?>,<?= $empresa; ?>.<?= $cpf; ?>,<?= $sexo; ?>,<?= $email; ?>,<?= $telefone; ?>,<?= $cidade; ?>,<?= $estado; ?>, foi salvo com sucesso.
    </p>
<?php else: ?>
    <p class="alert alert-danger">
        O cadastro <?= $nome; ?> não foi salvo!! <?= mysqli_error($conexao); ?>
    </p>
<?php endif; ?>

<?php include('rodape.php') ?>