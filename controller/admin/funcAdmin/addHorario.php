<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/atletas.css">
    <title>Document</title>
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
        <div class="mid-box-atletas">
            <div class="box-title">
                <h1>Horários</h1>
            </div>
            <div class="box-add">
            <form action="../../../controller/admin/funcAdmin/addHorario.php" method="POST">
                    <input type="text" name="nome" class="inp-form" placeholder="Nome" >
                    <input type="text" name="dia" class="inp-form" placeholder="Dia" >
                    <input type="text" name="horario-inicio" class="inp-form" placeholder="Horario inicio">
                    <input type="text" name="horario-termino" class="inp-form" placeholder="Horario termino">

                    <input type="submit" name="submit" value="Enviar">       
            </form>
            </div>
            <?php 
            session_start();
            if (isset($_POST['submit'])) {
                include('../../../controller/conn.php');

                $nome = $_POST['nome'] ?? null;
                $dia = $_POST['dia'] ?? null;
                $inicio = $_POST['horario-inicio'] ?? null;
                $termino = $_POST['horario-termino'] ?? null;

                if (!$nome || !$dia || !$inicio || !$termino) {
                    $_SESSION['error'] = "Todos os campos são obrigatórios.";
                    header("Location: addModalidade.php");
                    exit;
                }
                $sql = 'select nome_modalidade, localModalidade 
                    FROM clube_modalidade';
                    $modalidades = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($modalidades) > 0) {
                        
                $stmt = $conn->prepare("INSERT INTO modalidade_horario (id_modalidade, dia, inicio, termino) VALUES ((select id from clube_modalidade where nome_modalidade = '$nome'), ?, ?, ?)");
                $stmt->bind_param("sss", $dia, $inicio, $termino);
                $stmt->execute();
                $mensagem = "Novo horário adicionado: $nome às $inicio";
                $sql_notificacao = "INSERT INTO notificacoes (mensagem) VALUES (?)";
                $stmt_notificacao = $conn->prepare($sql_notificacao);
                $stmt_notificacao->bind_param("s", $mensagem);
                $stmt_notificacao->execute();

                if ($stmt->affected_rows > 0) {
                    $_SESSION['nome_modalidade'] = $nome;
                    $_SESSION['dia_horario'] = $dia;
                    $_SESSION['inicio_horario'] = $inicio;
                    $_SESSION['termino_horario'] = $termino;
                    header('Location: addHorario.php');
                } else {
                    $_SESSION['error'] = "Erro ao inserir os dados.";
                    header("Location: addHorario.php");
                }
            } else {
                echo '<h2 id="texto"> Adicione uma modalidade!</h2>';
            }
        }
?>

            <div class="box-excel">
            <form method="post" action="../../../controller/admin/funcAdmin/processaExcel.php" enctype="multipart/form-data">
                <input type="file" name="arquivo" id="file-input" title="">
                <label id = "file-input-label" for="file-input">Excel</label>
                <input type="submit" value="Enviar">
            </form>
            </div>
        </div>
    </div>

    <div class="right-box">        

    </div>
</body>
</html>
