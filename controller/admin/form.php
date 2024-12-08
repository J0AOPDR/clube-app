<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
    <div class="left-box">
        <p></p>

    </div>
    <div class="right-box">
        <div class="form-box">
            <form action="../admin/login.php" method="POST">
                <div class="form-box-title">
                    <p>Acessar conta</p>
                    <div class="box-form-img">
                        <div class="form-img">
                        <img src="../../css/img/admin.png" alt="">
                        </div>
                    <div class="form-img">
                        <img src="../../css/img/atleta.png" alt="">
                    </div>
                    </div>
                </div>
                    <input type="email" name="email" class="inp-form" placeholder="Endereço de Email">
                    <input type="password" name="senha" class="inp-form" placeholder="Senha" >
                <input type="submit" name="submit" value="Logar">
            </form>
        </div>
    </div>
</body>
</html>