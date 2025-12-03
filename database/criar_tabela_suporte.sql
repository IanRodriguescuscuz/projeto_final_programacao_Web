-- Tabela para armazenar mensagens de suporte
CREATE TABLE IF NOT EXISTS mensagens_suporte (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    assunto VARCHAR(100) NOT NULL,
    mensagem TEXT NOT NULL,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('novo', 'em_atendimento', 'respondido', 'fechado') DEFAULT 'novo',
    resposta_admin TEXT,
    data_resposta DATETIME,
    INDEX (email),
    INDEX (status),
    INDEX (data_envio)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
