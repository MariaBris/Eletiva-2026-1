<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    try{
        $stmt = $pdo->prepare('SELECT * FROM categoria WHERE id=?');
    }catch(Exception $e){
        echo "Erro!".$e->getMessage();
    }
?>

<h1>Consultar Categoria</h1>
    <form method="post">
        <div class="mb-3">
              <p><strong>Descrição:</strong> Descrição </p>
        </div>
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>

<?php
    require_once('rodape.php');