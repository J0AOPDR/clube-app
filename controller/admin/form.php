<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/clube-app-main/css/index.css">
</head>
<body>
    <div class="header">
        <div class="icon-clube">

        </div>
    </div>
    <div class="cont">
        <div class="left-cont">
            <div class="left-cont-painel">
                
            </div>
        </div>
        <div class="mid-cont">
            <div class="mid-cont-form">
            <form action="/clube-app-main/controller/admin/login.php" method="POST">
                <p>Bem vindo!</p>
                <input type="email" name="email" class="inp-form" placeholder="Email">
                <input type="password" name="senha" class="inp-form" placeholder="Senha">
                <input type="submit" name="submit" value="Acessar Conta">
                <a href="../mail/mail.php">Esqueceu a Senha?</a>
                <a href="../controller/form-atleta.php">Entrar</a>
            </form>
            </div>
        </div>
        <div class="right-cont">

        </div>
    </div>
</body>
</html>