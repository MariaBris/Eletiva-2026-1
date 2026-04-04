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
<?php 
    for($i = 0;$i < 5;$i++)
        echo '<div class="mb-3">
            <label for="nome[]" class="form-label">Insira o nome:</label>
            <input type="text" id="nome[]" name="nome[]" class="form-control" required="">
        </div><div class="mb-3">
            <label for="telefone[]" class="form-label">Insira o telefone para contato:</label>
            <input type="text" id="telefone[]" name="telefone[]" class="form-control" required="">
        </div>'
?>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $contatos = [];
        for($i = 0;$i < 5;$i++){
            $nome = $_POST['nome'][$i];
            $telefone = $_POST['telefone'][$i];
            if(isset($contatos[$nome])){
                echo "<p>Nome duplicado! $nome não foi adicionado novamente.</p>";
            }
            if(in_array($telefone, $contatos)){
                echo "<p>Telefone duplicado! $telefone do contato $nome não foi adicionado novamente.</p>";
            }
            else{
                $contatos[$nome] = $telefone;
            }
        }
        ksort($contatos);
        foreach($contatos as $chave => $valor){
            echo "<p>Telefone de $chave: $valor</p>";
        }
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>