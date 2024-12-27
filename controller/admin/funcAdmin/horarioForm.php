<?php 
session_start();
if (isset($_POST['submit'])) {
    include('../../../controller/conn.php');

    $nome = $_POST['nome'] ?? null;
    $dia = $_POST['dia'] ?? null;
    $inicio = $_POST['horario-inicio'] ?? null;
    $termino = $_POST['horario-termino'] ?? null;

    if (!$nome || !$dia || !$inicio || !$termino) {
        $_SESSION['error'] = "Todos os campos são obrigatórios.";
        header("Location: addModalidade.php");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO modalidade_horario (modalidade, dia, inicio, termino) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $dia, $inicio, $termino);
    $stmt->execute();
    $mensagem = "Nova modalidade adicionada: $modalidade";
    $sql_notificacao = "INSERT INTO notificacoes (mensagem) VALUES (?)";
    $stmt_notificacao = $conn->prepare($sql_notificacao);
    $stmt_notificacao->bind_param("s", $mensagem);
    $stmt_notificacao->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['nome_modalidade'] = $nome;
        $_SESSION['dia_horario'] = $dia;
        $_SESSION['inicio_horario'] = $inicio;
        $_SESSION['termino_horario'] = $termino;
        header('Location: addHorario.php');
    } else {
        $_SESSION['error'] = "Erro ao inserir os dados.";
        header("Location: addHorario.php");
    }
} else {
    header("Location: addHorario.php");
}
?>
