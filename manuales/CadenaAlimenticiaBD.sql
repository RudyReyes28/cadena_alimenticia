CREATE SCHEMA `cadena_alimenticia` ;


CREATE TABLE `cadena_alimenticia`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nombre_usuario` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idusuario`), PRIMARY KEY (`nombre_usuario`));
  
CREATE TABLE `cadena_alimenticia`.`minijuegos` (
  `idminijuegos` INT NOT NULL AUTO_INCREMENT,
  `nombre_juego` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idminijuegos`));  
  
 CREATE TABLE `cadena_alimenticia`.`productores` (
  `idproductores` INT NOT NULL AUTO_INCREMENT,
  `idminijuego` INT NOT NULL,
  `idusuario` INT NOT NULL,
  `soles` INT NOT NULL,
  `puntaje` INT NOT NULL,
  `tiempo` INT NOT NULL,
  PRIMARY KEY (`idproductores`),
  INDEX `fk_minijuego_idx` (`idminijuego` ASC) VISIBLE,
  INDEX `fk_usuario_idx` (`idusuario` ASC) VISIBLE,
  CONSTRAINT `fk_minijuego`
    FOREIGN KEY (`idminijuego`)
    REFERENCES `cadena_alimenticia`.`minijuegos` (`idminijuegos`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_usuario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `cadena_alimenticia`.`usuario` (`idusuario`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT); 
    
CREATE TABLE `cadena_alimenticia`.`consumidores` (
  `idconsumidores` INT NOT NULL AUTO_INCREMENT,
  `idminijuego` INT NOT NULL,
  `idusuario` INT NOT NULL,
  `peces` INT NOT NULL,
  `tiburones` INT NOT NULL,
  `tiempo` INT NOT NULL,
  PRIMARY KEY (`idconsumidores`),
  INDEX `fk_minijuego_con_idx` (`idminijuego` ASC) VISIBLE,
  INDEX `fk_usuario_con_idx` (`idusuario` ASC) VISIBLE,
  CONSTRAINT `fk_minijuego_con`
    FOREIGN KEY (`idminijuego`)
    REFERENCES `cadena_alimenticia`.`minijuegos` (`idminijuegos`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_usuario_con`
    FOREIGN KEY (`idusuario`)
    REFERENCES `cadena_alimenticia`.`usuario` (`idusuario`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);
    
    
  CREATE TABLE `cadena_alimenticia`.`descomponedores` (
  `iddescomponedores` INT NOT NULL AUTO_INCREMENT,
  `idminijuego` INT NOT NULL,
  `idusuario` INT NOT NULL,
  `puntaje` INT NOT NULL,
  `tiempo` INT NOT NULL,
  INDEX `fk_minijuego_descom_idx` (`idminijuego` ASC) VISIBLE,
  INDEX `fk_usuario_descom_idx` (`idusuario` ASC) VISIBLE,
  PRIMARY KEY (`iddescomponedores`),
  CONSTRAINT `fk_minijuego_descom`
    FOREIGN KEY (`idminijuego`)
    REFERENCES `cadena_alimenticia`.`minijuegos` (`idminijuegos`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_usuario_descom`
    FOREIGN KEY (`idusuario`)
    REFERENCES `cadena_alimenticia`.`usuario` (`idusuario`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);  
    
INSERT INTO minijuegos  (nombre_juego) VALUES ('productores');
INSERT INTO minijuegos  (nombre_juego) VALUES ('consumidores');
INSERT INTO minijuegos  (nombre_juego) VALUES ('descomponedores');


