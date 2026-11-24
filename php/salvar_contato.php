<?php
// ============================================================
// CONTATO - INSERÇÃO
// Recebe a mensagem do formulário de contato e grava na
// tabela "contatos".
// ============================================================

header("Content-Type: application/json; charset=utf-8");
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["sucesso" => false, "mensagem" => "Método não permitido."]);
    exit;
}

$nome     = trim($_POST["nome"] ?? "");
$email    = trim($_POST["email"] ?? "");
$mensagem = trim($_POST["mensagem"] ?? "");

if ($nome === "" || $email === "" || $mensagem === "") {
    http_response_code(400);
    echo json_encode(["sucesso" => false, "mensagem" => "Preencha todos os campos."]);
    exit;
}

$sql  = "INSERT INTO contatos (nome, email, mensagem) VALUES (?, ?, ?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $mensagem);

if ($stmt->execute()) {
    echo json_encode([
        "sucesso"  => true,
        "mensagem" => "Mensagem enviada com sucesso! Responderemos em breve."
    ]);
} else {
    http_response_code(500);
    echo json_encode(["sucesso" => false, "mensagem" => "Erro ao salvar: " . $stmt->error]);
}

$stmt->close();
$conexao->close();
