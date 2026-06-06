<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    try{
        $sql = "SELECT c.*, 
                       p.nome AS nome_pet, 
                       t.nome AS nome_tutor, 
                       a.nome AS nome_atendimento
                FROM consulta c
                INNER JOIN atendimento a ON a.id = c.atendimento_id
                INNER JOIN pet p ON p.id = c.pet_id AND p.id_tutor = c.pet_tutor_id
                INNER JOIN tutor t ON t.id = p.id_tutor
                WHERE c.id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $resultado = $stmt->fetch();
    }catch(Exception $e){
        echo "Erro! ".$e->getMessage();
    }
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-md mt-4 conteudo-sistema">
    <h1 class="text-center text-muted mb-4">Consultar Agendamento</h1>

    <form method="post" id="formExcluir" action="consultar_consulta.php?id=<?= $resultado['id'] ?>">
        <h3 class="col text-center mb-4">Consulta #<?= str_pad($resultado['id'], 4, '0', STR_PAD_LEFT) ?></h3>

        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <p><strong>Data / Hora:</strong> <?= date('d/m/Y H:i', strtotime($resultado['data_consulta'])) ?></p>
            </div>
            <div class="col-md-4">
                <p><strong>Pet Paciente:</strong> <?= $resultado['nome_pet'] ?></p>
            </div>
            <div class="col-md-4">
                <p><strong>Tutor Responsável:</strong> <?= $resultado['nome_tutor'] ?></p>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-12">
                <p><strong>Procedimento Agendado:</strong> <?= $resultado['nome_atendimento'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col text-end">
                <a href="consultas.php" class="btn btn-salvar">Voltar</a>
                <button type="button" onclick="confirmarExclusao()" class="btn btn-danger">Excluir</button>
            </div>
        </div>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_GET['id'];
            try{
                $sql = "DELETE FROM consulta WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                if($stmt->execute([$id])){
                    header('Location: consultas.php');
                }else{
                    echo "Erro ao excluir!";
                }
            } catch(Exception $e){
                echo "Erro: ".$e->getMessage();
            }
        }
    ?>
</div>

<script>
function confirmarExclusao() {
    Swal.fire({
        title: "Deseja desmarcar?",
        text: "Esta consulta será removida permanentemente da agenda!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sim, remover!",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('formExcluir').submit();
        }
    });
}
</script>

<?php
    require_once('rodape.php');