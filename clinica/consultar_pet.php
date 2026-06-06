<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    try{
        $stmt = $pdo->prepare('SELECT p.*, t.nome AS nome_tutor FROM pet p 
                               INNER JOIN tutor t on t.id = p.id_tutor WHERE p.id = ?');
        $stmt->execute([$_GET['id']]);
        $resultado = $stmt->fetch();
    }catch(Exception $e){
        echo "Erro! ".$e->getMessage();
    }
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-md mt-4 conteudo-sistema">
    <h1 class="text-center text-muted mb-4">Consultar Pet</h1>
    
    <form method="post" id="formExcluir" action="consultar_pet.php?id=<?= $resultado['id'] ?>">
        
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="bg-primary p-3 text-white text-center" style="background-color: var(--verde-principal) !important;">
                <h3 class="mb-0"><?= $resultado['nome'] ?></h3>
            </div>
            
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-7">
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="text-muted small fw-bold">ESPÉCIE</label>
                                <p class="mb-0 fs-5"><?= $resultado['especie'] ?></p>
                            </div>
                            <div class="col-6">
                                <label class="text-muted small fw-bold">RAÇA</label>
                                <p class="mb-0 fs-5"><?= $resultado['raca'] ?></p>
                            </div>
                            <div class="col-6">
                                <label class="text-muted small fw-bold">COR</label>
                                <p class="mb-0 fs-5"><?= $resultado['cor'] ?></p>
                            </div>
                            <div class="col-6">
                                <label class="text-muted small fw-bold">SEXO</label>
                                <p class="mb-0 fs-5"><?= $resultado['sexo'] == 'M' ? 'Macho' : 'Fêmea' ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="bg-light p-3 rounded">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Castrado:</span>
                                <span class="fw-bold"><?= $resultado['castrado'] == 1 ? 'Sim' : 'Não' ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Peso:</span>
                                <span class="fw-bold"><?= number_format($resultado['peso'], 2, ',', '.') ?> kg</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Idade:</span>
                                <span class="fw-bold"><?= $resultado['idade'] ?> anos</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <label class="text-muted small fw-bold">TUTOR RESPONSÁVEL</label>
                    <p class="fs-5 mb-0 text-dark"> <?= $resultado['nome_tutor'] ?></p>
                </div>
            </div>

            <div class="card-footer bg-light p-3 text-end">
                <a href="pets.php" class="btn btn-salvar">Voltar</a>
                <button type="button" onclick="confirmarExclusao()" class="btn btn-danger">Excluir</button>
            </div>
        </div>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_GET['id'];
            try{
                $sql = "DELETE FROM pet WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                if($stmt->execute([$id])){
                    header('Location: pets.php');
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
    function confirmarExclusao(){
        Swal.fire({
            title: "Deseja excluir?",
            text: "Esta ação nao pode ser desfeita!",
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