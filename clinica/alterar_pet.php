<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    $mensagem = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = $_POST['nome'];
        $especie = $_POST['especie'];
        $cor = $_POST['cor'];
        $sexo = $_POST['sexo'];
        $tutor_idtutor = $_POST['tutor_idtutor'];
        $id = $_GET['id'];
        try{
            $sql = "UPDATE pet SET nome = ?, especie = ?, cor = ?, sexo = ?, tutor_idtutor = ? WHERE idpet = ?";
            $stmt = $pdo->prepare($sql);
            if($stmt->execute([$nome, $especie, $cor, $sexo, $id, $tutor_idtutor])){
                $mensagem = "<p>Alteração realizada!</p>";
            } else {
                $mensagem = "<p>Erro ao alterar! Tente novamente</p>";
            }
        }catch(Exception $e){
          echo "Erro: ".$e->getMessage();
        }
    }
    try{
        $stmt = $pdo->prepare("SELECT * FROM pet WHERE idpet = ?");
        $stmt->execute([$_GET['id']]);
        $resultado = $stmt->fetch();
    } catch (Exception $e){
        echo "Erro: ".$e->getMessage();
    }
    try{
        $stmt_tutores = $pdo->prepare("SELECT idtutor, nome FROM tutor ORDER BY nome");
        $stmt_tutores->execute();
        $tutores = $stmt_tutores->fetchAll();
    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
?>

<div class="container-md mt-4 conteudo-sistema">
    <h1>Alterar informações do Pet</h1>
    <form method="post" action="alterar_pet.php?id=<?= $resultado['idpet'] ?>">
        <div class="row g-3 mb-3">
            <div class="col">
                <label for="Nome" class="form-label fw-bold">Nome</label>
                <input value="<?= $resultado['nome']?>" type="text" class="form-control" id="Nome" name="nome" required="">
            </div>
            <div class="col">
                <label for="especie" class="form-label fw-bold">Espécie</label>
                <select class="form-select" id="especie" name="especie">
                    <option value="Gato" <?= $resultado['especie'] == 'Gato' ? 'selected' : ''?>>Gato</option>
                    <option value="Cão" <?= $resultado['especie'] == 'Cão' ? 'selected' : ''?> >Cão</option>
                    <option value="Coelho" <?= $resultado['especie'] == 'Coelho' ? 'selected' : ''?> >Coelho</option>
                    <option value="Hamsters" <?= $resultado['especie'] == 'Hamsters' ? 'selected' : ''?> >Hamsters</option>
                </select>
            </div>
            <div class="col">
                <label for="cor" class="form-label fw-bold">Cor</label>
                <input value="<?= $resultado['cor'] ?>" type="text" class="form-control" id="cor" name="cor" placeholder="Preta" required="">
            </div>
        </div>

        <div class="row inline-row mb-3">
            <label class="form-label fw-bold d-block">Sexo</label>
            <div class="col-md-2">
              <div class="form-check form-check-inline">
                <input type="radio" id="femea" name="sexo" value="F" class="form-check-input" <?= $resultado['sexo'] == 'F' ? 'checked' : '' ?> required="">
                <label for="femea" class="form-check-label">Fêmea</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-check form-check-inline">
                <input type="radio" id="macho" name="sexo" value="M" class="form-check-input" <?= $resultado['sexo'] == 'M' ? 'checked' : '' ?> required="">
                <label for="macho" class="form-check-label">Macho</label>
              </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
              <label for="tutor_idtutor" class="form-label fw-bold">Tutor Responsável</label>
              <select class="form-select" id="tutor_idtutor" name="tutor_idtutor" required="">
                  <option value="">Selecione um tutor...</option>
                  <?php foreach($tutores as $t): ?>
                      <option value="<?= $t['idtutor'] ?>" <?= $t['idtutor'] == $resultado['tutor_idtutor'] ? 'selected' : '' ?>>
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
?>