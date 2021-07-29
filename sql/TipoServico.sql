CREATE TABLE TipoServico
(
    Id              INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Id_Categoria    INT          NOT NULL,
    Id_Subcategoria INT          NOT NULL,
    Nome            VARCHAR(255) NOT NULL,
    Descricao       TEXT         NOT NULL,
    FOREIGN KEY (Id_Categoria) REFERENCES Categoria (Id),
    FOREIGN KEY (Id_Subcategoria) REFERENCES Subcategoria (Id)
);

INSERT INTO TipoServico (Id_Categoria, Id_Subcategoria, Nome, Descricao)
VALUES (1, 3, 'Conserto de Celular', 'Bateria, tela, touchscreen, botoes'),
       (1, 2, 'Conserto de Desktop', ''),
       (1, 2, 'Conserto de Notebook', ''),
       (1, 3, 'Conserto de Aparelhos Apple', 'Macbooks, iMacs, Apple Watch, iPhone'),
       (1, 1, 'Conserto de Home Theater', '');