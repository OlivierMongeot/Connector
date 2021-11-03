
-- Use MYSQL > 5.1 and import the script 


DROP DATABASE IF EXISTS presta_kezia_tampon;
CREATE DATABASE presta_kezia_tampon;

USE presta_kezia_tampon;
--
-- Base de données :  `presta_kezia_tampon`
--
#
# Structure de la table `WEB_ARTICLE`
#
CREATE TABLE WEB_ARTICLE (
  IDART int(10) unsigned NOT NULL default '0',
  MULTI_CODE varchar(14) default NULL,
  REF_FOU varchar(30) default NULL,
  DESIGNATION varchar(50) default NULL,
  PRIX_TTC decimal(10,2) NOT NULL default '0.00',
  PRIX_PROMO decimal(10,2) NOT NULL default '0.00',
  TAUX_TVA decimal(10,2) NOT NULL default '0.00',
  IDRAY int(11) NOT NULL default '0',  # Catégories principales
  IDFAM int(11) NOT NULL default '0',   # Sous-catégorie 
  IDSSFAM int(11) NOT NULL default '0',
  POIDS decimal(10,3) NOT NULL default '0.000',
  stock decimal(10,3) NOT NULL default '0.000',
  PhotoLarg int(11) NOT NULL default '0',
  PhotoHaut int(11) NOT NULL default '0',
  DATEENTREE varchar(8) NOT NULL default '00000000',
  COMP_DEF text,
  NOTA text,    #EAN13
  ID_FAB int(11) NOT NULL default '0',
  IDCOULEUR int(11) NOT NULL default '0',
  IDTAILLE int(11) NOT NULL default '0',
  IDMODELE int(11) NOT NULL default '0',
  PRIMARY KEY  (IDART),
  KEY IDRAY (IDRAY),
  KEY IDFAM (IDFAM),
  KEY IDSSFAM (IDSSFAM),
  KEY IDCOULEUR (IDCOULEUR),
  KEY IDTAILLE (IDTAILLE),
  KEY IDMODELE (IDMODELE)
) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_CLIENT`
#
CREATE TABLE WEB_CLIENT (
  CODE_WEB int(10) unsigned NOT NULL auto_increment,
  NOMCLI varchar(50) default NULL,
  ADR1 varchar(40) default NULL,
  ADR2 varchar(40) default NULL,
  CP varchar(5) default NULL,
  VILLE varchar(35) default NULL,
  PAYS varchar(30) default NULL,
  TELPERSO varchar(24) default NULL,
  TELPRO varchar(24) default NULL,
  GSM varchar(24) default NULL,
  EMAIL varchar(50) default NULL,
  DATECREATION varchar(10) default NULL,
  TRAITE tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (CODE_WEB)
) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_COMMANDE`
#
CREATE TABLE WEB_COMMANDE (
  NO_WEB int(10) unsigned NOT NULL auto_increment,
  CODE_WEB int(10) unsigned NOT NULL default '0',
  LIV varchar(30) default NULL,
  ADR1 varchar(30) default NULL,
  ADR2 varchar(30) default NULL,
  CP varchar(5) default NULL,
  VILLE varchar(30) default NULL,
  PAYS varchar(30) default NULL,
  DATECDE varchar(8) default NULL,
  PORT decimal(10,5) NOT NULL default '0.00000',
  MODE_DE_REGLEMENT int(11) NOT NULL default '0',  # ??? 
  NOTA text,                                        # ??
  TRAITE tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (NO_WEB),
  KEY IDCLI (CODE_WEB)
) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_FAMILLE`
#
CREATE TABLE WEB_FAMILLE (
  IDFAM int(11) NOT NULL default '0',
  IDRAY int(11) NOT NULL default '0',
  Famille varchar(20) default NULL,
  PRIMARY KEY  (IDFAM),
  KEY IDRAY (IDRAY)
) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_LI_CDE`
#
CREATE TABLE WEB_LI_CDE (
  NO_WEB int(10) unsigned NOT NULL default '0',
  IDART int(10) unsigned NOT NULL default '0',
  Q_CDE decimal(10,3) unsigned NOT NULL default '0.000',
  PRIX_TTC decimal(10,2) unsigned NOT NULL default '0.00',
  REMISE decimal(10,2) unsigned NOT NULL default '0.00',
  TAUXTVA decimal(10,2) unsigned NOT NULL default '0.00',
  TRAITE tinyint(1) unsigned NOT NULL default '0',
  KEY NO_WEB (NO_WEB),
  KEY IDART (IDART)
) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_MULTI_CODE`
#
CREATE TABLE WEB_MULTI_CODE (
  IDMULTI_CODE int(11) NOT NULL default '0',
  CODE varchar(14) default NULL,
  IDART int(11) NOT NULL default '0',
  PRIMARY KEY  (IDMULTI_CODE),
  KEY IDART (IDART)
) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_RAYON`
#
CREATE TABLE WEB_RAYON (
  IDRAY int(11) NOT NULL default '0',
  Rayon varchar(20) default NULL,
  PRIMARY KEY  (IDRAY)
) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_SSFAMILLE`
#
CREATE TABLE WEB_SSFAMILLE (
  IDSSFAM int(11) NOT NULL default '0',
  IDFAM int(11) NOT NULL default '0',
  SSFam varchar(20) default NULL,
  PRIMARY KEY  (IDSSFAM),
  KEY IDFAM (IDFAM)
) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_FABRICANT`
#
CREATE TABLE WEB_FABRICANT (
  IDFAB int(11) NOT NULL default '0',
  NOM_FAB varchar(30) default NULL,
  PRIMARY KEY  (IDFAB)
  ) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_COULEUR`
#
CREATE TABLE WEB_COULEUR (
  IDCOULEUR int(11) NOT NULL default '0',
  DES_COULEUR varchar(30) default NULL,
  PRIMARY KEY  (IDCOULEUR)
  ) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_TAILLE`
