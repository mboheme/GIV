#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: fuel
#------------------------------------------------------------

CREATE TABLE fuel(
        id    Int  Auto_increment  NOT NULL ,
        name  Varchar (25) ,
        price Decimal (2,3) COMMENT "Prix du fuel" 
	,CONSTRAINT fuel_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: component_category_cars
#------------------------------------------------------------

CREATE TABLE categorie_composant_vehicule(
        id_categorie_composant_vehicule      Int  Auto_increment  NOT NULL ,
        libelle_categorie_composant_vehicule Varchar (100)
	,CONSTRAINT categorie_composant_vehicule_PK PRIMARY KEY (id_categorie_composant_vehicule)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cars_brand
#------------------------------------------------------------

CREATE TABLE cars_brand(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (100)
	,CONSTRAINT cars_brand_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cars_model
#------------------------------------------------------------

CREATE TABLE cars_model(
        id            Int  Auto_increment  NOT NULL ,
        name          Varchar (100) ,
        id_cars_brand Int NOT NULL
	,CONSTRAINT cars_model_PK PRIMARY KEY (id)

	,CONSTRAINT cars_model_cars_brand_FK FOREIGN KEY (id_cars_brand) REFERENCES cars_brand(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: sous_categorie_composant_vehicule
#------------------------------------------------------------

CREATE TABLE sous_categorie_composant_vehicule(
        id_sous_categorie_composant_vehicule      Int  Auto_increment  NOT NULL ,
        libelle_sous_categorie_composant_vehicule Varchar (100) ,
        id_categorie_composant_vehicule           Int NOT NULL
	,CONSTRAINT sous_categorie_composant_vehicule_PK PRIMARY KEY (id_sous_categorie_composant_vehicule)

	,CONSTRAINT sous_categorie_composant_vehicule_categorie_composant_vehicule_FK FOREIGN KEY (id_categorie_composant_vehicule) REFERENCES categorie_composant_vehicule(id_categorie_composant_vehicule)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: composant_vehicule
#------------------------------------------------------------

CREATE TABLE composant_vehicule(
        id_composant_vehicule                Int  Auto_increment  NOT NULL ,
        libelle_composant_vehicule           Varchar (100) ,
        id_sous_categorie_composant_vehicule Int NOT NULL
	,CONSTRAINT composant_vehicule_PK PRIMARY KEY (id_composant_vehicule)

	,CONSTRAINT composant_vehicule_sous_categorie_composant_vehicule_FK FOREIGN KEY (id_sous_categorie_composant_vehicule) REFERENCES sous_categorie_composant_vehicule(id_sous_categorie_composant_vehicule)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type_intervention
#------------------------------------------------------------

CREATE TABLE type_intervention(
        id_type_intervention      Int  Auto_increment  NOT NULL ,
        libelle_type_intervention Varchar (25)
	,CONSTRAINT type_intervention_PK PRIMARY KEY (id_type_intervention)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cars
#------------------------------------------------------------

CREATE TABLE cars(
        id                                      Int  Auto_increment  NOT NULL ,
        numberplate                             Varchar (25) ,
        liter_cent                              Decimal (2,1) ,
        km                                      Int ,
        is_aluminum                             Decimal (3,1) ,
        front_left_tire                         Decimal (3,1) ,
        front_right_tire                        Decimal (3,1) ,
        bot_left_tyre                           Decimal (3,1) ,
        bot_right_tyre                          Decimal (3,1) ,
        taille_plaquette_frein_vehicule         Decimal (3,1) ,
        pression_freins_vehicule                Decimal (3,1) ,
        usure_pneu_vehicule                     Decimal (3,1) ,
        niveau_huile_vehicule                   Decimal (3,1) ,
        niveau_liquide_refroidissement_vehicule Decimal (3,1) ,
        niveau_frein_vehicule                   Decimal (3,1) ,
        carte_grise_vehicule                    Varchar (250) ,
        photo_vehicule                          Varchar (250) ,
        date_circulation_vehicule               Date ,
        usure_pneu_hiver_vehicule               Int ,
        usure_pneu_ete_vehicule                 Int ,
        id_cars_model                           Int NOT NULL ,
        id_fuel                                 Int NOT NULL
	,CONSTRAINT cars_PK PRIMARY KEY (id)

	,CONSTRAINT cars_cars_model_FK FOREIGN KEY (id_cars_model) REFERENCES cars_model(id)
	,CONSTRAINT cars_fuel0_FK FOREIGN KEY (id_fuel) REFERENCES fuel(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: vitesse_pneu
#------------------------------------------------------------

CREATE TABLE vitesse_pneu(
        id_vitesse_pneu      Int  Auto_increment  NOT NULL ,
        libelle_vitesse_pneu Varchar (25) ,
        kmh_vitesse_pneu     Int
	,CONSTRAINT vitesse_pneu_PK PRIMARY KEY (id_vitesse_pneu)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: tires_type
#------------------------------------------------------------

CREATE TABLE tires_type(
        id              Int  Auto_increment  NOT NULL ,
        name            Varchar (30) ,
        is_winter       Bool COMMENT "Le types des pneumatiques"  ,
        type            Varchar (6) COMMENT "type_type_pneu"  ,
        height          Int ,
        width           Int ,
        contruction     Varchar (6) ,
        diametre        Int ,
        charge          Int ,
        speed           Int ,
        km_h_speed      Decimal (3) ,
        min_iswinter    Int COMMENT "Le type de pneumatique"  ,
        pressure        Decimal (3,1) ,
        wear            Decimal (3,1) ,
        oil             Decimal (3,1) ,
        cooling         Decimal (3,1) ,
        brake           Decimal (3,1) ,
        id_cars         Int ,
