CREATE TABLE Categoria
(
    Id              INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nome            VARCHAR(255) NOT NULL,
    Descricao       TEXT                  DEFAULT NULL,
    DataCadastro    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    DataModificacao TIMESTAMP             DEFAULT NULL
);

INSERT INTO Categoria (Nome, Descricao)
VALUES ('Eletrônicos', 'Áudio, vídeo, computadores, smartphones, etc'),
       ('Móveis', 'Guarda roupas, Sofás, Mesas, Racks, etc'),
       ('Eletrodomésticos', 'Geladeiras, Máquinas de lavar e secar, Ar-condicionados, Fogões, Lava louças, etc');