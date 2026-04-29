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
    <h1>Cadastro de Pet</h1>
    <form method="post">
        <div class="row g-3 mb-3">
            <div class="col-md-auto">
                <label for="Codigo" class="form-label fw-bold">ID</label>
                <span class="input-group-text bg-light text-muted">0000</span>
            </div>
            <div class="col">
                <label for="Nome" class="form-label fw-bold">Nome</label>
                <input type="text" class="form-control" id="Nome" name="nome" placeholder="Nome do pet" required>
            </div>
            <div class="col">
                <label for="especie" class="form-label fw-bold">Espécie</label>
                <select class="form-select" id="especie" name="especie">
                    <option selected>Gato</option>
                    <option>Cão</option>
                    <option>Coelho</option>
                    <option>Hamsters</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="raca" class="form-label fw-bold">Raça</label>
                <select class="form-select" id="raca" name="raca">
                    <option selected>SRD(SEM RAÇA DEFINIDA)</option>
                    <option>Siamês</option>
                    <option>Persa</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="pelagem" class="form-label fw-bold">Pelagem</label>
                <select class="form-select" id="pelagem" name="pelagem">
                    <option selected>Curta</option>
                    <option>Média</option>
                    <option>Longa</option>
                </select>
            </div>
            <div class="col">
                <label for="cor" class="form-label fw-bold">Cor</label>
                <input type="text" class="form-control" id="cor" name="cor" placeholder="Preta" required>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col">
                <label for="peso" class="form-label">Peso</label>
                <input type="number" id="peso" name="peso" class="form-control" placeholder="9kg/900g">
            </div>
            <div class="col">
                <label for="sexo" class="form-label fw-bold">Sexo</label>
                <select class="form-select" id="sexo" name="sexo">
                    <option selected>Macho</option>
                    <option>Fêmea</option>
                </select>
            </div>
            <div class="col">
              <label for="idade" class="form-label">Idade</label>
              <input type="text" id="idade" name="idade" class="form-control">
            </div>
            <div class="col">
              <label for="chip" class="form-label">Chip</label>
              <input type="text" id="chip" name="chip" class="form-control">
            </div>
            <div class="col">
              <label for="tutor" class="form-label">Tutor</label>
              <input type="text" id="tutor" name="tutor" class="form-control">
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