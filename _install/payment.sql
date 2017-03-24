CREATE TABLE `mini`.`payment` CHARACTER SET utf8 COLLATE utf8_general_ci(
  `id` INT NOT NULL auto_increment,
  `category_id` INT NOT NULL,
  `direct_id` INT NOT NULL,
  `summ` FLOAT NOT NULL,
  `date` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

CREATE TABLE `mini`.`category` CHARACTER SET utf8 COLLATE utf8_general_ci(
  `id` INT NOT NULL auto_increment,
  `name` VARCHAR(100) NOT NULL DEFAULT 'null',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

CREATE TABLE `mini`.`direct` CHARACTER SET utf8 COLLATE utf8_general_ci(
  `id` INT NOT NULL auto_increment,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

ALTER TABLE `mini`.`payment`
ADD INDEX `fk_payment_direct_idx` (`direct_id` ASC),
ADD INDEX `fk_payment_category_idx` (`category_id` ASC);
ALTER TABLE `mini`.`payment`
ADD CONSTRAINT `fk_payment_direct`
  FOREIGN KEY (`direct_id`)
  REFERENCES `mini`.`direct` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_payment_category`
  FOREIGN KEY (`category_id`)
  REFERENCES `mini`.`category` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `mini`.`payment`
CHANGE COLUMN `date` `date` VARCHAR(20) NULL DEFAULT NULL ;
