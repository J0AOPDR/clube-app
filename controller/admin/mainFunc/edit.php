<?php
include('../../conn.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT clube_atleta.id,nome,sobrenome,avaliacao,email,nome_modalidade,senha,clube_atleta.data_criacao FROM clube_atleta inner join clube_modalidade on clube_modalidade.id = id_modalidade WHERE clube_atleta.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $atleta = $result->fetch_assoc();
    } else {
        echo "Atleta não encontrado.";
        exit;
    }
} else {
    echo "ID não informado.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../css/modalidade.css">
</head>
<body>
<div class="left-box">
        <div class="left-box-painel">
            <div class="left-box-inicio">
                <a href="../../admin/main.php">
                    <button class="img-btn no-border">
                        <img src="../../../css/img/inicio.png" alt="Início">
                    </button>
                </a>
            </div>
            <div class="painel-line"></div>

            <div class="left-box-img">
                <a href="../../admin/mainFunc/mainAtleta.php">
                    <button class="img-btn no-border">
                        <img src="../../../css/img/membros.png" alt="Membros">
                    </button>
                </a>
            </div>

            <div class="left-box-img">
                <a href="../../admin/mainFunc/mainModalidade.php">
                    <button class="img-btn no-border">
                        <img src="../../../css/img/horarios.png" alt="Horários">
                    </button>
                </a>
            </div>

            <div class="left-box-img">
                <a href="../../admin/mainFunc/mainHorarios.php">
                    <button class="img-btn no-border">
                        <img src="../../../css/img/modalidades.png" alt="Modalidades">
                    </button>
                </a>
            </div>
            <div id="exit" class="left-box-img">
                <a href="../../admin/form.php">
                    <button class="img-btn no-border">
                        <img src="../../../css/img/exit.png" alt="Modalidades">
                    </button>
                </a>
            </div>
        </div>
    </div>

    <div class="mid-box">
        <div class="box-mid">
            
            <h2>Editar Atleta</h2>
            <form method="POST" action="edit.php?id=<?php echo $atleta['id']; ?>">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($atleta['nome']); ?>" required>
                </div>


                <div class="form-group">
                    <label for="avaliacao">Avaliação:</label>
                    <input type="text" name="avaliacao" id="avaliacao" value="<?php echo htmlspecialchars($atleta['avaliacao']); ?>" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-btn">Salvar Alterações</button>
                </div>
            </form>
            <?php 
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $nome = $_POST['nome'];
                    $modalidade = $_POST['modalidade'];
                    $avaliacao = $_POST['avaliacao'];
                
                    $sql_update = "UPDATE clube_atleta SET nome = ?, avaliacao = ? WHERE id = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("ssi", $nome, $avaliacao, $id);
                    $stmt_update->execute();
                
                    if ($stmt_update->affected_rows > 0) {
                        header("Location: mainAtleta.php"); 
                    } else {
                        echo "Erro ao atualizar os dados.";
                    }
                }
            ?>
        </div>
    </div>

    <div class="right-box">

    </div>

</body>
</html>
