<?php 
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include('../conn.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM clube_atleta WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows < 1) {
        unset($_SESSION['email-atleta']);
        unset($_SESSION['senha-atleta']);
        header("Location: form-atleta.php?error=invalid");
        exit;
    } else {
        $_SESSION['email-atleta'] = $email;
        $_SESSION['senha-atleta'] = $senha;
        header("Location: main-atleta.php");
        exit;
    }
} else {
    header("Location: form-atleta.php?error=empty");
    exit;
}
?>
