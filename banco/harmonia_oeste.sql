-- ============================================================
-- Banco de dados: harmonia_oeste
-- Trabalho A1.3 - Fundamentos ao Desenvolvimento Web (UNOESC)
-- Aluno: Diego Vinicius Donin Quadrado
--
-- Como usar: no phpMyAdmin, aba "Importar", escolha este arquivo
-- e clique em "Importar". Ele cria o banco, as 3 tabelas e
-- os depoimentos iniciais.
-- ============================================================

SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS harmonia_oeste
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE harmonia_oeste;

-- ------------------------------------------------------------
-- Tabela 1: ORÇAMENTOS (inserção)
-- Guarda os pedidos feitos pelo modal "Solicitar Orçamento"
-- das páginas de Violão, Piano e Bateria.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS orcamentos (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  servico       VARCHAR(60)  NOT NULL,          -- curso escolhido
  nome          VARCHAR(100) NOT NULL,
  email         VARCHAR(120) NOT NULL,
  telefone      VARCHAR(20)  NOT NULL,
  endereco      VARCHAR(150),
  cidade        VARCHAR(80),
  uf            CHAR(2),
  data_desejada DATE,
  observacoes   TEXT,
  data_envio    DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ------------------------------------------------------------
-- Tabela 2: CONTATOS (inserção)
-- Guarda as mensagens do formulário da página Contato.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS contatos (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  nome        VARCHAR(100) NOT NULL,
  email       VARCHAR(120) NOT NULL,
  mensagem    TEXT         NOT NULL,
  data_envio  DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ------------------------------------------------------------
-- Tabela 3: DEPOIMENTOS (listagem + inserção)
-- Os depoimentos da página inicial são carregados daqui.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS depoimentos (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  nome            VARCHAR(100) NOT NULL,
  curso           VARCHAR(60),
  foto            VARCHAR(150),                  -- caminho da imagem (pode ficar vazio)
  texto           TEXT NOT NULL,
  data_depoimento DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Depoimentos que já estavam no site (A1.1)
INSERT INTO depoimentos (nome, curso, foto, texto, data_depoimento) VALUES
('João Pedro', 'Violão e Guitarra', 'img/cliente-joao.jpg',
 'Comecei as aulas de violão do zero aos 35 anos e achei que seria muito difícil. O professor Lucas teve uma paciência incrível e em poucos meses já consigo tocar minhas músicas favoritas nas reuniões de família. A escola é fantástica!',
 '2026-05-15'),
('Camila Santos', 'Piano e Teclado', 'img/cliente-camila.jpg',
 'Minha filha de 8 anos faz teclado com a professora Mariana há um ano. O desenvolvimento da atenção e da coordenação dela melhorou visivelmente. A estrutura da Harmonia do Oeste em Chapecó é sem dúvida a melhor da cidade!',
 '2026-06-22'),
('Felipe Schmidt', 'Bateria e Percussão', 'img/cliente-felipe.jpg',
 'As aulas de bateria são o meu momento de descompressão da semana. Equipamentos top de linha, ambiente super limpo e organizado. Recomendo demais para quem quer aprender de verdade!',
 '2026-08-10'),
('Beatriz Fontana', 'Piano e Teclado', 'img/clinte-beatriz.jpeg',
 'Sempre tive vontade de tocar piano, mas achava que já estava velha demais pra isso. A professora Mariana me mostrou que não existe idade certa: em seis meses já toco as músicas que eu mais gosto de ouvir. Recomendo demais para quem tem receio de começar.',
 '2026-09-02'),
('Gustavo Zanella', 'Violão e Guitarra', 'img/clinte-gustavo.jpeg',
 'Meu filho de 13 anos entrou tímido nas aulas de guitarra e hoje já se apresentou no recital semestral da escola. O professor Lucas tem muita paciência com os adolescentes e sabe motivar de um jeito que faz a diferença.',
 '2026-09-07');
