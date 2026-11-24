<?php
// ============================================================
// Conexão com o banco de dados MySQL (XAMPP)
// Este arquivo é incluído em todos os outros arquivos PHP.
// ============================================================

$servidor = "localhost";
$usuario  = "root";        // usuário padrão do XAMPP
$senha    = "";            // no XAMPP a senha do root vem vazia
$banco    = "harmonia_oeste";

// Cria a conexão usando mysqli
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Se der erro, devolve uma resposta JSON e para o script
if ($conexao->connect_error) {
    header("Content-Type: application/json; charset=utf-8");
    http_response_code(500);
    echo json_encode([
        "sucesso"  => false,
        "mensagem" => "Erro ao conectar no banco: " . $conexao->connect_error
    ]);
    exit;
}

// Garante que acentos (ç, ã, é...) sejam gravados e lidos corretamente
$conexao->set_charset("utf8mb4");
