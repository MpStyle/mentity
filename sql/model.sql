-- MySQL Script generated by MySQL Workbench
-- gio 17 dic 2015 14:57:10 CET
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user` ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `email` VARCHAR(500) NOT NULL COMMENT '',
  `password` VARCHAR(500) NOT NULL COMMENT '',
  `phone_number` VARCHAR(60) NULL COMMENT '',
  `two_factor_enabled` BIT NOT NULL DEFAULT 0 COMMENT '',
  `lockout_end_date_utc` DATETIME NULL DEFAULT NOW() COMMENT '',
  `lockout_enabled` BIT NOT NULL DEFAULT 0 COMMENT '',
  `access_failed_count` INT NOT NULL DEFAULT 0 COMMENT '',
  `username` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '',
  UNIQUE INDEX `username_UNIQUE` (`username` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `role` ;

CREATE TABLE IF NOT EXISTS `role` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `name_UNIQUE` (`name` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `user_logins`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_logins` ;

CREATE TABLE IF NOT EXISTS `user_logins` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `login_provider` VARCHAR(200) NOT NULL COMMENT '',
  `provider_key` VARCHAR(500) NOT NULL COMMENT '',
  `user_id` VARCHAR(300) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `login_provider_UNIQUE` (`login_provider` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `user_role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_role` ;

CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` INT NOT NULL COMMENT '',
  `user_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`role_id`, `user_id`)  COMMENT '',
  INDEX `fk_user_role_user1_idx` (`user_id` ASC)  COMMENT '',
  CONSTRAINT `fk_user_role_role`
    FOREIGN KEY (`role_id`)
    REFERENCES `role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_role_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `user_user_logins`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_user_logins` ;

CREATE TABLE IF NOT EXISTS `user_user_logins` (
  `user_id` INT NOT NULL COMMENT '',
  `user_logins_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`user_id`, `user_logins_id`)  COMMENT '',
  INDEX `fk_user_user_logins_user_logins1_idx` (`user_logins_id` ASC)  COMMENT '',
  CONSTRAINT `fk_user_user_logins_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_user_logins_user_logins1`
    FOREIGN KEY (`user_logins_id`)
    REFERENCES `user_logins` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- mentity_role_save(?)
DELIMITER //
CREATE PROCEDURE mentity_role_save(
  IN `@name` VARCHAR(255)
)
  BEGIN
    REPLACE INTO role (`name`)
    VALUES (`@name`);

    SELECT LAST_INSERT_ID() AS id;
  END//
DELIMITER ;

-- mentity_user_logins_save(?, ?, ?, ?);
DELIMITER //
CREATE PROCEDURE mentity_user_logins_save(
  IN `@login_provider` VARCHAR(255),
  IN `@provider_key` VARCHAR(255),
  IN `@user_id` VARCHAR(255)
)
  BEGIN
    REPLACE INTO role (`login_provider`,`provider_key`,`user_id`)
    VALUES (`@login_provider`,`@provider_key`,`@user_id`);

    SELECT LAST_INSERT_ID() AS id;
  END//
DELIMITER ;

-- mentity_user_save(?, ?, ?, ?, ?, ?, ?, ?)

-- mentity_role_get(?)
-- mentity_user_logins_get(?)
-- mentity_user_get

-- mentity_role_get_list(?)
-- mentity_user_logins_get_list(?)
-- mentity_user_get_list(?)

-- mentity_user_save_role
-- mentity_user_save_user_logins