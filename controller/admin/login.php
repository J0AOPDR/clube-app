<?php 
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include('../conn.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM clube_admin WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows < 1) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("Location: form.php?error=invalid");
        exit;
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header("Location: main.php");
        exit;
    }
} else {
    header("Location: form.php?error=empty");
    exit;
}
?>
