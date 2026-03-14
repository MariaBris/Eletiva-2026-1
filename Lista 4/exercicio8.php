<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 8</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercício 8</h1>
<form method="post">
<div class="mb-3">
              <label for="frase" class="form-label">Insira uma frase:</label>
              <input type="text" id="frase" name="frase" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $frase = $_POST['frase'];
        $vogais = "aeiouAEIOU";
        $qtd_vogais = 0;
        for($i = 0; $i < strlen($frase); $i++){
            if(strpos($vogais, $frase[$i]) !== false){
                $qtd_vogais ++;
            }
        }
        echo "A quantidade de vogais na frase é de $qtd_vogais";
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>