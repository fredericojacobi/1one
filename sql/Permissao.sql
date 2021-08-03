CREATE TABLE Permissao
(
    Id        INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nome      VARCHAR(30)  NOT NULL,
    Nivel     INT UNSIGNED NOT NULL DEFAULT 0,
    Categoria VARCHAR(30)  NOT NULL DEFAULT 0
);

INSERT INTO Permissao
    (Nome, Nivel, Categoria)
VALUES ('Inativo', 0, 'Parceiro'),
       ('Inativo', 0, 'Cliente'),
       ('Basico', 1, 'Parceiro'),
       ('Basico', 1, 'Cliente'),
       ('Admin', 99, 'Admin');

select * from Permissao