<?php 
session_start();
if (isset($_POST['submit'])) {
    include('../../../controller/conn.php');

    $nome = $_POST['nome'] ?? null;
    $sobrenome = $_POST['sobrenome'] ?? null;
    $avaliacao = $_POST['avaliacao'] ?? null;
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;

    if (!$nome || !$sobrenome || !$avaliacao || !$email || !$senha) {
        $_SESSION['error'] = "Todos os campos são obrigatórios.";
        header("Location: addAtleta.php");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO clube_atleta (nome, sobrenome, avaliacao, email, senha) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $sobrenome, $avaliacao, $email, $senha);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['nome_atleta'] = $nome;
        $_SESSION['sobrenome_atleta'] = $sobrenome;
        $_SESSION['avaliacao_atleta'] = $avaliacao;
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: addAtleta.php');
    } else {
        $_SESSION['error'] = "Erro ao inserir os dados.";
        header("Location: addAtleta.php");
    }
} else {
    header("Location: addAtleta.php");
}
?>
