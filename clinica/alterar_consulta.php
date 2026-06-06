<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    $mensagem = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data_consulta = $_POST['data_consulta'];
        $atendimento_id = $_POST['atendimento_id'];
        $pet_info = explode(',', $_POST['pet_info']);
        $pet_id = $pet_info[0];
        $pet_tutor_id = $pet_info[1];
        $id = $_GET['id'];
        try {
            $sql = "UPDATE consulta SET data_consulta = ?, atendimento_id = ?, pet_id = ?, pet_tutor_id = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            if($stmt->execute([$data_consulta, $atendimento_id, $pet_id, $pet_tutor_id, $id])){
                $mensagem = "<p>Alteração realizada!</p>";
            } else {
                $mensagem = "<p>Erro ao alterar! Tente novamente</p>";
            }
        } catch (Exception $e){
            echo "Erro: " . $e->getMessage();
        }
    }
    try {
        $stmt = $pdo->prepare("SELECT * FROM consulta WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $resultado = $stmt->fetch();
        $sql_pets = "SELECT p.id AS pet_id, p.nome AS nome_pet, p.id_tutor, t.nome AS nome_tutor 
                     FROM pet p 
                     INNER JOIN tutor t ON t.id = p.id_tutor 
                     ORDER BY p.nome ASC";
        $pets = $pdo->query($sql_pets)->fetchAll();
        $atendimentos = $pdo->query("SELECT id, nome FROM atendimento ORDER BY nome ASC")->fetchAll();
    } catch (Exception $e){
        echo "Erro: " . $e->getMessage();
    }
?>

<div class="container-md mt-4 conteudo-sistema">
    <h1 class="text-center text-muted mb-4">Alterar Agendamento de Consulta</h1>
    <form method="post" action="alterar_consulta.php?id=<?= $resultado['id'] ?>">
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="data_consulta" class="form-label fw-bold">Data e Hora</label>
                <input value="<?= date('Y-m-d\TH:i', strtotime($resultado['data_consulta'])) ?>" type="datetime-local"
                    class="form-control" id="data_consulta" name="data_consulta" required="">
            </div>

            <div class="col-md-4">
                <label for="pet_info" class="form-label fw-bold">Pet / Tutor</label>
                <select class="form-select" id="pet_info" name="pet_info" required="">
                    <?php foreach($pets as $p): ?>
                    <?php $selected = ($p['pet_id'] == $resultado['pet_id'] && $p['id_tutor'] == $resultado['pet_tutor_id']) ? 'selected' : ''; ?>
                    <option value="<?= $p['pet_id'] ?>,<?= $p['id_tutor'] ?>" <?= $selected ?>>
                        <?= $p['nome_pet'] ?> (Tutor: <?= $p['nome_tutor'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="atendimento_id" class="form-label fw-bold">Procedimento / Serviço</label>
                <select class="form-select" id="atendimento_id" name="atendimento_id" required="">
                    <?php foreach($atendimentos as $a): ?>
                    <?php $selected = ($a['id'] == $resultado['atendimento_id']) ? 'selected' : ''; ?>
                    <option value="<?= $a['id'] ?>" <?= $selected ?>>
                        <?= $a['nome'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-salvar">Salvar</button>
            <a href="consultas.php" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>
<?php
    echo $mensagem;
?>

<?php
    require_once('rodape.php');