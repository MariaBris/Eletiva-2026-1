<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1></h1>
        <form method="post">
            <?php
              for($i = 0; $i < 3; $i++)
                echo '<div class="mb-3">
                <label for="cod[]" class="form-label">Insira o código do produto:</label>
                <input type="text" id="cod[]" name="cod[]" class="form-control" required="">
                </div><div class="mb-3">
                <label for="nome[]" class="form-label">Insira o nome do produto:</label>
                <input type="text" id="nome[]" name="nome[]" class="form-control" required="">
                </div><div class="mb-3">
                <label for="preco[]" class="form-label">Insira o preço do produto:</label>
                <input type="text" id="preco[]" name="preco[]" class="form-control" required="">
                </div>'?>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $produto = [];
    $produtos = [];
    for($i = 0; $i < 3; $i++){
      $cod = $_POST['cod'][$i];
      $nome = $_POST['nome'][$i];
      $preco = $_POST['preco'][$i];
      if($preco > 100){
        $preco = $preco + ($preco * (10 / 100));
      }
      $produto[$nome] = $preco;
      $produtos[$cod] = $produto;
    }
    foreach($produtos as $chave => $valor){
      echo"<p></p>";
    }
    foreach($produto as $chave => $valor){
      echo"<p>Produto: $chave | Preço R$$valor ";
    }
  }
?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>