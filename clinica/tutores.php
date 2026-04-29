<?php
    require_once('cabecalho.php');
?>

<style>
    :root {
        --verde-principal: #4fa52c;
        --verde-hover: #5ec734;
        --roxo-escuro: #6d28d9;
        --roxo-claro: #8b5cf6;
        --azul-consulta: #284caf;
        --azul-hover: #349dc7;
    }

    .btn-novo {
        background-color: var(--verde-principal);
        color: white;
        border: none;
        transition: 0.3s;
    }
    .btn-novo:hover {
        background-color: var(--verde-hover);
        color: white;
    }

    .btn-editar {
        background-color: var(--roxo-escuro);
        color: white;
        border: 1px solid var(--roxo-escuro);
        transition: 0.3s;
    }
    .btn-editar:hover {
        background-color: var(--roxo-claro);
        border-color: var(--roxo-claro);
        color: white;
    }

    .btn-consultar {
        background-color: var(--azul-consulta);
        color: white;
        border: none;
        transition: 0.3s;
    }
    .btn-consultar:hover {
        background-color: var(--azul-hover);
        color: white;
    }
</style>

<div class="container py-3"> 
    <h2>Tutores</h2>
    <a href="novo_tutor.php" class="btn btn-success mb-3 btn-novo">Novo Registro</a>
    
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Endereço</th>
                <th>Email</th>
                <th>Tel.</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i=1; $i<=5; $i++): ?>
            <tr>
                <td><?= $i ?></td>
                <td>Exemplo</td>
                <td>Exemplo</td>
                <td>Exemplo</td>
                <td>Exemplo</td>
                <td>Exemplo</td>
                <td>Exemplo</td>
                <td class="d-flex gap-2">
                    <a href="alterar_tutor.php" class="btn btn-sm btn-editar">Editar</a>
                    <a href="consultar_tutor.php" class="btn btn-sm btn-consultar">Consultar</a>
                </td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>

<?php
    require_once('rodape.php');
?>