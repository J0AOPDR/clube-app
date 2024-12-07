<?php 
    session_start();
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
        unset($_SESSION['email']);
        unset($_SESSION['senha']); 
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/main.css">
</head>
<body>

<div class="header">
        <div class="icon-clube">

        </div>
    </div>
    <div class="cont">
        <div class="left-cont">
            <div class="left-cont-painel">
                <div class="painel-mod">
                    <button><img src="https://cdn-icons-png.flaticon.com/512/77/77305.png" alt=""></button>
                </div>
                <div class="painel-mod">
                    <a href="../test.php">funciona!</a>
                </div>
                <div class="painel-mod">
                    <a href="../cadastro-atleta.php">funciona!</a>
                </div>
                <div class="painel-mod">
                </div>
                <div class="painel-mod">
                </div>
            </div>
        </div>
        <div class="right-cont">
            
        </div>
    </div>
</body>
</html>
