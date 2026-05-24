-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`tutor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tutor` (
  `idtutor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `telefone` VARCHAR(11) NOT NULL,
  `endereco` VARCHAR(200) NOT NULL,
  `bairro` VARCHAR(200) NOT NULL,
  `cidade` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idtutor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `senha` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`pet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`pet` (
  `idpet` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `especie` VARCHAR(200) NOT NULL,
  `cor` VARCHAR(45) NOT NULL,
  `sexo` VARCHAR(1) NOT NULL,
  `tutor_idtutor` INT NOT NULL,
  PRIMARY KEY (`idpet`, `tutor_idtutor`),
  INDEX `fk_pet_tutor_idx` (`tutor_idtutor` ASC),
  CONSTRAINT `fk_pet_tutor`
    FOREIGN KEY (`tutor_idtutor`)
    REFERENCES `mydb`.`tutor` (`idtutor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`atendimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`atendimento` (
  `idatendimento` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idatendimento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`consulta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`consulta` (
  `idconsulta` INT NOT NULL AUTO_INCREMENT,
  `data_consulta` DATETIME NOT NULL,
  `atendimento_idatendimento` INT NOT NULL,
  `pet_idpet` INT NOT NULL,
  `pet_tutor_idtutor` INT NOT NULL,
  PRIMARY KEY (`idconsulta`, `atendimento_idatendimento`, `pet_idpet`, `pet_tutor_idtutor`),
  INDEX `fk_consulta_atendimento1_idx` (`atendimento_idatendimento` ASC),
  INDEX `fk_consulta_pet1_idx` (`pet_idpet` ASC, `pet_tutor_idtutor` ASC),
  CONSTRAINT `fk_consulta_atendimento1`
    FOREIGN KEY (`atendimento_idatendimento`)
    REFERENCES `mydb`.`atendimento` (`idatendimento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_consulta_pet1`
    FOREIGN KEY (`pet_idpet` , `pet_tutor_idtutor`)
    REFERENCES `mydb`.`pet` (`idpet` , `tutor_idtutor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
