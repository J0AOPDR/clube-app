<?php
include('../../conn.php');

if (isset($_GET['nome'])) {
    $id = $_GET['nome'];
    $sql = 'SELECT clube_atleta.id, nome, nome_modalidade, avaliacao, DATE_FORMAT(clube_atleta.data_criacao, "%d/%m/%Y") AS data_formatada 
    FROM clube_atleta inner join clube_modalidade on clube_modalidade.id = id_modalidade';
    $atletas = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM clube_modalidade WHERE nome_modalidade = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $modalidade = $result->fetch_assoc();
    } else {
        echo "Modalidade não encontrada.";
        exit;
    }
} else {
    echo "ID não informado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8');
    $local = htmlspecialchars($_POST['local'], ENT_QUOTES, 'UTF-8');
    $sql_update = "UPDATE clube_modalidade SET nome_modalidade = ?, localModalidade = ? WHERE nome_modalidade = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sss", $nome, $local, $id);
    $stmt_update->execute(); 
    
    if ($stmt_update->affected_rows > 0) {
        header("Location: mainModalidade.php");
        exit;
    } else {
        echo "Erro ao atualizar os dados.";
    }
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
                    <button id="img-btn">
                        <img src="../../../css/img/inicio.png" alt="Início">
                    </button>
                </a>
            </div>
            <div class="painel-line"></div>
            <div class="left-box-img">
                <a href="../../admin/mainFunc/mainAtleta.php">
                    <button id="img-btn">
                        <img src="../../../css/img/membros.png" alt="Membros">
                    </button>
                </a>
            </div>
            <div class="left-box-img">
                <a href="../../admin/mainFunc/mainModalidade.php">
                    <button id="img-btn">
                        <img src="../../../css/img/horarios.png" alt="Horários">
                    </button>
                </a>
            </div>
            <div class="left-box-img">
                <a href="../../admin/mainFunc/mainHorarios.php">
                    <button id="img-btn">
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
            <h2>Editar Modalidade</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($modalidade['nome_modalidade']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="modalidade">Local:</label>
                    <input type="text" name="local" id="modalidade" value="<?php echo htmlspecialchars($modalidade['localModalidade']); ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="submit-btn">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
    <div class="right-box">

    </div>
</body>
</html>
