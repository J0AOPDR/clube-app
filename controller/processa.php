<?php 
    include('conn.php');
    $arquivo = $_FILES['arquivo'];

    $primeira_linha = true;
    $linhas_importadas = 0;
    $linhas_nao_importadas = 0;
    $atleta_nao_importado = "";
    if($arquivo['type'] == "text/csv"){
        $dados_arquivo = fopen($arquivo['tmp_name'], "r");

        while ($linha = fgetcsv($dados_arquivo, 1000, ";")) {
            if ($primeira_linha) {
                $primeira_linha = false;
                continue;
            }
        
            array_walk_recursive($linha, 'converter');
            
            $nome = trim($linha[0] ?? null);
            $sobrenome = trim($linha[1] ?? null);
            $avaliacao = trim($linha[2] ?? null);
            $email = trim($linha[3] ?? null);
            $senha = trim($linha[4] ?? null);
        
            if (empty($email)) {
                $linhas_nao_importadas++;
                $atleta_nao_importado .= ", " . ($nome ?? "NULL");
                continue;
            }
        
            $query_verifica = "SELECT COUNT(*) FROM clube_atleta WHERE email = ?";
            $stmt_verifica = $conn->prepare($query_verifica);
            $stmt_verifica->bind_param("s", $email);
            $stmt_verifica->execute();
            $stmt_verifica->bind_result($email_existe);
            $stmt_verifica->fetch();
            $stmt_verifica->close();
        
            if ($email_existe > 0) {
                $linhas_nao_importadas++;
                $atleta_nao_importado .= ", " . $nome;
                continue;
            }
        
            $query_atleta = "INSERT INTO clube_atleta (nome, sobrenome, avaliacao, email, senha) 
                             VALUES (?, ?, ?, ?, ?)";
            $cad_atleta = $conn->prepare($query_atleta);
            $cad_atleta->bind_param("sssss", $nome, $sobrenome, $avaliacao, $email, $senha);
        
            if ($cad_atleta->execute()) {
                $linhas_importadas++;
            } else {
                $linhas_nao_importadas++;
                $atleta_nao_importado .= ", " . ($nome ?? "NULL");
            }
        }
        echo "$linhas_importadas linhas importadas, $linhas_nao_importadas não importadas, Atletas nao importados: $atleta_nao_importado";
    }


    function converter(&$dados_arquivo){
        $dados_arquivo = mb_convert_encoding($dados_arquivo,"UTF-8","ISO-8859-1");
    }
?>