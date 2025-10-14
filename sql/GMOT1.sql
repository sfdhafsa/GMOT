/*==============================================================*/
    /* Nom de SGBD :  MySQL 5.0                                     */
    /* Date de cr�ation :  12/09/2023 00:45:58                      */
    /*==============================================================*/
DROP TABLE IF EXISTS
    CHANTIER;
DROP TABLE IF EXISTS
    MOTEUR;
DROP TABLE IF EXISTS
    REPERE;
DROP TABLE IF EXISTS
    RESPONSABLE;
    /*==============================================================*/
    /* Table : CHANTIER                                             */
    /*==============================================================*/
CREATE TABLE CHANTIER(
    ID_CHANT INT PRIMARY KEY AUTO_INCREMENT,
    LIBEL_CHANT VARCHAR(20)
);
/*==============================================================*/
/* Table : REPERE                                               */
/*==============================================================*/
CREATE TABLE REPERE(
    ID_REP INT PRIMARY KEY AUTO_INCREMENT,
    ID_CHANT INT NOT NULL,
    LIBELLE_REP VARCHAR(20),
    DESC_REP VARCHAR(30)
);
/*==============================================================*/
/* Table : MOTEUR                                               */
/*==============================================================*/
CREATE TABLE MOTEUR(
    ID_MOT INT PRIMARY KEY AUTO_INCREMENT,
    ID_REP INT DEFAULT NULL,
    ID_RESPO INT NOT NULL,
    MATRICULE_MOT VARCHAR(10) UNIQUE NOT NULL,
    NUM_SERVICE VARCHAR(20),
    TYPE_ VARCHAR(30),
    MARQUE VARCHAR(10),
    PUISSANCE DECIMAL(10),
    COURANT_MIN DECIMAL(10),
    VITESSE_ INT,
    TENSION INT,
    COUPLAGE_ CHAR(1),
    FORME_ VARCHAR(5),
    ETAT_MOT VARCHAR(20),
    REPARE BOOLEAN,
    TYPE_REP VARCHAR(20),
    ENTREPRISE_REP VARCHAR(20),
    DATE_ENVOI_REP DATE,
    DATE_RECEP DATE
);
/*==============================================================*/
/* Table : RESPONSABLE                                          */
/*==============================================================*/
CREATE TABLE RESPONSABLE(
    ID_RESPO INT PRIMARY KEY AUTO_INCREMENT,
    USER_NAME VARCHAR(10),
    PASSWORD VARCHAR(8)
); ALTER TABLE
    MOTEUR ADD CONSTRAINT FK_AJOUTE FOREIGN KEY(ID_RESPO) REFERENCES RESPONSABLE(ID_RESPO) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE
    MOTEUR ADD CONSTRAINT FK_INSTALLE_DANS FOREIGN KEY(ID_REP) REFERENCES REPERE(ID_REP) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE
    REPERE ADD CONSTRAINT FK_CONTIENT FOREIGN KEY(ID_CHANT) REFERENCES CHANTIER(ID_CHANT) ON DELETE RESTRICT ON UPDATE RESTRICT;