<?php 
    session_start();
    if(isset($_POST['submit']) && !empty($_POST['email-atleta'])  && !empty($_POST['senha-atleta'])){
        include('conn.php');
        $email = isset($_POST['email-atleta']) ? $_POST['email-atleta'] : false;
        $senha = isset($_POST['senha-atleta']) ? $_POST['senha-atleta'] : false;

        $sql = "select * from clube_atleta where email = '$email' and senha = '$senha'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) < 1){
            unset($_SESSION['email-atleta']);
            unset($_SESSION['senha-atleta']);
            header("Location: form-atleta.php");
        }else{
            $_SESSION['email-atleta'] = $email;
            $_SESSION['senha-atlteta'] = $senha;
            header('Location: main-atleta.php');
        }
    }else{
        header("Location: form-atleta.php");
    }

?>