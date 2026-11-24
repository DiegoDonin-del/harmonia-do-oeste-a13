<?php
// ============================================================
// ORÇAMENTO - INSERÇÃO
// Recebe os dados do formulário de orçamento (enviados pelo
// JavaScript via fetch) e grava na tabela "orcamentos".
// ============================================================

header("Content-Type: application/json; charset=utf-8");
require "conexao.php";

// Só aceita envio pelo método POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["sucesso" => false, "mensagem" => "Método não permitido."]);
    exit;
}

// Pega os campos enviados. O "?? ''" evita erro se o campo não vier.
$servico     = trim($_POST["servico"] ?? "");
$nome        = trim($_POST["nome"] ?? "");
$email       = trim($_POST["email"] ?? "");
$telefone    = trim($_POST["telefone"] ?? "");
$endereco    = trim($_POST["endereco"] ?? "");
$cidade      = trim($_POST["cidade"] ?? "");
$uf          = strtoupper(trim($_POST["uf"] ?? ""));
$dataDesejada = $_POST["data_desejada"] ?? "";
$observacoes = trim($_POST["observacoes"] ?? "");

// Validação dos campos obrigatórios
if ($servico === "" || $nome === "" || $email === "" || $telefone === "") {
    http_response_code(400);
    echo json_encode(["sucesso" => false, "mensagem" => "Preencha nome, e-mail e telefone."]);
    exit;
}

// Data é opcional: se veio vazia, grava NULL no banco
if ($dataDesejada === "") {
    $dataDesejada = null;
}

// Prepared statement: os "?" são substituídos pelos valores com segurança
// (isso evita SQL Injection)
$sql = "INSERT INTO orcamentos
          (servico, nome, email, telefone, endereco, cidade, uf, data_desejada, observacoes)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conexao->prepare($sql);
// "sssssssss" = 9 parâmetros do tipo string
$stmt->bind_param("sssssssss",
    $servico, $nome, $email, $telefone, $endereco, $cidade, $uf, $dataDesejada, $observacoes);

if ($stmt->execute()) {
    echo json_encode([
        "sucesso"  => true,
        "mensagem" => "Solicitação enviada! Entraremos em contato em breve.",
        "id"       => $stmt->insert_id
    ]);
} else {
    http_response_code(500);
    echo json_encode(["sucesso" => false, "mensagem" => "Erro ao salvar: " . $stmt->error]);
}

$stmt->close();
$conexao->close();
