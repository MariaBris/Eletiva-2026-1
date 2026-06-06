<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    try{
        $stmt = $pdo->prepare('SELECT * FROM atendimento WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $resultado = $stmt->fetch();
    }catch(Exception $e){
        echo "Erro!".$e->getMessage();
    }
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-md mt-4 conteudo-sistema">
    <h1 class="text-center text-muted mb-4">Consultar Atendimento</h1>

    <form method="post" id="formExcluir" action="consultar_atendimento.php?id=<?= $resultado['id'] ?>">
        
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="p-3 text-white text-center" style="background-color: var(--verde-principal);">
                <h3 class="mb-0"><?= $resultado['nome'] ?></h3>
            </div>
            
            <div class="card-body p-4">
                <div class="row g-4 mb-2">
                    <div class="col-md-12 py-2 border-bottom">
                        <label class="text-muted small fw-bold text-uppercase">Procedimento</label>
                        <p class="mb-0 fs-5"><?= $resultado['nome'] ?></p>
                    </div>
                    <div class="col-md-12 py-2 border-bottom">
                        <label class="text-muted small fw-bold text-uppercase">Descrição</label>
                        <p class="mb-0 fs-5"><?= $resultado['descricao'] ?></p>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light p-3 text-end">
                <a href="atendimentos.php" class="btn btn-salvar">Voltar</a>
                <button type="button" onclick="confirmarExclusao()" class="btn btn-danger ms-2">Excluir</button>
            </div>
        </div>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_GET['id'];
            try{
                $sql = "DELETE FROM atendimento WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                if($stmt->execute([$id])){
                    header('Location: atendimentos.php');
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
        title: "Deseja excluir?",
        text: "Esta ação não pode ser desfeita!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sim, excluir!",
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