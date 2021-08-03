CREATE TABLE Anexo
(
    Id                  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Cpf                 VARCHAR(255) DEFAULT NULL,
    AntecedenteCriminal VARCHAR(255) DEFAULT NULL,
    Foto                VARCHAR(255) DEFAULT NULL
);

INSERT INTO Anexo (Cpf, AntecedenteCriminal, Foto)
VALUES ('/src/docs/cpf/20210721224122_cpf',
        '/src/docs/ac/20210721224123_ac',
        'src/docs/fotos/20210721224123_fotos');