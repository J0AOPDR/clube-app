<?php 
session_start();
if (isset($_POST['submit'])) {
    include('../../../controller/conn.php');

    $nome = $_POST['nome'] ?? null;
    $local = $_POST['local'] ?? null;

    if (!$nome || !$local ) {
        $_SESSION['error'] = "Todos os campos são obrigatórios.";
        header("Location: addModalidade.php");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO clube_modalidade(nome_modalidade, localModalidade) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $local);
    $stmt->execute();

    $mensagem = "Nova modalidade adicionada: $nome no(a) $local";
    $sql_notificacao = "INSERT INTO notificacoes (mensagem) VALUES (?)";
    $stmt_notificacao = $conn->prepare($sql_notificacao);
    $stmt_notificacao->bind_param("s", $mensagem);
    $stmt_notificacao->execute();
    if ($stmt->affected_rows > 0) {
        $_SESSION['nome_modalidade'] = $nome;
        $_SESSION['local_modalidade'] = $local;
        header('Location: addModalidade.php');
    } else {
        $_SESSION['error'] = "Erro ao inserir os dados.";
        header("Location: addModalidade.php");
    }
} else {
    header("Location: addModalidade.php");
}
?>