<?php
// ============================================================
// DEPOIMENTOS - LISTAGEM
// Busca os depoimentos na tabela "depoimentos" e devolve em
// formato JSON para o JavaScript montar os cards na página.
// ============================================================

header("Content-Type: application/json; charset=utf-8");
require "conexao.php";

// Do mais recente para o mais antigo
$sql = "SELECT id, nome, curso, foto, texto,
               DATE_FORMAT(data_depoimento, '%d/%m/%Y') AS data
        FROM depoimentos
        ORDER BY data_depoimento DESC, id DESC";

$resultado = $conexao->query($sql);

$depoimentos = [];
while ($linha = $resultado->fetch_assoc()) {
    $depoimentos[] = $linha;   // adiciona cada linha no array
}

echo json_encode($depoimentos);

$conexao->close();
