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

    body {
        background-image: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), url('fundo.png');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
    }

    .btn-cadastrar {
        background-color: var(--verde-principal);
        color: white;
        border: none;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-cadastrar:hover {
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
        max-width: 45px;
        height: auto;
    }

    .text-link {
        color: var(--verde-principal);
        text-decoration: none;
        font-weight: bold;
    }

    .text-link:hover {
        color: var(--verde-hover);
    }
    </style>
</head>

<body>

    <div class="container vh-100 d-flex flex-column justify-content-center align-items-center">

        <img src="gato.png" alt="Gato" class="gatinho-topo">

        <div class="card shadow p-4 card-login" style="width: 100%; max-width: 400px;">

            <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                <img src="logo.svg" alt="Logo Clínica" class="logo-clinica">
                <h4 class="mb-0" style="color: var(--verde-principal); font-weight: 700;">Clínica Vet</h4>
            </div>
            
            <h6 class="text-center text-muted mb-4">Cadastro de Usuário</h6>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label text-muted small">Nome</label>
                    <input type="text" name="nome" class="form-control" placeholder="Digite seu nome" required="">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Digite seu email" required="">
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small">Senha</label>
                    <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" required="">
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
              $stmt = $pdo->prepare('INSERT INTO usuario (nome, email, senha) VALUES (? , ?, ?);');
              if($stmt->execute([$nome, $email, $senha])){
                echo "<p>Cadastro realizado. Faça o login!</p>";
              } else {
                echo "<p>Erro ao cadastrar! Tente novamente</p>";
              }
            } catch(Exception $e){
              echo "Erro: ".$e->getMessage();
            }
          }
        ?>

            <p class="text-center mt-4 mb-0 small">
                Já tem conta? <a href="index.php">Faça login</a>
            </p>
        </div>
    </div>

</body>

</html>