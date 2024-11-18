/* 

    Este script estara todas las creaciones de las tablas necesarias para el desarollo del quiz.

*/

CREATE TABLE TipoPropietario (

	idTipoPropietario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipoPropietario VARCHAR(10) NOT NULL
);

CREATE TABLE Aseguradora ( 
    
    idAseguradora INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    nombreAseguradora VARCHAR(30) NOT NULL, 
    polizaSeguro VARCHAR(10) NOT NULL CHECK (polizaSeguro REGEXP '^PS-[0-9]{4}$'), 
    fechaInicio DATE NOT NULL, 
    fechaVencimiento DATE NOT NULL 
); 

CREATE TABLE Propietario (

	idPropietario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombrePropietario VARCHAR(30) NOT NULL,
    cedulaPropietario VARCHAR(10) NOT NULL CHECK (cedulaPropietario REGEXP '^[0-9]{1,2}-[0-9]{3}-[0-9]{3,4}$'),
    contactoPropietario VARCHAR(9) NOT NULL CHECK (contactoPropietario REGEXP '^[0-9]{4}-[0-9]{4}$'),
    direccionPropieatrio VARCHAR(50) NOT NULL,
    idTipoPropietario INT NOT NULL,
    FOREIGN KEY (idTipoPropietario) REFERENCES TipoPropietario (idTipoPropietario)
);

CREATE TABLE TipoVehiculo (

	idTipoVehiculo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipoVehiculo VARCHAR(30) NOT NULL
);

CREATE TABLE TipoCombustible (

	idTipoCombustible INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipoCombustible VARCHAR(20) NOT NULL
);

CREATE TABLE TipoTransmision (
	
    idTipoTransmision INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipoTransmision VARCHAR(20) NOT NULL
);

CREATE TABLE EspecificacionesTecnicas (
  idEspecificacionesTecnicas INT  NOT NULL PRIMARY KEY AUTO_INCREMENT,
  capacidadDelMotor DECIMAL(3,1) NOT NULL,
  numeroCilindros INT NOT NULL,
  pesoVehiculo INT NOT NULL,
  idTipoVehiculo INT NOT NULL,
  idTipoTransmision INT NOT NULL,
  idTipoCombustible INT NOT NULL,
  FOREIGN KEY (idTipoVehiculo) REFERENCES TipoVehiculo (idTipoVehiculo),
  FOREIGN KEY (idTipoTransmision) REFERENCES TipoTransmision (idTipoTransmision),
  FOREIGN KEY (idTipoCombustible) REFERENCES TipoCombustible (idTipoCombustible)

);

CREATE TABLE Vehiculo (

	idVehiculo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    numeroVin VARCHAR(17) NOT NULL,
    numeroPlaca VARCHAR(6) NOT NULL,
    modeloVehiculo VARCHAR(15) NOT NULL,
    marcaVehiculo VARCHAR(15) NOT NULL,
    colorVehiculo  VARCHAR(10) NOT NULL,
    fechaFabricacion DATE NOT NULL,
    idEspecificacionesTecnicas INT NOT NULL,
    idPropietario INT NOT NULL,
    idAseguradora INT NOT NULL,
    FOREIGN KEY (idEspecificacionesTecnicas) REFERENCES EspecificacionesTecnicas (idEspecificacionesTecnicas),
    FOREIGN KEY (idPropietario) REFERENCES Propietario (idPropietario),
    FOREIGN KEY (idAseguradora) REFERENCES Aseguradora (idAseguradora)
    
);




