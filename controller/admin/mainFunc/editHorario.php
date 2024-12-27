<?php
include('../../conn.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT nome_modalidade, dia, inicio, termino FROM modalidade_horario inner join clube_modalidade on id_modalidade = id WHERE nome_modalidade = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $horario = $result->fetch_assoc();
    } else {
        echo "Modalidade não encontrada.";
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
    <title>Editar Horário</title>
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
            <h2>Editar horário</h2>
            <form method="POST" action="editHorario.php?id=<?php echo $horario['nome_modalidade']; ?>">
                <div class="form-group">
                    <label for="nome">Dia</label>
                    <input type="text" name="dia" id="nome" value="<?php echo htmlspecialchars($horario['dia']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="avaliacao">Início</label>
                    <input type="text" name="inicio" id="avaliacao" value="<?php echo htmlspecialchars($horario['inicio']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="avaliacao">Término</label>
                    <input type="text" name="termino" id="avaliacao" value="<?php echo htmlspecialchars($horario['termino']); ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="submit-btn">Salvar Alterações</button>
                </div>
            </form>
            <?php 
               if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $dia = $_POST['dia'];
                $inicio = $_POST['inicio'];
                $termino = $_POST['termino'];

                if (empty($dia) || empty($inicio) || empty($termino)) {
                    echo "Por favor, preencha todos os campos.";
                } else {
                    $sql_update = "UPDATE modalidade_horario SET dia = ?, inicio = ?, termino = ? WHERE id_modalidade = (select id from clube_modalidade where nome_modalidade = '$id')";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("sss", $dia, $inicio, $termino);
                    $stmt_update->execute();

                    if ($stmt_update->affected_rows > 0) {
                        header("Location: mainHorarios.php");
                        exit;
                    } else {
                        echo "Erro ao atualizar os dados. Nenhuma linha foi afetada.";
                    }
                }
            }
            ?>
        </div>
    </div>
    <div class="right-box">

    </div>
</body>
</html>
