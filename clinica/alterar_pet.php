<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    $mensagem = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = $_POST['nome'];
        $especie = $_POST['especie'];
        $raca = $_POST['raca'];
        $cor = $_POST['cor'];
        $peso = $_POST['peso'];
        $sexo = $_POST['sexo'];
        $idade = $_POST['idade'] !== "" ? $_POST['idade'] : null;
        $id_tutor = $_POST['id_tutor'];
        $id = $_GET['id'];
        try {
            $stmt_foto_antiga = $pdo->prepare("SELECT foto FROM pet WHERE id = ?");
            $stmt_foto_antiga->execute([$id]);
            $pet_antigo = $stmt_foto_antiga->fetch();
            $nome_foto = $pet_antigo['foto'];
        } catch (Exception $e) {
            echo "Erro ao buscar foto antiga: " . $e->getMessage();
        }
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nome_foto = md5(uniqid(time())) . "." . $extensao;
            $diretorio = "enviados/";
            if(!file_exists($diretorio)){
                mkdir($diretorio, 0777, true);
            }
            move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . $nome_foto);
        }
        try{
            $sql = "UPDATE pet SET nome = ?, especie = ?, raca = ?, cor = ?, peso = ?, sexo = ?, idade = ?, id_tutor = ?, foto = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            if($stmt->execute([$nome, $especie, $raca, $cor, $peso, $sexo, $idade, $id_tutor, $nome_foto, $id])){
                $mensagem = "<p>Alteração realizada!</p>";
            } else {
                $mensagem = "<p>Erro ao alterar! Tente novamente</p>";
            }
        }catch(Exception $e){
          echo "Erro: ".$e->getMessage();
        }
    }
    try{
        $stmt = $pdo->prepare("SELECT * FROM pet WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $resultado = $stmt->fetch();
    } catch (Exception $e){
        echo "Erro: ".$e->getMessage();
    }
    try{
        $stmt_tutores = $pdo->prepare("SELECT id, nome FROM tutor ORDER BY nome");
        $stmt_tutores->execute();
        $tutores = $stmt_tutores->fetchAll();
    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
?>

<div class="container-md mt-4 conteudo-sistema">
    <h1>Alterar informações do Pet</h1>
    <form method="post" action="alterar_pet.php?id=<?= $resultado['id'] ?>" enctype="multipart/form-data">
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="Nome" class="form-label fw-bold">Nome</label>
                <input value="<?= $resultado['nome']?>" type="text" class="form-control" id="Nome" name="nome" required="">
            </div>
            <div class="col-md-3">
                <label for="especie" class="form-label fw-bold">Espécie</label>
                <select class="form-select" id="especie" name="especie" required="">
                    <option value="Gato" <?= $resultado['especie'] == 'Gato' ? 'selected' : ''?>>Gato</option>
                    <option value="Cão" <?= $resultado['especie'] == 'Cão' ? 'selected' : ''?> >Cão</option>
                    <option value="Coelho" <?= $resultado['especie'] == 'Coelho' ? 'selected' : ''?> >Coelho</option>
                    <option value="Hamsters" <?= $resultado['especie'] == 'Hamsters' ? 'selected' : ''?> >Hamsters</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="raca" class="form-label fw-bold">Raça</label>
                <input value="<?= $resultado['raca'] ?>" type="text" class="form-control" id="raca" name="raca" required="">
            </div>
            <div class="col-md-2">
                <label for="cor" class="form-label fw-bold">Cor</label>
                <input value="<?= $resultado['cor'] ?>" type="text" class="form-control" id="cor" name="cor" required="">
            </div>
        </div>

        <div class="row g-3 mb-3 align-items-center">
            <div class="col-md-4">
                <label class="form-label fw-bold d-block">Sexo</label>
                <div class="form-check form-check-inline mt-1">
                    <input type="radio" id="femea" name="sexo" value="F" class="form-check-input" <?= $resultado['sexo'] == 'F' ? 'checked' : '' ?> required="">
                    <label for="femea" class="form-check-label">Fêmea</label>
                </div>
                <div class="form-check form-check-inline mt-1">
                    <input type="radio" id="macho" name="sexo" value="M" class="form-check-input" <?= $resultado['sexo'] == 'M' ? 'checked' : '' ?> required="">
                    <label for="macho" class="form-check-label">Macho</label>
                </div>
            </div>
            <div class="col-md-4">
                <label for="idade" class="form-label fw-bold">Idade (em anos)</label>
                <input value="<?= $resultado['idade'] ?>" type="number" class="form-control" id="idade" name="idade" min="0">
            </div>
            <div class="col-md-4">
                <label for="peso" class="form-label fw-bold">Peso (kg)</label>
                <input value="<?= $resultado['peso'] ?>" type="number" class="form-control" id="peso" name="peso" step="0.01" min="0" required="">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <label for="foto" class="form-label fw-bold">Foto do Pet</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
              <label for="id_tutor" class="form-label fw-bold">Tutor Responsável</label>
              <select class="form-select" id="id_tutor" name="id_tutor" required="">
                  <option value="">Selecione um tutor...</option>
                  <?php foreach($tutores as $t): ?>
                      <option value="<?= $t['id'] ?>" <?= $t['id'] == $resultado['id_tutor'] ? 'selected' : '' ?>>
                          <?= $t['nome'] ?>
                      </option>
                  <?php endforeach; ?>
              </select>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-salvar">Salvar Alterações</button>
            <a href="pets.php" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
    
    <div class="mt-3">
        <?= $mensagem ?>
    </div>
</div>

<?php
    require_once('rodape.php');