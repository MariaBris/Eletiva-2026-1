<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    try {
        $stmt = $pdo->query("SELECT * FROM tutor ORDER BY nome");
        $resultado = $stmt->fetchAll();
    } catch(Exception $e) {
        echo "Erro: ".$e->getMessage();
    }
?>

<div class="container-fluid py-3 conteudo-sistema">
    <h2 class="text-center text-muted mb-4">Tutores</h2>
    <a href="cadastrar_tutor.php" class="btn btn-success mb-3 btn-novo">Novo Registro</a>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Tel.</th>
                    <th  class="text-center" style="width: 200px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($resultado as $r): ?>
                    <tr>
                        <td><?= $r['nome'] ?></td>
                        <td><?= $r['endereco'] ?></td>
                        <td><?= $r['bairro'] ?></td>
                        <td><?= $r['telefone'] ?></td>
                        <td class="text-end">
                            <a href="alterar_tutor.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-editar-roxo me-1">Editar</a>
                            <a href="consultar_tutor.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-consultar-azul">Consultar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
    require_once('rodape.php');