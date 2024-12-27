<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/index.css">
    <?php 
    session_start();
    session_unset(); 
    session_destroy();
    ?>
</head>
<body>
    <div class="left-box">
        <p></p>

    </div>
    <div class="right-box">
        <div class="form-box">
            <form action="../admin/login.php" method="POST">
                <div class="form-box-title">
                    <p>Acessar conta - Administrador</p>
                    <div class="box-form-img">
                        <a href="../admin/form.php">
                        <div class="form-img">
                        <img src="../../css/img/admin.png" alt="">
                        </div>
                        </a>
                        <a href="../atleta/form-atleta.php">
                    <div class="form-img">
                        <img src="../../css/img/atleta.png" alt="">
                    </div>
                    </a>
                    </div>
                </div>
                    <input type="email" name="email" class="inp-form" placeholder="Endereço de Email">
                    <input type="password" name="senha" class="inp-form" placeholder="Senha" >
                <input type="submit" name="submit" value="Logar">
            </form>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid') { ?>
                <p style="color: red; text-align: center;">Email ou senha inválidos!</p>
            <?php } elseif (isset($_GET['error']) && $_GET['error'] === 'empty') { ?>
                <p style="color: red; text-align: center;">Preencha todos os campos!</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>