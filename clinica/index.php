<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clínica Vet - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    :root {
        --verde-principal: #4fa52c;
        --verde-hover: #5ec734;
    }

    body {
        background-image: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), url('fundo.png');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
    }
    
    .btn-login {
        background-color: var(--verde-principal);
        color: white;
        border: none;
        font-weight: 500;
    }
    
    .btn-login:hover {
        background-color: var(--verde-hover);
        color: white;
    }
    
    .card-login {
        border-top: 4px solid var(--verde-hover);
        border-bottom: 4px solid var(--verde-hover);
        position: relative;
        z-index: 1;
        background-color: #ffffff;
    }

    .gatinho-topo {
        max-width: 250px;
        margin-bottom: -12px;
        position: relative;
        z-index: 2;
    }

    .logo-clinica {
        max-width: 90px;
        height: auto;
    }

    .link-cadastro {
        color: var(--verde-principal);
        text-decoration: none;
        font-weight: bold;
    }

    .link-cadastro:hover {
        color: var(--verde-hover);
    }
  </style>
</head>
<body>

<div class="container vh-100 d-flex flex-column justify-content-center align-items-center">
  
    <img src="gato.png" alt="Gato" class="gatinho-topo">

    <div class="card shadow p-4 card-login" style="width: 100%; max-width: 400px;">
        
        <div class="text-center mb-2">
            <img src="logo.svg" alt="Logo Clínica" class="logo-clinica">
        </div>
        
        <h5 class="text-center mb-4" style="color: var(--verde-principal);"><strong>Clínica Vet</strong></h5>

        <form method="post">
          <div class="mb-3">
            <label class="form-label text-muted small">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Digite seu email" required>
          </div>

          <div class="mb-4">
            <label class="form-label text-muted small">Senha</label>
            <input name="senha" type="password" class="form-control" placeholder="Digite sua senha" required>
          </div>

          <button type="submit" class="btn btn-login w-100 py-2">Entrar</button>
        </form>

        <?php
          session_start();
          if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            if($email == "adm@adm" && $senha == '123'){
              $_SESSION['nome'] = 'Administrador';
              $_SESSION['acesso'] = true; 
              header('Location: principal.php');
            } else {
              $_SESSION['acesso'] = false;
              echo "<p class='text-danger text-center mt-3 mb-0'>Dados incorretos!</p>";
            }
          }
        ?>

        <p class="text-center mt-4 mb-0 small">
          Não tem conta? <a href="cadastro.php" class="link-cadastro">Cadastre-se</a>
        </p>
    </div>
</div>

</body>
</html>