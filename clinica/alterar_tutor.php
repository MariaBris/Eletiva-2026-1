<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    $mensagem = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $id = $_GET['id'];
        try {
            $sql = "UPDATE tutor SET nome = ?, telefone = ?, endereco = ?, bairro = ?, cidade = ? WHERE idtutor = ?";
            $stmt = $pdo->prepare($sql);
            
            if($stmt->execute([$nome, $telefone, $endereco, $bairro, $cidade, $id])){
                $mensagem = "<p>Alteração realizada!</p>";
            } else {
                $mensagem = "<p>Erro ao alterar! Tente novamente</p>";
            }
        } catch (Exception $e){
            echo "Erro: " . $e->getMessage();
        }
    }
    try {
        $stmt = $pdo->prepare("SELECT * FROM tutor WHERE idtutor = ?");
        $stmt->execute([$_GET['id']]);
        $resultado = $stmt->fetch();
    } catch (Exception $e){
        echo "Erro: " . $e->getMessage();
    }
?>

<div class="container-md mt-4 conteudo-sistema">
    <h1>Alterar Informações do Tutor</h1>
    <form method="post" action="alterar_tutor.php?id=<?= $resultado['idtutor'] ?>">
        <div class="row g-3 mb-3">
            <div class="col">
                <label for="Nome" class="form-label fw-bold">Nome</label>
                <input value="<?= $resultado['nome'] ?>" type="text" class="form-control" id="Nome" name="nome" required="">
            </div>
            <div class="col-md-4">
                <label for="telefone" class="form-label fw-bold">Telefone</label>
                <input value="<?= $resultado['telefone'] ?>" type="text" class="form-control" id="telefone" name="telefone" required="">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="Endereco" class="form-label fw-bold">Endereço (Rua, Nº)</label>
                <input value="<?= $resultado['endereco'] ?>" type="text" class="form-control" id="Endereco" name="endereco" required="">
            </div>
            <div class="col-md-3">
                <label for="Bairro" class="form-label fw-bold">Bairro</label>
                <input value="<?= $resultado['bairro'] ?>" type="text" class="form-control" id="Bairro" name="bairro" required="">
            </div>
            <div class="col-md-3">
                <label for="Cidade" class="form-label fw-bold">Cidade</label>
                <input value="<?= $resultado['cidade'] ?>" type="text" class="form-control" id="Cidade" name="cidade" required="">
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-salvar">Salvar Alterações</button>
            <a href="tutores.php" class="btn btn-danger">Cancelar</a>
        </div>
    </form>

    <div class="mt-3">
        <?= $mensagem ?>
    </div>
</div>

<?php
    require_once('rodape.php');
?>