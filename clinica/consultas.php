<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    try {
        $sql = "SELECT c.id, c.data_consulta, 
                       p.nome AS nome_pet, 
                       p.especie AS especie_pet,
                       t.nome AS nome_tutor, 
                       a.nome AS nome_atendimento
                FROM consulta c
                INNER JOIN atendimento a ON a.id = c.atendimento_id
                INNER JOIN pet p ON p.id = c.pet_id AND p.id_tutor = c.pet_tutor_id
                INNER JOIN tutor t ON t.id = p.id_tutor
                ORDER BY c.data_consulta DESC";
        $stmt = $pdo->query($sql);
        $resultado = $stmt->fetchAll();
    } catch(Exception $e) {
        echo "Erro: ".$e->getMessage();
    }
?>

<div class="container-fluid py-3 conteudo-sistema">
    <h2 class="text-center text-muted mb-4">Agenda de Consultas</h2>
    <a href="cadastrar_consulta.php" class="btn btn-success mb-3 btn-novo">Agendar Consulta</a>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Data / Hora</th>
                    <th>Pet</th>
                    <th>Espécie</th>
                    <th>Tutor Responsável</th>
                    <th>Procedimento</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($resultado as $r): ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($r['data_consulta'])) ?></td>
                    <td><?= $r['nome_pet'] ?></td>
                    <td><?= $r['especie_pet'] ?></td>
                    <td><?= $r['nome_tutor'] ?></td>
                    <td><?= $r['nome_atendimento'] ?></td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="alterar_consulta.php?id=<?= $r['id'] ?>"
                                class="btn btn-sm btn-editar-roxo">Editar</a>
                            <a href="consultar_consulta.php?id=<?= $r['id'] ?>"
                                class="btn btn-sm btn-consultar-azul">Consultar</a>
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