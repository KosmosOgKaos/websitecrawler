SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `vegbuinn` ;
CREATE SCHEMA IF NOT EXISTS `vegbuinn` DEFAULT CHARACTER SET utf8 COLLATE utf8_icelandic_ci ;
USE `vegbuinn` ;

-- -----------------------------------------------------
-- Table `vegbuinn`.`Location`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vegbuinn`.`Location` ;

CREATE  TABLE IF NOT EXISTS `vegbuinn`.`Location` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `address` VARCHAR(70) NULL ,
  `town` VARCHAR(70) NULL ,
  `email` VARCHAR(100) NULL ,
  `website` VARCHAR(100) NULL ,
  `phone` VARCHAR(10) NULL ,
  `fax` VARCHAR(10) NULL ,
  `rooms` SMALLINT NULL ,
  `beds` SMALLINT NULL ,
  `x_coords_ja` DOUBLE NULL ,
  `y_coords_ja` DOUBLE NULL ,
  `x_coords_google` DOUBLE NULL ,
  `y_coords_google` DOUBLE NULL ,
  `avatar` VARCHAR(100) NULL ,
  `safename` VARCHAR(100) NULL ,
  `source` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `safename_UNIQUE` (`safename` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vegbuinn`.`LocationTranslate`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vegbuinn`.`LocationTranslate` ;

CREATE  TABLE IF NOT EXISTS `vegbuinn`.`LocationTranslate` (
  `location_id` INT UNSIGNED NOT NULL ,
  `region` CHAR(5) NOT NULL ,
  `name` VARCHAR(100) NULL ,
  `description` TEXT NULL ,
  `source_url` VARCHAR(255) NULL ,
  PRIMARY KEY (`region`, `location_id`) ,
  INDEX `fk_LocationTranslate_Location1` (`location_id` ASC) ,
  CONSTRAINT `fk_LocationTranslate_Location1`
    FOREIGN KEY (`location_id` )
    REFERENCES `vegbuinn`.`Location` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vegbuinn`.`LocationIsOpen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vegbuinn`.`LocationIsOpen` ;

CREATE  TABLE IF NOT EXISTS `vegbuinn`.`LocationIsOpen` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `location_id` INT UNSIGNED NOT NULL ,
  `day_id` INT UNSIGNED NOT NULL ,
  `hours` TIME NULL ,
  PRIMARY KEY (`id`, `location_id`) ,
  INDEX `fk_LocationIsOpen_Location1` (`location_id` ASC) ,
  CONSTRAINT `fk_LocationIsOpen_Location1`
    FOREIGN KEY (`location_id` )
    REFERENCES `vegbuinn`.`Location` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vegbuinn`.`LocationIsOpenTranslate`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vegbuinn`.`LocationIsOpenTranslate` ;

