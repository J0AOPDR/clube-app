<?php
include('../../conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id');
    if ($id) {
        $sql = "DELETE FROM modalidade_horario WHERE id_modalidade = (select id from clube_modalidade where nome_modalidade = '$id')";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            

            if ($stmt->execute()) {
                header("Location: mainHorarios.php");
                exit;
            } else {
                echo "Erro ao deletar o registro: " . $stmt->error;
                header('Location:mainHorarios.php');
            }
        } else {
            echo "Erro na preparação da consulta: " . $conn->error;
            header('Location:mainHorarios.php');
        }
    } else {
        echo "ID inválido.";
    }
} else {
    echo "Método de solicitação inválido.";
}
?>
