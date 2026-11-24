<?php
// ============================================================
// DEPOIMENTOS - INSERÇÃO
// Recebe um novo depoimento enviado pelo aluno e grava na
// tabela "depoimentos".
// ============================================================

header("Content-Type: application/json; charset=utf-8");
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["sucesso" => false, "mensagem" => "Método não permitido."]);
    exit;
}

$nome  = trim($_POST["nome"] ?? "");
$curso = trim($_POST["curso"] ?? "");
$texto = trim($_POST["texto"] ?? "");

if ($nome === "" || $texto === "") {
    http_response_code(400);
    echo json_encode(["sucesso" => false, "mensagem" => "Informe seu nome e o depoimento."]);
    exit;
}

// Novos depoimentos não têm foto: o JavaScript mostra um ícone no lugar.
// A data é preenchida automaticamente pelo banco (DEFAULT CURRENT_TIMESTAMP).
$sql  = "INSERT INTO depoimentos (nome, curso, texto) VALUES (?, ?, ?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("sss", $nome, $curso, $texto);

if ($stmt->execute()) {
    echo json_encode(["sucesso" => true, "mensagem" => "Obrigado! Seu depoimento foi publicado."]);
} else {
    http_response_code(500);
    echo json_encode(["sucesso" => false, "mensagem" => "Erro ao salvar: " . $stmt->error]);
}

$stmt->close();
$conexao->close();
