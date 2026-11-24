# Escola de Música Harmonia do Oeste — A1.3

Trabalho A1.3 de Fundamentos ao Desenvolvimento Web (UNOESC), feito por Diego Vinicius Donin Quadrado.
Site de aulas de instrumentos musicais (A1.1) integrado a um banco MySQL com PHP.

## Seções implementadas

| Seção | Tipo | Tabela | PHP | JavaScript |
|---|---|---|---|---|
| Orçamento | Inserção | `orcamentos` | `php/salvar_orcamento.php` | `js/orcamento.js` |
| Contato | Inserção | `contatos` | `php/salvar_contato.php` | `js/contato.js` |
| Depoimentos | Listagem + inserção | `depoimentos` | `php/listar_depoimentos.php`, `php/salvar_depoimento.php` | `js/depoimentos.js` |

`php/conexao.php` faz a conexão com o banco, e `js/funcoes.js` tem as funções comuns (envio com `fetch` e mensagens de retorno).

## Como rodar (XAMPP)

1. Copie a pasta do projeto para `C:\xampp\htdocs\`.
2. No XAMPP Control Panel, inicie o **Apache** e o **MySQL**.
3. Abra `http://localhost/phpmyadmin`, vá em **Importar** e importe `banco/harmonia_oeste.sql`.
4. Acesse `http://localhost/<nome-da-pasta>/index.html`.
