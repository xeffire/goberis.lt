DROP TABLE IF EXISTS Vartotojai;
DROP TABLE IF EXISTS Vertinimas;
DROP TABLE IF EXISTS Cart;
DROP TABLE IF EXISTS Items;
DROP TABLE IF EXISTS PrimaryCategory;
DROP TABLE IF EXISTS SecondaryCategory;

CREATE TABLE `Vartotojai` (
	`id` INT(5) NOT NULL AUTO_INCREMENT,
	`vardas` VARCHAR(225) NOT NULL,
	`pavarde` VARCHAR(225) NOT NULL,
	`slaptazodis` VARCHAR(128) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Vertinimas` (
	`vartotojoId` INT(5) NOT NULL,
	`vertinimas` INT(3) NOT NULL
);

CREATE TABLE `Items` (
	`id` INT(5) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`price` INT(5) NOT NULL,
	`img` VARCHAR(255) NOT NULL,
	`primaryCategory` INT(5) NOT NULL,
	`secondaryCategory` INT(5),
	PRIMARY KEY (`id`)
);

CREATE TABLE `Cart` (
	`userId` INT(5) NOT NULL,
	`itemId` INT(5) NOT NULL
);

CREATE TABLE `PrimaryCategory` (
	`id` INT(5) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(225) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `SecondaryCategory` (
	`id` INT(5) NOT NULL AUTO_INCREMENT,
	`primaryId` INT(5) NOT NULL,
	`name` VARCHAR(225) NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `Vertinimas` ADD CONSTRAINT `Vertinimas_fk0` FOREIGN KEY (`vartotojoId`) REFERENCES `Vartotojai`(`id`);

ALTER TABLE `Items` ADD CONSTRAINT `Items_fk0` FOREIGN KEY (`primaryCategory`) REFERENCES `PrimaryCategory`(`id`);

ALTER TABLE `Items` ADD CONSTRAINT `Items_fk1` FOREIGN KEY (`secondaryCategory`) REFERENCES `SecondaryCategory`(`id`);

ALTER TABLE `Cart` ADD CONSTRAINT `Cart_fk0` FOREIGN KEY (`userId`) REFERENCES `Vartotojai`(`id`);

ALTER TABLE `Cart` ADD CONSTRAINT `Cart_fk1` FOREIGN KEY (`itemId`) REFERENCES `Items`(`id`);

ALTER TABLE `SecondaryCategory` ADD CONSTRAINT `SecondaryCategory_fk0` FOREIGN KEY (`primaryId`) REFERENCES `PrimaryCategory`(`id`);

SET character_set_client='utf8mb4';
SET character_set_results='utf8mb4';

INSERT INTO `PrimaryCategory` (id, name)
VALUES (1, 'maistas'), (2, 'statybines'), (3, 'laisvalaikio'), (4, 'buities');

INSERT INTO `SecondaryCategory` (primaryId, name)
VALUES (1, 'sviezias'), (1, 'saldytas'), (2, 'dazai'), (2, 'tapetai');


INSERT INTO `Items` (name, price, img, primaryCategory, secondaryCategory) 
VALUES 
('Obuolys', 199, '🍎', 1, 1),
('Pomidoras', 149, '🍅', 1, 1),
('Šaldyta lašiša', 799, '🐟', 1, 2),
('Šaldyta rykliena', 1099, '🦈', 1, 2),
('Balti dažai', 599, '⚪', 2, 3),
('Juodi dažai', 599, '⚫', 2, 3),
('Balti tapetai', 699, '🧻', 2, 4),
('Krepšinio kamuolys', 1099, '🏀', 3, null),
('Pačiūžos', 4550, '⛸', 3, null);