<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro - Clínica Vet</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
        --verde-principal: #4fa52c;
        --verde-hover: #5ec734;
    }
    .btn-cadastrar {
        background-color: var(--verde-principal);
        color: white;
        border: none;
        transition: 0.3s;
    }
    .btn-cadastrar:hover {
        background-color: var(--verde-hover);
        color: white;
    }
    .text-link {
        color: var(--verde-principal);
        text-decoration: none;
    }
    .text-link:hover {
        color: var(--verde-hover);
        text-decoration: underline;
    }
  </style>
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4" style="color: var(--verde-principal);">Clínica Vet</h3>
    <h5 class="text-center text-muted mb-4">Criar Conta</h5>

    <form method="post">
      <div class="mb-3">
        <label class="form-label fw-bold">Nome</label>
        <input type="text" name="nome" class="form-control" placeholder="Digite o nome" required="">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Digite o email" required="">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Senha</label>
        <input type="password" name="senha" class="form-control" placeholder="Digite a senha" required="">
      </div>

      <button type="submit" class="btn btn-cadastrar w-100">Cadastrar</button>
    </form>

    <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        require_once('conexao.php');
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
        try{
          $stmt = $pdo->prepare('INSERT INTO usuario (nome, email, senha)
                                 VALUES (? , ?, ?);');
          if($stmt->execute([$nome, $email, $senha])){
            echo "<p>Cadastro realizado! Faça o login!</p>";
          } else {
            echo "<p>Erro ao cadastrar! Tente novamente</p>";
          }
        } catch(Exception $e){
          echo "Erro: ".$e->getMessage();
        }
      }
    ?>

    <p class="text-center mt-3 mb-0">
      Já tem conta? <a href="index.php" class="text-link">Faça login</a>
    </p>
  </div>
</div>

</body>
</html>