#
CREATE TABLE WEB_TAILLE (
  IDTAILLE int(11) NOT NULL default '0',
  DES_TAILLE varchar(30) default NULL,
  RANG int(2) default NULL,
  PRIMARY KEY  (IDTAILLE)
  ) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_COMPO_COULEUR`
#
CREATE TABLE WEB_COMPO_COULEUR (
  IDCOMPO_COULEUR int(11) NOT NULL default '0',
  IDGAM_CLR int(11) NOT NULL default '0',
  IDCOULEUR int(11) NOT NULL default '0',
  PRIMARY KEY  (IDCOMPO_COULEUR),
  KEY IDGAM_CLR (IDGAM_CLR),
  KEY IDCOULEUR (IDCOULEUR)
  ) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_COMPO_TAILLE`
#
CREATE TABLE WEB_COMPO_TAILLE (
  IDCOMPO_TAILLE int(11) NOT NULL default '0',
  IDGAM_TAILLE int(11) NOT NULL default '0',
  IDTAILLE int(11) NOT NULL default '0',
  PRIMARY KEY  (IDCOMPO_TAILLE),
  KEY IDGAM_TAILLE (IDGAM_TAILLE),
  KEY IDTAILLE (IDTAILLE)
  ) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_GAM_CLR`
#
CREATE TABLE WEB_GAM_CLR (
  IDGAM_CLR int(11) NOT NULL default '0',
  DES_GAM_CLR varchar(20) default NULL,
  PRIMARY KEY  (IDGAM_CLR)
  ) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_GAM_TAILLE`
#
CREATE TABLE WEB_GAM_TAILLE (
  IDGAM_TAILLE int(11) NOT NULL default '0',
  DES_GAM_TAILLE varchar(20) default NULL,
  PRIMARY KEY  (IDGAM_TAILLE)
  ) ENGINE=MYISAM;
# --------------------------------------------------------
#
# Structure de la table `WEB_MODELE`
#
CREATE TABLE WEB_MODELE (
  IDMODELE int(11) NOT NULL default '0',
  MODELE varchar(20) default NULL,
  IDGAM_CLR int(11) NOT NULL default '0',
  IDGAM_TAILLE int(11) NOT NULL default '0',
  COD_MOD VARCHAR(20),
  PRIMARY KEY  (IDMODELE),
  KEY IDGAM_TAILLE (IDGAM_TAILLE),
  KEY IDGAM_CLR (IDGAM_CLR)
  ) ENGINE=MYISAM;