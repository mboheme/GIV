#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: alerte
#------------------------------------------------------------

CREATE TABLE alerte(
        id_alerte         int (11) Auto_increment  NOT NULL ,
        date_alerte       Date ,
        descriptif_alerte Varchar (500) ,
        id_vehicule       Int ,
        PRIMARY KEY (id_alerte )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: carburant
#------------------------------------------------------------

CREATE TABLE carburant(
        id_carburant      int (11) Auto_increment  NOT NULL ,
        libelle_carburant Varchar (25) ,
        prix_carburant    Float ,
        PRIMARY KEY (id_carburant )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: categorie_vehicule
#------------------------------------------------------------

CREATE TABLE categorie_vehicule(
        id_categorie_vehicule      int (11) Auto_increment  NOT NULL ,
        libelle_categorie_vehicule Varchar (25) ,
        PRIMARY KEY (id_categorie_vehicule )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: composant_vehicule
#------------------------------------------------------------

CREATE TABLE composant_vehicule(
        id_composant_vehicule      int (11) Auto_increment  NOT NULL ,
        libelle_composant_vehicule Varchar (25) ,
        id_sous_categorie_vehicule Int ,
        PRIMARY KEY (id_composant_vehicule )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: marque_vehicule
#------------------------------------------------------------

CREATE TABLE marque_vehicule(
        id_marque_vehicule      int (11) Auto_increment  NOT NULL ,
        libelle_marque_vehicule Varchar (25) ,
        PRIMARY KEY (id_marque_vehicule )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: modele_vehicule
#------------------------------------------------------------

CREATE TABLE modele_vehicule(
        id_modele_vehicule      int (11) Auto_increment  NOT NULL ,
        libelle_modele_vehicule Varchar (25) ,
        id_marque_vehicule      Int ,
        PRIMARY KEY (id_modele_vehicule )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: sous_categorie_vehicule
#------------------------------------------------------------

CREATE TABLE sous_categorie_vehicule(
        id_sous_categorie_vehicule      int (11) Auto_increment  NOT NULL ,
        libelle_sous_categorie_vehicule Varchar (25) ,
        id_categorie_vehicule           Int ,
        PRIMARY KEY (id_sous_categorie_vehicule )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type_intervention
#------------------------------------------------------------

CREATE TABLE type_intervention(
        id_type_intervention      int (11) Auto_increment  NOT NULL ,
        libelle_type_intervention Varchar (25) ,
        PRIMARY KEY (id_type_intervention )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type_pneu
#------------------------------------------------------------

CREATE TABLE type_pneu(
        id_type_pneu              int (11) Auto_increment  NOT NULL ,
        libelle_type_pneu         Varchar (30) ,
        hiver_type_pneu           Bool ,
        type_type_pneu            Varchar (6) ,
        largeur_type_pneu         Int ,
        hauteur_largeur_type_pneu Int ,
        contruction_type_pneu     Varchar (6) ,
        diametre_roue_type_pneu   Int ,
        indice_charge_type_pneu   Int ,
        indiice_vitesse_type_pneu Int ,
        min_hiver_type_pneu       Int ,
        min_ete_type_pneu         Int ,
        id_vehicule               Int ,
        id_vitesse_pneu           Int ,
        PRIMARY KEY (id_type_pneu )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: vehicule
#------------------------------------------------------------

CREATE TABLE vehicule(
        id_vehicule                             int (11) Auto_increment  NOT NULL ,
        plaque_vehicule                         Varchar (25) ,
        litre_cent_vehicule                     Float ,
        km_vehicule                             Int ,
        serrage_ecrou_alu_vehicule              Decimal (3,1) ,
        serrage_ecrou_tole_vehicule             Decimal (3,1) ,
        pression_pneu_av_droit_vehicule         Decimal (3,1) ,
        pression_pneu_av_gauche_vehicule        Decimal (3,1) ,
        pression_pneu_ar_droit_vehicule         Decimal (3,1) ,
        pression_pneu_ar_gauche_vehicule        Decimal (3,1) ,
        epaisseur_p_frein_av_droit_vehicule     Decimal (3,1) ,
        epaisseur_p_frein_av_gauche_vehicule    Decimal (3,1) ,
        epaisseur_p_frein_ar_droit_vehicule     Decimal (3,1) ,
        epaisseur_p_frein_ar_gauche_vehicule    Decimal (3,1) ,
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
        id_modele_vehicule                      Int ,
        id_carburant                            Int ,
        PRIMARY KEY (id_vehicule )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: vitesse_pneu
#------------------------------------------------------------

CREATE TABLE vitesse_pneu(
        id_vitesse_pneu      int (11) Auto_increment  NOT NULL ,
        libelle_vitesse_pneu Varchar (25) ,
        kmh_vitesse_pneu     Int ,
        PRIMARY KEY (id_vitesse_pneu )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: intervention
#------------------------------------------------------------

CREATE TABLE intervention(
        id_intervention                             int (11) Auto_increment  NOT NULL ,
        km_vehicule                                 Int NOT NULL ,
        serrage_ecrou_alu_intervention              Float NOT NULL ,
        serrage_ecrou_tole_intervention             Float NOT NULL ,
        pression_pneu_av_droit_intervention         Float NOT NULL ,
        pression_pneu_av_gauche_intervention        Float NOT NULL ,
        pression_pneu_ar_droit_intervention         Float NOT NULL ,
        pression_pneu_ar_gauche_intervention        Float NOT NULL ,
        epaisseur_p_frein_av_droit_intervention     Float NOT NULL ,
        epaisseur_p_frein_av_gauche_intervention    Float NOT NULL ,
        epaisseur_p_frein_ar_droit_intervention     Float NOT NULL ,
        epaisseur_p_frein_ar_gauche_intervention    Float NOT NULL ,
        taille_plaquette_frein_intervention         Float NOT NULL ,
        pression_freins_intervention                Float NOT NULL ,
        usure_pneu_intervention                     Float NOT NULL ,
        niveau_huile_intervention                   Float NOT NULL ,
        niveau_liquide_refroidissement_intervention Float NOT NULL ,
        niveau_frein_intervention                   Float NOT NULL ,
        etat_es_glace_intervention                  Varchar (30) ,
        description_intervention                    Varchar (500) ,
        usure_pneu_av_droit_intervention            Int ,
        usure_pneu_av_gauche_intervention           Int ,
        usure_pneu_ar_droit_intervention            Int ,
        usure_pneu_ar_gauche_intervention           Int ,
        cout_intervention                           Float ,
        devis_intervention                          Varchar (50) ,
        facture_intervention                        Varchar (50) ,
        id_vehicule                                 Int ,
        id_type_intervention                        Int ,
        id_composant_vehicule                       Int ,
        id_utilisateur                              Int ,
        PRIMARY KEY (id_intervention )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        id_utilisateur int (11) Auto_increment  NOT NULL ,
        PRIMARY KEY (id_utilisateur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: utilise
#------------------------------------------------------------

CREATE TABLE utilise(
        id_composant_vehicule Int NOT NULL ,
        id_vehicule           Int NOT NULL ,
        PRIMARY KEY (id_composant_vehicule ,id_vehicule )
)ENGINE=InnoDB;

ALTER TABLE alerte ADD CONSTRAINT FK_alerte_id_vehicule FOREIGN KEY (id_vehicule) REFERENCES vehicule(id_vehicule);
ALTER TABLE composant_vehicule ADD CONSTRAINT FK_composant_vehicule_id_sous_categorie_vehicule FOREIGN KEY (id_sous_categorie_vehicule) REFERENCES sous_categorie_vehicule(id_sous_categorie_vehicule);
ALTER TABLE modele_vehicule ADD CONSTRAINT FK_modele_vehicule_id_marque_vehicule FOREIGN KEY (id_marque_vehicule) REFERENCES marque_vehicule(id_marque_vehicule);
ALTER TABLE sous_categorie_vehicule ADD CONSTRAINT FK_sous_categorie_vehicule_id_categorie_vehicule FOREIGN KEY (id_categorie_vehicule) REFERENCES categorie_vehicule(id_categorie_vehicule);
ALTER TABLE type_pneu ADD CONSTRAINT FK_type_pneu_id_vehicule FOREIGN KEY (id_vehicule) REFERENCES vehicule(id_vehicule);
ALTER TABLE type_pneu ADD CONSTRAINT FK_type_pneu_id_vitesse_pneu FOREIGN KEY (id_vitesse_pneu) REFERENCES vitesse_pneu(id_vitesse_pneu);
ALTER TABLE vehicule ADD CONSTRAINT FK_vehicule_id_modele_vehicule FOREIGN KEY (id_modele_vehicule) REFERENCES modele_vehicule(id_modele_vehicule);
ALTER TABLE vehicule ADD CONSTRAINT FK_vehicule_id_carburant FOREIGN KEY (id_carburant) REFERENCES carburant(id_carburant);
ALTER TABLE intervention ADD CONSTRAINT FK_intervention_id_vehicule FOREIGN KEY (id_vehicule) REFERENCES vehicule(id_vehicule);
ALTER TABLE intervention ADD CONSTRAINT FK_intervention_id_type_intervention FOREIGN KEY (id_type_intervention) REFERENCES type_intervention(id_type_intervention);
ALTER TABLE intervention ADD CONSTRAINT FK_intervention_id_composant_vehicule FOREIGN KEY (id_composant_vehicule) REFERENCES composant_vehicule(id_composant_vehicule);
ALTER TABLE intervention ADD CONSTRAINT FK_intervention_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur);
ALTER TABLE utilise ADD CONSTRAINT FK_utilise_id_composant_vehicule FOREIGN KEY (id_composant_vehicule) REFERENCES composant_vehicule(id_composant_vehicule);
ALTER TABLE utilise ADD CONSTRAINT FK_utilise_id_vehicule FOREIGN KEY (id_vehicule) REFERENCES vehicule(id_vehicule);
