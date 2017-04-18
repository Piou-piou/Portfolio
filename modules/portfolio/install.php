<?php
	$requete = "
		DROP TABLE IF EXISTS _portfolio ;
		CREATE TABLE _portfolio (
		 ID_portfolio INT  AUTO_INCREMENT NOT NULL,
		 titre VARCHAR(255),
		 description TEXT,
		 image VARCHAR(255),
		 lien VARCHAR(255), PRIMARY KEY (ID_portfolio) ) ENGINE=InnoDB;
		 
		DROP TABLE IF EXISTS _portfolio_tag ;
		CREATE TABLE _portfolio_tag (
		 ID_tag INT  AUTO_INCREMENT NOT NULL,
		 nom VARCHAR(255), PRIMARY KEY (ID_tag) ) ENGINE=InnoDB;
		 
		DROP TABLE IF EXISTS _portfolio_portfolio_tag ;
		CREATE TABLE _portfolio_portfolio_tag (
		 ID_portfolio_tag INT AUTO_INCREMENT NOT NULL,
		 ID_portfolio INT,
		 ID_tag INT NOT NULL, PRIMARY KEY (ID_portfolio_tag) ) ENGINE=InnoDB;
	";