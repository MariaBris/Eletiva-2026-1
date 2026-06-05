<?php
    require_once('cabecalho.php');
?>

<div class="container-md mt-4 conteudo-sistema">
    <h1>Cadastro de Tutor</h1>
    <form method="post">
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="Nome" class="form-label fw-bold">Nome</label>
                <input type="text" class="form-control" id="Nome" name="nome" placeholder="Nome Completo do Tutor" required="">
            </div>
            <div class="col-md-3">
                <label for="CPF" class="form-label fw-bold">CPF</label>
                <input type="text" class="form-control" id="CPF" name="cpf" placeholder="Somente números" required="">
            </div>
            <div class="col-md-3">
                <label for="telefone" class="form-label fw-bold">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Somente números" required="">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="endereco" class="form-label fw-bold">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua Pernambuco, 999" required="">
            </div>
            <div class="col-md-3">
                <label for="Bairro" class="form-label fw-bold">Bairro</label>
                <input type="text" class="form-control" id="Bairro" name="bairro" placeholder="Centro" required="">
            </div>
            <div class="col-md-3">
                <label for="Cidade" class="form-label fw-bold">Cidade</label>
                <input type="text" class="form-control" id="Cidade" name="cidade" placeholder="Presidente" required="">
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-salvar">Cadastrar Tutor</button>
            <a href="tutores.php" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require_once('conexao.php');
            $nome = strtoupper($_POST['nome']);
            $cpf = $_POST['cpf'];
            $telefone = $_POST['telefone'];
            $endereco = strtoupper($_POST['endereco']);
            $bairro = strtoupper($_POST['bairro']);
            $cidade = strtoupper($_POST['cidade']);
            try{
                $stmt = $pdo->prepare('INSERT INTO tutor (nome, cpf, telefone, endereco, bairro, cidade) VALUES (?, ?, ?, ?, ?, ?);');
                if($stmt->execute([$nome, $cpf, $telefone, $endereco, $bairro, $cidade])){
                    echo "<p>Cadastro realizado!</p>";
                } else {
                    echo "<p>Erro ao cadastrar! Tente novamente.</p>";
                }
            }catch(Exception $e){
                echo "Erro: ".$e->getMessage();
            }
        }
    ?>
</div>

<?php
    require_once('rodape.php');