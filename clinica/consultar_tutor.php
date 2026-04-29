<?php
    require_once('cabecalho.php');
?>

<style>
    :root {
        --verde-principal: #4fa52c;
        --verde-hover: #5ec734;
    }

    .btn-salvar {
        background-color: var(--verde-principal);
        color: white;
        border: none;
        transition: 0.3s;
    }
    .btn-salvar:hover {
        background-color: var(--verde-hover);
        color: white;
    }
    
    .form-label.fw-bold {
        color: #333;
    }
</style>

<div class="container-md mt-4">
    <h1>Consultar Tutor</h1>
    <form method="post">
        <div class="row g-3 mb-3">
            <div class="col-md-auto">
                <label for="Codigo" class="form-label fw-bold">ID</label>
                <span class="input-group-text bg-light text-muted">0000</span>
            </div>
            <div class="col">
                <label for="Nome" class="form-label fw-bold">Nome</label>
                <input type="text" class="form-control" id="Nome" name="nome" placeholder="Nome Completo do Tutor" required>
            </div>
            <div class="col">
                <label for="Email" class="form-label fw-bold">E-mail</label>
                <input type="email" class="form-control" id="Email" name="email" placeholder="tutor@gmail.com">
            </div>
            <div class="col-md-2">
                <label for="CPF" class="form-label fw-bold">CPF</label>
                <input type="text" class="form-control" id="CPF" name="cpf" placeholder="000.000.000-00">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col">
                <label for="telefone" class="form-label fw-bold">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(18)99999-9999" required>
            </div>
            <div class="col">
                <label for="CEP" class="form-label fw-bold">CEP</label>
                <input type="text" class="form-control" id="CEP" name="cep" placeholder="ex.: 11220802">
            </div>
            <div class="col">
                <label for="Logradouro" class="form-label fw-bold">Logradouro</label>
                <input type="text" class="form-control" id="Logradouro" name="logradouro" placeholder="ex.: Rua Pernambuco">
            </div>
            <div class="col-md-1">
                <label for="NCasa" class="form-label fw-bold">Nº</label>
                <input type="text" class="form-control" id="NCasa" name="numero" placeholder="Nº">
            </div>
        </div>
        
        <div class="row g-3 mb-3">
            <div class="col">
                <label for="Bairro" class="form-label fw-bold">Bairro</label>
                <input type="text" class="form-control" id="Bairro" name="bairro" placeholder="Bairro">
            </div>
            <div class="col">
                <label for="Cidade" class="form-label fw-bold">Cidade</label>
                <input type="text" class="form-control" id="Cidade" name="cidade" placeholder="Cidade">
            </div>
            <div class="col-md-1">
                <label for="Estado" class="form-label fw-bold">UF</label>
                <select class="form-select" id="Estado" name="uf">
                    <option selected>SP</option>
                    <option>PR</option>
                    <option>MG</option>
                    <option>RJ</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col mt-4">
            <a href="tutores.php" class="btn btn-salvar">Voltar</a>
            </div>
            <div class="col text-end mt-4">
                <button type="submit" class="btn btn-danger">Excluir</button>
            </div>
        </div>
    </form>
</div>

<?php
    require_once('rodape.php');
?>