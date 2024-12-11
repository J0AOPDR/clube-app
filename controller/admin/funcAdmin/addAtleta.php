<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/funcAtletas.css">
    <title>Document</title>
</head>
<body>
    <div class="left-box">
        <div class="left-box-painel">
            <div class="left-box-inicio">
                <img src="../../../css/img/inicio.png" alt="">
            </div>
            <div class="painel-line"></div>
            <div class="left-box-img">
                <button id="img-btn">
                    <img src="../../../css/img/membros.png" alt="">
                </button>
            </div>
            <div class="left-box-img">
                <button id="img-btn">
                    <img src="../../../css/img/horarios.png" alt="">
                </button>
            </div>
            <div class="left-box-img">
                <button id="img-btn">
                    <img src="../../../css/img/modalidades.png" alt="">
                </button>
            </div>
            <div class="left-box-img">
                <button id="img-btn">
                    <img src="../../../css/img/relatorios.png" alt="">
                </button>
            </div>
            <div class="left-box-img">
                <button id="img-btn">
                    <img src="../../../css/img/mensagens.png" alt="">
                </button>
            </div>
        </div>
    </div>

    <div class="mid-box">
        <div class="mid-box-atletas">
            <div class="box-title">
                <h1>Equipe</h1>
            </div>
            <div class="box-add">
            <form action="../../../controller/admin/funcAdmin/add.php" method="POST">
                    <input type="text" name="nome" class="inp-form" placeholder="Nome" >
                    <input type="text" name="sobrenome" class="inp-form" placeholder="Sobrenome" >
                    <input type="text" name="avaliacao" class="inp-form" placeholder="Avaliação" >
                    <input type="email" name="email" class="inp-form" placeholder="Endereço de Email">
                    <input type="password" name="senha" class="inp-form" placeholder="Senha" >

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
        <div class="box-notifi-title">
            <h1>Notificações</h1>
            <p id="geral-not">Geral</p>
            <div class="notifi-geral">
                
            </div>
            <div class="notifi-line">

            </div>
            
        </div>
        <div class="box-mensagem">
        <div class="left-msg">
                    <img src="../../css/img/inicio.png" alt="">
                    <p>Atividades</p>
                </div>
            <div class="text-msg">
                
                <p>A comissão técnica marcou os treinos do turno da manhã do time de futebol</p>
            </div>
            <div>

            </div>
        </div>
        <div class="box-mensagem">

        </div>
        <div class="box-mensagem">

        </div>
        

    </div>
    <script src="../../js/test.js"></script>
</body>
</html>
