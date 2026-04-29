<?php
    session_start();
    if (!isset($_SESSION['acesso']) || $_SESSION['acesso'] == false){
        header('Location: index.php');
        exit();
    }
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clínica Vet - Sistema de Gestão</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --azul-vet: #1e3a8a; /* Azul Profundo */
            --roxo-vet: #6d28d9; /* Roxo Intenso */
            --verde-vet: #10b981; /* Verde Saúde */
        }

        .navbar-custom {
            background-color: var(--azul-vet);
            border-bottom: 4px solid var(--roxo-vet);
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: #c4b5fd !important; /* Roxo claro ao passar o mouse */
        }

        .dropdown-menu {
            border-top: 3px solid var(--roxo-vet);
        }

        .active-vet {
            border-left: 4px solid var(--verde-vet);
            padding-left: 10px;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="principal.php">
      <span class="me-2" style="color: var(--verde-vet);">🐾</span> 
      <strong>Clínica Vet</strong>
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuClinica">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="menuClinica">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">      
        <li class="nav-item">
            <a class="nav-link" href="principal.php">Início</a>
        </li>
        
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="cadastros" role="button" data-bs-toggle="dropdown">
                Cadastros
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="tutores.php">Tutores (Donos)</a></li>
                <li><a class="dropdown-item" href="pets.php">Pets (Animais)</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="atendimentos.php">Tipos de Atendimento</a></li>
            </ul>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="consultas.php">Agendar Consulta</a>
        </li>
      </ul>
      
      <div class="d-flex">
          <span class="navbar-text me-3 text-white small">
              Olá, <?= $_SESSION['nome'] ?>
          </span>
          <a href="logout.php" class="btn btn-sm btn-outline-light">Sair</a>
      </div>
    </div>
  </div>
</nav>

<div class="container py-5">