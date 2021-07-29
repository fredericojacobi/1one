CREATE TABLE Subcategoria
(
    Id              INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Id_Categoria    INT          NOT NULL,
    Nome            VARCHAR(255) NOT NULL,
    Descricao       TEXT                  DEFAULT NULL,
    DataCadastro    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    DataModificacao TIMESTAMP             DEFAULT NULL,
    FOREIGN KEY (Id_Categoria) REFERENCES Categoria (Id)
);

INSERT INTO Subcategoria (Id_Categoria, Nome, Descricao)
VALUES (1, 'Áudio e vídeo', 'Home Theater, Caixas de Som, DVD, Blueray, etc'),
       (1, 'Computadores', 'Notebooks, Desktops, Macbooks'),
       (1, 'Smartphones', 'Smartphones'),
       (2, 'Sofá', 'Sofá'),
       (2, 'Guarda-roupa', 'Guarda-roupa'),
       (2, 'Mesa', 'Mesa'),
       (2, 'Rack', 'Rack'),
       (3, 'Geladeira', 'Geladeira'),
       (3, 'Máquina de lavar', 'Máquina de lavar'),
       (3, 'Máquina de secar', 'Máquina de secar'),
       (3, 'Ar-condicionado', 'Ar-condicionado');