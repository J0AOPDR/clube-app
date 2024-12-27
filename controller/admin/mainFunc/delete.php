<?php
include('../../conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    if ($id) {
        $sql = "DELETE FROM clube_atleta WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                header("Location: mainAtleta.php");
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
