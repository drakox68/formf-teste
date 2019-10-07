<?php 
require_once('cabecalho.php');
require_once('conecta.php'); 
require_once('visitante-banco.php');

?>

<div class="jumbotron text-center">
    <h1 class="display-4">Lista de Visitantes</h1> 
</div>

<?php if(array_key_exists('removido', $_GET) && $_GET['removido'] == true): ?>
    <p class="alert alert-success">Cadastro deletado</p>
<?php endif; ?>

<table class="table table-dark">
    <thead>
        <tr>
            <th>#ID</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Empresa</th>
            <th>Cpf</th>
            <th>Sexo</th>
            <th>Email</th>
            <th>telefone</th>
            <th>Cidade</th>
            <th>Estado</th>
          
        </tr>
    </thead>
    <tbody>
    <?php $visitantes = listaVisitantes($conexao); ?>
    <?php foreach($visitantes as $visitante):  ?>
        <tr>
            <td><?= $visitante['id'] ?></td>
            <td><?= $visitante['nome'] ?></td>
            <td><?= $visitante['sobrenome'] ?></td>
            <td><?= $visitante['empresa'] ?></td>
            <td><?= $visitante['cpf'] ?></td>
            <td><?= $visitante['sexo'] ?></td>
            <td><?= $visitante['email'] ?></td>
            <td><?= $visitante['telefone'] ?></td>
            <td><?= $visitante['cidade'] ?></td>
            <td><?= $visitante['estado'] ?></td>
            <td>
                <form action="remove-visitante.php" method="post" class="m-0">
                    <input type="hidden" name="id" value="<?= $visitante['id'] ?>" />
                    <button type="submit" class="btn btn-danger">Deletar</button>
                    
                <a class="btn btn-sm btn-primary" 
                   href="visitante-formulario.php?id=<?= $id['id'] ?>">Alterar</a>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<?php include('rodape.php'); ?>