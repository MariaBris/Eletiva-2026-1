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
<title>Sistema</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    :root {
        --verde-principal: #4fa52c;
        --verde-hover: #5ec734;
    }

    .navbar-custom {
        background-color: var(--verde-principal);
        border-bottom: 4px solid var(--roxo-vet);
    }

    .navbar-brand, .nav-link {
        color: white !important;
    }

    .nav-link {
        border-radius: 5px;
        padding: 8px 12px !important;
        margin: 0 2px;
        transition: all 0.3s;
    }

    .nav-link:hover {
        background-color: var(--roxo-vet);
        color: white !important;
    }

    .dropdown-menu {
        border-top: 3px solid var(--roxo-vet);
    }

    .logo-nav {
        width: 40px;
        height: auto;
        filter: brightness(0) invert(1);
    }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="principal.php">
        <img src="logo.svg" alt="Logo" class="logo-nav me-2">
        <strong>Clínica Vet</strong>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Alternar navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">      
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="principal.php">Início</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownCadastros" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Cadastros
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownCadastros">
                <li><a class="dropdown-item" href="tutores.php">Tutores</a></li>
                <li><a class="dropdown-item" href="pets.php">Pets</a></li>
                <li><a class="dropdown-item" href="atendimentos.php">Tipos de Atendimentos</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="consultas.php">Agenda</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item d-flex align-items-center">
            <span class="navbar-text me-3 text-white small">
                Olá, <?= $_SESSION['nome'] ?>
            </span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container py-3">