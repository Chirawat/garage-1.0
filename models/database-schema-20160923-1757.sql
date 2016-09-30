-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema quotation
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema quotation
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `quotation` DEFAULT CHARACTER SET utf8 ;
USE `quotation` ;

-- -----------------------------------------------------
-- Table `quotation`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotation`.`customer` (
  `CID` INT(11) NOT NULL AUTO_INCREMENT,
  `fullname` TEXT NULL DEFAULT NULL,
  `type` TEXT NULL DEFAULT NULL,
  `address` TEXT NULL DEFAULT NULL,
  `phone` INT(11) NULL DEFAULT NULL,
  `fax` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`CID`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `quotation`.`employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotation`.`employee` (
  `EID` INT(11) NOT NULL AUTO_INCREMENT,
  `fullname` TEXT NULL DEFAULT NULL,
  `phone` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`EID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `quotation`.`insurance_company`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotation`.`insurance_company` (
  `ICID` INT(11) NOT NULL AUTO_INCREMENT,
  `name` TEXT NULL DEFAULT NULL,
  `address` TEXT NULL DEFAULT NULL,
  `phone` INT(11) NULL DEFAULT NULL,
  `fax` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ICID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `quotation`.`organization`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotation`.`organization` (
  `OID` INT(11) NOT NULL AUTO_INCREMENT,
  `name` TEXT NULL DEFAULT NULL,
  `address` TEXT NULL DEFAULT NULL,
  `phone` INT(11) NULL DEFAULT NULL,
  `fax` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`OID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `quotation`.`viecle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotation`.`viecle` (
  `VID` INT(11) NOT NULL AUTO_INCREMENT,
  `viecle_type` TEXT NULL DEFAULT NULL,
  `plate_no` TEXT NULL DEFAULT NULL,
  `serial` TEXT NULL DEFAULT NULL,
  `viecle_name` TEXT NULL DEFAULT NULL,
  `brand` TEXT NULL DEFAULT NULL,
  `model` TEXT NULL DEFAULT NULL,
  `body_code` TEXT NULL DEFAULT NULL,
  `machine_code` TEXT NULL DEFAULT NULL,
  `model_year` INT(11) NULL DEFAULT NULL,
  `body_type` TEXT NULL DEFAULT NULL,
  `CC` INT(11) NULL DEFAULT NULL,
  `seat` INT(11) NULL DEFAULT NULL,
  `weight` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`VID`))
ENGINE = MyISAM
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `quotation`.`quotation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotation`.`quotation` (
  `QID` INT(11) NOT NULL AUTO_INCREMENT,
  `CID` INT(11) NULL DEFAULT NULL,
  `ICID` INT(11) NULL DEFAULT NULL,
  `EID` INT(11) NULL DEFAULT NULL,
  `quotation_id` TEXT NULL DEFAULT NULL,
  `quotation_date` DATE NULL DEFAULT NULL,
  `claim_no` TEXT NULL DEFAULT NULL,
  `viecle_VID` INT(11) NOT NULL,
  PRIMARY KEY (`QID`),
  INDEX `fk_quotation_customer1_idx` (`CID` ASC),
  INDEX `fk_quotation_insurance_company1_idx` (`ICID` ASC),
  INDEX `fk_quotation_employee1_idx` (`EID` ASC),
  INDEX `fk_quotation_viecle1_idx` (`viecle_VID` ASC),
  CONSTRAINT `fk_quotation_customer1`
    FOREIGN KEY (`CID`)
    REFERENCES `quotation`.`customer` (`CID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_quotation_employee1`
    FOREIGN KEY (`EID`)
    REFERENCES `quotation`.`employee` (`EID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_quotation_insurance_company1`
    FOREIGN KEY (`ICID`)
    REFERENCES `quotation`.`insurance_company` (`ICID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_quotation_viecle1`
    FOREIGN KEY (`viecle_VID`)
    REFERENCES `quotation`.`viecle` (`VID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 24
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `quotation`.`quotation_description`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotation`.`quotation_description` (
  `QDID` INT(11) NOT NULL AUTO_INCREMENT,
  `QID` INT(11) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `type` TEXT NULL DEFAULT NULL,
  `price` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`QDID`),
  INDEX `fk_quotation_description_quotation1_idx` (`QID` ASC),
  CONSTRAINT `fk_quotation_description_quotation1`
    FOREIGN KEY (`QID`)
    REFERENCES `quotation`.`quotation` (`QID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
