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
                <h1>Modalidades</h1>
            </div>
            <div class="box-add">
            <form action="../../../controller/admin/funcAdmin/modalidadeForm.php" method="POST">
                    <input type="text" name="nome" class="inp-form" placeholder="Nome" >
                    <input type="text" name="local" class="inp-form" placeholder="Local">

                    <input type="submit" name="submit" value="Enviar">       
            </form>
            </div>
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
