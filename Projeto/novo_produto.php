<?php
    require_once('cabecalho.php');
?>

<h1>Novo Produto</h1>
    <form method="post">
        <div class="mb-3">
              <label for="nome" class="form-label">Informe a descrição</label>
              <input type="text" id="descricao" name="descricao" class="form-control" required="">
        </div>
        <div class="mb-3">
              <label for="nome" class="form-label">Informe o valor</label>
              <input type="text" id="descricao" name="descricao" class="form-control" required="">
        </div>
        <div class="mb-3">
              <label for="nome" class="form-label">Selecione a categoria</label>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        require_once('conexao.php');
        $descricao = $_POST['descricao'];
        $valor = $_POST['valor'];
        $categoria = $_POST['categoria'];
        try{
          $stmt = $pdo->prepare('INSERT INTO produto (descricao, valor, categoria_id) VALUES (?, ?, ?);');
          if($stmt->execute([$descricao, $valor, $categoria])){
            echo "<p>Cadastro realizado!</p>";
          } else {
            echo "<p>Erro ao cadastrar! Tente novamente</p>";
          }
        } catch(Exception $e){
          echo "Erro: ".$e->getMessage();
        }
      }
    ?>

<?php
    require_once('rodape.php');
