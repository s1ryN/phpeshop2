DROP DATABASE IF EXISTS viktorklucina;
CREATE DATABASE viktorklucina;
USE viktorklucina;

-- obrázky pro produkty
DROP TABLE IF EXISTS obrazek;
CREATE TABLE obrazek (
  idobrazek INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
  name VARCHAR(255) NOT NULL,
  cesta VARCHAR(255) NOT NULL
);

-- platebky
DROP TABLE IF EXISTS platebnimetoda;
CREATE TABLE platebnimetoda (
  idplatebnimetoda INT(11) NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  cislokarty VARCHAR(45) NOT NULL,
  cvv INT(11) NOT NULL,
  datum VARCHAR(45) NOT NULL
);

-- produkty
DROP TABLE IF EXISTS produkt;
CREATE TABLE produkt (
  idprodukt INT(11) NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
  nazev VARCHAR(45) NOT NULL,
  popis VARCHAR(200) NOT NULL,
  cena VARCHAR(45) NOT NULL,
  obrazek_idobrazek INT(11) NOT NULL,
  FOREIGN KEY (obrazek_idobrazek) REFERENCES obrazek(idobrazek)
);

-- uživatelé
DROP TABLE IF EXISTS user;
CREATE TABLE user (
  iduser INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
  jmeno VARCHAR(45) NOT NULL,
  primeni VARCHAR(45) NOT NULL,
  heslo VARCHAR(255) NOT NULL,
  ICO VARCHAR(8) NOT NULL,
  ulicecp VARCHAR(255) NOT NULL,
  mesto VARCHAR(255) NOT NULL,
  PSC INT(5) NOT NULL,
  telefon VARCHAR(45) NOT NULL,
  email VARCHAR(255) NOT NULL,
  platebnimetoda_idplatebnimetoda INT(11) NOT NULL,
  FOREIGN KEY (platebnimetoda_idplatebnimetoda) REFERENCES platebnimetoda(idplatebnimetoda)
);

-- možnosti dopravy
DROP TABLE IF EXISTS doprava;
CREATE TABLE doprava (
  iddoprava INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
  nazev VARCHAR(255) NOT NULL
);

INSERT INTO doprava (nazev) VALUES
('Zásilkovna'),
('Česká Pošta'),
('PPL'),
('Osobní převzetí');

-- možnosti platby
DROP TABLE IF EXISTS platba;
CREATE TABLE platba (
  idplatba INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
  nazev VARCHAR(255) NOT NULL
);

INSERT INTO platba (nazev) VALUES
('Platba kartou online');

-- objednavky pro fakturu
DROP TABLE IF EXISTS faktura;
CREATE TABLE faktura (
  idfaktura INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
  datumobjednani TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  datumdoruceni DATETIME NOT NULL,
  datumsplatnosti TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  datumvystaveni DATETIME NOT NULL,
  celkovacena INT(11) NOT NULL,
  user_iduser INT(11) NOT NULL,
  doprava_iddoprava INT(11) NOT NULL,
  platba_idplatba INT(11) NOT NULL,
  FOREIGN KEY (user_iduser) REFERENCES user(iduser),
  FOREIGN KEY (doprava_iddoprava) REFERENCES doprava(iddoprava),
  FOREIGN KEY (platba_idplatba) REFERENCES platba(idplatba)
);

DROP TABLE IF EXISTS produkty;
CREATE TABLE produkty (
  idprodukty INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
  pocet INT(11) NOT NULL,
  cenaks INT(11) NOT NULL,
  produkt_idprodukt INT(11) NOT NULL,
  faktura_idfaktura INT(11) NOT NULL,
  FOREIGN KEY (produkt_idprodukt) REFERENCES produkt(idprodukt),
  FOREIGN KEY (faktura_idfaktura) REFERENCES faktura(idfaktura)
);

