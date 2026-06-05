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

<div class="container-md mt-4">
    <h1 class="col text-center">Consultar Tutor</h1>
    <form method="post" id="formExcluir" action="consultar_tutor.php?id=<?= $resultado['id'] ?>">
        <h3 class="col text-center mb-4"><?= $resultado['nome'] ?></h3>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <p><strong>Nome:</strong><?= $resultado['nome'] ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>CPD:</strong><?= $resultado['cpf'] ?></p>
            </div>
            <div class="col-mds-3">
                <p><strong>Telefone:</strong><?= $resultado['telefone'] ?></p>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <p><strong>Endereço:</strong><?= $resultado['endereco'] ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Bairro:</strong><?= $resultado['bairro'] ?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Cidade:</strong><?= $resultado['cidade'] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col text-end">
                <a href="tutores.php" class="btn btn-salvar">Voltar</a>
                <button type="button" onclick="confirmarExclusao()" class="btn btn-danger">Excluir</button>
            </div>
        </div>
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_GET['id'];
            try{
                $sql = "DELETE FROM tutor WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                if($stmt->execute(['id'])){
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
?>