#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: alerte
#------------------------------------------------------------

CREATE TABLE alerte(
        id             int (11) Auto_increment  NOT NULL ,
        name           Varchar (250) ,
        password       Char (250) ,
        date           Date ,
        description    Varchar (500) ,
        id_vehicule    Int ,
        id_utilisateur Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: carburant
#------------------------------------------------------------

CREATE TABLE carburant(
        id    int (11) Auto_increment  NOT NULL ,
        name  Varchar (25) ,
        value Decimal (5,3) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: categorie
#------------------------------------------------------------

CREATE TABLE categorie(
        id   int (11) Auto_increment  NOT NULL ,
        name Varchar (100) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: composant
#------------------------------------------------------------

CREATE TABLE composant(
        id               int (11) Auto_increment  NOT NULL ,
        name             Varchar (100) ,
        id_souscategorie Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: marque
#------------------------------------------------------------

CREATE TABLE marque(
        id   int (11) Auto_increment  NOT NULL ,
        name Varchar (100) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: modele
#------------------------------------------------------------

CREATE TABLE modele(
        id        int (11) Auto_increment  NOT NULL ,
        name      Varchar (100) ,
        id_marque Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: souscategorie
#------------------------------------------------------------

CREATE TABLE souscategorie(
        id           int (11) Auto_increment  NOT NULL ,
        name         Varchar (100) ,
        id_categorie Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: pneu
#------------------------------------------------------------

CREATE TABLE pneu(
        id              int (11) Auto_increment  NOT NULL ,
        name            Varchar (30) ,
        hiver           Bool ,
        type            Varchar (6) ,
        largeur         Int ,
        hauteur         Int ,
        contruction     Varchar (6) ,
        diametre_roue   Int ,
        indice_charge   Int ,
        indiice_vitesse Int ,
        min_hiver       Int ,
        min_ete         Int ,
        id_composant    Int ,
        id_vitesse      Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: vehicule
#------------------------------------------------------------

CREATE TABLE vehicule(
        id           int (11) Auto_increment  NOT NULL ,
        name         Varchar (250) ,
        plaque       Varchar (25) ,
        litre_cent   Decimal (2,1) ,
        kilometre    Int ,
        carte_grise  Varchar (250) ,
        photo        Varchar (250) ,
        date         Date ,
        id_modele    Int ,
        id_carburant Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: vitesse
#------------------------------------------------------------

CREATE TABLE vitesse(
        id              int (11) Auto_increment  NOT NULL ,
        name            Varchar (25) ,
        kilometre_heure Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: intervention
#------------------------------------------------------------

CREATE TABLE intervention(
        id             int (11) Auto_increment  NOT NULL ,
        kilometre      Int NOT NULL ,
        description    Varchar (500) ,
        cout           Decimal (9,2) ,
        devis          Varchar (50) ,
        facture        Varchar (50) ,
        id_utilisateur Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        id int (11) Auto_increment  NOT NULL ,
        email          Varchar (100) ,
        password       Varchar (500) ,
        name           Varchar (250) ,
        function       Varchar (250) ,
        id_groupe      Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: serrage
#------------------------------------------------------------

CREATE TABLE serrage(
        id              int (11) Auto_increment  NOT NULL ,
        value           Decimal (5,3) ,
        id_intervention Int ,
        id_composant    Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: pression
#------------------------------------------------------------

CREATE TABLE pression(
        id              int (11) Auto_increment  NOT NULL ,
        value           Decimal (5,3) ,
        id_intervention Int ,
        id_composant    Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: epaisseur
#------------------------------------------------------------

CREATE TABLE epaisseur(
        id              int (11) Auto_increment  NOT NULL ,
        value           Decimal (5,3) ,
        id_intervention Int ,
        id_composant    Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: usure
#------------------------------------------------------------

CREATE TABLE usure(
        id              int (11) Auto_increment  NOT NULL ,
        value           Decimal (5,3) ,
        id_intervention Int ,
        id_composant    Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: etat
#------------------------------------------------------------

CREATE TABLE etat(
        id              int (11) Auto_increment  NOT NULL ,
        value           Decimal (5,3) ,
        id_intervention Int ,
        id_composant    Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: niveau
#------------------------------------------------------------

CREATE TABLE niveau(
        id              int (11) Auto_increment  NOT NULL ,
        value           Decimal (5,3) ,
        id_intervention Int ,
        id_composant    Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: groupe
#------------------------------------------------------------

CREATE TABLE groupe(
        id   int (11) Auto_increment  NOT NULL ,
        name Varchar (250) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: droit
#------------------------------------------------------------

CREATE TABLE droit(
        id int (11) Auto_increment  NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: compasant_vehicule
#------------------------------------------------------------

CREATE TABLE compasant_vehicule(
        id          Int NOT NULL ,
        id_vehicule Int NOT NULL ,
        PRIMARY KEY (id ,id_vehicule )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: vehicule_utilisateur
#------------------------------------------------------------

CREATE TABLE vehicule_utilisateur(
        id_utilisateur Int NOT NULL ,
        id             Int NOT NULL ,
        PRIMARY KEY (id_utilisateur ,id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: droit_groupe
#------------------------------------------------------------

CREATE TABLE droit_groupe(
        id        Int NOT NULL ,
        id_groupe Int NOT NULL ,
        PRIMARY KEY (id ,id_groupe )
)ENGINE=InnoDB;

ALTER TABLE alerte ADD CONSTRAINT FK_alerte_id_vehicule FOREIGN KEY (id_vehicule) REFERENCES vehicule(id);
ALTER TABLE alerte ADD CONSTRAINT FK_alerte_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id);
ALTER TABLE composant ADD CONSTRAINT FK_composant_id_souscategorie FOREIGN KEY (id_souscategorie) REFERENCES souscategorie(id);
ALTER TABLE modele ADD CONSTRAINT FK_modele_id_marque FOREIGN KEY (id_marque) REFERENCES marque(id);
ALTER TABLE souscategorie ADD CONSTRAINT FK_souscategorie_id_categorie FOREIGN KEY (id_categorie) REFERENCES categorie(id);
ALTER TABLE pneu ADD CONSTRAINT FK_pneu_id_composant FOREIGN KEY (id_composant) REFERENCES composant(id);
ALTER TABLE pneu ADD CONSTRAINT FK_pneu_id_vitesse FOREIGN KEY (id_vitesse) REFERENCES vitesse(id);
ALTER TABLE vehicule ADD CONSTRAINT FK_vehicule_id_modele FOREIGN KEY (id_modele) REFERENCES modele(id);
ALTER TABLE vehicule ADD CONSTRAINT FK_vehicule_id_carburant FOREIGN KEY (id_carburant) REFERENCES carburant(id);
ALTER TABLE intervention ADD CONSTRAINT FK_intervention_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id);
ALTER TABLE utilisateur ADD CONSTRAINT FK_utilisateur_id_groupe FOREIGN KEY (id_groupe) REFERENCES groupe(id);
ALTER TABLE serrage ADD CONSTRAINT FK_serrage_id_intervention FOREIGN KEY (id_intervention) REFERENCES intervention(id);
ALTER TABLE serrage ADD CONSTRAINT FK_serrage_id_composant FOREIGN KEY (id_composant) REFERENCES composant(id);
ALTER TABLE pression ADD CONSTRAINT FK_pression_id_intervention FOREIGN KEY (id_intervention) REFERENCES intervention(id);
ALTER TABLE pression ADD CONSTRAINT FK_pression_id_composant FOREIGN KEY (id_composant) REFERENCES composant(id);
ALTER TABLE epaisseur ADD CONSTRAINT FK_epaisseur_id_intervention FOREIGN KEY (id_intervention) REFERENCES intervention(id);
ALTER TABLE epaisseur ADD CONSTRAINT FK_epaisseur_id_composant FOREIGN KEY (id_composant) REFERENCES composant(id);
ALTER TABLE usure ADD CONSTRAINT FK_usure_id_intervention FOREIGN KEY (id_intervention) REFERENCES intervention(id);
ALTER TABLE usure ADD CONSTRAINT FK_usure_id_composant FOREIGN KEY (id_composant) REFERENCES composant(id);
ALTER TABLE etat ADD CONSTRAINT FK_etat_id_intervention FOREIGN KEY (id_intervention) REFERENCES intervention(id);
ALTER TABLE etat ADD CONSTRAINT FK_etat_id_composant FOREIGN KEY (id_composant) REFERENCES composant(id);
ALTER TABLE niveau ADD CONSTRAINT FK_niveau_id_intervention FOREIGN KEY (id_intervention) REFERENCES intervention(id);
ALTER TABLE niveau ADD CONSTRAINT FK_niveau_id_composant FOREIGN KEY (id_composant) REFERENCES composant(id);
ALTER TABLE compasant_vehicule ADD CONSTRAINT FK_compasant_vehicule_id FOREIGN KEY (id) REFERENCES composant(id);
ALTER TABLE compasant_vehicule ADD CONSTRAINT FK_compasant_vehicule_id_vehicule FOREIGN KEY (id_vehicule) REFERENCES vehicule(id);
ALTER TABLE vehicule_utilisateur ADD CONSTRAINT FK_vehicule_utilisateur_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id);
ALTER TABLE vehicule_utilisateur ADD CONSTRAINT FK_vehicule_utilisateur_id FOREIGN KEY (id) REFERENCES vehicule(id);
ALTER TABLE droit_groupe ADD CONSTRAINT FK_droit_groupe_id FOREIGN KEY (id) REFERENCES droit(id);
ALTER TABLE droit_groupe ADD CONSTRAINT FK_droit_groupe_id_groupe FOREIGN KEY (id_groupe) REFERENCES groupe(id);
