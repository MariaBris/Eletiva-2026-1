<?php
    require_once('cabecalho.php');
    require_once('conexao.php');
    $mensagem = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = $_POST['nome'];
        $especie = $_POST['especie'];
        $raca = $_POST['raca'];
        $cor = $_POST['cor'];
        $castrado = $_POST['castrado'];
        $peso = $_POST['peso'];
        $sexo = $_POST['sexo'];
        $data_nascimento = $_POST['data_nascimento'] !== "" ? $_POST['data_nascimento'] : null;
        $id_tutor = $_POST['id_tutor'];
        $id = $_GET['id'];
        
        /* ==========================================================================
           LOGICA DETALHADA DE ALTERAÇÃO / RECONHECIMENTO DA FOTO DO PET
           ========================================================================== */
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
            // Query atualizada trocando idade por data_nascimento e inserindo o campo castrado
            $sql = "UPDATE pet SET nome = ?, especie = ?, raca = ?, cor = ?, castrado = ?, peso = ?, sexo = ?, data_nascimento = ?, id_tutor = ?, foto = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            if($stmt->execute([$nome, $especie, $raca, $cor, $castrado, $peso, $sexo, $data_nascimento, $id_tutor, $nome_foto, $id])){
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