<?php
    require_once('cabecalho.php');
?>



<div class="container-fluid py-3 conteudo-sistema">
    <h2>Pets</h2>
    <a href="cadastrar_pet.php" class="btn btn-success mb-3 btn-novo">Novo Registro</a>
    
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Espécie</th>
                    <th>Raça</th>
                    <th>Pelagem</th>
                    <th>Cor</th>
                    <th>Peso</th>
                    <th>Sexo</th>
                    <th>Idade</th>
                    <th>Chip</th>
                    <th>Tutor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Rex</td><td>Cão</td><td>Labrador</td><td>Curta</td><td>Caramelo</td><td>30kg</td><td>M</td><td>3 anos</td><td>9851...</td><td>Maria Silva</td>
                    <td class="d-flex gap-2">
                        <a href="alterar_pet.php" class="btn btn-sm btn-editar-roxo">Editar</a>
                        <a href="consultar_pet.php" class="btn btn-sm btn-consultar-azul">Consultar</a>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Luna</td><td>Gato</td><td>Siamês</td><td>Média</td><td>Branco/Bege</td><td>4kg</td><td>F</td><td>2 anos</td><td>-</td><td>João Santos</td>
                    <td class="d-flex gap-2">
                        <a href="alterar_pet.php" class="btn btn-sm btn-editar-roxo">Editar</a>
                        <a href="consultar_pet.php" class="btn btn-sm btn-consultar-azul">Consultar</a>
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>Bibi</td><td>Cão</td><td>Poodle</td><td>Enrolada</td><td>Branco</td><td>6kg</td><td>F</td><td>5 anos</td><td>-</td><td>Ana Oliveira</td>
                    <td class="d-flex gap-2">
                        <a href="alterar_pet.php" class="btn btn-sm btn-editar-roxo">Editar</a>
                        <a href="consultar_pet.php" class="btn btn-sm btn-consultar-azul">Consultar</a>
                    </td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>Thor</td><td>Cão</td><td>Bulldog</td><td>Curta</td><td>Malhado</td><td>25kg</td><td>M</td><td>4 anos</td><td>-</td><td>Carlos Souza</td>
                    <td class="d-flex gap-2">
                        <a href="alterar_pet.php" class="btn btn-sm btn-editar-roxo">Editar</a>
                        <a href="consultar_pet.php" class="btn btn-sm btn-consultar-azul">Consultar</a>
                    </td>
                </tr>

                <tr>
                    <td>5</td>
                    <td>Mel</td><td>Gato</td><td>SRD</td><td>Longa</td><td>Tricolor</td><td>3kg</td><td>F</td><td>1 ano</td><td>-</td><td>Fernanda Lima</td>
                    <td class="d-flex gap-2">
                        <a href="alterar_pet.php" class="btn btn-sm btn-editar-roxo">Editar</a>
                        <a href="consultar_pet.php" class="btn btn-sm btn-consultar-azul">Consultar</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
    require_once('rodape.php');
?>