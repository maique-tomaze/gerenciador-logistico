CREATE DATABASE IF NOT EXISTS gerenciador_logistico
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE gerenciador_logistico;

CREATE TABLE IF NOT EXISTS produtos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT NULL,
    quantidade INT UNSIGNED NOT NULL DEFAULT 0,
    preco DECIMAL(10, 2) UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS enderecos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    rua VARCHAR(150) NOT NULL,
    numero VARCHAR(20) NULL,
    bairro VARCHAR(100) NULL,
    cidade VARCHAR(100) NOT NULL,
    estado CHAR(2) NOT NULL,
    cep VARCHAR(20) NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS transportadores (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    documento VARCHAR(30) NULL,
    telefone VARCHAR(30) NULL,
    veiculo VARCHAR(100) NULL,
    placa VARCHAR(20) NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS fretes (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    transportador_id INT UNSIGNED NOT NULL,
    origem_id INT UNSIGNED NOT NULL,
    destino_id INT UNSIGNED NOT NULL,
    data_frete DATE NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_frete_transportador
        FOREIGN KEY (transportador_id) REFERENCES transportadores (id),
    CONSTRAINT fk_frete_origem
        FOREIGN KEY (origem_id) REFERENCES enderecos (id),
    CONSTRAINT fk_frete_destino
        FOREIGN KEY (destino_id) REFERENCES enderecos (id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS frete_produtos (
    frete_id INT UNSIGNED NOT NULL,
    produto_id INT UNSIGNED NOT NULL,
    quantidade INT UNSIGNED NOT NULL,
    PRIMARY KEY (frete_id, produto_id),
    CONSTRAINT fk_frete_produto_frete
        FOREIGN KEY (frete_id) REFERENCES fretes (id) ON DELETE CASCADE,
    CONSTRAINT fk_frete_produto_produto
        FOREIGN KEY (produto_id) REFERENCES produtos (id)
) ENGINE=InnoDB;