CREATE  TABLE IF NOT EXISTS `vegbuinn`.`LocationIsOpenTranslate` (
  `locationisopen_id` INT UNSIGNED NOT NULL ,
  `region` CHAR(5) NOT NULL ,
  `day` VARCHAR(45) NULL ,
  PRIMARY KEY (`region`, `locationisopen_id`) ,
  INDEX `fk_LocationIsOpenTranslate_LocationIsOpen1` (`locationisopen_id` ASC) ,
  CONSTRAINT `fk_LocationIsOpenTranslate_LocationIsOpen1`
    FOREIGN KEY (`locationisopen_id` )
    REFERENCES `vegbuinn`.`LocationIsOpen` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vegbuinn`.`Event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vegbuinn`.`Event` ;

CREATE  TABLE IF NOT EXISTS `vegbuinn`.`Event` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `location_id` INT UNSIGNED NOT NULL ,
  `when` TIME NULL ,
  `howmuch` DOUBLE NULL ,
  `currency` VARCHAR(3) NULL ,
  PRIMARY KEY (`id`, `location_id`) ,
  INDEX `fk_Event_Location1` (`location_id` ASC) ,
  CONSTRAINT `fk_Event_Location1`
    FOREIGN KEY (`location_id` )
    REFERENCES `vegbuinn`.`Location` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vegbuinn`.`EventTranslation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vegbuinn`.`EventTranslation` ;

CREATE  TABLE IF NOT EXISTS `vegbuinn`.`EventTranslation` (
  `event_id` INT UNSIGNED NOT NULL ,
  `region` CHAR(5) NULL ,
  `name` VARCHAR(100) NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`event_id`) ,
  INDEX `fk_EventTranslation_Event1` (`event_id` ASC) ,
  CONSTRAINT `fk_EventTranslation_Event1`
    FOREIGN KEY (`event_id` )
    REFERENCES `vegbuinn`.`Event` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vegbuinn`.`Picture`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vegbuinn`.`Picture` ;

CREATE  TABLE IF NOT EXISTS `vegbuinn`.`Picture` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vegbuinn`.`Picture_has_Location`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vegbuinn`.`Picture_has_Location` ;

CREATE  TABLE IF NOT EXISTS `vegbuinn`.`Picture_has_Location` (
  `pictures_id` INT UNSIGNED NOT NULL ,
  `location_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`pictures_id`, `location_id`) ,
  INDEX `fk_Pictures_has_Location_Pictures` (`pictures_id` ASC) ,
  INDEX `fk_Pictures_has_Location_Location1` (`location_id` ASC) ,
  CONSTRAINT `fk_Pictures_has_Location_Pictures`
    FOREIGN KEY (`pictures_id` )
    REFERENCES `vegbuinn`.`Picture` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pictures_has_Location_Location1`
    FOREIGN KEY (`location_id` )
    REFERENCES `vegbuinn`.`Location` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vegbuinn`.`PictureTranslate`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vegbuinn`.`PictureTranslate` ;

CREATE  TABLE IF NOT EXISTS `vegbuinn`.`PictureTranslate` (
  `picture_id` INT UNSIGNED NOT NULL ,
  `region` CHAR(5) NOT NULL ,
  `caption` VARCHAR(255) NULL ,
  PRIMARY KEY (`picture_id`, `region`) ,
  INDEX `fk_PictureTranslate_Picture1` (`picture_id` ASC) ,
  CONSTRAINT `fk_PictureTranslate_Picture1`
    FOREIGN KEY (`picture_id` )
    REFERENCES `vegbuinn`.`Picture` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vegbuinn`.`LinkCollection`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vegbuinn`.`LinkCollection` ;

CREATE  TABLE IF NOT EXISTS `vegbuinn`.`LinkCollection` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `href` VARCHAR(255) NULL ,
  `visited` TINYINT NULL DEFAULT 0 ,
  `id_location` INT UNSIGNED NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vegbuinn`.`CategoryTranslate`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vegbuinn`.`CategoryTranslate` ;

CREATE  TABLE IF NOT EXISTS `vegbuinn`.`CategoryTranslate` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `region` CHAR(5) NOT NULL ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`, `region`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vegbuinn`.`Location_has_CategoryTranslate`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vegbuinn`.`Location_has_CategoryTranslate` ;

CREATE  TABLE IF NOT EXISTS `vegbuinn`.`Location_has_CategoryTranslate` (
  `location_id` INT UNSIGNED NOT NULL ,
  `categorytranslate_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`location_id`, `categorytranslate_id`) ,
  INDEX `fk_Location_has_CategoryTranslate_CategoryTranslate1` (`categorytranslate_id` ASC) ,
  INDEX `fk_Location_has_CategoryTranslate_Location1` (`location_id` ASC) ,
  CONSTRAINT `fk_Location_has_CategoryTranslate_Location1`
    FOREIGN KEY (`location_id` )
    REFERENCES `vegbuinn`.`Location` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Location_has_CategoryTranslate_CategoryTranslate1`
    FOREIGN KEY (`categorytranslate_id` )
    REFERENCES `vegbuinn`.`CategoryTranslate` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
