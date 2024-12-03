<?php 
    session_start();
    if(isset($_POST['submit']) && !empty($_POST['email'])  && !empty($_POST['senha'])){
        include('conn.php');
        $email = isset($_POST['email']) ? $_POST['email'] : false;
        $senha = isset($_POST['senha']) ? $_POST['senha'] : false;

        $sql = "select * from clube_admin where email = '$email' and senha = '$senha'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) < 1){
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header("Location: form.php");
        }else{
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: main.php');
        }
    }

?>