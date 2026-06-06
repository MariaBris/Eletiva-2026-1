<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    try{
        $stmt = $pdo->prepare('SELECT * FROM tutor WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $resultado = $stmt->fetch();
    } catch(Exception $e){
        echo "Erro! ".$e->getMessage();
    }
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-md mt-4 conteudo-sistema">
    <h1 class="text-center text-muted mb-4">Consultar Tutor</h1>

    <form method="post" id="formExcluir" action="consultar_tutor.php?id=<?= $resultado['id'] ?>">
        
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="p-3 text-white text-center" style="background-color: var(--verde-principal);">
                <h3 class="mb-0"><?= $resultado['nome'] ?></h3>
            </div>
            
            <div class="card-body p-4">
                <div class="row g-4 mb-2">
                    <div class="col-md-7 py-2 border-bottom">
                        <label class="text-muted small fw-bold text-uppercase">Nome Completo</label>
                        <p class="mb-0 fs-5"><?= $resultado['nome'] ?></p>
                    </div>
                    <div class="col-md-5 py-2 border-bottom">
                        <label class="text-muted small fw-bold text-uppercase">CPF</label>
                        <p class="mb-0 fs-5"><?= $resultado['cpf'] ?></p>
                    </div>
                </div>

                <div class="row g-4 mb-2">
                    <div class="col-md-7 py-2 border-bottom">
                        <label class="text-muted small fw-bold text-uppercase">Endereço</label>
                        <p class="mb-0 fs-5"><?= $resultado['endereco'] ?></p>
                    </div>
                    <div class="col-md-5 py-2 border-bottom">
                        <label class="text-muted small fw-bold text-uppercase">Bairro</label>
                        <p class="mb-0 fs-5"><?= $resultado['bairro'] ?></p>
                    </div>
                </div>

                <div class="row g-4 mb-2">
                    <div class="col-md-7 py-2 border-bottom">
                        <label class="text-muted small fw-bold text-uppercase">Cidade</label>
                        <p class="mb-0 fs-5"><?= $resultado['cidade'] ?></p>
                    </div>
                    <div class="col-md-5 py-2 border-bottom">
                        <label class="text-muted small fw-bold text-uppercase">Telefone</label>
                        <p class="mb-0 fs-5"><?= $resultado['telefone'] ?></p>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light p-3 text-end">
                <a href="tutores.php" class="btn btn-salvar">Voltar</a>
                <button type="button" onclick="confirmarExclusao()" class="btn btn-danger ms-2">Excluir</button>
            </div>
        </div>
    </form>

    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_GET['id'];
            try{
                $sql = "DELETE FROM tutor WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                if($stmt->execute([$id])){
                    header('Location: tutores.php');
                } else{
                    echo "Erro ao excluir!";
                }
            } catch(Exception $e){
                echo "Erro! ".$e->getMessage();
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
?>