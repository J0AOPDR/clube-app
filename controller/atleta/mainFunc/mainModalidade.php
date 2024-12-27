<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/modalidade.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="left-box">
    <div class="left-box-painel">
            <div class="left-box-inicio">
                <a href="../../atleta/main-atleta.php">
                    <button class="img-btn no-border">
                        <img src="../../../css/img/inicio.png" alt="Início">
                    </button>
                </a>
            </div>
            <div class="painel-line"></div>

            <div class="left-box-img">
                <a href="../../atleta/mainFunc/mainAtleta.php">
                    <button class="img-btn no-border">
                        <img src="../../../css/img/membros.png" alt="Membros">
                    </button>
                </a>
            </div>

            <div class="left-box-img">
                <a href="../../atleta/mainFunc/mainModalidade.php">
                    <button class="img-btn no-border">
                        <img src="../../../css/img/horarios.png" alt="Horários">
                    </button>
                </a>
            </div>

            <div class="left-box-img">
                <a href="../../atleta/mainFunc/mainHorarios.php ">
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
    <?php if (isset($_GET['status']) && $_GET['status'] === 'success'){ ?>
        <p style="color: green; text-align: center;">Registro excluído com sucesso!</p>
    <?php  } ?>
        <div class="box-mid">
        <h2 id="title">Modalidades</h2>
            <div class="table-header">
                <div>Nome</div>
                <div>Local</div>
            </div>

            <div class="table-container">
                <table>
                    <tbody>
                    <?php 
                            include('../../conn.php');

                            $sql = 'SELECT nome_modalidade, localModalidade 
                                    FROM clube_modalidade';
                            $modalidades = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($modalidades) > 0) {
                                foreach ($modalidades as $modalidade) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($modalidade['nome_modalidade']); ?></td>
                            <td>
                                <?php echo htmlspecialchars($modalidade['localModalidade']); ?><br>
                            </td>
                        </tr>
                        <?php 
                                }
                            } else { 
                        ?>
                        <tr>
                            <td colspan="5">Nenhuma modalidade encontrado.</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="right-box">
        
    </div>

    
</body>
</html>
