create database Parking;
use Parking;

#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: MEMBRE
#------------------------------------------------------------

CREATE TABLE MEMBRE(
        id_membre         Int (11) NOT NULL AUTO_INCREMENT ,
        mail_membre       varchar (255) ,
        psw_membre        varchar (255) ,
        civilite_membre   Varchar (5) ,
        nom_membre        Varchar (30) ,
        prenom_membre     Varchar (30) ,
        date_naiss_membre Date ,
        adRue_membre      Varchar (100) ,
        adCP_membre       Varchar (5) ,
        adVille_membre    Varchar (50) ,
        valide_membre     Bool ,
        admin_membre      Bool ,
        PRIMARY KEY (id_membre )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PLACE
#------------------------------------------------------------

CREATE TABLE PLACE(
        id_place  Int (11) NOT NULL AUTO_INCREMENT ,
        num_place Int ,
        PRIMARY KEY (id_place )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PERIODE
#------------------------------------------------------------

CREATE TABLE PERIODE(
        id_periode         Int(11) NOT NULL AUTO_INCREMENT ,
        date_debut_periode Date ,
        duree_periode      Int ,
        PRIMARY KEY (id_periode )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RESERVER
#------------------------------------------------------------

CREATE TABLE RESERVER(
        id_membre  Int NOT NULL ,
        id_place   Int NOT NULL ,
        id_periode Int NOT NULL ,
        PRIMARY KEY (id_membre ,id_place ,id_periode )
)ENGINE=InnoDB;

ALTER TABLE RESERVER ADD CONSTRAINT FK_RESERVER_id_membre FOREIGN KEY (id_membre) REFERENCES MEMBRE(id_membre);
ALTER TABLE RESERVER ADD CONSTRAINT FK_RESERVER_id_place FOREIGN KEY (id_place) REFERENCES PLACE(id_place);
ALTER TABLE RESERVER ADD CONSTRAINT FK_RESERVER_id_periode FOREIGN KEY (id_periode) REFERENCES PERIODE(id_periode);