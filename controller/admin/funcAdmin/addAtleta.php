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
                <a href="../admin/form.php">
                    <button class="img-btn no-border">
                        <img src="../../css/img/exit.png" alt="Modalidades">
                    </button>
                </a>
            </div>


        </div>
    </div>

    <div class="mid-box">
        <div class="mid-box-atletas">
            <div class="box-title">
                <h1>Equipe</h1>
            </div>
            <div class="box-add">
            <form action="../../../controller/admin/funcAdmin/addAtleta.php" method="POST">
                    <input type="text" name="nome" class="inp-form" placeholder="Nome" >
                    <input type="text" name="sobrenome" class="inp-form" placeholder="Sobrenome" >
                    <input type="text" name="avaliacao" class="inp-form" placeholder="Avaliação" >
                    <input type="text" name="modalidade" class="inp-form" placeholder="Modalidade">
                    <input type="email" name="email" class="inp-form" placeholder="Endereço de Email">
                    <input type="password" name="senha" class="inp-form" placeholder="Senha" >

                    <input type="submit" name="submit" value="Enviar">       
            </form>
            </div>
            <?php 
            session_start();
            if (isset($_POST['submit'])) {
                include('../../../controller/conn.php');

                $nome = $_POST['nome'] ?? null;
                $sobrenome = $_POST['sobrenome'] ?? null;
                $avaliacao = $_POST['avaliacao'] ?? null;
                $modalidade = $_POST['modalidade'] ?? null;
                $email = $_POST['email'] ?? null;
                $senha = $_POST['senha'] ?? null;

                if (!$nome || !$sobrenome || !$avaliacao || !$modalidade || !$email || !$senha) {
                    $_SESSION['error'] = "Todos os campos são obrigatórios.";
                    exit;
                }

                $sql = 'SELECT nome_modalidade, localModalidade FROM clube_modalidade';
                $modalidades = mysqli_query($conn, $sql);
                $modalidade_encontrada = false;

                if (mysqli_num_rows($modalidades) > 0) {
                    foreach ($modalidades as $modalidade_item) {
                        if ($modalidade == $modalidade_item['nome_modalidade']) {
                            $modalidade_encontrada = true;
                            break; 
                        }
                    }
                }
                if ($modalidade_encontrada == true) {
                    $stmt = $conn->prepare("INSERT INTO clube_atleta (nome, sobrenome, avaliacao, id_modalidade, email, senha) VALUES (?, ?, ?, (select id from clube_modalidade where nome_modalidade = '$modalidade'), ?, ?)");
                    $stmt->bind_param("sssss", $nome, $sobrenome, $avaliacao, $email, $senha);
                    $stmt->execute();
                    $mensagem = "Novo jogador adicionado: $nome";
                    $sql_notificacao = "INSERT INTO notificacoes (mensagem) VALUES (?)";
                    $stmt_notificacao = $conn->prepare($sql_notificacao);
                    $stmt_notificacao->bind_param("s", $mensagem);
                    $stmt_notificacao->execute();

                    if ($stmt->affected_rows > 0) {
                        $_SESSION['nome_atleta'] = $nome;
                        $_SESSION['sobrenome_atleta'] = $sobrenome;
                        $_SESSION['avaliacao_atleta'] = $avaliacao;
                        $_SESSION['modalidade_atleta'] = $modalidade;
                        $_SESSION['email'] = $email;
                        $_SESSION['senha'] = $senha;
                    } else {
                        $_SESSION['error'] = "Erro ao inserir os dados.";
                    }
                } else {
                    $_SESSION['error'] = "Adicione uma modalidade!";
                }
                if (isset($_SESSION['error'])) {
                    echo '<h2 id="texto">' . $_SESSION['error'] . '</h2>';
                    unset($_SESSION['error']); 
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
    <script src="../../js/test.js"></script>
</body>
</html>
