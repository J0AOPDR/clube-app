<?php
include('../../conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id');

    if ($id) {
        $sql = "DELETE FROM clube_modalidade WHERE nome_modalidade = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $id);

            if ($stmt->execute()) {
                header("Location: mainModalidade.php");
                exit;
            } else {
                echo "Erro ao deletar o registro.";
            }
        } else {
            echo "Erro na preparação da consulta.";
        }
    } else {
        echo "ID inválido.";
    }
} else {
    echo "Método de solicitação inválido.";
}
?>
