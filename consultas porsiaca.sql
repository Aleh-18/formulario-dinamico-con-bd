//Tabla de los atos del selectdatos

CREATE database selectdatos;

CREATE TABLE SelectValues (
    idDato INT AUTO_INCREMENT PRIMARY KEY,
    dato VARCHAR(255)
);


insert into SelectValues (dato) values ("El oso polar");
insert into SelectValues (dato) values ("Biodiversidad");
insert into SelectValues (dato) values ("Soluciones");
insert into SelectValues (dato) values ("Datos");


//Tabla para recoger lo que envia el usuario del formulario sin checkbox aun
// porque puede poner multiples opciones

CREATE TABLE datosformulario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    pw VARCHAR(100) NOT NULL,
    radio_opcion VARCHAR(50) NOT NULL,
    seleccionFK INT,
    sugerencias VARCHAR(500) NOT NULL,
    CONSTRAINT fk_seleccion FOREIGN KEY (seleccionFK) REFERENCES SelectValues(idDato) ON DELETE CASCADE
);



//Creando todo lo necesario para que el checkbox sea dinamico y tmb teniendo en cuenta la multiple seleccion de estos

CREATE TABLE CheckboxValues (
    idCheckbox INT AUTO_INCREMENT PRIMARY KEY,
    valor VARCHAR(255)
);

INSERT INTO CheckboxValues (valor) VALUES ("Reciclaje");
INSERT INTO CheckboxValues (valor) VALUES ("Reducir el uso de plásticos");
INSERT INTO CheckboxValues (valor) VALUES ("Usar transporte sostenible");
INSERT INTO CheckboxValues (valor) VALUES ("Ahorrar energía en casa");


//Tabla intermedia para el multivaluado checkbox
CREATE TABLE FormularioCheckbox (
    idFormulario INT,
    idCheckbox INT,
    PRIMARY KEY (idFormulario, idCheckbox),
    CONSTRAINT fk_formulario FOREIGN KEY (idFormulario) REFERENCES datosformulario(id) ON DELETE CASCADE,
    CONSTRAINT fk_checkbox FOREIGN KEY (idCheckbox) REFERENCES CheckboxValues(idCheckbox) ON DELETE CASCADE
);


