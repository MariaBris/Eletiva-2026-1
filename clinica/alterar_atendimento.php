<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    $mensagem = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = strtoupper($_POST['nome']);
        $descricao = strtoupper($_POST['descricao']);
        $preco = $_POST['preco'];
        $id = $_GET['id'];
        try {
            $sql = "UPDATE atendimento SET nome = ?, descricao = ? WHERE id= ?";
            $stmt = $pdo->prepare($sql);
            if($stmt->execute([$nome, $descricao, $id])){
                $mensagem = "<p>Alteração realizada!</p>";
            } else {
                $mensagem = "<p>Erro ao alterar! Tente novamente.</p>";
            }
        } catch (Exception $e){
            echo "Erro: " . $e->getMessage();
        }
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM atendimento WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $resultado = $stmt->fetch();
    } catch (Exception $e){
        echo "Erro: " . $e->getMessage();
    }
?>

<div class="container-md mt-4 conteudo-sistema">
    <h1  class="text-center text-muted mb-4">Alterar Informações do Atendimento</h1>
    <form method="post" action="alterar_atendimento.php?id=<?= $resultado['id'] ?>">
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="nome" class="form-label fw-bold">Procedimento</label>
                <input value="<?= $resultado['nome'] ?>" type="text" class="form-control" id="nome" name="nome" maxlength="45" required="">
            </div>
            <div class="col-md-5">
                <label for="descricao" class="form-label fw-bold">Descrição</label>
                <input value="<?= $resultado['descricao'] ?>" type="text" class="form-control" id="descricao" name="descricao" maxlength="45" required="">
            </div>
            <div class="col-md-3">
                <label for="preco" class="form-label fw-bold">Preço (R$)</label>
                <input value="<?= $resultado['preco'] ?>" type="number" class="form-control" id="preco" name="preco" step="0.01" min="0" required="">
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-salvar">Salvar</button>
            <a href="atendimentos.php" class="btn btn-danger">Cancelar</a>
        </div>
    </form>

    </div>
    <?php
      echo $mensagem;
    ?>

<?php
    require_once('rodape.php');