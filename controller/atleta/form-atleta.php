<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Atleta</title>
    <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
    <div class="left-box">
        <p></p>
    </div>
    <div class="right-box">
        <div class="form-box">
            <form action="../atleta/login-atleta.php" method="POST">
                <div class="form-box-title">
                    <p>Acessar conta - Atleta</p>
                    <a href="../admin/form.php">
                        <div class="box-form-img">
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
                <input type="email" name="email" class="inp-form" placeholder="Endereço de Email" required>
                <input type="password" name="senha" class="inp-form" placeholder="Senha" required>
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
