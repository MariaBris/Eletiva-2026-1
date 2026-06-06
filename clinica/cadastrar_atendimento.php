<?php
    require_once('cabecalho.php');
?>

<div class="container-md mt-4 conteudo-sistema">
    <h1  class="text-center text-muted mb-4">Cadastrar Atendimento</h1>
    <form method="post">
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="nome" class="form-label fw-bold">Nome do Procedimento</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: Consulta Geral, Vacina..." maxlength="45" required="">
            </div>
            <div class="col-md-5">
                <label for="descricao" class="form-label fw-bold">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Breve resumo sobre o procedimento" maxlength="45" required="">
            </div>
            <div class="col-md-3">
                <label for="preco" class="form-label fw-bold">Preço (R$)</label>
                <input type="number" class="form-control" id="preco" name="preco" placeholder="0.00" step="0.01" min="0" required="">
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-salvar">Salvar</button>
            <a href="atendimentos.php" class="btn btn-danger">Cancelar</a>
        </div>
    </form>

    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require_once('conexao.php');
            $nome = strtoupper($_POST['nome']);
            $descricao = strtoupper($_POST['descricao']);
            $preco = $_POST['preco'];
            try{
                $stmt = $pdo->prepare('INSERT INTO atendimento (nome, descricao, preco) VALUES (?, ?, ?);');
                if($stmt->execute([$nome, $descricao, $preco])){
                    echo "Procedimento cadastrado com sucesso!";
                } else {
                    echo "Erro ao cadastrar! Tente novamente.";
                }
            }catch(Exception $e){
                echo "Erro: ".$e->getMessage();
            }
        }
    ?>
</div>

<?php
    require_once('rodape.php');