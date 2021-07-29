CREATE TABLE Usuario
(
    Id              INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Id_Anexo        INT                   DEFAULT NULL,
    Nome            VARCHAR(255) NOT NULL,
    Sobrenome       VARCHAR(255) NOT NULL,
    DataNascimento  DATE         NOT NULL,
    Cpf             LONG         NOT NULL,
    TipoUsuario     INT(1)       NOT NULL,
    Endereco        VARCHAR(255) NOT NULL,
    Telefone        LONG         NOT NULL,
    Verificado      BOOL                  DEFAULT FALSE,
    DataCadastro    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    DataModificacao TIMESTAMP             DEFAULT NULL,
    DataVerificado  TIMESTAMP             DEFAULT NULL,
    FOREIGN KEY (Id_Anexo) REFERENCES Anexo (Id)
);

INSERT INTO Usuario (Nome, Sobrenome, DataNascimento, Cpf, TipoUsuario, Endereco, Telefone)
VALUES ('Frederico', 'Jacobi', STR_TO_DATE('02/05/1994', '%m/%d/%Y'), 85914673020, 0, 'Avenida Cai, 546, Quarto 3',
        51997522673),
       ('Helena', 'Jacobi', STR_TO_DATE('07/09/1958', '%m/%d/%Y'), 68893418053, 1, 'Avenida Cai, 546, Quarto 1',
        51999839043),
       ('Luis Henrique', 'Jacobi', STR_TO_DATE('07/12/1957', '%m/%d/%Y'), 00000000000, 1, 'Avenida Cai, 546, Quarto 1',
        51999673336);
INSERT INTO Anexo (Cpf, AntecedenteCriminal, Foto)
VALUES ('/src/docs/cpf/20210721224122_cpf',
        '/src/docs/ac/20210721224123_ac',
        'src/docs/fotos/20210721224123_fotos');