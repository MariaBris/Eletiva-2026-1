<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1>Exercício 2</h1>
        <form method="post">
            <?php
            for($i = 0; $i < 5; $i++)
            echo '<div class="mb-3">
              <label for="nome[]" class="form-label">Insira o nome:</label>
              <input type="text" id="nome[]" name="nome[]" class="form-control" required="">
            </div><div class="mb-3">
              <label for="nota1[]" class="form-label">Insira a primeria nota:</label>
              <input type="text" id="nota1[]" name="nota1[]" class="form-control" required="">
            </div><div class="mb-3">
              <label for="nota2[]" class="form-label">Insira a segunda nota:</label>
              <input type="text" id="nota2[]" name="nota2[]" class="form-control" required="">
            </div><div class="mb-3">
              <label for="nota3[]" class="form-label">Insira a terceira nota:</label>
              <input type="text" id="nota3[]" name="nota3[]" class="form-control" required="">
            </div>'?>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $alunos = [];
                $media = 0;
                for($i = 0; $i < 5; $i++){
                    $nome = $_POST['nome'][$i];
                    $nota1 = $_POST['nota1'][$i];
                    $nota2 = $_POST['nota2'][$i];
                    $nota3 = $_POST['nota3'][$i];
                    $media = ($nota1 + $nota2 + $nota3) / 3;
                    $alunos[$nome] = $media;                   
                }
                arsort($alunos);
                foreach($alunos as $chave => $valor){
                    echo"<p> Aluno: $chave | Média: $valor</p>";
                }
            }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>