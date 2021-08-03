CREATE TABLE Servico
(
    Id              INT           NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Id_Usuario      INT           NOT NULL,
    Id_TipoServico  INT           NOT NULL,
    Titulo          VARCHAR(255)  NOT NULL,
    DescricaoCurta  VARCHAR(120)  NOT NULL,
    DescricaoLonga  TEXT          NOT NULL,
    ValorDesejado   DECIMAL(6, 2) NOT NULL,
    DataExpiracao   DATE          NOT NULL,
    DataCadastro    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    DataModificacao TIMESTAMP              DEFAULT NULL,
    FOREIGN KEY (Id_Usuario) REFERENCES Usuario (Id),
    FOREIGN KEY (Id_TipoServico) REFERENCES TipoServico (Id)
);

INSERT INTO Servico (Id_Usuario, Id_TipoServico, Titulo, DescricaoCurta, DescricaoLonga, ValorDesejado, DataExpiracao)
VALUES (1, 1, 'Consertar Samsung S20', 'Tela quebrada', 'Caiu a tela no chao e preciso trocar o display inteiro', 200,
        '2021-08-02'),
       (2, 4, 'Consertar Apple SE', 'Wifi nao funciona', 'Antena de wifi parou de funcionar de repente', 120,
        '2021-08-05'),
       (3, 3, 'Consertar LG Gram', 'Entrada USB nao funciona',
        'Quando reiniciei parou de funcionar uma das entradas USB', 400, '2021-08-02');
