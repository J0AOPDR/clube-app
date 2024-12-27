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
                <h1>Estatísticas</h1>
            </div>
            <div class="box-add">
            <form action="../../../controller/admin/funcAdmin/addEstatistica.php" method="POST">
                    <input type="text" name="modalidade" class="inp-form" placeholder="Modalidade">
                    <input type="text" name="vitoria" class="inp-form" placeholder="Vitorias" >
                    <input type="text" name="derrota" class="inp-form" placeholder="Derrotas" >
                    <input type="text" name="empate" class="inp-form" placeholder="Empates">
                    <input type="submit" name="submit" value="Enviar">       
            </form>
            </div>
            <?php 
                if (isset($_POST['submit'])) {
                    include('../../../controller/conn.php');
                
                    $vitoria = $_POST['vitoria'] ?? null;
                    $derrota = $_POST['derrota'] ?? null;
                    $empate = $_POST['empate'] ?? null;
                    $modalidade = $_POST['modalidade'] ?? null;
                
                    if (empty($modalidade) || empty($vitoria) || empty($derrota) || empty($empate)) {
                        $_SESSION['error'] = "Todos os campos são obrigatórios.";
                        header("Location: addEstatistica.php");
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
                
                    
                    if($modalidade_encontrada == true){

                    
                    $stmt = $conn->prepare("INSERT INTO modalidade_estatistica (id_modalidade, vitorias, derrotas, empates) VALUES ( (Select id from clube_modalidade where nome_modalidade = '$modalidade'), ?, ?, ?)");
                    $stmt->bind_param("sss", $vitoria, $derrota, $empate);
                    $stmt->execute();
                
                    $mensagem = "Nova estatística adicionada: $modalidade | $vitoria | $derrota | $empate";
                    $sql_notificacao = "INSERT INTO notificacoes (mensagem) VALUES (?)";
                    $stmt_notificacao = $conn->prepare($sql_notificacao);
                    $stmt_notificacao->bind_param("s", $mensagem);
                    $stmt_notificacao->execute();
                
                    if ($stmt->affected_rows > 0) {
                        $_SESSION['nome_modalidade'] = $modalidade;
                        $_SESSION['vitoria'] = $vitoria;
                        $_SESSION['derrota'] = $derrota;
                        $_SESSION['empate'] = $empate;
                        header('Location: addEstatistica.php');
                    } else {
                        $_SESSION['error'] = "Erro ao inserir os dados.";
                        header("Location: addEstatistica.php");
                    }
                    }else{
                        echo '<h2 id="texto">Adicione uma modalidade!</h2>';
                    }
                } 
                
?>
      
    </div>

    <div class="right-box">
        <div>
            
        </div>
    </div>
</body>
</html>
