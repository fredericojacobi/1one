CREATE TABLE Usuario
(
    Id              INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Id_Anexo        INT                   DEFAULT NULL,
    Nome            VARCHAR(255) NOT NULL,
    Sobrenome       VARCHAR(255) NOT NULL,
    DataNascimento  DATE         NOT NULL,
    Cpf             LONG         NOT NULL,
    TipoUsuario     INT          NOT NULL,
    Endereco        VARCHAR(255) NOT NULL,
    Telefone        LONG         NOT NULL,
    Verificado      BOOL                  DEFAULT FALSE,
    Ativo           BOOL         NOT NULL,
    Email           VARCHAR(255) NOT NULL,
    Senha           VARCHAR(100) NOT NULL,
    Id_Permissao    INT                   DEFAULT NULL,
    DataCadastro    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    DataModificacao TIMESTAMP             DEFAULT NULL,
    DataVerificado  TIMESTAMP             DEFAULT NULL,
    FOREIGN KEY (Id_Anexo) REFERENCES Anexo (Id),
    FOREIGN KEY (Id_Permissao) REFERENCES Permissao (Id)
);
INSERT INTO Usuario (Nome, Sobrenome, DataNascimento, Cpf, TipoUsuario, Endereco, Telefone, Ativo, Email, Senha)
VALUES ('Frederico', 'Jacobi', STR_TO_DATE('12/30/1924', '%m/%d/%Y'), 2203938192, 0,
        'Avenida do McDonalds, 666, Batata Frita',
        99332218255, TRUE, 'fred@email.com', 'd0cfc2e5319b82cdc71a33873e826c93d7ee11363f8ac91c4fa3a2cfcd2286e5'),
       ('Helena', 'Jacobi', STR_TO_DATE('09/12/1911', '%m/%d/%Y'), 23228102930, 1,
        'Avenida do McDonalds, 666, Milkshake',
        99332218255, FALSE, 'helena@email.com', 'd0cfc2e5319b82cdc71a33873e826c93d7ee11363f8ac91c4fa3a2cfcd2286e5'),
       ('Luis Henrique', 'Jacobi', STR_TO_DATE('07/12/1957', '%m/%d/%Y'), 00000000000, 1,
        'Avenida do McDonalds, 666, Sundae',
        99332218255, TRUE, 'henrique@email.com', 'd0cfc2e5319b82cdc71a33873e826c93d7ee11363f8ac91c4fa3a2cfcd2286e5');

SELECT * from Usuario
