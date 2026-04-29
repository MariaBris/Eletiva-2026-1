<?php
    require_once('cabecalho.php');
?>

<style>
    :root {
        --verde-principal: #4fa52c;
        --verde-hover: #5ec734;
        --roxo-escuro: #6d28d9;
        --roxo-claro: #8b5cf6;
        --azul-consulta: #2c7da5;
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

    .btn-editar-roxo {
        background-color: var(--roxo-escuro);
        color: white;
        border: none;
        transition: 0.3s;
    }
    .btn-editar-roxo:hover {
        background-color: var(--roxo-claro);
        color: white;
    }

    .btn-consultar-azul {
        background-color: var(--azul-consulta);
        color: white;
        border: none;
        transition: 0.3s;
    }
    .btn-consultar-azul:hover {
        background-color: var(--azul-hover);
        color: white;
    }
</style>

<div class="container-fluid py-3">
    <h2>Tutores</h2>
    <a href="novo_tutor.php" class="btn btn-success mb-3 btn-novo">Novo Registro</a>

    <div class="table-responsive">
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
                <tr>
                    <td>1</td>
                    <td>Maria Silva</td>
                    <td>123.456.789-00</td>
                    <td>12.345.678-X</td>
                    <td>Rua Pernambuco, 123</td>
                    <td>maria@gmail.com</td>
                    <td>(18) 99999-0001</td>
                    <td class="d-flex gap-2">
                        <a href="alterar_tutor.php" class="btn btn-sm btn-editar-roxo">Editar</a>
                        <a href="consultar_tutor.php" class="btn btn-sm btn-consultar-azul">Consultar</a>
                    </td>
                </tr>
                
                <tr>
                    <td>2</td>
                    <td>João Santos</td>
                    <td>234.567.890-11</td>
                    <td>23.456.789-0</td>
                    <td>Av. Brasil, 500</td>
                    <td>joao@hotmail.com</td>
                    <td>(18) 99999-0002</td>
                    <td class="d-flex gap-2">
                        <a href="alterar_tutor.php" class="btn btn-sm btn-editar-roxo">Editar</a>
                        <a href="consultar_tutor.php" class="btn btn-sm btn-consultar-azul">Consultar</a>
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>Ana Oliveira</td>
                    <td>345.678.901-22</td>
                    <td>34.567.890-1</td>
                    <td>Rua das Flores, 45</td>
                    <td>ana.vet@outlook.com</td>
                    <td>(18) 99999-0003</td>
                    <td class="d-flex gap-2">
                        <a href="alterar_tutor.php" class="btn btn-sm btn-editar-roxo">Editar</a>
                        <a href="consultar_tutor.php" class="btn btn-sm btn-consultar-azul">Consultar</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
    require_once('rodape.php');
?>