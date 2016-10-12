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
  `taxpayer_id` INT(11) NULL DEFAULT NULL COMMENT 'เลขประจำตัวผู้เสียภาษี',
  PRIMARY KEY (`CID`))
ENGINE = InnoDB
AUTO_INCREMENT = 346
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `quotation`.`viecle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotation`.`viecle` (
  `VID` INT(11) NOT NULL AUTO_INCREMENT,
  `viecle_type` TEXT NULL DEFAULT NULL COMMENT 'ชนิดรถยนต์',
  `plate_no` TEXT NULL DEFAULT NULL COMMENT 'เลขทะเบียน',
  `viecle_name` TEXT NULL DEFAULT NULL COMMENT 'ชื่อรถยนต์',
  `brand` TEXT NULL DEFAULT NULL COMMENT 'ยี่ห้อ',
  `model` TEXT NULL DEFAULT NULL COMMENT 'รุ่น',
  `body_code` TEXT NULL DEFAULT NULL COMMENT 'เลขตัวถัง',
  `engin_code` TEXT NULL DEFAULT NULL COMMENT 'เลขเครื่องยนต์',
  `viecle_year` INT(11) NULL DEFAULT NULL COMMENT 'ปี',
  `body_type` TEXT NULL DEFAULT NULL COMMENT 'แบบตัวถัง',
  `cc` INT(11) NULL DEFAULT NULL COMMENT 'ซีซี',
  `seat` INT(11) NULL DEFAULT NULL COMMENT 'ที่นั่ง',
  `weight` INT(11) NULL DEFAULT NULL COMMENT 'น้ำหนักรวม',
  PRIMARY KEY (`VID`))
ENGINE = InnoDB
AUTO_INCREMENT = 219
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `quotation`.`quotation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotation`.`quotation` (
  `QID` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสใบเสนอราคา',
  `CID` INT(11) NULL DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `VID` INT(11) NULL DEFAULT NULL COMMENT 'รหัสรถ',
  `Employee` TEXT NULL DEFAULT NULL COMMENT 'พนักงาน',
  `TID` INT(11) NULL DEFAULT NULL,
  `quotation_id` TEXT NULL DEFAULT NULL COMMENT 'รหัสใบเสนอราคาอ้างอิง',
  `quotation_date` DATE NULL DEFAULT NULL COMMENT 'วันทีทำรายการ',
  `claim_no` TEXT NULL DEFAULT NULL COMMENT 'เลขที่เคลม',
  PRIMARY KEY (`QID`),
  INDEX `fk_quotation_customer1_idx` (`CID` ASC),
  INDEX `fk_quotation_test1_idx` (`VID` ASC),
  CONSTRAINT `fk_quotation_customer1`
    FOREIGN KEY (`CID`)
    REFERENCES `quotation`.`customer` (`CID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_quotation_test1`
    FOREIGN KEY (`VID`)
    REFERENCES `quotation`.`viecle` (`VID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 162
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `quotation`.`description`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotation`.`description` (
  `DID` INT(11) NOT NULL AUTO_INCREMENT,
  `QID` INT(11) NOT NULL,
  `row` INT(11) NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL COMMENT 'รายการ',
  `type` TEXT NULL DEFAULT NULL COMMENT 'ประเภท',
  `price` FLOAT NULL DEFAULT NULL COMMENT 'ราคา',
  PRIMARY KEY (`DID`),
  INDEX `fk_quotation_description_quotation1_idx` (`QID` ASC),
  CONSTRAINT `fk_quotation_description_quotation1`
    FOREIGN KEY (`QID`)
    REFERENCES `quotation`.`quotation` (`QID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 451
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `quotation`.`invoice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotation`.`invoice` (
  `IID` INT(11) NOT NULL AUTO_INCREMENT,
  `CID` INT(11) NOT NULL,
  `invoice_id` TEXT NULL DEFAULT NULL,
  `date` DATE NULL DEFAULT NULL,
  `employee` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`IID`),
  INDEX `fk_invoice_customer1_idx` (`CID` ASC),
  CONSTRAINT `fk_invoice_customer1`
    FOREIGN KEY (`CID`)
    REFERENCES `quotation`.`customer` (`CID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 56
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `quotation`.`invoice_description`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotation`.`invoice_description` (
  `idid` INT(11) NOT NULL AUTO_INCREMENT,
  `IID` INT(11) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `price` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idid`, `IID`),
  INDEX `fk_invoice_description_invoice1_idx` (`IID` ASC),
  CONSTRAINT `fk_invoice_description_invoice1`
    FOREIGN KEY (`IID`)
    REFERENCES `quotation`.`invoice` (`IID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 130
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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
