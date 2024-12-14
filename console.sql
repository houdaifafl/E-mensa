CREATE  DATABASE emensawerbeseite
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE emensawerbeseite;
CREATE TABLE gericht ( id INT8 PRIMARY KEY,
                       name VARCHAR(80) NOT NULL ,
                       beschreibung VARCHAR(800) NOT NULL ,
                       erfasst_am DATE NOT NULL ,
                       vegetarisch BOOLEAN NOT NULL ,
                       vegan BOOLEAN NOT NULL,
                       preis_intern DOUBLE NOT NULL,
                       preis_extern DOUBLE NOT NULL,
                       CONSTRAINT check_preis CHECK (preis_intern <= gericht.preis_extern)
);

CREATE TABLE allergen (code CHAR(4) PRIMARY KEY,
                       name VARCHAR(300) NOT NULL ,
                       typ VARCHAR(20) NOT NULL);


CREATE TABLE kategorie (id INT8 PRIMARY KEY,
                        name VARCHAR(80) NOT NULL ,
                        eltern_id INT8,
                        bildname VARCHAR(200),
                        FOREIGN KEY (eltern_id) REFERENCES kategorie(id));


CREATE TABLE gericht_hat_allergen ( code CHAR(4),
                                    FOREIGN KEY (code) REFERENCES allergen(code),
                                    gericht_id INT8 NOT NULL ,
                                    FOREIGN KEY (gericht_id) REFERENCES gericht(id)
);


CREATE TABLE gericht_hat_kategorie (gericht_id INT8 NOT NULL ,
                                    FOREIGN KEY (gericht_id) REFERENCES gericht(id),
                                    kategorie_id INT8 NOT NULL,
                                    FOREIGN KEY (kategorie_id) REFERENCES kategorie(id));

SELECT COUNT(*) AS allergs FROM allergen;
SELECT COUNT(*) AS gericht FROM gericht;
SELECT COUNT(*) AS Kategorien FROM kategorie;

SELECT COUNT(*) AS hat_allergen FROM gericht_hat_allergen;

SELECT COUNT(*) AS hat_Kategorie FROM gericht_hat_kategorie;

SELECT * FROM gericht;

SELECT id, erfasst_am FROM gericht;

SELECT name, erfasst_am FROM gericht ORDER BY name DESC;

SELECT name, beschreibung FROM  gericht ORDER BY name ASC LIMIT 5;

SELECT name, beschreibung FROM  gericht ORDER BY name ASC LIMIT 10 offset 5;

SELECT DISTINCT typ FROM allergen;

SELECT name FROM gericht WHERE name LIKE 'K%' or name LIKE 'k%';

SELECT id, name FROM gericht WHERE name LIKE '%suppe%';


SELECT name FROM kategorie WHERE eltern_id IS NULL;

UPDATE allergen SET name = 'Kamut' WHERE code = 'a6';

INSERT INTO gericht (id, name, beschreibung, erfasst_am, vegan, vegetarisch, preis_intern, preis_extern)
VALUES ('2', 'Currywurst mit Pommes', 'schweinfleish', '2020-08-26' , '0', '0' , '4' , '5');

INSERT INTO gericht_hat_kategorie (`kategorie_id`, `gericht_id`) VALUES (3, 2);




SELECT g.name AS gericht_name , GROUP_CONCAT(ga.code) AS Allergiencodes
FROM gericht g JOIN gericht_hat_allergen ga ON g.id = ga.gericht_id
GROUP BY g.id;

SELECT g.name AS gericht_name , GROUP_CONCAT(ga.code) AS Allergiencodes
FROM gericht g LEFT JOIN gericht_hat_allergen ga ON g.id = ga.gericht_id
GROUP BY g.id;


SELECT g.name AS gericht_name , GROUP_CONCAT(ga.code) AS Allergiencodes
FROM gericht g
         JOIN gericht_hat_allergen ga
         JOIN allergen a
              ON g.id = ga.gericht_id
GROUP BY g.id;


SELECT kategorie_id, COUNT(gericht_id) AS gerichtanzahl
FROM gericht_hat_kategorie
GROUP BY kategorie_id
ORDER BY gerichtanzahl ASC;

SELECT kategorie_id, COUNT(gericht_id) AS gerichtanzahl
FROM gericht_hat_kategorie
GROUP BY kategorie_id
HAVING gerichtanzahl > 2
ORDER BY gerichtanzahl ASC;


ALTER TABLE gericht
    ADD CONSTRAINT unique_id_constraint UNIQUE (id);

ALTER TABLE kategorie
    ADD CONSTRAINT unique_id_kconstraint UNIQUE (id);

CREATE TABLE user_data (
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL

);


SELECT COUNT(*) FROM gericht;

CREATE TABLE user_data (
                           name VARCHAR(255) NOT NULL,
                           email VARCHAR(255) NOT NULL
);



CREATE TABLE besucher (
    anzahl INT PRIMARY KEY
);
INSERT INTO besucher (anzahl) VALUES (0);




