<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    try{
        $stmt = $pdo->prepare('SELECT p.*, t.nome AS nome_tutor FROM pet p 
                               INNER JOIN tutor t on t.id = p.id_tutor WHERE p.id = ?');
        $stmt->execute([$_GET['id']]);
        $resultado = $stmt->fetch();
    }catch(Exception $e){
        echo "Erro!".$e->getMessage();
    }
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-md mt-4 conteudo-sistema">
    <h1 class="text-center text-muted mb-4">Consultar Pet</h1>
    
    <form method="post" id="formExcluir" action="consultar_pet.php?id=<?= $resultado['id'] ?>">
        <h3 class="col text-center mb-4"><?= $resultado['nome'] ?></h3>

        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <p><strong>Espécie:</strong> <?= $resultado['especie'] ?></p>
            </div>
            <div class="col-md-4">
                <p><strong>Raça:</strong> <?= $resultado['raca'] ?></p>
            </div>
            <div class="col-md-4">
                <p><strong>Cor:</strong> <?= $resultado['cor'] ?></p>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <p><strong>Sexo:</strong> <?= $resultado['sexo'] == 'M' ? 'Macho' : 'Fêmea' ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Castrado:</strong> <?= $resultado['castrado'] == 1 ? 'Sim' : 'Não' ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Peso:</strong> <?= number_format($resultado['peso'], 2, ',', '.') ?> kg</p>
            </div>
            <div class="col-md-3">
                <p><strong>Idade:</strong> <?= $resultado['idade'] ?> <?= $resultado['idade'] == 1 ? 'ano' : 'anos' ?></p>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-12">
                <p><strong>Tutor Responsável:</strong> <?= $resultado['nome_tutor'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col text-end">
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