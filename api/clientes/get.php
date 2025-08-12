<?php

    

    if ($acao === 'lista') {

        // Buscar todos os clientes
        if ($param === '') {
            $rs = $db->prepare("SELECT * FROM clientes ORDER BY nome");
            $rs->execute();
            $dados = $rs->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                "dados" => $dados ?: 'Não existem dados'
            ]);
            exit;
        }

        // Buscar cliente por ID
        if ($param !== '') {
            $rs = $db->prepare("SELECT * FROM clientes WHERE id = :id");
            $rs->bindParam(':id', $param, PDO::PARAM_INT);
            $rs->execute();
            $cliente = $rs->fetchObject();

            echo json_encode([
                "dados" => $cliente ?: 'Não existem dados'
            ]);
            exit;
        }
    }

    // Se a ação não for reconhecida
    echo json_encode(["erro" => "Ação inválida"]);
    exit;