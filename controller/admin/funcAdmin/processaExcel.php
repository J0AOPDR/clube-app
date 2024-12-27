<?php 
    include('../../conn.php');

    $arquivo = $_FILES['arquivo'];
    $primeira_linha = true;

    // Verifica se o arquivo é CSV
    if ($arquivo['type'] == "text/csv") {
        $dados_arquivo = fopen($arquivo['tmp_name'], "r");
        
        if (!$dados_arquivo) {
            die("Erro ao abrir o arquivo.");
        }

        while ($linha = fgetcsv($dados_arquivo, 1000, ";")) {
            if ($primeira_linha) {
                $primeira_linha = false;
                continue;
            }

            // Converte a codificação
            array_walk_recursive($linha, 'converter');

            // Extrai dados da linha
            $nome = trim($linha[0] ?? null);
            $sobrenome = trim($linha[1] ?? null);
            $avaliacao = trim($linha[2] ?? null);
            $modalidade = trim($linha[3] ?? null);
            $email = trim($linha[4] ?? null);
            $senha = trim($linha[5] ?? null);

            // Verifica duplicação de e-mail
            $query_verifica = "SELECT COUNT(*) AS total FROM clube_atleta WHERE email = ?";
            $stmt_verifica = $conn->prepare($query_verifica);
            if (!$stmt_verifica) {
                die("Erro ao preparar consulta: " . $conn->error);
            }

            $stmt_verifica->bind_param("s", $email);
            $stmt_verifica->execute();
            $stmt_verifica->bind_result($total);
            $stmt_verifica->fetch();
            $stmt_verifica->close();

            if ($total > 0) {
                continue; // Ignora duplicatas
            }

            // Insere os dados no banco
            $query_atleta = "INSERT INTO clube_atleta (nome, sobrenome, avaliacao, id_modalidade, email, senha) VALUES (?, ?, ?, ?, ?, ?)";
            $cad_atleta = $conn->prepare($query_atleta);
            if (!$cad_atleta) {
                die("Erro ao preparar inserção: " . $conn->error);
            }

            $cad_atleta->bind_param("ssssss", $nome, $sobrenome, $avaliacao, $modalidade, $email, $senha);
            if (!$cad_atleta->execute()) {
                die("Erro ao executar inserção: " . $cad_atleta->error);
            }

            $cad_atleta->close();
        }

        fclose($dados_arquivo);
        header("Location: addAtleta.php");
        exit();
    } else {
        die("O arquivo enviado não é um CSV válido.");
    }

    // Função para converter a codificação dos dados
    function converter(&$dados_arquivo) {
        $dados_arquivo = mb_convert_encoding($dados_arquivo, "UTF-8", "ISO-8859-1");
    }
?>
