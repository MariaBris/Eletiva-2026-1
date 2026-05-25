<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    try {
        $stmt_tutores = $pdo->query("SELECT id, nome FROM tutor ORDER BY nome ASC");
        $tutores = $stmt_tutores->fetchAll();
    } catch(Exception $e){
        die("Erro: ". $e->getMessage());
    }
?>

<div class="container-md mt-4 conteudo-sistema">
    <h1>Cadastro do Pet</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="Nome" class="form-label fw-bold">Nome</label>
                <input type="text" class="form-control" id="Nome" name="nome" placeholder="Nome do pet" required="">
            </div>
            <div class="col-md-3">
                <label for="especie" class="form-label fw-bold">Espécie</label>
                <select class="form-select" id="especie" name="especie" required="">
                    <option value="" selected disabled>Selecione a espécie...</option>
                    <option value="Gato">Gato</option>
                    <option value="Cão">Cão</option>
                    <option value="Coelho">Coelho</option>
                    <option value="Hamsters">Hamsters</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="raca" class="form-label fw-bold">Raça</label>
                <input type="text" class="form-control" id="raca" name="raca" placeholder="Ex: Poodle, SRD" required="">
            </div>
            <div class="col-md-2">
                <label for="cor" class="form-label fw-bold">Cor</label>
                <input type="text" class="form-control" id="cor" name="cor" placeholder="Ex: Preta, Caramelo" required="">
            </div>
        </div>

        <div class="row g-3 mb-3 align-items-center">
            <div class="col-md-4">
                <label class="form-label fw-bold d-block">Sexo</label>
                <div class="form-check form-check-inline mt-1">
                    <input type="radio" id="femea" name="sexo" value="F" class="form-check-input" required="">
                    <label for="femea" class="form-check-label">Fêmea</label>
                </div>
                <div class="form-check form-check-inline mt-1">
                    <input type="radio" id="macho" name="sexo" value="M" class="form-check-input" required="">
                    <label for="macho" class="form-check-label">Macho</label>
                </div>
            </div>
            <div class="col-md-4">
                <label for="idade" class="form-label fw-bold">Idade (em anos)</label>
                <input type="number" class="form-control" id="idade" name="idade" placeholder="Ex: 2" min="0">
            </div>
            <div class="col-md-4">
                <label for="peso" class="form-label fw-bold">Peso (kg)</label>
                <input type="number" class="form-control" id="peso" name="peso" placeholder="Ex: 8.50" step="0.01" min="0" required="">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <label for="foto" class="form-label fw-bold">Foto do Pet</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-12">
              <label for="id_tutor" class="form-label fw-bold">Tutor Responsável</label>
              <select class="form-select" id="id_tutor" name="id_tutor" required="">
                  <option value="" selected disabled>Selecione um tutor...</option>
                  <?php foreach($tutores as $t): ?>
                      <option value="<?= $t['id'] ?>"><?= $t['nome'] ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-salvar">Cadastrar Pet</button>
            <a href="pets.php" class="btn btn-danger">Cancelar</a>
        </div>
    </form>

    <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        require_once('conexao.php');
        $nome = $_POST['nome'];
        $especie = $_POST['especie'];
        $raca = $_POST['raca'];
        $cor = $_POST['cor'];
        $peso = $_POST['peso'];
        $sexo = $_POST['sexo'];
        $idade = $_POST['idade'] !== "" ? $_POST['idade'] : null;//no bd pode aceita sem a idade, dai a ia me ajudou e falou que coloca assim para nao dar erro no bd
        $id_tutor = $_POST['id_tutor'];
        $nome_foto = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nome_foto = md5(uniqid(time())) . "." . $extensao;
            $diretorio = "enviados/";
            if(!file_exists($diretorio)){
                mkdir($diretorio, 0777, true);
            }
            move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . $nome_foto);
        }
        try {
          $sql = 'INSERT INTO pet (nome, especie, raca, cor, peso, sexo, idade, id_tutor, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);';
          $stmt = $pdo->prepare($sql);
          
          if($stmt->execute([$nome, $especie, $raca, $cor, $peso, $sexo, $idade, $id_tutor, $nome_foto])){
            echo "<p>Cadastro realizado!</p>";
          } else {
            echo "<p>Erro ao cadastrar! Tente novamente</p>";
          }
        } catch(Exception $e){
          echo "Erro: ".$e->getMessage();
        }
      }
    ?>
</div>

<?php
    require_once('rodape.php');