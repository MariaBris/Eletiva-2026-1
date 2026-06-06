<?php
    require_once('cabecalho.php');
    require_once('conexao.php');

    try {
        $sql_pets = "SELECT p.id AS pet_id, p.nome AS nome_pet, p.id_tutor, t.nome AS nome_tutor 
                     FROM pet p 
                     INNER JOIN tutor t ON t.id = p.id_tutor 
                     ORDER BY p.nome";
        $stmt_pets = $pdo->query($sql_pets);
        $pets = $stmt_pets->fetchAll();
        $stmt_atendimentos = $pdo->query("SELECT id, nome FROM atendimento ORDER BY nome");
        $atendimentos = $stmt_atendimentos->fetchAll();
    } catch(Exception $e) {
        echo "Erro: ".$e->getMessage();
    }
?>

<div class="container-md mt-4 conteudo-sistema">
    <h1 class="text-center text-muted mb-4">Agendar Consulta</h1>

    <form method="post">
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="data_consulta" class="form-label fw-bold">Data e Hora</label>
                <input type="datetime-local" class="form-control" id="data_consulta" name="data_consulta" required="">
            </div>

            <div class="col-md-4">
                <label for="pet_info" class="form-label fw-bold">Pet / Tutor</label>
                <select class="form-select" id="pet_info" name="pet_info" required="">
                    <option value="" selected disabled>Selecione o pet...</option>
                    <?php foreach($pets as $p): ?>
                    <option value="<?= $p['pet_id'] ?>,<?= $p['id_tutor'] ?>">
                        <?= $p['nome_pet'] ?> (Tutor: <?= $p['nome_tutor'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="atendimento_id" class="form-label fw-bold">Procedimento / Serviço</label>
                <select class="form-select" id="atendimento_id" name="atendimento_id" required="">
                    <option value="" selected disabled>Selecione o procedimento...</option>
                    <?php foreach($atendimentos as $a): ?>
                    <option value="<?= $a['id'] ?>">
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

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data_consulta = $_POST['data_consulta'];
            $atendimento_id = $_POST['atendimento_id'];
            $pet_info = explode(',', $_POST['pet_info']);
            $pet_id = $pet_info[0];
            $pet_tutor_id = $pet_info[1];

            try {
                $sql = "INSERT INTO consulta (data_consulta, atendimento_id, pet_id, pet_tutor_id) 
                        VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                
                if($stmt->execute([$data_consulta, $atendimento_id, $pet_id, $pet_tutor_id])){
                    echo "<p>Consulta agendada com sucesso!</p>";
                } else {
                    echo "<p>Erro ao cadastrar! Tente novamente</p>";
                }
            } catch(Exception $e){
                echo "Erro: ".$e->getMessage();
            }
        }
    ?>
</div>

<?php
    require_once('rodape.php');