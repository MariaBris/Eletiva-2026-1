<?php
    require_once('cabecalho.php');
    require_once('conexao.php');

    try {
        $stmt = $pdo->query("SELECT * FROM atendimento ORDER BY nome");
        $resultado = $stmt->fetchAll();
    } catch(Exception $e) {
        echo "Erro: ".$e->getMessage();
    }
?>

<div class="container-fluid py-3 conteudo-sistema">
    <h2  class="text-center text-muted mb-4">Serviços e Atendimentos</h2>
    <a href="cadastrar_atendimento.php" class="btn btn-success mb-3 btn-novo">Novo Atendimento</a>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Procedimento</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach($resultado as $r): ?>
                        <tr>
                            <td><?= $r['nome'] ?></td>
                            <td><?= $r['descricao'] ?></td>
                            <td>R$ <?= $r['preco'] ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="alterar_atendimento.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-editar-roxo">Editar</a>
                                    <a href="consultar_atendimento.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-consultar-azul">Consultar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
    require_once('rodape.php');