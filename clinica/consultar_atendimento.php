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
        <h3 class="col text-center mb-4"><?= $resultado['nome'] ?></h3>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <p><strong>Procedimento:</strong> <?= $resultado['nome'] ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Descrição: </strong> <?= $resultado['descricao'] ?></p>
            </div>
            <div class="col-md-2">
                <p><strong>Preço (R$):</strong> <?= $resultado['preco'] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col text-end">
                <a href="atendimentos.php" class="btn btn-salvar">Voltar</a>
                <button type="button" onclick="confirmarExclusao()" class="btn btn-danger">Excluir</button>
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