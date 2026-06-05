<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    try{
        $stmt = $pdo->query('SELECT p.*, p.id AS id_pet, t.nome AS nome_tutor 
                             FROM pet p
                             INNER JOIN tutor t ON t.id = p.id_tutor 
                             ORDER BY p.nome');
        $resultado = $stmt->fetchAll();
    } catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
?>

<div class="container-fluid py-3 conteudo-sistema">
    <h2 class="text-center text-muted mb-4">Pets</h2>
    <a href="cadastrar_pet.php" class="btn btn-success mb-3 btn-novo">Novo Registro</a>
    
    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Espécie</th>
                    <th>Tutor Responsável</th>
                    <th class="text-center" style="width: 200px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($resultado as $r): ?>
                <tr>
                    <td><?= $r['nome'] ?></td>
                    <td><?= $r['especie'] ?></td>
                    <td><?= $r['nome_tutor'] ?></td>
                    <td class="text-end">
                        <a href="alterar_pet.php?id=<?= $r['id_pet'] ?>" class="btn btn-sm btn-editar-roxo me-1">Editar</a>
                        <a href="consultar_pet.php?id=<?= $r['id_pet'] ?>" class="btn btn-sm btn-consultar-azul">Consultar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
    require_once('rodape.php');