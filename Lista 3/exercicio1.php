<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 1</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercício 1</h1>
<form method="post">
<div class="mb-3">
              <label for="num1" class="form-label">Insira o 1º número:</label>
              <input type="text" id="num1" name="num1" class="form-control" required="">
            </div><div class="mb-3">
              <label for="num2" class="form-label">Insira o 2º número:</label>
              <input type="text" id="num2" name="num2" class="form-control" required="">
            </div><div class="mb-3">
              <label for="num3" class="form-label">Insira o 3º número:</label>
              <input type="text" id="num3" name="num3" class="form-control" required="">
            </div><div class="mb-3">
              <label for="num4" class="form-label">Insira o 4º número:</label>
              <input type="text" id="num4" name="num4" class="form-control" required="">
            </div><div class="mb-3">
              <label for="num5" class="form-label">Insira o 5º número:</label>
              <input type="text" id="num5" name="num5" class="form-control" required="">
            </div><div class="mb-3">
              <label for="num6" class="form-label">Insira o 6º número:</label>
              <input type="text" id="num6" name="num6" class="form-control" required="">
            </div><div class="mb-3">
              <label for="num7" class="form-label">Insira o 7º número:</label>
              <input type="text" id="num7" name="num7" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        for($i=1; $i<=7; $i++){
            $num = $_POST['num'.$i];
            if($i == 1){
                $valor = $_POST['num1'];        
                $posicao = 1;
            }
            if($num < $valor){ 
                $posicao = $i; 
                $valor = $num;
            }
        }   
        echo "$valor é o menor número digitado, " . "sua posição é o ". $posicao . "º número" ;
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>