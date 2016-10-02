create database parking;
use parking;
#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: MEMBRE
#------------------------------------------------------------

CREATE TABLE MEMBRE(
        id_membre         Int NOT NULL AUTO_INCREMENT,
        mail_membre       Varchar (255) ,
        psw_membre        Varchar (255) ,
        civilite_membre   Varchar (5) ,
        nom_membre        Varchar (30) ,
        prenom_membre     Varchar (30) ,
        date_naiss_membre Date ,
        adRue_membre      Varchar (100) ,
        adCP_membre       Varchar (5) ,
        adVille_membre    Varchar (50) ,
        rang              Int ,
        valide_membre     Boolean ,
        admin_membre      Boolean ,

        PRIMARY KEY (id_membre )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PLACE
#------------------------------------------------------------

CREATE TABLE PLACE(
        id_place  Int NOT NULL AUTO_INCREMENT,
        num_place Int ,
        active_place Boolean ,
        PRIMARY KEY (id_place )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PERIODE
#------------------------------------------------------------

CREATE TABLE PERIODE(
        date_debut_periode Date NOT NULL ,
        PRIMARY KEY (date_debut_periode )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RESERVER
#------------------------------------------------------------

CREATE TABLE RESERVER(
        date_fin_periode   Date ,
        id_membre          Int NOT NULL ,
        id_place           Int NOT NULL ,
        date_debut_periode Date NOT NULL ,
        PRIMARY KEY (id_membre ,id_place ,date_debut_periode )
)ENGINE=InnoDB;

ALTER TABLE RESERVER ADD CONSTRAINT FK_RESERVER_id_membre FOREIGN KEY (id_membre) REFERENCES MEMBRE(id_membre);
ALTER TABLE RESERVER ADD CONSTRAINT FK_RESERVER_id_place FOREIGN KEY (id_place) REFERENCES PLACE(id_place);
ALTER TABLE RESERVER ADD CONSTRAINT FK_RESERVER_date_debut_periode FOREIGN KEY (date_debut_periode) REFERENCES PERIODE(date_debut_periode);
